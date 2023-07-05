@extends('layouts.app')


@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" style="width: 100%;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-danger" style="width: 100%;">
            {{ session('message') }}
        </div>
    @endif


    @if ($name_of_model != 'absence' && $name_of_model != 'role')
        @if ($name_of_model != 'user')
            <form action="{{ route('Gerer.create') }}" method="GET" style="width:100%;">
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                <div style="width:100%;">
                    <button type="submit" class="btn btn-primary"
                        style="float:right;  margin-top:15px;  margin-bottom:15px; font-size:1.5vh; ">

                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px; margin-bottom: 2.5px;"
                            width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>Add {{ ucfirst($name_of_model) }}</button>
                </div>
                <h2 style="font-family: 'Noto Sans TC', sans-serif;  margin:5px">Liste {{ ucfirst($name_of_model) }} </h2>
            </form>
        @else
            <div style="width:100%">
                <h2 style="font-family: 'Noto Sans TC', sans-serif;  margin:5px ; float:left">Liste
                    {{ ucfirst($name_of_model) }} </h2>
            </div>
        @endif
    @endif

    @if ($name_of_model == 'absence')
        <form action="{{ route('set-persiode-absence') }}" method="POST">
            <div class="d-flex gap-4">
                @csrf
                <div id="date1">
                    <label for="">from_date</label>

                    <input type="date" name="from_date" id="from_date">
                </div>
                <div id="date1">
                    <label for="">to_date</label>

                    <input type="date" name="to_date" id="to_date">
                </div>

                <button id="fresh" type="submit" name="periode" class="btn btn-dark">Fresh</button>

            </div>
        </form>
    @endif



    <table id="myTable" class="table table-hover" style="background-color:white;">
        <button id="exportButton" class="btn btn-success" style="margin-top:15px; margin-bottom:15px;">Export to
            Excel</button>
        <thead>
            <tr>
                @foreach ($informations_of_columns as $column)
                    @if ($column['name'] != 'id_icon')
                        <th style="font-size:0.7rem;">{{ filter_name($column['name']) }}</th>
                    @endif
                @endforeach
                <th style="font-size:0.7rem;">Action</th>
                @if ($name_of_model == 'user')
                    <th>Role</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data_of_table as $data)
                <tr {{ color_expired_event($name_of_model, $column, $data) }}>

                    @foreach ($informations_of_columns as $column)
                        @if ($column['name'] != 'id_icon')
                            <td style="font-size:0.7rem;">
                                {{ choose_data($data->{$column['name']}, $column) }}

                            </td>
                        @endif
                    @endforeach

                    <td>
                        <div style="display:flex; ">

                            @if ($name_of_model !== 'role')
                                <form action="{{ route('Gerer.edit', $data->id) }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></button>
                                    <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                </form>
                                <form action="{{ route('Gerer.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btn1" type="sumbit" class="btn btn-danger"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg></button>
                                    <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                </form>
                            @endif

                            @if ($name_of_model == 'user')
                                <form action="{{ route('roles.user', $data->id) }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-success"
                                        style="height:100%; font-size:0.5rem;">Gérer
                                        Roles</button>
                                    <input type="hidden" name="name_of_model" value="role">
                                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                                </form>
                            @endif

                            @if ($name_of_model == 'role' && (isset($_GET['user_id']) || isset($test)))
                                @if (isset($user) && $user->hasRole($data->name))
                                    <form action="{{ route('retirerRole') }}" method="POST">
                                        @csrf
                                        <button id="btn1" id="refreshButton" type="submit"
                                            class="btn btn-danger">Revoke
                                            role of
                                            {{ choose_data($data->{$column['name']}, $column) }}</button>
                                        <input type="hidden" name="role_id" value="{{ $data->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                    </form>
                                @else
                                    <form action="{{ route('affecterRole') }}" method="POST">
                                        @csrf
                                        <button id="btn1" id="refreshButton" type="submit"
                                            class="btn btn-success">Assign
                                            role of
                                            {{ choose_data($data->{$column['name']}, $column) }}</button>
                                        <input type="hidden" name="role_id" value="{{ $data->id }}">
                                        <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    </form>
                                @endif
                            @endif
                            {{-- Absence Button --}}
                            @if ($name_of_model == 'personne')
                                <form action="{{ route('Gerer.create') }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-outline-success"
                                        style="font-size:0.7rem;">Absence</button>
                                    <input type="hidden" name="name_of_model" value="Absence">
                                    <input type="hidden" name="extra_informations[0][data]" value={{ $data->id }}>
                                    <input type="hidden" name="extra_informations[0][column]" value="id_personne">
                                </form>
                                <form action="{{ route('Gerer.create') }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-warning"
                                        style="font-size:0.7rem;">Evenement</button>
                                    <input type="hidden" name="name_of_model" value="event">
                                    <input type="hidden" name="extra_informations[0][data]" value={{ $data->id }}>
                                    <input type="hidden" name="extra_informations[0][column]" value="id_personne">
                                </form>
                                <form action="{{ route('Gerer.create') }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-warning"
                                        style="font-size:0.7rem;">Banner</button>
                                    <input type="hidden" name="name_of_model" value="ban">

                                    <input type="hidden" name="extra_informations[0][data]" value={{ $data->nom }}>
                                    <input type="hidden" name="extra_informations[0][column]" value="nom">
                                    <input type="hidden" name="extra_informations[1][data]" value={{ $data->prenom }}>
                                    <input type="hidden" name="extra_informations[1][column]" value="prenom">
                                    <input type="hidden" name="extra_informations[2][data]" value={{ $data->cin }}>
                                    <input type="hidden" name="extra_informations[2][column]" value="cin">
                                </form>
                            @endif
                        </div>
                    </td>

                    @if ($name_of_model == 'user' && $data->id !== 0)
                        <td>
                            <form action="{{ route('roles') }}" method="GET">
                                @csrf
                                <input type="hidden" name="name_of_model" value="role">
                                <input type="hidden" name="user_id" value="{{ $data->id }}">
                                <button id="btn1" type="submit" class="btn btn-outline-info"
                                    style="font-size:0.7rem;padding:height:100%"><svg xmlns="http://www.w3.org/2000/svg"
                                        style="padding-right: 6px; padding-bottom:2.5px;" width="20" height="20"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>See Roles</button>
                                <!-- <input type="text" name="assigned_role_id" value=""> Affichez l'ID du rôle ici -->
                            </form>

                        </td>
                    @elseif($name_of_model == 'user')
                        <td>
                        </td>
                    @endif


                </tr>
            @endforeach


        <tbody>
    </table>
@endsection
