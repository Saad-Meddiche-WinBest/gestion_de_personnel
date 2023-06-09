@extends('layouts.app')


@section('content')
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

    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


    @if ($name_of_model != 'absence')
        <form action="{{ route('Gerer.create') }}" method="GET" style="width:100%;">
            <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
            <div style="width:100%;">
                <button type="submit" class="btn btn-primary" style="float:right;  margin-bottom:15px; font-size:1.5vh; ">
                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:20px" width="16" height="16"
                        fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                        <path
                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>Add {{ ucfirst($name_of_model) }}</button>
            </div>
        </form>
    @else
        <form action="{{ route('Gerer.create') }}" method="GET" style="width:100%;">

            <input type="hidden" name="name_of_model" value="reason">
            <div style="width:100%;">
                <button type="submit" class="btn btn-primary" style="float:right;  margin-bottom:15px; font-size:1.5vh; ">
                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:20px" width="16" height="16"
                        fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                        <path
                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>Add Date</button>
            </div>
        </form>
    @endif


    @if ($name_of_model == 'absence')
        <form action="{{ route('set-persiode-absence') }}" method="POST">
            <div class="d-flex gap-4">
                @csrf
                <div>
                    <label for="">from_date</label>
                    <br>
                    <input type="date" name="from_date" id="from_date">
                </div>
                <div>
                    <label for="">to_date</label>
                    <br>
                    <input type="date" name="to_date" id="to_date">
                </div>

                <button type="submit" name="periode"> Ok</button>
            </div>
        </form>
    @endif

    <table id="myTable" class="table table-borderless" style="background-color:white;">
        <button id="exportButton">Export to Excel</button>
        <thead>
            <tr>
                @foreach ($informations_of_columns as $column)
                    <th>{{ filter_name($column['name']) }}</th>
                @endforeach
                <th>Action</th>
                @if ($name_of_model == 'user')
                    <th>Role</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data_of_table as $data)
                <tr @if (
                    $name_of_model == 'event' &&
                        $column['name'] == 'date' &&
                        $data->{$column['name']} == Carbon\Carbon::today()->format('Y-m-d')) style="background-color: grey" @endif>
                    @foreach ($informations_of_columns as $column)
                        <td>
                            {{ choose_data($data->{$column['name']}, $column) }}
                        </td>
                    @endforeach

                    <td>
                        <div style="display:flex; ">

                            @if ($name_of_model !== 'role' && $data->id !== 0)
                                <form action="{{ route('Gerer.edit', $data->id) }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-warning">Edit</button>
                                    <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                </form>
                                <form action="{{ route('Gerer.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btn1" type="sumbit" class="btn btn-danger">Delete</button>
                                    <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                                </form>
                            @endif

                            @if ($name_of_model == 'user' && $data->id !== 0)
                                <form action="{{ route('roles.user', $data->id) }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-success">Gérer Roles</button>
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
                                    <button id="btn1" type="sumbit" class="btn btn-primary">Absence</button>
                                    <input type="hidden" name="name_of_model" value="Absence">
                                    <input type="hidden" name="extra_informations[0][data]" value={{ $data->id }}>
                                    <input type="hidden" name="extra_informations[0][column]" value="id_personne">
                                </form>
                                <form action="{{ route('Gerer.create') }}" method="GET">
                                    <button id="btn1" type="sumbit" class="btn btn-primary">Evenement</button>
                                    <input type="hidden" name="name_of_model" value="event">
                                    <input type="hidden" name="extra_informations[0][data]" value={{ $data->id }}>
                                    <input type="hidden" name="extra_informations[0][column]" value="id_personne">
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
                                <button id="btn1" type="submit" class="btn btn-primary">See Roles</button>
                                <!-- <input type="text" name="assigned_role_id" value=""> Affichez l'ID du rôle ici -->
                            </form>
                        </td>
                    @endif

                </tr>
            @endforeach


        <tbody>
    </table>
@endsection
