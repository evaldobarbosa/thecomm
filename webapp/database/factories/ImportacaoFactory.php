<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Importacao>
 */
class ImportacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'arquivo' => 'Arquivo ' . str()->random(3),
            'importado_em' => \Carbon\Carbon::now(),
        ];
    }
}
