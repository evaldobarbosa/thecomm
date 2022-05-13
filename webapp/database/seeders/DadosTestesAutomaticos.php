<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DadosTestesAutomaticos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imp1 = \App\Models\Importacao::factory()->create([
            'arquivo' => 'Arquivo ABC',
            'importado_em' => '2022-02-01 14:13',
        ]);

        foreach(range(1,3) as $row) {
            $venda = \App\Models\Venda::factory()->create();
            $venda->vincularImportacao($imp1);
        }

        $imp2 = \App\Models\Importacao::factory()->create([
            'arquivo' => 'Arquivo GHI',
            'importado_em' => '2022-02-08 09:11',
        ]);

        foreach(range(1,10) as $row) {
            $venda = \App\Models\Venda::factory()->create();
            $venda->vincularImportacao($imp2);
        }

        $imp3 = \App\Models\Importacao::factory()->create([
            'arquivo' => 'Arquivo XYZ',
            'importado_em' => '2022-02-10 10:01',
        ]);

        foreach(range(1,7) as $row) {
            $venda = \App\Models\Venda::factory()->create();
            $venda->vincularImportacao($imp3);
        }
    }
}
