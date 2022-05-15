<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CSV\ImportacaoVendas;
use Illuminate\Support\Facades\Storage;

class ProcessamentoArquivoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_arquivo_deve_ser_processado_com_sucesso()
    {
        $arquivo = $this->criaArquivo();

        $imp = new ImportacaoVendas;
        $hash = $imp->novoArquivo($arquivo);
        $imp->processar($hash);

        $this->assertEquals(4, \App\Models\Venda::count());
        $this->assertEquals('João Silva', \App\Models\Venda::first()->comprador->name);
        $this->assertEquals('dados.csv', \App\Models\Venda::first()->importacao->arquivo);
    }

    public function test_erro_ao_processar_colunas_erradas()
    {
        $this->expectException(\App\Exceptions\CSV\InvalidHeaderException::class);
        $this->expectExceptionMessage('A primeira linha não contém as colunas aguardadas');

        $arquivo = $this->criaArquivo();

        file_put_contents($arquivo, "A\tB\nFulano\tBurgão");

        $imp = new ImportacaoVendas;
        $hash = $imp->novoArquivo($arquivo);
        $imp->processar($hash);
    }

    private function criaArquivo()
    {
        $csv = realpath(__DIR__ . '/../fixtures/dados.txt');
        $hash = hash_file('sha1', $csv);

        Storage::fake('csv');

        $tempcsv = "/tmp/{$hash}.csv";

        copy($csv, Storage::path('csv') . "/dados.csv");

        $this->adicionarCompradoresEFornecedores($tempcsv);

        return Storage::path("csv/dados.csv");
    }

    private function adicionarCompradoresEFornecedores($csv)
    {

        $reader = new \App\Services\CSV\CSVReader($csv, "\t");

        foreach($reader->rows() as $key => $row) {
            if ($key == 0) {
                continue;
            }

            \App\Models\User::factory()->comprador()->create([
                'name' => current($row),
            ]);

            \App\Models\User::factory()->fornecedor()->create([
                'name' => end($row),
            ]);
        }

    }


}
