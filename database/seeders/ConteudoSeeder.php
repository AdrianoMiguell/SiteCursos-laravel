<?php

namespace Database\Seeders;

use App\Models\Conteudo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConteudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('conteudos')->insert([
            [
                'type' => 4,
                'order' => 1,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => 1,
                'modulo_id' => 1,
                'curso_id' => 1,
            ],
            [
                'type' => 4,
                'order' => 2,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => 2,
                'modulo_id' => 1,
                'curso_id' => 1,
            ],
            [
                'type' => 4,
                'order' => 1,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => 3,
                'modulo_id' => 2,
                'curso_id' => 1,
            ],
            [
                'type' => 4,
                'order' => 2,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => 4,
                'modulo_id' => 2,
                'curso_id' => 1,
            ],
            [
                'type' => 3,
                'order' => 1,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => 1,
                'video_id' => null,
                'modulo_id' => 3,
                'curso_id' => 1,
            ],
            [
                'type' => 3,
                'order' => 2,
                'apostila_id' => null,
                'desafio_id' => null,
                'slide_id' => 2,
                'video_id' => null,
                'modulo_id' => 3,
                'curso_id' => 1,
            ],

            // New curso
            [
                'type' => 1,
                'order' => 1,
                'apostila_id' => 1,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 4,
                'curso_id' => 2,
            ],
            [
                'type' => 1,
                'order' => 2,
                'apostila_id' => 2,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 4,
                'curso_id' => 2,
            ],
            [
                'type' => 2,
                'order' => 3,
                'apostila_id' => null,
                'desafio_id' => 1,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 4,
                'curso_id' => 2,
            ],

            [
                'type' => 1,
                'order' => 1,
                'apostila_id' => 3,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 5,
                'curso_id' => 2,
            ],
            [
                'type' => 1,
                'order' => 2,
                'apostila_id' => 4,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 5,
                'curso_id' => 2,
            ],
            [
                'type' => 2,
                'order' => 3,
                'apostila_id' => null,
                'desafio_id' => 2,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 5,
                'curso_id' => 2,
            ],

            [
                'type' => 1,
                'order' => 1,
                'apostila_id' => 5,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 6,
                'curso_id' => 2,
            ],
            [
                'type' => 1,
                'order' => 2,
                'apostila_id' => 6,
                'desafio_id' => null,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 6,
                'curso_id' => 2,
            ],
            [
                'type' => 2,
                'order' => 3,
                'apostila_id' => null,
                'desafio_id' => 2,
                'slide_id' => null,
                'video_id' => null,
                'modulo_id' => 6,
                'curso_id' => 2,
            ],
        ]);

        Conteudo::factory()->count(100)->create();
    }
}
