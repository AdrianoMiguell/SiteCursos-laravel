@extends('layouts.app')

@section('content')
    <div id="contador" class="position-absolute end-0 me-5"></div>
    <form class="div_questionario" action="{{ route('finished.modulo') }}" method="post">
        @csrf
        <h2 class="text-center"> Questionário </h2>
        @foreach ($questions as $key => $q)
            <div class="div_perg">
                <span>{{ $key + 1 }}° - {{ $q->perg }}</span>
                <div class="d-grid gap-1 ms-5">
                    <select name="resp[]" class="resp p-1 px-3">
                        <option value="1" selected> a) {{ $q->resp1 }} </option>
                        <option value="2"> b) {{ $q->resp2 }} </option>
                        <option value="3"> c) {{ $q->resp3 }} </option>
                    </select>
                </div>
                <div class="next_previous">
                    @if ($key != 0)
                        <span class="btn btn-danger  mx-5" onclick="previous({{ $key }})" class="previous">
                            previous
                        </span>
                    @endif

                    @if (count($questions) != $key + 1)
                        <span class="btn btn-primary  mx-5" onclick="next({{ $key }})" class="next"> next
                        </span>
                    @else
                        <div class="form_quest"><button type="submit" class="btnGeral  mx-5">Concluido</button></div>
                    @endif
                </div>
            </div>
        @endforeach
        <input type="number" value="{{$questions[0]->curso_id}}" class="block" name="curso_id">
    </form>

    <script>
        const pergs = document.querySelectorAll('.div_perg');

        for (let i = 0; i < pergs.length; i++) {
            if (i != 0) {
                pergs[i].classList.add('block');
            }
        }

        // const previous = document.querySelectorAll('.previous');
        // const next = document.querySelectorAll('.next');

        // previous.classList.add('block');

        function next(n) {
            pergs[n].classList.add('block');
            pergs[n + 1].classList.remove('block');
            if (typeof pergs[n + 2] == undefined) {

            }
        }

        function previous(n) {
            pergs[n].classList.add('block');
            pergs[n - 1].classList.remove('block');
        }

        const contador = document.getElementById('contador');
        var time = Math.round({{count($questions)}} * 1.5);
        var nTime = time;

        if (typeof contador != undefined) {
            contador.innerHTML = 'Time : ' + time + ' minutos';

            const lop = setInterval(() => {
                time -= 1
                contador.innerHTML = 'Time : ' + time + ' minutos';

                if (time < 10) {
                    contador.style.color = '#faa';
                }
                if (time == 0) {
                    time = nTime;
                    clearInterval(lop);
                    window.location.reload(true);
                }
            }, 60000);
        }
    </script>

    <script src="/js/functions.js"></script>
@endsection
