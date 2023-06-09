@extends('layouts.app')

@section('content')
    <table id="myTable" class="display">
        <thead>
            <tr>
                @foreach ($columnData as $column)
                    <th>{{ filter_name($column['name']) }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $data1)
                <tr>
                    <form action="{{ route('Gerer.edit', $data1->id) }}" method="GET">
                        @csrf
                        @foreach ($columnData as $column)
                            <td>
                                {{ choose_data($data1->{$column['name']}, $column) }}
                            </td>
                        @endforeach
                        <td>
                            <button type="sumbit">Edit</button>
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
