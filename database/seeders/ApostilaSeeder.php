<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApostilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apostilas')->insert([
            [
                'title' => 'Introdução',
                'text' => 'Introdução do curso de Python.',
                'link' => '/files/uploads/apostila-teste.pdf',
            ], [
                'title' => 'O que veremos no curso de Python',
                'text' => 'Uma apresentação do que veremos ao longo deste curso.',
                'link' => '/files/uploads/apostila-teste.pdf',
            ],
            [
                'title' => 'Variáveis no Python',
                'text' => 'Como usar variáveis no Python',
                'link' => '/files/uploads/apostila-teste.pdf',
            ],
            [
                'title' => 'Tipos no Python',
                'text' => 'Como usar os diferentes tipos de variáveis no Python',
                'link' => '/files/uploads/apostila-teste.pdf',
            ],
            [
                'title' => 'Bibliotecas: Como usar - Parte 1',
                'text' => 'Como usar as bibliotecas no Python.',
                'link' => '/files/uploads/apostila-teste.pdf',
            ],
            [
                'title' => 'Bibliotecas: Como usar - Parte 2',
                'text' => 'As bibliotecas mais usadas no Python.',
                'link' => '/files/uploads/apostila-teste.pdf',
            ],
        ]);
        // 6
    }
}
