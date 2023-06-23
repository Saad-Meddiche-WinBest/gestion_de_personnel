@extends('layouts.app')

@section('content')



    <div class="box-container">

        @if (session('error'))
            <div class="alert alert-danger m-3">
                {{ session('error') }}
            </div>
        @endif

        

        <div class="notif">
            @if (auth()->user())
                @forelse($notifications as $notification)
                    <div class="alert alert-primary" role="alert">
                        [{{ $notification->created_at }}] User {{ $notification->data['name'] }}
                        ({{ $notification->data['email'] }})
                        has just registered.
                        <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                            Mark as read
                        </a>
                    </div>
                    @if ($loop->last)
                        <a href="#" id="mark-all">
                            Mark all as read
                        </a>
                    @endif
                @empty
                    There are no new notifications
                @endforelse
            @endif
        </div>

        <div class="content-dashboard" id="box-container">
            @foreach (fetch_cards() as $card)
                <div class="box box1" data-route-id="{{$card['text']}}">

                    <img src="{{ $card['image'] }}" class="image">
                    <form action="{{ $card['link'] }}" method="GET" id="myForm{{$card['text']}}">
                        <input type="hidden" name="name_of_model" value="{{ $card['name_of_model'] }}">
                        <div id="btn20" type="submit">{{ $card['text'] }}
                            @if ($card['text'] == 'Events')
                                <span id="notifications">0</span>
                            @endif
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var routes = document.querySelectorAll('.box');
        routes.forEach(function(route) {
            route.addEventListener('click', function() {
                var routeId = this.getAttribute('data-route-id');
                var form = document.getElementById('myForm' + routeId);
                form.submit();
            });
        });
    });
</script>
@endsection
