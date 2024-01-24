<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            [
                'title' => 'Introdução a ciência de dados.',
                'desc' => 'Introdução ao curso de ciência de dados.',
                'order' => 1,
                'curso_id' => 1
            ], 
            [
                'title' => 'Tratamento de dados.',
                'desc' => 'Os dados disponiveis para o estudo, deverão ser tradados antes de mais nada.',
                'order' => 2,
                'curso_id' => 1
            ], 
            [
                'title' => 'Leitura e interpretação de dados.',
                'desc' => 'Os dados após serem tratados, deverão ser lidos corretamente e interpretados.',
                'order' => 3,
                'curso_id' => 1
            ], 

            [
                'title' => 'Introdução a linguagem Python.',
                'desc' => 'Introdução ao curso de linguagem Python.',
                'order' => 1,
                'curso_id' => 2
            ], 
            [
                'title' => 'Variáveis e seus tipos.',
                'desc' => 'Aprendendo mais sobre variáveis e seus tipos no python.',
                'order' => 2,
                'curso_id' => 2
            ], 
            [
                'title' => 'Bibliotecas.',
                'desc' => 'Explorando as bibliotecas mais usadas e uteis no Python.',
                'order' => 3,
                'curso_id' => 2
            ], 
        ]);

        Modulo::factory()->count(50)->create();
    }
}
