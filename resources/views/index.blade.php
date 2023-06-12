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
                    @foreach ($columnData as $column)
                        <td>
                            {{ choose_data($data1->{$column['name']}, $column) }}
                        </td>
                    @endforeach
                    <td>
                        <form action="{{ route('Gerer.edit', $data1->id) }}" method="GET">
                            <button type="sumbit">Edit</button>
                            <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                        </form>
                        <form action="{{ route('Gerer.destroy', $data1->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="sumbit">Delete</button>
                            <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('Gerer.create') }}" method="GET">
        <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
        <button type="submit">Add {{ ucfirst($name_of_model) }}</button>
    </form>
@endsection
