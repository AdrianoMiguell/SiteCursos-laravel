<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('slides')->insert([
            [
                'title' => 'Leitura e interpretação de dados - parte 1',
                'text' => 'Leitura e interpretação de dados',
                'link' => '<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vS4UsvzAD0uXulgJCRMUOTm39ONjSp76mW74dxcN8YZRH4DLrHjN40-za19gDQh1P7F7ByaRERgSuCk/embed?start=false&loop=false&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>',
            ],
            [
                'title' => 'Leitura e interpretação de dados - parte 2',
                'text' => 'Leitura e interpretação de dados',
                'link' => '<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vS4UsvzAD0uXulgJCRMUOTm39ONjSp76mW74dxcN8YZRH4DLrHjN40-za19gDQh1P7F7ByaRERgSuCk/embed?start=false&loop=false&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>',
            ],
        ]);

        Slide::factory()->count(50)->create();
    }
}
