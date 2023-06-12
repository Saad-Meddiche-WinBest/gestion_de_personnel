<?php

use App\Models\Poste;

function fetch_cards()
{
    $routes = [

        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Présence',
            'name_of_model' => 'presence',
            'link' => '#'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/1168/1168776.png',
            'text' => 'Utilisateur',
            'name_of_model' => 'user',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/8653/8653200.png',
            'text' => 'Services',
            'name_of_model' => 'service',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://staffngo.com/wp-content/uploads/2021/03/embauche3.png',
            'text' => 'Sources',
            'name_of_model' => 'source',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://staffngo.com/wp-content/uploads/2021/03/embauche3.png',
            'text' => 'Postes',
            'name_of_model' => 'poste',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://staffngo.com/wp-content/uploads/2021/03/embauche3.png',
            'text' => 'Employements',
            'name_of_model' => 'employement',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://staffngo.com/wp-content/uploads/2021/03/embauche3.png',
            'text' => 'Personnes',
            'name_of_model' => 'personne',
            'link' => '/Gerer'
        ]
    ];

    $postes = Poste::all();

    foreach ($postes as $poste) {
        $routes[] = [
            'image' => 'https://cdn-icons-png.flaticon.com/512/3616/3616927.png',
            'text' => $poste->nom,
            'name_of_model' => 'personne',
            'link' => '/poste/' . $poste->id
        ];
    }

    return $routes;
}
