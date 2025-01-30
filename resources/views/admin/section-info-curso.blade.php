@if (isset($curso))
    <div class="sec-info-curso">
        <h2> Curso Selecionado: </h2>

        <div class="div-info">
            <div class="div-img" style=""><img src="{{ asset('storage/' . $curso->img) }}" alt=""
                    id="img_curso"></div>
            <div class="info">
                <h2 class="title fs-2 name" id="name_curso">{{ $curso->name }} </h2><span class="desc"
                    id="desc_curso">{{ $curso->desc }} </span>
            </div>
        </div>
    </div>
@endif
