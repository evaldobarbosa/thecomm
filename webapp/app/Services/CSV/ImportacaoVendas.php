<?php
namespace App\Services\CSV;

use App\Models\Venda;
use \App\Models\User;
use App\Exceptions\CSV\InvalidHeaderException;
use App\Exceptions\CSV\InterruptedImportingException;
use SplFileInfo;

class ImportacaoVendas
{
	// private string $csv;
	
	public function processar($csv)
	{
		\DB::transaction(function () use ($csv) {

			$importacao = \App\Models\Importacao::create([
				'arquivo' => (new SplFileInfo($csv))->getFilename(),
				'importado_em' => now(),
			]);

			$reader = new CSVReader($csv, "\t");
			foreach($reader->rows() as $key => $row) {
				if ($key == 0) {
					if (!$this->validarCabecalho($row)) {
						throw new InvalidHeaderException("A primeira linha não contém as colunas aguardadas");
					}

					continue;
				}

				$comprador = $this->buscaComprador(current($row));
				$fornecedor = $this->buscaFornecedor(end($row));

				$venda = Venda::factory()->create([
					'comprador_id' => $comprador->id,
					'fornecedor_id' => $fornecedor->id,
					'descricao' => $row[1],
					'preco' => $row[2],
					'quantidade' => $row[3],
					'endereco' => $row[4],
				]);

				$venda->vincularImportacao($importacao);
			}

		});
	}

	public function buscaFornecedor($nome)
	{
		$registro = User::where('tipo', 'fornecedor')->where('name', $nome)->first();

		if (is_null($registro)) {
			$registro = User::factory()->fornecedor()->create(['name' => $nome]);
		}

		return $registro;
	}

	public function buscaComprador($nome)
	{
		$registro = User::where('tipo', 'comprador')->where('name', $nome)->first();

		if (is_null($registro)) {
			$registro = User::factory()->comprador()->create(['name' => $nome]);
		}

		return $registro;
	}

	private function validarCabecalho($cabecalho)
	{
		$colunas =  ["Comprador", "Descrição", "Preço Unitário", "Quantidade", "Endereço", "Fornecedor"];

		return ($cabecalho == $colunas);
	}
}