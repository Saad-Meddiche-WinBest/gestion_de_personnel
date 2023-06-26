<!-- Votre formulaire de création de rôle -->
@extends('layouts.app')

@section('content')
    <div class="container-formule">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="formule">
            <h5 style="color:black; width:100%; text-align:center;">Informations de base</h5>
            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method='POST' class="formule">
                @csrf

                @method('PUT')

                <label>Name of Role : </label>
                <input type="text" name="name" value="{{ $role['name'] }}">

                <div class="Sumbit_Button">

                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </form>
        </div>

    </div>
@endsection
