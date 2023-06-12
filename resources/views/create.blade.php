@extends('layouts.app')

@section('content')

    <div class="container-formule"> 
    
        <div class="formule">
        <h5 style="color:black; width:100%; text-align:center;">Informations de base</h5>
            <form action="{{ route('Gerer.store') }}" method='POST' class="formule">
                @csrf
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                @foreach ($columnData as $column)
                    <div class="field">
                        {!! choose_input($column) !!}
                    </div>
                @endforeach
                <div class="Sumbit_Button">
                    
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
                
            </form>
        </div>

    </div>
    
@endsection
