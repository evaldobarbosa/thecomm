<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Testing\File as FakeFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EnviarArquivoCSVTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_acessar_form_pela_home()
    {
        $this->artisan('db:seed', ['--class' => 'DadosTestesAutomaticos']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Evaldo',
            'email' => 'evaldo@mrlucky.com.br',
        ]);
        
        $this->actingAs($user)
            ->visitRoute("home")
            ->see("Importações")
            ->seeInElement("#file-ttl-00003", "Arquivo XYZ")
            ->seeInElement("#file-desc-00003", "Importado em 10/02/2022 10:01")
            ->seeInElement("#file-qtd-00003", "7")
            ->click('Novo')
            ->seeInElement("#btn-send-csv-label", "Selecionar arquivo");

    }

    public function test_enviar_csv_com_sucesso()
    {
        $this->artisan('db:seed', ['--class' => 'DadosTestesAutomaticos']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Evaldo',
            'email' => 'evaldo@mrlucky.com.br',
        ]);

        $disco = Storage::fake('csv');

        $content = file_get_contents( realpath(__DIR__ . "/../fixtures/dados.txt") );
        $csv = FakeFile::fake()->createWithContent('/tmp/teste.csv', $content);
        
        $request = $this->actingAs($user)
            ->visitRoute("importacao.selecionar")
            ->attach($csv, "mycsv")
            ->press('Selecionar arquivo')
            ->seeInElement('#success-title', 'Upload realizado')
            ->seeInElement('#success-message', 'Você será informado quando o arquivo for processado');

        $ex = explode("/", $csv->getPathname());
        $file = end($ex);

        $this->actingAs($user)
            ->visitRoute("home")
            ->seeInElement("#file-ttl-00004", $file)
            ->seeInElement("#file-vlr-00004", 'R$ 95,00')
            ->seeInElement("#file-qtd-00004", "4 registros");
    }
}
