@extends('layouts.app')



@section('content')

    <div class="container-formule">
        <div class="formule">
            <form action="{{ route('Gerer.update', $data_of_table->id) }}" method='POST' class="formule">
                @csrf
                @method('PUT')
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                @foreach ($informations_of_columns as $column)
                    <div class="field">
                        {!! choose_input($column, $data_of_table) !!}

                    </div>
                @endforeach
                <div class="Sumbit_Button">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>

    </div>

    <style>
        .container-formule {
            display: flex;
            align-items: center;
            justify-content: center;

            margin: 10px;
        }

        .formule {
            background-color: aqua;

            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
            gap: 20px;
        }

        .field {
            width: fit-content;
        }

        .field input {
            width: 250px;
        }

        .field select {
            width: 225px;
            padding: 2px;
        }

        .Sumbit_Button {
            display: flex;
            align-items: end;
        }
    </style>

@endsection
