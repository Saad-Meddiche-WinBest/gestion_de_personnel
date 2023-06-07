@extends('layouts.app')

@section('content')
    <div style="height:fit-content">
        <form action="{{ route('Gerer.create') }}" method="GET">
            <input type="hidden" name="tablename" value="service">
            <button>Services</button>
        </form>
        <form action="{{ route('Gerer.create') }}" method="GET">
            <input type="hidden" name="tablename" value="personne">
            <button>Personnes</button>
        </form>
    </div>
@endsection
