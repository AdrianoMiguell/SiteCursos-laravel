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
                'img' => null,
                'text' => 'Como funciona o Java? Você sabe o que é JVM, JRE, JDK, JavaC, bytecode? É exatamente isso que você vai aprender durante essa aula.
                O JavaC (Java Compiler) vai transformar o Código Fonte Java em Bytecode, um código específico que vai executar em uma Máquina Virtual Java (Java Virtual Machine - JVM). As IDEs mais conhecidas são o Eclipse, o IntelliJ e o NetBeans. O Curso em Vídeo de Java vai adotar o NetBeans para o aprendizado da Linguagem Java.
                Na próxima aula, veremos as versões do Java que usaremos (SE/EE/ME), em qual lugar vamos fazer o download do JDK para o Java SE e veremos as instruções para a instalação da plataforma Java que será utilizada durante todo o curso.',
                'link' => 'https://www.youtube.com/embed/sTX0UEplF54?start=10',
                'numbering' => 0,
                'curso_id' => 1
            ],
            [
                'name' => 'Curso de Java #02 - Como Funciona o Java - Gustavo Guanabara',
                'img' => 'images/basico.jpg',
                'text' => 'Como funciona o Java? Você sabe o que é JVM, JRE, JDK, JavaC, bytecode? É exatamente isso que você vai aprender durante essa aula. O JavaC (Java Compiler) vai transformar o Código Fonte Java em Bytecode, um código específico que vai executar em uma Máquina Virtual Java (Java Virtual Machine - JVM). As IDEs mais conhecidas são o Eclipse, o IntelliJ e o NetBeans. O Curso em Vídeo de Java vai adotar o NetBeans para o aprendizado da Linguagem Java. Na próxima aula, veremos as versões do Java que usaremos (SE/EE/ME), em qual lugar vamos fazer o download do JDK para o Java SE e veremos as instruções para a instalação da plataforma Java que será utilizada durante todo o curso.',
                'link' => 'https://www.youtube.com/embed/v_ZCtgwbS3o?start=10',
                'numbering' => 1,
                'curso_id' => 1
            ],
            [
                'name' => 'Curso de PHP',
                'img' => null,
                'text' => 'PHP é uma linguagem de script de uso geral voltada para o desenvolvimento da web. Ele foi originalmente criado pelo programador dinamarquês-canadense Rasmus Lerdorf em 1993 e lançado em 1995. ',
                'link' => 'https://www.youtube.com/embed/F7KzJ7e6EAc?start=10',
                'numbering' => 0,
                'curso_id' => 2
            ],
            [
                'name' => 'Curso de HTML ',
                'img' => null,
                'text' => 'HTML é uma linguagem de marcação utilizada na construção de páginas na Web. Documentos HTML podem ser interpretados por navegadores. A tecnologia é fruto da junção entre os padrões HyTime e SGML. HyTime é um padrão para a representação estruturada de hipermídia e conteúdo baseado em tempo.',
                'link' => 'https://www.youtube.com/embed/E6CdIawPTh0?start=10',
                'numbering' => 0,
                'curso_id' => 3
            ]
        ]);
    }
}
