@extends('layouts.app')

@section('content')
    <div class="container-formule">
        <form action="{{ route('Gerer.store') }}" method='POST'>
            @csrf
            <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
            @foreach ($columnData as $column)
                <div class="field">
                    {!! choose_input($column) !!}
                </div>
            @endforeach
            <div class="Sumbit_Button">
                <button type="submit">AJouter</button>
            </div>
        </form>
    </div>
@endsection
