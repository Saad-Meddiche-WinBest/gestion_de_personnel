@extends('layouts.app')



@section('content')
    @if (session('error'))
        <div class="alert alert-danger m-3">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-formule">

        <div class="formule">
            <form action="{{ route('Gerer.update', $data_of_table->id) }}" method='POST' class="formule">
                @csrf
                @method('PUT')
                <input type="hidden" name="name_of_model" value="{{ $name_of_model }}">
                @foreach ($informations_of_columns as $column)
                    <div class="field">
                        {!! choose_input($column, $data_of_table) !!}

                    </div>
                @endforeach
                <div class="Sumbit_Button">
                    <button  class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>

    </div>

    <style>
        .container-formule {
            display: flex;
            align-items: center;
            justify-content: center;

            margin: 10px;
        }

        .formule {
  
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding: 10px;
  gap:20px;
  margin: 16px;
  background-color: #ffffff;
  border-radius: 20px;
  color: grey;
}
.field input {
  width: 500px;
  outline: none;
  border:none;
  
  border-bottom: 1px solid rgb(221, 220, 220);
  cursor: pointer;
}
.field select {
  width: 500px;
  outline: none;
  border:none;
  
  border-bottom: 1px solid rgb(224, 224, 224);
  cursor: pointer;
}
@media only screen and (max-width: 800px) {
  .field input {
    
      width: 250px;
  }
  .field select {
      width: 250px;
  }
}
.Sumbit_Button{
  display: flex;
  align-items: end;
 
}
.field input:focus{
  border-bottom: 1px solid rgb(49, 134, 190);
}
.field select:focus{
  border-bottom: 1px solid rgb(49, 134, 190);
}
.field input:hover{
  border-bottom: 1px solid rgb(49, 134, 190);
}
.field select:hover{
  border-bottom: 1px solid rgb(49, 134, 190);
}

    </style>
@endsection
