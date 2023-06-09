@extends('layouts.app')

@section('content')
    <table id="myTable" class="display">
        <thead>
            <tr>
                @foreach ($columnData as $column)
                    <th>{{ $column['name'] }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $data1)
                <tr>
                    <form action="{{ route('Gerer.update', $data1['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach ($columnData as $column)
                            <td>
                                {!! choose_input_and_fill_them($data1, $column) !!}
                                {{-- <input type="text" name="{{ $column['name'] }}" value="{{ $data1->{$column['name']} }}"> --}}
                            </td>
                        @endforeach
                        <td>
                            <button type="sumbit">Update</button>
                        </td>
                        <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                    </form>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    <form action="{{ route('Gerer.create') }}" method="GET">
        <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
        <button type="submit">Add {{ ucfirst($name_of_model) }}</button>
    </form>
@endsection
