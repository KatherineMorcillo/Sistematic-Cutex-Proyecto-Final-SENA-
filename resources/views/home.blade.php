@extends('layouts.app')

@section('content')
<h1 class="text-center">
@switch(Auth::user()->rol_id)
    @case(1)
        Administrador
        @break
        @case(2)
        Vendedor
        @break
        @case(3)
        Auxiliar
        @break
@endswitch
</h1>
<div class="d-flex justify-content-center">
    <img src="{{ url('images/1.jpg')}}" alt="dark logo sdfsdfsdfdsdfsdfsdfdsfsdf" width="600" height="600">
</div>



@endsection
