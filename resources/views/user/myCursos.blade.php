@if (isset($matricula) && isset($cursos))
    <div>
        @foreach ($cursos as $key => $c)
            @foreach ($matricula as $m)
                @if ($m->curso_id == $c->id)
                    <div class="curso section_gradient_light dark_text">
                        <img src="{{ asset('storage/' . $c->img) }}" alt="" class="img_curso">
                        <span class="nome_curso"> {{ $c->name }} </span>
                        <span class="desc_curso"> {{ $c->desc }} </span>
                        <span> Duração : {{ $c->duration }} </span>
                        <span> Modulos : {{ $c->modulos }} </span>
                        <div class="fw-bold">
                            @if ($c->promotion_price == 0)
                                <span> Gratuito </span>
                            @else
                                <span> Preço: R$ {{ $c->promotion_price }} </span>
                            @endif
                        </div>
                        <div class="div-btn">
                            <a class="btnGeral" href="{{ route('view.curso', ['curso_id' => $c->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                {{ $m->status }} </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
@endif
