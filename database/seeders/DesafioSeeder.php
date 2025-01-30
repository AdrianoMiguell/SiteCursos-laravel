<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesafioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desafios')->insert([
            [
                'title' => 'Desafio : Conhecimentos basicos do Python',
                'text' => 'Complete o desafio abaixo. Baixe o pdf e responda as questões.',
                'link' => '/files/uploads/questoes-teste.pdf',
            ], [
                'title' => 'Desafio : Variaveis e tipos',
                'text' => 'Complete o desafio abaixo. Baixe o pdf e responda as questões.',
                'link' => '/files/uploads/questoes-teste.pdf',
            ],
            [
                'title' => 'Desafio : Bibliotecas',
                'text' => 'Complete o desafio abaixo. Baixe o pdf e responda as questões.',
                'link' => '/files/uploads/questoes-teste.pdf',
            ]
        ]);
        // 3
    }
}
