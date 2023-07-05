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
            'text' => 'Utilisateurs',
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
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Departements',
            'name_of_model' => 'departement',
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
            'text' => 'Raisons d\'absence',
            'name_of_model' => 'reason',
            'link' => '/Gerer'
        ],
        [
            'image' => 'data:image/png;base64,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',
            'text' => 'Events',
            'name_of_model' => 'event',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://tse3.mm.bing.net/th/id/OIP.sK04hKKc72wLGqDP4hKhugHaHa?pid=ImgDet&w=900&h=900&rs=1',
            'text' => 'Roles',
            'name_of_model' => 'role',
            'link' => '/roles'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Jours Férier',
            'name_of_model' => 'celebration',
            'link' => '/Gerer'
        ],
        [
            'image' => 'https://cdn-icons-png.flaticon.com/512/5777/5777935.png',
            'text' => 'Block Notes',
            'name_of_model' => 'note',
            'link' => '/Gerer'
        ]
        


    ];

    $postes = Poste::all();

    foreach ($postes as $poste) {
        $routes[] = [
            'image' => $poste->icon->nom,
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
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
          </svg>',
            'name_of_model' => 'absence',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Utilisateurs',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        </svg>',
            'name_of_model' => 'user',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Services',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
          </svg>',
            'name_of_model' => 'service',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Sources',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z"/>
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
          </svg>',
            'name_of_model' => 'source',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Employements',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z"/>
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
          </svg>',
            'name_of_model' => 'employement',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Personnes',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
          </svg>',
            'name_of_model' => 'personne',
            'link' => '/Gerer'
        ],
        [
            'title' => 'Roles',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
          </svg>',
            'name_of_model' => 'role',
            'link' => '/roles'
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
