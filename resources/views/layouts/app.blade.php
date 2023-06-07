<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ContentS1 {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            align-content: center  !important;
        }
    </style>

</head>

<body style="height:100%;">
    <div id="app" style="height: 100%; display: flex; flex-direction: column;">

        @include('layouts.include.navbar')


        <main style="flex: 1;display:flex;">
            @include('layouts.include.sidebar')


            <div class="ContentS1" style="flex: 1;">
                @yield('content')
            </div>
        </main>

    </div>


    <script src="{{ asset('assets/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
