<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
@extends('master')  
@section('content') 


<h1 style="color:white;">You Win!!</h1>
<p style="color:white;">The Answer was {{$anime->value("name")}}</p>

<p style="color:white;">You're at {{$consec}} in a row!</p>
<?php $values = count($_SESSION['guesses']); ?>
  @if ($values == 1)
    <h1 style="color:white; ">You win in {{count($_SESSION['guesses'])}} guess! </h1>
  @else
    <h1 style="color:white; ">You win in {{count($_SESSION['guesses'])}} guesses! </h1>
  @endif

@stop