@extends('layouts.app')

@section('content')
    <div class="container-formule">

        <div class="formule">
            <h5 style="color:black; width:100%; text-align:center;">Informations de base</h5>
            <form action="{{ route('Gerer.store') }}" method='POST' class="formule">
                @csrf
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">

                @foreach ($columnData as $column)
                    <div class="field">
                        {!! choose_input($column) !!}
                    </div>
                @endforeach
                <div class="Sumbit_Button">

                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            if (response.sources.lenght == 0) {
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
