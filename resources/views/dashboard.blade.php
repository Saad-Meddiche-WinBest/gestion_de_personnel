@extends('layouts.app')

@section('content')
    <div class="box-container">
        <div class="Quick_Add">
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="service">
                <button>Services</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="personne">
                <button>Personnes</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="poste">
                <button>Postes</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="source">
                <button>Source</button>
            </form>
            <form action="{{ route('Gerer.create') }}" method="GET">
                <input type="hidden" name="name_of_model" value="employement">
                <button>Employements</button>
            </form>
        </div>

        <div class="content-dashboard" id="box-container">
            @foreach (fetch_cards() as $card)
                <div class="box box1">

                    <img src="{{ $card['image'] }}" class="image">
                    <form action="{{ $card['link'] }}" method="GET">
                        <input type="hidden" name="name_of_model" value="{{ $card['name_of_model'] }}">
                        <button type="submit">{{ $card['text'] }}
                            @if ($card['text'] == 'End')
                                <span id="notifications"></span>
                            @endif
                        </button>
                    </form>
                </div>
            @endforeach


        </div>
    </div>
    <script>
        $(document).ready(function() {
            var sourceSelect = $('#notifications');
            if (sourceSelect) {
                $.ajax({
                    url: '/check-expiration',
                    type: 'GET',
                    success: function(response) {
                        sourceSelect.html(response.notifications)
                    }
                });
            }
        });
    </script>
@endsection
