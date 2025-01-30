@extends('layouts.app')

@section('content')
    <h1> Certificados </h1>
    <h1> Lista </h1>
    <ul>
        @foreach ($cursos as $curso)
            @foreach ($concluidos as $c)
                @if (isset($c->id) && $curso->id == $c->curso_id)
                    <a href="{{route('certificado', ['curso_id' => $curso->id, 'matricula_id' => $c->id])}}">
                        <li> Certificado do curso: {{$curso->name}}; </li>
                    </a>
                @endif
            @endforeach
        @endforeach
    </ul>
@endsection
