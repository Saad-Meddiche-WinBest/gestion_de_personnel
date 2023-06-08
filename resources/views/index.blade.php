@extends('layouts.app')

@section('content')
<table id="myTable" class="display">
    <thead>
        <tr>
            @foreach($columnData as $column)
                <th>{{ $column['name'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $data1)
            <tr>
                @foreach($columnData  as $column)
                    <td>{{ $data1->{$column['name']} }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
