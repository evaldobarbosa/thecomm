<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (config('app.env') == 'local') {
            \App\Models\User::create([
                'name' => 'Evaldo Barbosa',
                'email' => 'evaldobarbosa@gmail.com',
                'password' => bcrypt('teste123'),
                'tipo' => 'usuario',
            ]);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
