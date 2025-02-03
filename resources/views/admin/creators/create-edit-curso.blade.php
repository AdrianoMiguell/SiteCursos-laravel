{{-- @dd($categories) --}}

@extends('layouts.app')

@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>

    @if (isset($curso))
        @include('admin.header-options')
    @endif

    <section class="container">

        <form action="{{ isset($curso) ? route('curso.edit') : route('curso.create') }}" method="post" class="m-5"
            enctype="multipart/form-data">

            @csrf

            @if (isset($curso))
                @method('PUT')
                <legend class="textDec fs-2">Editar curso</legend>

                <input type="hidden" name="id" value="{{ $curso->id }}">
                <input type="hidden" name="img_old" value="{{ $curso->img }}">
            @else
                <legend class="textDec fs-2">Criar curso</legend>
            @endif

            <div class="my-3">
                <label class="form-label" for="name-curso">Nome do curso</label>
                <input class="form-control" type="text" id="name-curso" name="name" maxlength="100"
                    value="{{ $curso->name ?? '' }}" placeholder="Ex: Programando em Python">
            </div>

            <div class="mb-3">
                <label class="form-label" for="img-curso">Imagem do curso</label>
                <div class="d-flex align-items-start gap-2">
                    @if (isset($curso) && !empty($curso->img))
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="imagem do curso: {{ $curso->name }}"
                            width="150px">
                    @endif
                    <input class="form-control" type="file" id="img-curso" name="img">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="desc-curso">Descrição</label>
                <textarea class="form-control" name="desc" type="text" id="desc-curso" maxlength="500" rows="4"> {{ $curso->desc ?? '' }} </textarea>
            </div>

            <div class="d-flex justify-content-between align-items-start gap-1 mb-3">
                <div class="col-2">
                    <label class="form-label" for="duration-curso">Duração</label>
                    <input class="form-control" type="number" min="1" max="3600" id="duration-curso"
                        name="duration" value="{{ $curso->duration ?? '' }}" placeholder="Horas">
                </div>
                <div class="col-3">
                    <label class="form-label" for="price_in_cents">Preço (in cents)</label>
                    <input class="form-control" type="number" id="price_in_cents" name="price_in_cents" min="0"
                        value="{{ $curso->price_in_cents ?? '' }}">
                </div>
                <div class="col-2">
                    <label class="form-label" for="category_type">Categoria</label>

                    <datalist id="list_category">
                        @if (isset($categories) && count($categories) > 1)
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->name }}">
                            @endforeach
                        @endif
                    </datalist>

                    <input class="form-control" type="text" id="category_type" name="category_type" list="list_category"
                        value="{{ $curso->category->type ?? '' }}">
                </div>
                <div class="col-3">
                    <label class="form-label" for="promotion">Promoção (%)</label>
                    <input class="form-control" type="number" id="promotion" name="promotion" min="0" max="100"
                        value="{{ isset($curso->promotion) ? $curso->promotion * 100 : '' }}" placeholder="Valor">
                </div>

                @isset($curso)
                    <div class="my-2 col-2">
                        <input type="checkbox" name="visible" id="visible" class="form-check-input"
                            @if ($curso->visible) @checked(true) @endif>
                        <label for="visible" class="form-check-label">
                            Visible
                        </label>
                    </div>
                @endisset

            </div>

            <input type="submit" value="{{ isset($curso) ? 'Editar' : 'Criar' }} "
                class="btnGeral btnGeral-dark m-auto my-2">
        </form>
    </section>
@endsection
