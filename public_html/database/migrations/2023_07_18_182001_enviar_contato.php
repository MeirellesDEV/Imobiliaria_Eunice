<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->string('mensagem');
            $table->string('motivoContato')->nullable();
            $table->string('cod_imovel')->nullable();
            $table->boolean('resolvido');
            $table->timestamps();

            // $table->foreign('cod_imovel')->references('cod_imovel')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};