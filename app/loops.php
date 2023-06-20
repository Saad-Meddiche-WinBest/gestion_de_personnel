<?php

use Carbon\Carbon;
use App\Models\Poste;
use App\Models\Personne;
use Illuminate\Support\Facades\Cache;

function fetch_cards()
{


    $routes = [

        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Absence & Retard',
            'name_of_model' => 'absence',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://tse1.mm.bing.net/th/id/OIP.Fg9VWaZARb9eR_iwbUpGbwAAAA?pid=ImgDet&w=298&h=298&rs=1',
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
            'image' => 'https://www.clipartkey.com/mpngs/m/73-731125_resources-icon-infographic-.png',
            'text' => 'Sources',
            'name_of_model' => 'source',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://cdn3.iconfinder.com/data/icons/ui-glynh-blue-01-of-5/100/UI_Glyph_Blue_1_of_3_50-512.png',
            'text' => 'Postes',
            'name_of_model' => 'poste',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://hirehoustonyouth.org/wp-content/uploads/2018/01/youth-icon.png',
            'text' => 'Employements',
            'name_of_model' => 'employement',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://tse3.mm.bing.net/th/id/OIP.sK04hKKc72wLGqDP4hKhugHaHa?pid=ImgDet&w=900&h=900&rs=1',
            'text' => 'Personnes',
            'name_of_model' => 'personne',
            'link' => '/Gerer'
        ],
        [

            'image' => 'https://cdn-icons-png.flaticon.com/512/1168/1168776.png',
            'text' => 'Les raisons d\'absence',
            'name_of_model' => 'reason',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/1168/1168776.png',
            'text' => 'Events',
            'name_of_model' => 'event',
            'link' => '/Gerer'

        ],
        [
            'image' => 'https://tse3.mm.bing.net/th/id/OIP.sK04hKKc72wLGqDP4hKhugHaHa?pid=ImgDet&w=900&h=900&rs=1',
            'text' => 'Role',
            'name_of_model' => 'role',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Celibrations',
            'name_of_model' => 'celebration',
            'link' => '/Gerer'
        ],

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

function fill_sidebar()
{
    $routes = [
        [
            'title' => 'Dashboard',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
                        </svg>',
            'name_of_model' => '',

            'link' => '/dashboard'
        ],
        [
            'title' => 'Présence',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
                        </svg>',
            'name_of_model' => '',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Utilisateur',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        </svg>',
            'name_of_model' => 'user',
            'link' => '/Gerer'
        ]
    ];

    $postes = Poste::all();

    foreach ($postes as $poste) {
        $routes[] = [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>',
            'title' => $poste->nom,
            'name_of_model' => '',

            'link' => '/poste/' . $poste->id
        ];
    }

    return $routes;
}
