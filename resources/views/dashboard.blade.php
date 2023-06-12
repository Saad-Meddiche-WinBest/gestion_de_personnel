@extends('layouts.app')

@section('content')
    <div class="box-container">
        <div class="Quick_Add">
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="service">
                <button>Services</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="personne">
                <button>Personnes</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="poste">
                <button>Postes</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="source">
                <button>Source</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="employement">
                <button>Employements</button>
            </form>
        </div>

        <div class="content-dashboard" id="box-container">

        </div>
    </div>
    <script>
        function fill_dash() {
            let dash = document.getElementById("box-container");
            let routes = [{
                    'image': 'https://cdn-icons-png.flaticon.com/512/3616/3616927.png',
                    'text': 'Employer',
                    'name': 'personne',
                    'link': '/poste/2'
                },
                {
                    'image': 'https://cdn-icons-png.flaticon.com/512/912/912214.png',
                    'text': 'Stagiaire',
                    'name': 'personne',
                    'link': '/poste/1'
                },
                {
                    'image': 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
                    'text': 'Présence',
                    'name': 'presence'
                },
                {
                    'image': 'https://cdn-icons-png.flaticon.com/512/1168/1168776.png',
                    'text': 'Utilisateur',
                    'name': 'user',
                    'link': '/Gerer'

                },
                {
                    'image': 'https://cdn-icons-png.flaticon.com/512/8653/8653200.png',
                    'text': 'Services',
                    'name': 'service',
                    'link': '/Gerer'
                },
                {
                    'image': 'https://staffngo.com/wp-content/uploads/2021/03/embauche3.png',
                    'text': 'Sources',
                    'name': 'source',
                    'link': '/Gerer'


                }
            ];

            routes.forEach(route => {
                let box = document.createElement("div");
                box.classList.add("box", "box1");

                let image = document.createElement("img");
                image.classList.add("image");
                image.src = route.image;

                let form = document.createElement("form");
                form.action = route.link;
                form.method = "GET";

                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "name_of_model";
                input.value = route.name;

                let button = document.createElement("button");
                button.classList.add("text");
                button.innerText = route.text;

                form.appendChild(input);
                form.appendChild(button);

                box.appendChild(image);
                box.appendChild(form);

                dash.appendChild(box);
            });
        }

        fill_dash();
    </script>
@endsection
