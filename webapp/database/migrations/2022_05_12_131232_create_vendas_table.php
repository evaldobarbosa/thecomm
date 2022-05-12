<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importacoes', function (Blueprint $table) {
            $table->id();

            $table->string('arquivo', 50);
            $table->timestamp('importado_em');

            $table->timestamps();
        });

        Schema::create('vendas', function (Blueprint $table) {
            $table->id();

            $table->text('descricao');
            $table->float('preco');
            $table->float('quantidade');
            $table->string('endereco', 255);

            $table->foreignId('comprador_id')->constrained('users');
            $table->foreignId('fornecedor_id')->constrained('users');

            $table->timestamps();
        });

        Schema::create('vendas_importacoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('venda_id')->constrained('vendas');
            $table->foreignId('importacao_id')->constrained('importacoes');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'tipo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('tipo');
            });
        }

        Schema::dropIfExists('vendas_importacoes');
        Schema::dropIfExists('vendas');
        Schema::dropIfExists('importacoes');
    }
};
