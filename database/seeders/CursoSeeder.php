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
            'name' => 'Curso de Java',
            'image' => 'images/java.jpg',
            'description' => 'Melhor curso de Java',
            'duration' => '20',
            'modulos' => '2',
            'price' => '1',
            'promotion' => '0',
        ]);
    }
}
