@extends('layouts.app')

@section('content')
    <div id="box-container">
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
@endsection
