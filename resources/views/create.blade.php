@extends('layouts.app')

@section('content')
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
        }

        .field {
            width: 50%;
        }

        .field input {
            width: 80%
        }
    </style>
    <div class="container-formule">
        <form action="">
            <div class="formule">
                @foreach ($columnData as $column)
                    <pre>{{ print_r($column) }}</pre>

                    <div class="field">
                        <label for="">{{ ucfirst($column['name']) }}</label>
                        <br>
                        <input type="tel" name="{{ $column['name'] }}">
                    </div>
                @endforeach
            </div>
        </form>
    </div>
@endsection
