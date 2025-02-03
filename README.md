# Site de Cursos | Play Cursos 

Um site focado em oferecer cursos de tecnologia com abordagem inovadora, didática envolvente e conteúdos atualizados sobre tendências do mercado. Aqui, você aprende de forma ágil e criativa, com materiais práticos, disponíveis também para estudo offline, para impulsionar seu desenvolvimento profissional na área de tecnologia.

<p align="right"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="150" alt="Laravel Logo"></a></p>

## Passos para instalação e uso

O github disponibiliza de diversos modos para fazer upload do codigo. 

Aqui estão duas dessas formas:
<p style="display: block"> 
   <strong> 1 - </strong>  Vá até uma pasta reservada para o projeto e use o comando no "git bash" : 
    https://github.com/AdrianoMiguell/SiteCursos-laravel.git
</p>
<p style="display: block"> 
    <strong> 2 - </strong>  Baixe o arquivo .zip do código, clicando no botão "Download .ZIP"
</p>

### Pré Requisitos

``` Ter suporte a linguagem PHP em sua maquina ```

``` Ter um editor de código (Ex.: Visual Studio Code) ```

``` Ter um sistema de hospedagem local, com suporte a banco de dados (Ex.: Xampp ) ```

``` Ter instalado em sua maquina o Gerenciador de dependências Composer ```

``` Ter instalado em sua maquina o framework Laravel ```

### Preparando ambiente

-- Abra o terminal, e na pasta do projeto, execute o código: ``` composer install ```

-- Ligue o seu servidor local apache e o servidor de banco de dados

-- Acesse a sua ferramenta de banco de dados, e crie um banco de dados com um nome que desejar (Ex: Cursos);

-- Agora, vá a raiz do código, copie um arquivo chamado  ``` .env.example ```  e cole-o nesse mesmo local, trocando o nome para apenas ```.env```.

-- Encontre esse trecho do código ``` DB_DATABASE ```  e troque o nome do banco, pelo nome do banco de dados que você acabou de criar. 

--Também encontre o trecho do código ```FILESYSTEM_DISK``` e troque o valor "local" para "public".

-- Vá ao terminal e digite este código para que as tabelas do banco sejam construidas altomaticamente:  ``` php artisan migrate ``` .  
As seguintes tabelas devem aparecer no banco de dados.

-- Agora, execute esse código no terminal, para geração de uma chave criptografada exigida pelo artisan: ``` php artisan key:generate ```

-- Execute também o código no terminal, para gerar um link entre a pasta "public" e "storage": ``` php artisan storage:link ```

-- Finalmente, execute o código no terminal, para visualização do sistema:  ``` php artisan serve ``` . 


## Fotos do site

<div>
    <img src="https://github.com/AdrianoMiguell/SiteCursos-laravel/blob/main/.github/imagens_app/dashboard_user.jpg" width="450" />
    <img src="https://github.com/AdrianoMiguell/SiteCursos-laravel/blob/main/.github/imagens_app/index_page_user.jpg" width="550" />
</div>
<div>
    <img src="https://github.com/AdrianoMiguell/SiteCursos-laravel/blob/main/.github/imagens_app/page_create_course_admin.jpg" width="500" />
    <img src="https://github.com/AdrianoMiguell/SiteCursos-laravel/blob/main/.github/imagens_app/search_page_user.jpg" width="500" />
</div>


