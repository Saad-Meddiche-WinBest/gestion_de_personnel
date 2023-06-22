@extends('layouts.app')

@section('content')
<!-- Afficher les messages de succès ou d'erreur si nécessaire -->
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('roles.create') }}" method="GET" style="width:100%;">
    <input type="hidden" name="name_of_model" value="reason">
    <div style="width:100%;"></div>
</form>

<table id="myTable" class="table table-borderless" style="background-color:white;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                <div style="display:flex; ">
               
                    @if (isset($role) && $role->hasPermissionTo($permission)  )
                    <form action="{{ route('retirPermission') }}" method="POST">
                        @csrf
                        <button id="btn1" type="submit" class="btn btn-danger">Revoke Permission</button>
                        <input type="hidden" name="permission" value="{{ $permission }}">
                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                        <input type="hidden" name="role_id" value="{{  $role->id }}">
                    </form>
                    @else
                    
                    <form action="{{ route('affectPermission') }}" method="POST">
                        @csrf
                        <button id="btn1" type="submit" class="btn btn-success">Assign Permission</button>
                        <input type="hidden" name="permission" value="{{ $permission }}">
                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                        <input type="hidden" name="role_id" value="{{  $role->id }}">
                    </form>
                    @endif

                </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
