<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'name' => "Ciência de Dados",
                'img' => "images/basico.jpg",
                'desc' => "A ciência de dados é o estudo dos dados para extrair insights significativos para os negócios. Ela é uma abordagem multidisciplinar que combina princípios e práticas das áreas de matemática, estatística, inteligência artificial e engenharia da computação para analisar grandes quantidades de dados.",
                'duration' => 160,
                'price_in_cents' => 25000,
                'promotion' => 1.00,
                'visible' => true,
                'stars' => 0,
                'learners' => 0,
                'release_date' => '2022/01/21',
                'slug' => Str::slug('Ciência de Dados') . '-' . uniqid(),
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => "Python",
                'img' => "images/basico.jpg",
                'desc' => "O Python é uma das linguagens de programação mais usadas no mundo, e isso deve-se, entre demais motivos, a sua complexidade, sintaxe amigável e diversas bibliotecas e recursos.",
                'duration' => 240,
                'price_in_cents' => 0,
                'promotion' => 1,
                'visible' => true,
                'stars' => 0,
                'learners' => 0,
                'release_date' => '2024/01/01',
                'slug' => Str::slug('Python') . '-' . uniqid(),
                'category_id' => 1,
                'user_id' => 1
            ]
        ]);

        Curso::factory()->count(100)->create();
    }
}
