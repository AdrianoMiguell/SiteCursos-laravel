@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <h1 class="fs-3"> Todos os cursos </h1>

        <section id="area_cursos" class="my-3">
            <div>
                @forelse ($cursos as $key => $curso)
                    <div class="curso section_gradient_dark text-light border-light m-2">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img_curso">
                        <span class="nome_curso"> Curso {{ $key + 1 }}: <span>{{ $curso->name }}</span> </span>
                        <span class="desc_curso"> {{ $curso->desc }} </span>
                        <span class="desc_curso"> {{ $curso->desc_more }} </span>
                        <span> Duração : {{ $curso->duration }} </span>
                        <span> Modulos : {{ $curso->modulos }} </span>
                        <div class="bege_text">
                            @if ($curso->promotion != 0)
                                <span style="text-decoration: line-through;"> Preço: R$ {{ $curso->real_price }}
                                </span>
                                <div>
                                    <span> Desconto de {{ $curso->promotion }}% </span>
                                    <span> Novo preço: R$ {{ $curso->promotion_price }} </span>
                                </div>
                            @else
                                <span class="bege_text"> Preço: R$ {{ $curso->real_price }} </span>
                            @endif
                        </div>
                        {{-- <span class="cartoes-parcela"> {{$curso->name}} </span> --}}
                        <div class="div-btn">
                            <a class="btnGeral" href="{{ route('view.conteudos', ['id' => $curso->id]) }}"> <img
                                    src="{{ asset('storage/icons/eye.svg') }}" alt="">
                            </a>
                            <button class="btnGeral" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $key }}"> <img
                                    src="{{ asset('storage/icons/pencil-edit.svg') }}" alt=""> </button>
                            <form action="{{ route('delete.curso', ['id' => $curso->id]) }}" method="POST"
                                class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button class="btnGeral" type="submit"> <img src="{{ asset('storage/icons/trash.svg') }}"
                                        alt=""> </button>
                            </form>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                        aria-labelledby="exampleModal{{ $key }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-1 section_gradient_light dark_text">
                                <div class="modal-body">
                                    <h1>Editar curso {{ $key + 1 }}</h1>
                                    <form action="{{ route('edit.curso', ['id' => $curso->id]) }}" method="post"
                                        class="my-4 d-grid gap-2" enctype="multipart/form-data">
                                        @csrf
                                        <label for="name_curso">Nome do curso</label>
                                        <input class="form-control" type="text" id="name_curso"
                                            value="{{ $curso->name }}" name="name">
                                        <label for="image_curso">Imagem do curso</label>
                                        <input class="form-control" type="file" id="image_curso" name="image">
                                        <label for="desc_curso">Descrição</label>
                                        <textarea class="form-control" name="desc" id="desc_curso" cols="5" rows="2"> {{ $curso->desc }} </textarea>
                                        <label for="desc_curso">Descrição mais detalhada</label>
                                        <textarea class="form-control" name="desc" id="desc_curso" cols="25" rows="10"> {{ $curso->desc_more }} </textarea>
                                        <label for="duration_curso">Duração</label>
                                        <input class="form-control" type="text" id="duration_curso"
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
                                        <div class="mt-4 d-flex justify-content-between align-items-center">
                                            <button type="button" class="btnGeral" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Fechar </button>
                                            <input type="submit" value="Editar" class="btnGeral">
                                        </div>
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
        alt="" id="img_curso">
    <span id="nome_curso"> Curso : <span>{{$curso->name}}</span> </span>
    <span id="descricao_curso"> {{$curso->description}} </span>
    <div id="informacoes">
        <span id="duracao_curso"> Duração : {{$curso->duration}} </span>
        <span id="modulos_curso"> Modulos : {{$curso->modulos}} </span>
    </div>
    <div id="precos">
        <span id="preco-atual"> R$ {{$curso->price}} </span>
        <span id="qtd-promocao"> {{$curso->promotion}}% </span>
    </div>
    <div id="btn_curso"><a href=""> Matriculi-se </a></div>
</div>
@endforeach --}}
