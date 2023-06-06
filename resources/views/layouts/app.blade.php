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
        <link rel="stylesheet" href="{{ asset("assets/style.css") }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom gaming styles */
        body {
            background-color: #ffffff;
            color: #030303;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            background-color: #000;
        }

        .navbar-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #ff0;
        }

        .nav-link {
            color: #fff;
            font-size: 18px;
        }

        .nav-link:hover {
            color: #ff0;
        }
    </style>
    
</head>
<body style="height:100%;">
    <div id="app" style="height:100%;">

       @include('layouts.include.navbar')

        <main style="height:93.25%;">
                   @include('layouts.include.sidebar')

            @yield('content')
        </main>
        
    </div>
            <script  src="{{ asset("assets/style.js") }}"></script>
            <script>
alert('sdfsdfsdfsd')
    function fill_sidebar(){
        alert('ssssssssssssssss')

        let sidebar = document.getElementById("container-sidebar")
        let routes = {
          {'title':'route1','icon':''},
          {'title':'route3','icon':''},
          {'title':'route2','icon':''},
        }
        routes.forEach(route => {
             sidebar.innerHTML += `<div class="route">
                                        <div class="icon">

                                        </div>
                                        <div class="title">
                                            ${route.title}
                                        </div>
                                    </div>`
        });
    }
    fill_sidebar()
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
