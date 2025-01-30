<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            [
                'question' => "O que é ciência de dados?",
                'alt1' => "Um ramo da ciência natural.",
                'alt2' => "Um ramo da tecnologia que estuda os dados.",
                'alt3' => "Um ramo da ciência politica.",
                'alt4' => "Um ramo da tecnologia cibernética e espacial.",
                'altTrue' => 2,
                'order' => 1,
                'modulo_id' => 1,
            ],
            [
                'question' => "Qual é o primeiro passo no processo de ciência de dados?",
                'alt1' => "Coleta de dados",
                'alt2' => "Análise exploratória",
                'alt3' => "Definição do problema",
                'alt4' => "Construção do modelo",
                'altTrue' => 3,
                'order' => 2,
                'modulo_id' => 1,
            ],
            [
                'question' => "O que é o termo \"feature\" em ciência de dados?",
                'alt1' => "Um modelo de aprendizado de máquina",
                'alt2' => "Uma variável de saída",
                'alt3' => "Uma medida de desempenho",
                'alt4' => "Uma variável de entrada",
                'altTrue' => 4,
                'order' => 3,
                'modulo_id' => 1,
            ],
            [
                'question' => "Qual é o objetivo principal da validação cruzada em machine learning?",
                'alt1' => "Treinar um modelo",
                'alt2' => "Avaliar o desempenho do modelo",
                'alt3' => "Realizar previsões",
                'alt4' => "Selecionar features",
                'altTrue' => 2,
                'order' => 4,
                'modulo_id' => 1,
            ],
            [
                'question' => "O que é o overfitting em modelos de machine learning?",
                'alt1' => "O modelo se ajusta demais aos dados de treinamento",
                'alt2' => "O modelo não se ajusta o suficiente aos dados de treinamento",
                'alt3' => "O modelo não generaliza bem para novos dados",
                'alt4' => "O modelo não tem features suficientes",
                'altTrue' => 1,
                'order' => 5,
                'modulo_id' => 1,
            ],
            [
                'question' => "Qual é a função da matriz de confusão em problemas de classificação?",
                'alt1' => "Avaliar a precisão do modelo",
                'alt2' => "Avaliar a dispersão dos dados",
                'alt3' => "Avaliar a sensibilidade do modelo",
                'alt4' => "Avaliar a distribuição dos dados",
                'altTrue' => 3,
                'order' => 6,
                'modulo_id' => 1,
            ],
            [
                'question' => "Qual dessas NÃO é uma forma de trataar os dados: ",
                'alt1' => "Remover dados nulos",
                'alt2' => "Renomear dados",
                'alt3' => "Retirar os valores repetidos",
                'alt4' => "Ler dados",
                'altTrue' => 4,
                'order' => 1,
                'modulo_id' => 2,
            ],
            [
                'question' => "Como os dados NÃO são interpretados?",
                'alt1' => "Pela análise",
                'alt2' => "Pela leitura",
                'alt3' => "Pela escrita",
                'alt4' => "Pela pesquisa",
                'altTrue' => 2,
                'order' => 1,
                'modulo_id' => 3,
            ],
            [
                'question' => "O que é o PYTHON?",
                'alt1' => "Uma cobra",
                'alt2' => "Uma linguagem de programação",
                'alt3' => "Um comando",
                'alt4' => "Um navegador auto sustentável",
                'altTrue' => 2,
                'order' => 1,
                'modulo_id' => 4,
            ],
            [
                'question' => "O que é uma linha de comando?",
                'alt1' => "Uma linguagem",
                'alt2' => "Uma escrita",
                'alt3' => "Uma ordem de execução",
                'alt4' => "Um comando com determinada função",
                'altTrue' => 4,
                'order' => 2,
                'modulo_id' => 4,
            ],
            [
                'question' => "Qual dessas alternativas NÃO são um tipo de variável?",
                'alt1' => "Inteiro",
                'alt2' => "Char",
                'alt3' => "String",
                'alt4' => "Real",
                'altTrue' => 4,
                'order' => 1,
                'modulo_id' => 5,
            ],
            [
                'question' => "Qual dessas é uma biblioteca para tratamento de dados em tabela?",
                'alt1' => "Pandas",
                'alt2' => "View",
                'alt3' => "Mouse",
                'alt4' => "PDF2",
                'altTrue' => 1,
                'order' => 1,
                'modulo_id' => 6,
            ],
        ]);
    }
}
