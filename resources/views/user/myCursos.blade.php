@if (isset($matricula) && isset($cursos))
    <div>
        @foreach ($cursos as $key => $c)
            @foreach ($matricula as $m)
                @if ($m->curso_id == $c->id)
                    <div class="curso section_gradient_dark light_text">
                        <img src="{{ asset('storage/' . $c->img) }}" alt="" class="img-curso">
                        <span class="nome-curso"> {{ $c->name }} </span>
                        <span class="descricao-curso"> {{ $c->desc }} </span>
                        <div class="informacoes">
                            <span class="duracao-curso"> Duração : {{ $c->duration }} </span>
                            <span class="modulos-curso"> Modulos : {{ $c->modulos }} </span>
                        </div>
                        @if ($c->promotion_price != 0)
                            <span class="preco" style="text-decoration: line-through;"> Preço: R$
                                {{ $c->real_price }}
                            </span>
                            <div class="desconto">
                                <span class="promocao"> Desconto de {{ $c->promotion }}% </span>
                                <span class="valorAtual"> Novo preço: R$ {{ $c->promotion_price }} </span>
                            </div>
                        @elseif ($c->real_price == 0)
                            <span class="preco"> Gratuito </span>
                        @else
                            <span class="preco"> Preço: R$ {{ $c->real_price }} </span>
                        @endif
                        @if ($c->promotion == 0)
                            <span class="preco"> Preço: R$ {{ $c->promotion_price }} </span>
                        @elseif($c->promotion_price == 0)
                            <span class="preco"> Gratuito </span>
                        @else
                            <span class="preco" style="text-decoration: line-through;"> Preço: R$
                                {{ $c->real_price }}
                            </span>
                            <div class="desconto">
                                <span class="promocao"> Desconto de {{ $c->promotion }}% </span>
                                <span class="valorAtual"> Novo preço: R$ {{ $c->promotion_price }} </span>
                            </div>
                        @endif
                        <div class="div-btn">
                            <a href="{{ route('user.conteudo', ['curso_id' => $c->id]) }}" class="btnGeral">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                {{ $m->status }}
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
@endif
