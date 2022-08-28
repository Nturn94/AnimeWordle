<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
@extends('master')  
@section('content') 
<div style="  margin: auto; width: 50%; text-align: center;">
<button onclick="on()" id="info">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="10"></circle>
  <line x1="12" y1="16" x2="12" y2="12"></line>
  <line x1="12" y1="8" x2="12.01" y2="8"></line>
</svg>
</button>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
<img src="{{ asset('img/title.png') }}">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20v-6M6 20V10M18 20V4"></path></svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
<div id="overlay" style="  margin: auto; width: 30%; text-align: center;">
  <div id="text">Info</div>
  <button onclick="off()" id = "x">
            X
  </button>
  <p id="infotext"> This website is inspired by the wordle and framed games. </p>
</div>
</div>
<script>
function on() {
  document.getElementById("overlay").style.display = "block";
}
function off() {
  document.getElementById("overlay").style.display = "none";
}
</script>
<?php
$list = array();
$aniarray = (array) $animes;
foreach($aniarray as $anime){
    array_push($list, $anime->name);
}
$image = $animes[$days]->image;
$dayno = 0;
$guessno = 0;
$consec = 0;
$win = 0;
$fail = 0;
$days = $days;
$currentimg = $animes[$days]->image;



  ?>


<div style="  margin: auto; width: 50%; text-align: center;">
<?php
$value = $_COOKIE['guessno'];
$values = (int)$value + 1;
?>
<img src= '' id="imageBox" style="padding:0; width:600; height:400"><br><br>
@if ($_COOKIE["win"] > 0 OR $_COOKIE["fail"] > 0)
<?php $values = 6;?>
@endif
@for ($i = 0; $i < $values; $i++)
 @if ($i < 6)
    <button onclick="toggle{{$i+1}}()" style="padding:0; width:auto; height:auto" ><img src='{{asset("img/box.jpg")}}' id="btn{{$i+1}}" class="img-btn"></button>
  @endif
@endfor
<script>
<?php 
$hello = $animes[$days]->image;
$tool = "image";
$tool2 = $i;
$tool3 = $tool.=$tool2;
if ($tool3 == "image1"){
  $tool3 = "image";
}
elseif ($tool3 == "image7"){
  $tool3 = "image6";
}
?>
var temp = <?php echo $i;?>;
var valuestojs = <?php echo $values;?>;
  const updateImage = () => {
    if((valuestojs) === 1){
      document.getElementById("imageBox").src = "{{$animes[$days]->image}}";
      return
    }
    document.getElementById("imageBox").src = "{{$animes[$days]->$tool3}}";
  }
  const runOnload = () => {
    updateImage();
  }
  runOnload();
  const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    buttons[buttons.length-1].src = "{{asset('img/greenbox.jpg')}}";
</script>
<?php $values = $_COOKIE['guessno']; ?>
@if ($_COOKIE["win"] > 0)
  @if ($values == 1)
    <h1 style="color:white; ">You win in {{$_COOKIE["guessno"]}} guess! </h1>
  @else
    <h1 style="color:white; ">You win in {{$_COOKIE["guessno"]}} guesses! </h1>
  @endif
  <p style="color:white; ">It was: {{$animes[$days]->name }}</p>
  <p style='color:white; ;'>You're at {{$_COOKIE["consec"]}} in a row! </p>
@endif
@if ($_COOKIE["fail"] > 0 || $values > 5)
<p style="color:white;">Sorry you lost! the answer was: {{$animes[$days]->name}}</p>
@endif
@if ($_COOKIE["win"] < 1 and $_COOKIE["fail"] < 1 and $values < 6)
  <h2 style="color: white;">This is guess number: {{$_COOKIE['guessno']+1}} out of 6 </h2><br>' ;
  <form method="post" autocomplete="off" class = "autocomplete" action="{{route('game.guess')}}" style="">
    @csrf
    <input type="text" id="search" name="guess"/>
    <input onClick="onClick()" type="submit" name="SubmitButton"/>
  </form>    
@endif
<h3> Previous guesses</h3>
@if (empty($_COOKIE['guesslist']))
   No guesses
@else
  {!! $_COOKIE["guesslist"] !!}
@endif
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var path = "{{ route('game.autocomplete') }}";
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
  const gl = document.getElementsByClassName('guesslisto');
    for (var i = 0; i < gl.length; i++) {
      gl[i].style.color = "white";
    }
  <?php echo 'if ('.$_COOKIE["win"].' == 1){
    const guesslist = document.getElementsByClassName("guesslisto");
    guesslist[guesslist.length - 1].style.color = "#FFA500";
  }';?>
  function toggle1(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = '{{asset("img/box.jpg")}}';
    }
    document.getElementById("btn1").src = '{{asset("img/greenbox.jpg")}}'; 
    var myvar = <?php echo json_encode($animes[$days]->image); ?>;
    document.getElementById('imageBox').src = myvar;
  }
  function toggle2(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = '{{asset("img/box.jpg")}}';
    }
    document.getElementById("btn2").src = '{{asset("img/greenbox.jpg")}}'; 
    var myvar = <?php echo json_encode($animes[$days]->image2); ?>;
    document.getElementById('imageBox').src = myvar;
  }
  function toggle3(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn3").src = "img/greenbox.jpg"; 
    var myvar = <?php echo json_encode($animes[$days]->image3); ?>;
    document.getElementById('imageBox').src = myvar;
  }
  function toggle4(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn4").src = "img/greenbox.jpg"; 
    var myvar = <?php echo json_encode($animes[$days]->image4); ?>;
    document.getElementById('imageBox').src = myvar;
  }
  function toggle5(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn5").src = "img/greenbox.jpg"; 
    var myvar = <?php echo json_encode($animes[$days]->image5); ?>;
    document.getElementById('imageBox').src = myvar;
  }
  function toggle6(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn6").src = "img/greenbox.jpg"; 
    var myvar = <?php echo json_encode($animes[$days]->image6); ?>;
    document.getElementById('imageBox').src = myvar;
  }
</script>
@stop

