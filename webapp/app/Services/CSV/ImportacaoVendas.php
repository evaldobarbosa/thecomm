<?php
namespace App\Services\CSV;

use App\Models\Venda;
use \App\Models\User;
use App\Exceptions\CSV\InvalidHeaderException;
use SplFileInfo;
use Illuminate\Support\Facades\Storage;

class ImportacaoVendas
{	
	public function processar($hash)
	{
		\DB::transaction(function () use ($hash) {
			$importacao = \App\Models\Importacao::where('hash', hash('sha1', $hash))->first();

			$reader = new CSVReader(
				Storage::path(
					sprintf('csv/%s.csv', $importacao->hash)
				),
				"\t"
			);
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

			\Log::info("Arquivo {$importacao->arquivo} importado");
		});
	}

	public function novoArquivo($csv)
	{
		\DB::beginTransaction();

		try {
			$importacao = \App\Models\Importacao::create([
				'arquivo' => (new SplFileInfo($csv))->getFilename(),
				'importado_em' => now(),
				'hash' => hash('sha1', $csv),
			]);

			Storage::move(
				"csv/" . (new SplFileInfo($csv))->getFilename(),
				"csv/" . hash('sha1', $csv) . ".csv"
			);

			\DB::commit();

			return hash('sha1', $csv);
		} catch (\Exception $e) {
			\DB::rollback();

			\Log::error("Problema ao movimentar arquivo {$csv} para hash");

			throw new \InvalidArgumentException("Tivemos uma falha no armazenamento do arquivo. Tente novamente mais tarde", 1);
			
		}
	}

	public static function verificarDuplicacao(string $csv):bool
	{
		return \App\Models\Importacao::where('hash', hash('sha1', $csv))->exists();
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