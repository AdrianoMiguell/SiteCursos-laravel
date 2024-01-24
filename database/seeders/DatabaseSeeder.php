<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            CursoSeeder::class,
            ModuloSeeder::class,
            ApostilaSeeder::class,
            DesafioSeeder::class,
            VideoSeeder::class,
            SlideSeeder::class,
            ConteudoSeeder::class,
            UserSeeder::class,
            QuizSeeder::class
        ]);
    }
}
