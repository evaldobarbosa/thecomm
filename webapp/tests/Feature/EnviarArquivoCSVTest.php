<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\File;
// use Illuminate\Http\Testing\File;
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
        $user = \App\Models\User::factory()->create([
            'name' => 'Evaldo',
            'email' => 'evaldo@mrlucky.com.br',
        ]);
        
        $this->actingAs($user)
            ->visitRoute("home")
            ->see("Importações")
            ->seeInElement("#file-ttl-0001", "Arquivo XYZ")
            ->seeInElement("#file-desc-0001", "Importado em 10/02/2022 10:01")
            ->click('Novo')
            ->seeInElement("#btn-send-csv-label", "Selecionar arquivo");

    }

    public function test_enviar_csv_com_sucesso()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Evaldo',
            'email' => 'evaldo@mrlucky.com.br',
        ]);

        $csv = new File('/tmp/teste.csv', 1000, 'text/csv');

        Storage::fake('csv');
        
        $request = $this->actingAs($user)
            ->visitRoute("importacao.selecionar")
            ->attach($csv, "mycsv")
            ->press('Selecionar arquivo')
            ->seeInElement('#success-title', 'Upload realizado')
            ->seeInElement('#success-message', 'Você será informado quando o arquivo for processado');

        Storage::assertExists('csv/teste.csv');
    }
}
