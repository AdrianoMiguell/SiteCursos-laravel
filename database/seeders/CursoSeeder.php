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
                'desc_more' => 'Comece aqui seus estudos em Java! Java é uma das linguagens de programação mais usadas no mundo. A plataforma Java ganhou muitos mercados diferentes - da web ao desktop em grandes empresas e governos, passando por mobile e IoT mas o grande mercado Java hoje ainda é o back-end em sistemas Web.',
                'duration' => '20',
                'modulos' => '2',
                'real_price' => '1',
                'promotion' => '100',
                'promotion_price' => '0',
                'ready' => 'ok'
            ], [
                'name' => 'Curso de PHP',
                'img' => 'images/basico.jpg',
                'desc' => 'Melhor curso basico',
                'desc_more' => 'PHP é uma linguagem de script popular especialmente adequada para desenvolvimento web, que também pode ser utilizada para programar de forma geral.

                Rápida, flexível e pragmática, a linguagem PHP pode ser usada em tudo na Web, desde blogs até os sites mais populares do mundo.

                Aumente seu repertório de dev e aprenda, nesta formação, como criar uma aplicação Web com PHP. Bora começar?',
                'duration' => '20',
                'modulos' => '1',
                'real_price' => '0',
                'promotion' => '0',
                'promotion_price' => '0',
                'ready' => 'ok'
            ],
            [
                'name' => 'Curso de HTML e CSS',
                'img' => 'images/basico.jpg',
                'desc' => 'Aprenda uma das linguagens web mais essenciais.',
                'desc_more' => 'Um site profissional precisa de HTML e CSS bem estruturados. Aprenda a importância do código semântico, como potencializar informações com CSS e seguir boas práticas de desenvolvimento.',
                'duration' => '20',
                'modulos' => '1',
                'real_price' => '10',
                'promotion' => '50',
                'promotion_price' => '5',
                'ready' => 'ok'
            ]
        ]);
    }
}
