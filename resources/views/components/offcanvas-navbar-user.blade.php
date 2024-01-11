<button class="btnGeral btnGeral-light btn-offcanvas" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvas-navbar-user" aria-controls="offcanvas-navbar-user">
    <i class="bi bi-list"></i>
</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvas-navbar-user"
    aria-labelledby="offcanvas-navbar-userLabel" style="width: 300px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title d-inline-block text-truncate" id="offcanvas-navbar-userLabel"
            style="max-width: 250px; overflow: hidden;">
            @auth
                <a href="{{ route('profile.view') }}">
                    {{ Auth::user()->name }}
                </a>
            @endauth
            @guest
                Convidado
            @endguest
        </h5>
        <button type="button" class="offcanvas-btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <h2> Convidado </h2>
        <p class="m-2 mx-4">
            Opções de controle. Todos as alterações devem ser feitas com cuidado, pois
            algumas podem ser
            inalteráveis.
        </p>

        <div class="my-5">
            <ul class="offcanvas-menu">
                <li class="offcanvas-item"><span> lorem y 1</span></li>
                <li class="offcanvas-item"><span> lorem y 2</span></li>
                <li class="offcanvas-item"><span> lorem y 3</span></li>
                <li class="offcanvas-item"><span> lorem y 4</span></li>
            </ul>

        </div>

    </div>
</div>
