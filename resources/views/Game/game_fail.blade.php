<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
@extends('master')  
@section('content') 


<h1 style="color:white;">You Lose!!</h1>
<p style="color:white;">The Answer was {{$anime->value("name")}}</p>


@stop