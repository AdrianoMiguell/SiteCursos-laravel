<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class QuestionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('questionarios')->insert([
            [
                'perg' => 'Qual o significado por trás da palavra JAVA?',
                'resp1' => 'O nome da terra de origem do café',
                'resp2' => 'Um sinônimo da palavra "Javali"',
                'resp3' => 'Uma cmaisa de marca',
                'respTrue' => '1',
                'curso_id' => '1'
            ],
            [
                'perg' => 'Qual a vantagem do PHP?',
                'resp1' => 'Compatível com diversos bancos de dados',
                'resp2' => 'Ele possui código aberto',
                'resp3' => 'Facilidade no aprendizado',
                'respTrue' => '3',
                'curso_id' => '2'
            ],
            [
                'perg' => 'O HTML é:',
                'resp1' => 'Linguagem de marcação',
                'resp2' => 'Linguagem de programação',
                'resp3' => 'Linguagem de programação orientada a objeto',
                'respTrue' => '1',
                'curso_id' => '3'
            ]
        ]);
    }
}
