@extends('layouts.app')

@section('content')
   <!-- <table id="myTable" class="table table-dark table-sm">
    <thead>
        <tr>
            @foreach($columnData as $column)
                <th>{{ $column['name'] }}</th>
            @endforeach
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(id_poste== 2)
            @foreach($dataEmploye as $data)
                <tr>
                    @foreach($columnData as $column)
                        <td>{{ $data->{$column['name']} }}</td>
                    @endforeach
                    <td><button>Modifier</button></td>
                </tr>
            @endforeach
        @elseif(id_poste== 1)
            @foreach($dataStagiaire as $data)
                <tr>
                    @foreach($columnData as $column)
                        <td>{{ $data->{$column['name']} }}</td>
                    @endforeach
                    <td><button>Modifier</button></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table> -->
@endsection
