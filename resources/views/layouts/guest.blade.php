<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cursos Online') }}</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/css/geral.css">
    <link rel="stylesheet" href="/css/general_components.css">

    @if (isset($slot))
        <link rel="stylesheet" href="/css/auth.css">
    @endif

    @yield('links')

</head>

<body class="font-sans text-gray-900 antialiased">

    @if (isset($slot))
        <div class="div-form py-5 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-25 h-25" style="margin: 1rem auto;" />
                </a>
            </div>
            <div class="w-100 d-flex flex-column justify-content-center align-items-center py-5"
                style="background-color: rgba(var(--tert-c), .1);">
                {{ $slot }}
            </div>
        </div>
    @else
        @include('layouts.navigation')

        @yield('content')

        @yield('welcome')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger position-fixed end-0 bottom-0 m-2">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
    @endif

    @yield('scripts')
</body>

</html>
