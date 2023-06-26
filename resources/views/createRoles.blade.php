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
            <form action="{{ route('roles.store') }}" method='POST' class="formule" >
                @csrf
                <label>Name of Role : </label>
                <input type="text" name="name">

                <div class="Sumbit_Button">

                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>
        </div>

    </div>

   
@endsection
