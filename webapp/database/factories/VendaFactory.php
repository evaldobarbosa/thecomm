<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'preco' => mt_rand(10, 99),
            'descricao' => $this->faker->sentence(),
            'quantidade' => mt_rand(1, 10),
            'endereco' => 'rua xyz', //$this->faker->address(),
            'comprador_id' => \App\Models\User::factory()->comprador()->create(),
            'fornecedor_id' => \App\Models\User::factory()->fornecedor()->create(),
        ];
    }
}
