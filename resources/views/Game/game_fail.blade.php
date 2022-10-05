<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
@extends('master')  
@section('content') 





<div style="margin: auto; width: 100%; text-align: center;    height:90%;padding:10px;">

<img src= '{{$anime->value("image1")}}' id="imageBox" style="padding:0; width: 30%; height:350"><br><br>
@for ($i = 0; $i < 7; $i++)
 @if ($i < 6)
    <button onclick="toggle{{$i+1}}()" style="padding:0; width:auto; height:auto" ><img src='{{asset("img/box.jpg")}}' id="btn{{$i+1}}" class="img-btn"></button>
  @endif
@endfor

@For($k = 1; $k < 7; $k++)
  @if ($k < 7)
  
    <script>
      function toggle{{$k}}(){
        const buttons = document.getElementsByClassName('img-btn');
        for (var i = 0; i < buttons.length; i++) {
          const buttonImage = buttons[i].src = "img/box.jpg";
        }
        document.getElementById("btn{{$k}}").src = "img/greenbox.jpg"; 
        var myvar = "{{$anime->value("image$k")}}";
        document.getElementById('imageBox').src = myvar;

      }
    </script>
  @endif 
@endfor

<h1 style="color:white;">You Lose!!</h1>
<p style="color:white;">The Answer was {{$anime->value("name")}}</p>

<script>
const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    buttons[buttons.length-1].src = "{{asset('img/greenbox.jpg')}}";
</script>

@stop