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
            <form action="{{ route('Gerer.store') }}" method='POST' class="formule" data-parsley-validate>
                @csrf
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">

                @foreach ($informations_of_columns as $column)
                    <div class="field">
                        {!! choose_input($column) !!}
                    </div>
                @endforeach
                @if ($name_of_model == 'personne')
                    <div class="field">
                        <label for="">Notify</label>
                        <br>
                        <input type="date" name="date_notification">
                    </div>
                @endif
                <div class="Sumbit_Button">

                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#Poste').change(function() {
                var selectedPoste = $(this).val();
                var sourceSelect = $('#Source');

                if (selectedPoste) {
                    $.ajax({
                        url: '/get-sources/' + selectedPoste,
                        type: 'GET',
                        success: function(response) {

                            if (response.sources.length != 0) {
                                sourceSelect.html('<option value="">Selectionner</option>');

                                $.each(response.sources, function(key, value) {
                                    sourceSelect.append('<option value="' + value.id +
                                        '">' + value.nom + '</option>');
                                });
                            } else {
                                sourceSelect.html(
                                    '<option value="">No Source For This Poste</option>');

                            }

                            sourceSelect.prop('disabled', false);
                        }
                    });
                } else {
                    sourceSelect.prop('disabled', true);
                    sourceSelect.html('<option value="">Selectionner</option>');
                }
            });
        });
    </script>
@endsection
