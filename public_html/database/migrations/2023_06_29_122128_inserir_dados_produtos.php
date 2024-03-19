<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('produtos')->insert([
            ['id' => 1, 'descricao' => 'Terreno'],
            ['id' => 2, 'descricao' => 'Casa'],
            ['id' => 3, 'descricao' => 'Apartamento'],
            ['id' => 4, 'descricao' => 'Chacara'],
            ['id' => 5, 'descricao' => 'Barracao'],
            ['id' => 6, 'descricao' => 'Galpao'],
            ['id' => 7, 'descricao' => 'Predio'],
            ['id' => 8, 'descricao' => 'Sala'],
            ['id' => 9, 'descricao' => 'Salao'],
            ['id' => 10, 'descricao' => 'Loja'],
            ['id' => 11, 'descricao' => 'Sitio'],
            ['id' => 12, 'descricao' => 'Hotel'],
            ['id' => 13, 'descricao' => 'Area'],
            ['id' => 14, 'descricao' => 'Cobertura'],
            ['id' => 15, 'descricao' => 'Flat'],
            ['id' => 16, 'descricao' => 'Kitnet'],
            ['id' => 17, 'descricao' => 'Studio'],

            // Adicione mais registros, se necessário
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('produtos')->truncate();
    }
};
