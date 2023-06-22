@extends('layouts.master')

@section('title', 'Edit Account')

@section('content')
    <div class="container-fluid px-4">

        <div class="card mt-5 Big-Card">
            <div class="card-header Big-Title">
                <h4>Edit Account
                    {{-- <a href="{{ url('admin/users') }}" class="btn btn-light float-end" style="color:#FFC107;"><b>Back</b></a> --}}
                </h4>
            </div>
            <form action="{{ route('account.update') }}" method="post" class="mb-2">
                @csrf
                @method('PUT')

                @if (session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="card-body">

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input class="form-control" value="{{ Auth::user()->name }}" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="">Email</label>
                        <input class="form-control" value="{{ Auth::user()->email }}" name="email">
                    </div>

                    <div class="mb-3 on-modification by-default-showen" id="account-password">
                        <label for="">Password</label>
                        <input class="form-control fw-bold" value="********">
                    </div>

                    <div class="mb-3 on-modification by-default-hidden">
                        <label for="">Current Password</label>
                        <input class="form-control clear" type="password" value="" name="current-password">
                    </div>

                    <div class="mb-3 on-modification by-default-hidden">
                        <label for="">New Password</label>
                        <input class="form-control clear" type="password" value="" name="new-password">
                    </div>

                    <div class="mb-3 on-modification by-default-hidden">
                        <label for="">Repeat Password</label>
                        <input class="form-control clear" type="password" value="" name="repeat-password">
                    </div>

                    <div class="w-100 " style="gap:10px">
                        <div class="on-modification by-default-hidden">
                            <button class="btn btn-warning text-white fw-bold float-start"
                                onclick="event.preventDefault(); display_inputs();">Cancel</button>
                        </div>
                        <div class="on-modification by-default-hidden">
                            <button class="btn btn-warning text-white fw-bold float-end " type="submit">Update</button>

                        </div>
                        <div class="on-modification by-default-showen">
                            <button class="btn btn-warning text-white fw-bold float-end"
                                onclick="event.preventDefault(); display_inputs();">Modification</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
