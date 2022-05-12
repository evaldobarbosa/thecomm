<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CSV\ImportacaoVendas;

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
        $csv = realpath(__DIR__ . '/../fixtures/dados.txt');

        $this->adicionarCompradoresEFornecedores($csv);

        $imp = new ImportacaoVendas;
        $imp->processar($csv);

        $this->assertEquals(4, \App\Models\Venda::count());
        $this->assertEquals('João Silva', \App\Models\Venda::first()->comprador->name);
        $this->assertEquals('dados.txt', \App\Models\Venda::first()->importacao->arquivo);
    }

    public function test_erro_ao_processar_colunas_erradas()
    {
        $this->expectException(\App\Exceptions\CSV\InvalidHeaderException::class);
        $this->expectExceptionMessage('A primeira linha não contém as colunas aguardadas');

        $arq = "/tmp/colunas_ruins.txt";

        file_put_contents($arq, "A\tB\nFulano\tBurgão");

        $csv = realpath($arq);
        $imp = new ImportacaoVendas;
        $imp->processar($csv);
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
