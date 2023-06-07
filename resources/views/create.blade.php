@extends('layouts.app')

@section('content')
    <div class="container-formule">
        <form action="">
            <div class="formule">
                @foreach ($columnData as $column)
                    <div class="field">
                        <label for="">{{ filter_name($column['name']) }}</label>
                        <br>
                        @empty($column['comment'] == 'foreign')
                            <input type="{{ $column['comment'] }}" name="{{ $column['name'] }}">
                        @else
                            <select name="" id="">
                                {!! fetch_options($column['foreign_key']['referenced_table']) !!}
                            </select>
                        @endempty
                    </div>
                @endforeach
            </div>
        </form>
    </div>
@endsection
