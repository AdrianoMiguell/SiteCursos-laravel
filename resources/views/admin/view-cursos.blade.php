@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <h1 class="fs-3"> Todos os cursos </h1>

        <section id="area-cursos" class="my-3">
            <div class="">
                @foreach ($cursos as $key => $curso)
                    <div id="curso">
                        <img src="hhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAbnGp1vx6fGJ6mWZfoBoJNGfKgGy7rrZsd_i_7JjNhilXD3tHu7GKS4o4G_feRE4GcVo&usqp=CAU"
                            alt="" id="img-curso">
                        <span id="nome-curso"> Curso {{$key + 1}}: <span>{{ $curso->name }}</span> </span>
                        <span id="descricao-curso"> {{ $curso->description }} </span>
                        <div id="informacoes">
                            <span id="duracao-curso"> Duração : {{ $curso->duration }} </span>
                            <span id="modulos-curso"> Modulos : {{ $curso->modulos }} </span>
                        </div>
                        <div id="precos">
                            <span id="preco-atual"> R$ {{ $curso->price }} </span>
                            <span id="qtd-promocao"> {{ $curso->promotion }}% </span>
                            {{-- <span id="cartoes-parcela"> {{$curso->name}} </span> --}}
                        </div>
                        <div id="btn-curso">
                            <a href="{{route('view.conteudos', ['id' => $curso->id]) }}"> View Contents </a>
                            <a href=""> <img src="{{ asset('storage/icons/pencil-edit.svg') }}" alt=""> </a>
                            <a href=""> <img src="{{ asset('storage/icons/pencil-edit.svg') }}" alt=""> </a>
                        </div>
                        {{-- src="{{asset('js/formCurriculo.js')}}"
                        C:\Users\adria\Documents\Programs\laravel\SiteCursos\storage\app\public\icons\pencil-edit.svg --}}
                    </div>
                @endforeach
            </div>
        </section>

        <section id="relatos">

        </section>
        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
         --}}
        {{-- <form action="{{ route('edit.curso', ['id' => $curso[0]->id]) }}" method="post"
            class="w-50 bg-warning mx-auto rounded my-2">
            @csrf
            <h1>Editar curso</h1>
            <label for="name-curso">Nome do curso</label>
            <input class="form-control" type="text" id="name-curso" value="{{ $curso[0]->name }}" name="name">

            <label for="description-curso">Descrição</label>
            <textarea class="form-control" name="description" id="description-curso" cols="25" rows="10"> {{ $curso[0]->description }} </textarea>

            <label for="duration-curso">Duração</label>
            <input class="form-control" type="text" id="duration-curso" value="{{ $curso[0]->duration }}"
                name="duration">

            <label for="qtd-modulos">Quantidade de modulos</label>
            <input class="form-control" type="int" id="qtd-modulos" value="{{ $curso[0]->modulos }}" name="modulos">

            <label for="price">Preço</label>
            <input class="form-control" type="int" id="price" value="{{ $curso[0]->price }}" name="price">

            <label for="promotion">Promoção</label>
            <input class="form-control" type="int" id="promotion" value="{{ $curso[0]->promotion }}"
                name="promotion">

            <input type="submit" value="Enviar" class="btn btn-primary">
        </form> --}}
    </section>
@endsection
</body>

</html>

{{-- @foreach ($cursos as $curso)
<div id="curso">
    <img src="hhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAbnGp1vx6fGJ6mWZfoBoJNGfKgGy7rrZsd_i_7JjNhilXD3tHu7GKS4o4G_feRE4GcVo&usqp=CAU"
        alt="" id="img-curso">
    <span id="nome-curso"> Curso : <span>{{$curso->name}}</span> </span>
    <span id="descricao-curso"> {{$curso->description}} </span>
    <div id="informacoes">
        <span id="duracao-curso"> Duração : {{$curso->duration}} </span>
        <span id="modulos-curso"> Modulos : {{$curso->modulos}} </span>
    </div>
    <div id="precos">
        <span id="preco-atual"> R$ {{$curso->price}} </span>
        <span id="qtd-promocao"> {{$curso->promotion}}% </span>
    </div>
    <div id="btn-curso"><a href=""> Matriculi-se </a></div>
</div>
@endforeach --}}
