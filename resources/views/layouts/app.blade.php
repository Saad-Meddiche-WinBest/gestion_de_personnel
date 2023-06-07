<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{-- CDN Bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

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


    {{-- scripts --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
