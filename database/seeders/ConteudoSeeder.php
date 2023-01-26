<?php

namespace Database\Seeders;

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
                'name' => 'Curso de Java #01 - História do Java - Gustavo Guanabara',
                'text' => 'Como funciona o Java? Você sabe o que é JVM, JRE, JDK, JavaC, bytecode? É exatamente isso que você vai aprender durante essa aula.
                O JavaC (Java Compiler) vai transformar o Código Fonte Java em Bytecode, um código específico que vai executar em uma Máquina Virtual Java (Java Virtual Machine - JVM). As IDEs mais conhecidas são o Eclipse, o IntelliJ e o NetBeans. O Curso em Vídeo de Java vai adotar o NetBeans para o aprendizado da Linguagem Java.
                Na próxima aula, veremos as versões do Java que usaremos (SE/EE/ME), em qual lugar vamos fazer o download do JDK para o Java SE e veremos as instruções para a instalação da plataforma Java que será utilizada durante todo o curso.',
                'link' => 'https://youtube.com/watch?v=sTX0UEplF54&list=PLHz_AreHm4dkI2ZdjTwZA4mPMxWTfNSpR&index=1&ab_channel=CursoemVídeo',
                'curso_id' => 1
            ],
            [
                'name' => 'Curso de Java #02 - Como Funciona o Java - Gustavo Guanabara',
                'text' => 'Como funciona o Java? Você sabe o que é JVM, JRE, JDK, JavaC, bytecode? É exatamente isso que você vai aprender durante essa aula. O JavaC (Java Compiler) vai transformar o Código Fonte Java em Bytecode, um código específico que vai executar em uma Máquina Virtual Java (Java Virtual Machine - JVM). As IDEs mais conhecidas são o Eclipse, o IntelliJ e o NetBeans. O Curso em Vídeo de Java vai adotar o NetBeans para o aprendizado da Linguagem Java. Na próxima aula, veremos as versões do Java que usaremos (SE/EE/ME), em qual lugar vamos fazer o download do JDK para o Java SE e veremos as instruções para a instalação da plataforma Java que será utilizada durante todo o curso.',
                'link' => 'https://youtube.com/watch?v=sTX0UEplF54&list=PLHz_AreHm4dkI2ZdjTwZA4mPMxWTfNSpR&index=1&ab_channel=CursoemVídeo',
                'curso_id' => 1
            ]
        ]);
    }
}
