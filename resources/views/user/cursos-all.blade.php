@if (isset($cursos))
    <div>
        @forelse ($cursos as $key => $curso)
            <div class="curso section_gradient_dark light_text">
                <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img-curso">
                <span class="nome-curso"> {{ $curso->name }} </span>
                <span class="descricao-curso"> {{ $curso->desc }} </span>
                <div class="informacoes">
                    <span class="duracao-curso"> Duração : {{ $curso->duration }} </span>
                    <span class="modulos-curso"> Modulos : {{ $curso->modulos }} </span>
                </div>
                @if ($curso->promotion == 0)
                    <span class="preco"> Preço: R$ {{ $curso->promotion_price }} </span>
                @elseif($curso->promotion_price == 0)
                    <span class="preco"> Gratuito </span>
                @else
                    <span class="preco" style="text-decoration: line-through;"> Preço: R$ {{ $curso->real_price }}
                    </span>
                    <div class="desconto">
                        <span class="promocao"> Desconto de {{ $curso->promotion }}% </span>
                        <span class="valorAtual"> Novo preço: R$ {{ $curso->promotion_price }} </span>
                    </div>
                @endif
                <div class="div-btn">
                    <a class="btnGeral" href="{{ route('view.curso', ['curso_id' => $curso->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                        visualizar</a>
                </div>
            </div>
        @empty
            <div class="alert alery-primary">
                <h1>Nenhum curso cadastrado</h1>
            </div>
        @endforelse
    </div>
@endif
