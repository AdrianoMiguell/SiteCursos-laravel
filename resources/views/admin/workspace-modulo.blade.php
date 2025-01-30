@extends('layouts.app')

@section('content')
    @include('admin.header-options')

    <section class="container workspace-conteudo">

        @include('admin.section-info-curso')

        <h2>
            @if (isset($modulo))
                <i class="bi bi-pencil-fill"></i>
            @else
                <i class="bi bi-plus-circle-fill"></i>
            @endif

            Módulo
        </h2>

        <form action="{{ isset($modulo) ? route('modulo.edit') : route('modulo.create') }}" method="POST"
            style="max-width: 75vw;" class="my-4">
            @csrf

            @if (isset($modulo))
                @method('PUT')
                <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">
            @endif

            <legend class="mb-3 fs-5" style="color: rgba(var(--main-c), .75)">Divida os conteúdos do seu curso em modúlos.
                <br> Lembre-se: dê Titulos e descrições chamátivas aos seus
                módulos.
            </legend>

            <input type="hidden" name="curso_id" value="{{ $curso->id }}">

            <div class="mt-5 mb-3">
                <label for="title" class="form-label"> Título</label>
                <input type="text" value="{{ isset($modulo) ? $modulo->title : '' }}" name="title"
                    class="form-control" minlength="3">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label"> Descrição</label>
                <textarea type="text" name="desc" class="form-control" minlength="25">{{ isset($modulo) ? $modulo->desc : '' }}</textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="btnGeral btnGeral-dark" value="{{ isset($modulo) ? 'Editar ' : 'Enviar' }}">
            </div>
            {{-- Introdução a Cibersegurança --}}
            {{-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro nostrum voluptas nemo voluptate hic quisquam consequuntur corporis quasi praesentium inventore quas molestiae quae alias itaque, nesciunt doloremque aspernatur non at. --}}
        </form>
    </section>
@endsection
