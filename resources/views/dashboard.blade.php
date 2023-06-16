@extends('layouts.app')

@section('content')



    <div class="box-container">
     <div class="notif">   
    @if(auth()->user())
       
       @forelse($notifications as $notification)
           <div class="alert alert-primary" role="alert">
               [{{ $notification->created_at }}] User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just registered.
               <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                   Mark as read
               </a>
           </div>
           @if($loop->last)
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
                <div class="box box1">
                    <img src="{{ $card['image'] }}" class="image">
                    <form action="{{ $card['link'] }}" method="GET">
                        <input type="hidden" name="name_of_model" value="{{ $card['name_of_model'] }}">
                        <button id="btn20" type="submit">{{$card['text']}}</button>
                    </form>
                </div>
            @endforeach

        </div> 

      
    </div>

    
   
@endsection
<!-- <div class="Quick_Add">
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
        </div> -->