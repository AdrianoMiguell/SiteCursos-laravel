<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            [
                'name' => 'Curso de Java',
                'img' => 'images/java.jpg',
                'desc' => 'Melhor curso de Java',
                'duration' => '20',
                'modulos' => '2',
                'real_price' => '1',
                'promotion' => '100',
                'promotion_price' => '0'
            ], [
                'name' => 'Curso de PHP',
                'img' => 'images/basico.jpg',
                'desc' => 'Melhor curso basico',
                'duration' => '20',
                'modulos' => '1',
                'real_price' => '0',
                'promotion' => '0',
                'promotion_price' => '0'
            ],
            [
                'name' => 'Curso de HTML',
                'img' => 'images/basico.jpg',
                'desc' => 'Melhor curso',
                'duration' => '20',
                'modulos' => '1',
                'real_price' => '10',
                'promotion' => '50',
                'promotion_price' => '5'
            ]
        ]);
    }
}
