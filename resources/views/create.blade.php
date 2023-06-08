@extends('layouts.app')

@section('content')
    <div class="container-formule">
        <form action="{{ route('Gerer.store') }}" method='POST'>
            @csrf
            <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
            <div class="formule">
                @foreach ($columnData as $column)
                    <div class="field">
                        <label for="">{{ filter_name($column['name']) }}</label>
                        <br>
                        @empty($column['comment'] == 'foreign')
                            <input type="{{ $column['comment'] }}" name="{{ $column['name'] }}">
                        @else
                            <select name="{{ $column['name'] }}">
                                {!! fetch_options($column['foreign_key']['referenced_table']) !!}
                            </select>
                        @endempty
                    </div>
                @endforeach
                <div class="Sumbit_Button">
                    <button type="submit">AJouter</button>
                </div>
            </div>
        </form>
    </div>
@endsection
