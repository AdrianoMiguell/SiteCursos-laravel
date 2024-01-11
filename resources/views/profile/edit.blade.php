@extends('layouts.app')

@section('content')
    <div>
        <h2 class="text-center my-4 fs-1 fw-bold dark_text text-shadow">
            {{ __('Profile') }}
        </h2>
    </div>

    <div class=" mt-0 p-4">
        <div class="border-none shadow-none dark_text">
            <div class="p-4">
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4">
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4">
                <div>
                    <h1 class="textDec fs-2">Logout</h1>
                    <p> Sair da conta atualmente logada. </p>
                    <form method="POST" action="{{ route('logout') }}" class="bg-transparent p-0 m-0">
                        @csrf
                        <a :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                            class="btnGeral btnGeral-dark">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>

            <div class="p-4">
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
