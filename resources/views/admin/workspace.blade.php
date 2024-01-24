@extends('layouts.app')

@section('content')

    <section class="workspace container py-5">

        @if ($cursos->count() > 0)
            <h1 class="fs-3"> Todos os cursos </h1>

            <div class="sec-cursos">

                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">duração</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Promoção</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody style="overflow-x: visible;">
                        @foreach ($cursos as $key => $curso)
                            <tr class="curso">
                                <th scope="row"> {{ $curso->id }} </th>
                                <td class="img-curso">
                                    <img src="{{ asset('storage/' . $curso->img) }}" alt="">
                                </td>
                                <td>{{ $curso->name }}</td>
                                <td>{{ $curso->desc }}</td>
                                <td>{{ $curso->category->name }}</td>
                                <td>{{ $curso->duration }}</td>
                                <td>{{ $curso->price_in_cents }}</td>
                                <td>{{ $curso->promotion }}</td>
                                <td>
                                    <div class="div-actions">
                                        <a href="{{ route('curso.workspace', ['curso_id' => $curso->id]) }}"
                                            class="btnGeral btnGeral-dark">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('curso.view', ['curso_id' => $curso->id]) }}"
                                            class="btnGeral btnGeral-dark">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        @include('admin.deletion.delete-curso')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @else
            <div class="d-grid gap-3 my-5">

                <h1> Cadastre Novos Cursos </h1>

                <span class="alert alert-danger"> Sem cursos no momento </span>

            </div>
        @endif

    </section>
@endsection
