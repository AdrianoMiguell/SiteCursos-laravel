{{-- @if (Auth::user()->type == '1')
    {{ $admin = true }}
    {{print($admin);}}
@endif --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/css/general_components.css">
    <link rel="stylesheet" href="/css/geral.css">

    @if (Auth::user()->type == 1)
        <link rel="stylesheet" href="/css/admin/admin_geral.css">
        <link rel="stylesheet" href="/css/admin/workspaces.css">
    @else
        <link rel="stylesheet" href="/css/user.css">
    @endif

</head>

<body class="font-sans antialiased">
    @include('layouts.navigation')
    {{-- <div :errors="$errors"> </div> --}}
    <!-- Page Content -->

    <main>
        @yield('welcome')

        @yield('content')
    </main>

    <x-auth-session-status class="position-fixed alert alert-primary bottom-0 end-0 m-2" :status="session('status')" />

    @if ($errors->any())
        <div class="alert alert-danger position-fixed end-0 bottom-0 m-2">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
    @endif

    @include('layouts.footer')
</body>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

@yield('scripts')
{{-- <script src="/js/functions.js"></script> --}}

</html>
