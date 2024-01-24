<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            [
                'title' => 'Introdução',
                'text' => 'Introdução ao curso.',
                'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8lnT9ra4kqQ?si=tC2haclyGoCX_uEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ],
            [
                'title' => 'Preparando o ambiente',
                'text' => 'Preparando o ambiente para desenvolvimento em python.',
                'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8lnT9ra4kqQ?si=tC2haclyGoCX_uEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ],
            [
                'title' => 'Tratando os dados - parte 1.',
                'text' => 'Tratando os dados para a pesquisa.',
                'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8lnT9ra4kqQ?si=tC2haclyGoCX_uEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ],
            [
                'title' => 'Tratando os dados - parte 2.',
                'text' => 'Tratando os dados para a pesquisa.',
                'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8lnT9ra4kqQ?si=tC2haclyGoCX_uEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            ],
        ]);

        Video::factory()->count(50)->create();
    }
}
