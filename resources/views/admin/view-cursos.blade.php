@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <h1 class="fs-3"> Todos os cursos </h1>

        <section id="area-cursos" class="my-3">
            <div class="">
                @forelse ($cursos as $key => $curso)
                    <div class="curso">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img-curso">
                        <span class="nome-curso"> Curso {{ $key + 1 }}: <span>{{ $curso->name }}</span> </span>
                        <span class="descricao-curso"> {{ $curso->description }} </span>
                        <div class="informacoes">
                            <span class="duracao-curso"> Duração : {{ $curso->duration }} </span>
                            <span class="modulos-curso"> Modulos : {{ $curso->modulos }} </span>
                        </div>
                        {{-- <div class="precos"> --}}
                        @if ($curso->promotion != 0)
                            <span class="preco" style="text-decoration: line-through;"> Preço: R$ {{ $curso->real_price }} </span>
                            <div class="desconto">
                                <span class="promocao"> Desconto de {{ $curso->promotion }}% </span>
                                <span class="valorAtual"> Novo preço: R$ {{ $curso->promotion_price }} </span>
                            </div>
                        @else
                            <span class="preco"> Preço: R$ {{ $curso->real_price }} </span>
                        @endif
                        {{-- </div> --}}
                        {{-- <span class="cartoes-parcela"> {{$curso->name}} </span> --}}
                        <div class="div-btn">
                            <a class="btn-curso" href="{{ route('view.conteudos', ['id' => $curso->id]) }}"> <img
                                    src="{{ asset('storage/icons/eye.svg') }}" alt="">
                            </a>
                            <button class="btn-curso" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $key }}"> <img
                                    src="{{ asset('storage/icons/pencil-edit.svg') }}" alt=""> </button>
                            <form action="{{ route('delete.curso', ['id' => $curso->id]) }}" method="POST"
                                class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn-curso" type="submit"> <img src="{{ asset('storage/icons/trash.svg') }}"
                                        alt=""> </button>
                            </form>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                        aria-labelledby="exampleModal{{ $key }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModal{{ $key }}Label"> Editar curso
                                        {{ $key + 1 }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('edit.curso', ['id' => $curso->id]) }}" method="post"
                                        class="my-2" enctype="multipart/form-data">
                                        @csrf
                                        <h1>Editar curso</h1>
                                        <label for="name-curso">Nome do curso</label>
                                        <input class="form-control" type="text" id="name-curso"
                                            value="{{ $curso->name }}" name="name">

                                        <label for="image-curso">Imagem do curso</label>
                                        <input class="form-control" type="file" id="image-curso" name="image">

                                        <label for="description-curso">Descrição</label>
                                        <textarea class="form-control" name="description" id="description-curso" cols="25" rows="10"> {{ $curso->description }} </textarea>

                                        <label for="duration-curso">Duração</label>
                                        <input class="form-control" type="text" id="duration-curso"
                                            value="{{ $curso->duration }}" name="duration">

                                        <label for="qtd-modulos">Quantidade de modulos</label>
                                        <input class="form-control" type="int" id="qtd-modulos"
                                            value="{{ $curso->modulos }}" name="modulos">

                                        <label for="real_price">Preço</label>
                                        <input class="form-control" type="int" id="real_price"
                                            value="{{ $curso->real_price }}" name="real_price">

                                        <label for="promotion">Promoção</label>
                                        <input class="form-control" type="int" id="promotion"
                                            value="{{ $curso->promotion }}" name="promotion">

                                        <div class="my-2 d-flex justify-content-end"><input type="submit" value="Enviar"
                                                class="btn-curso"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alery-primary">
                        <h1>Nenhum curso cadastrado</h1>
                    </div>
                @endforelse
            </div>
        </section>
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
