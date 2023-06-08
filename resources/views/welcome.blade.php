@extends('layouts.master')

@section('content')
<div class="content-welcome">
    <div class="Inscription">

        <div class="Title">
            <h1>Offrez à vos employés des expériences exceptionnelles</h1>
        </div>

        <div class="Description">
            <p>Le monde du travail évolue rapidement et vos pratiques
                en matière de ressources humaines doivent s'adapter à
                cette évolution. WEBSITE est un logiciel RH
                conçu pour fidéliser les employés, s'adapter
                rapidement aux changements et, favoriser l'agilité et
                l'efficacité liées à la gestion des RH. Simplifiez vos
                opérations RH, fidélisez les talents et développez des
                équipes très performantes tout en accordant la priorité
                à l'expérience des employés.</p>
        </div>

         @guest
             <div class="Inscrire_Button">
                 <button><a href="/register">INSCRIVEZ-VOUS GRATUITEMENT</a></button>
                 <button id="btn"><a href="/login">SE CONNECTER</a></button>
             </div>
         @else

                    @endguest
                </div>
                <div class="Image">
                    <img src="https://www.zohowebstatic.com/sites/zweb/images/people/zp-img2.png">
                </div>

</div>
@endsection