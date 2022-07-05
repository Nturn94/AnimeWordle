<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />


@extends('master')  
@section('content') 




<div style="  margin: auto; width: 50%; text-align: center;">
  


  <img src="{{ asset('img/title.png') }}">
</div>

<!-- <h1 style="margin-left: auto; margin-right: auto;"> Hello world </h1> -->

<?php
// print_r($animes[$days]);
// echo '<br><br><img src= ' .$animes[$days]->image6. ' width="600" height="400" style="position: absolute; top: 300px; right: 750px;">';


$list = array();

// echo $days;
// if(ISSET($_COOKIE['dayno'])){
//     echo "Heelo this is cookie". $_COOKIE['dayno'];
// }

// print_r($animes);


$aniarray = (array) $animes;

foreach($aniarray as $anime){
    array_push($list, $anime->name);

    
}
// print_r($list);

// echo '<br>this is fail: '. $_COOKIE["fail"]. '<br>' ;
// echo 'this is win: '. $_COOKIE["win"]. '<br>' ;


// setcookie("fail", 0, "/"); 
// setcookie("guessno", 0, "/"); 



$image = $animes[$days]->image;
$dayno = 0;
$guessno = 0;
$consec = 0;
$win = 0;
$fail = 0;
$days = $days;



// setcookie("dayno", $days, "/");
// setcookie("guessno", $guessno, "/");
// setcookie("consec", $consec, "/");
// setcookie("win", $win, "/");
// setcookie("fail", $fail, "/");


if(!isset($_COOKIE["dayno"])) {
    setcookie("dayno", $days,  "/");
    setcookie("guessno", 0,  "/");
    setcookie("consec", 0,  "/");
    setcookie("win", 0,   "/");
    setcookie("fail", 0,  "/");
}
if($_COOKIE["dayno"] != $days) {
    setcookie("dayno", $days,  "/");
    setcookie("guessno", 0,  "/");
    setcookie("win", 0,  "/");
    setcookie("fail", 0,  "/");
    header('Refresh: 0');
}




// echo "<br>This is nubers". $_COOKIE['dayno'], $days;

if($_COOKIE["win"] == 1){

    echo '<div style="  margin: auto; width: 50%; text-align: center;">';
    echo '    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <button onclick="toggleText()" id="Stupoo" ><img src='.asset("img/box.jpg") . ' id="btn1"></button>
    <button onclick="toggle2()" ><img src='.asset("img/box.jpg") . ' style="font-size:0" id="btn2"></button>
    <button onclick="toggle3()" ><img src='.asset("img/box.jpg") . ' id="btn3" class="img-btn"></button>
    <button onclick="toggle4()" ><img src='.asset("img/box.jpg") . ' id="btn4" class="img-btn"></button>
    <button onclick="toggle5()" ><img src='.asset("img/box.jpg") . ' id="btn5" class="img-btn"></button>
    <button onclick="toggle6()" ><img src='.asset("img/greenbox.jpg") . ' id="btn6"></button>
    <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image4. ' id="Myid3" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image5. ' id="Myid4" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image6. ' id="Myid5" class="aniimg"  width="600" height="400" style="position: absolute; top: 125px; right: 650px;"> 

    ';

    echo '<h1 style="color:white; ">You win in ' .$_COOKIE["guessno"]. ' </h1>';
    echo '<p style="color:white; ">It was: '. $animes[$days]->name. '</p>';
    echo "<p style='color:white; ;'>You're at ". $_COOKIE["consec"]. " in a row! </p>";
    


    echo '


    </div>

    
        



    ';



}

if($_COOKIE["fail"] == 0 && $_COOKIE["win"] != 1){

    if($_COOKIE["guessno"] == 0){
        $guessnotwo = $_COOKIE["guessno"] + 1;
        echo '<div style="  margin: auto; width: 50%; text-align: center;">';
        
        echo '<br><br><img src= ' .$animes[$days]->image. ' class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">';
        

        echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn1" class="img-btn"></button>
        <h2 style="color: white; ">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>
        <form method="post" autocomplete="off" action="'.route('anime.guess').'" style="">
            '.csrf_field().'
            <input type="text" id="search" name="guess"/>
            <input type="hidden" name="animu"  value= "' .$animes[$days]->name. '">
            <input type="hidden" name="days" value= "' .$days. '">
            <input type="submit" name="SubmitButton"/>
        </form>
        <br>
        
        </div>
        

        ';


    }
    
    if($_COOKIE["guessno"] == 1){
        $guessnotwo = $_COOKIE["guessno"] + 1;
        echo '<div style="  margin: auto; width: 50%; text-align: center;">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button onclick="toggleText()" ><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
        <button onclick="toggle2()" ><img src='.asset("img/greenbox.jpg") . ' id="btn2" class="img-btn"></button>

        <h2 style="color: white;">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>' ;
        echo '
        <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <form method="post" autocomplete="off" class = "autocomplete" action="'.route('anime.guess').'" style="">
            '.csrf_field().'
            <input type="text" id="search" name="guess"/>
            <input type="hidden" name="animu" value= "' .$animes[$days]->name. '">
            <input type="hidden" name="days" value= "' .$days. '">
            <input onClick="onClick()" type="submit" name="SubmitButton"/>
        </form>
        <br>
    

        </div>
    

        ';
    }
    
    if($_COOKIE["guessno"] == 2){
        $guessnotwo = $_COOKIE["guessno"] + 1;
        echo '<div style="  margin: auto; width: 50%; text-align: center;">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
        <button onclick="toggle2()" style=""><img src='.asset("img/box.jpg") . ' id="btn2" class="img-btn"></button>
        <button onclick="toggle3()" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn3" class="img-btn"></button>';
        echo '<h2 style="color: white;">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>' ;
        echo '
        <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <form method="post" autocomplete="off" class = "autocomplete" action="'.route('anime.guess').'" style="">
            '.csrf_field().'
            <input type="text" id="search" name="guess"/>
            <input type="hidden" name="animu" value= "' .$animes[$days]->name. '">
            <input type="hidden" name="days" value= "' .$days. '">
            <input onClick="onClick()" type="submit" name="SubmitButton"/>
        </form>
    
        </div>


        

        ';
    }
    
    if($_COOKIE["guessno"] == 3){
        $guessnotwo = $_COOKIE["guessno"] + 1;
        echo '<div style="  margin: auto; width: 50%; text-align: center;">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
        <button onclick="toggle3()" style=""><img src='.asset("img/box.jpg") . ' id="btn2" class="img-btn"></button>
        <button onclick="toggle3()" style=""><img src='.asset("img/box.jpg") . ' id="btn3" class="img-btn"></button>
        <button onclick="toggle4()" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn4" class="img-btn"></button>';
        echo '<h2 style="color: white;">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>' ;
        echo '
        <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <img src= ' .$animes[$days]->image4. ' id="Myid3" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
        <form method="post" autocomplete="off"  class = "autocomplete" action="'.route('anime.guess').'" style="">
            '.csrf_field().'
            <input type="text" id="search" name="guess"/>
            <input type="hidden" name="animu" value= "' .$animes[$days]->name. '">
            <input type="hidden" name="days" value= "' .$days. '">
            <input onClick="onClick()" type="submit" name="SubmitButton"/>
        </form>
    
        </div>
        

        ';
    }
    if($_COOKIE["guessno"] == 4){
      $guessnotwo = $_COOKIE["guessno"] + 1;
      echo '<div style="  margin: auto; width: 50%; text-align: center;">
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
      <button onclick="toggle2()" style=""><img src='.asset("img/box.jpg") . ' id="btn2" class="img-btn"></button>
      <button onclick="toggle3()" style=""><img src='.asset("img/box.jpg") . ' id="btn3" class="img-btn"></button>
      <button onclick="toggle4()" style=""><img src='.asset("img/box.jpg") . ' id="btn4" class="img-btn"></button>
      <button onclick="toggle5()" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn5" class="img-btn"></button>';
      echo '<h2 style="color: white;">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>' ;
      echo '
      <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
      <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
      <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
      <img src= ' .$animes[$days]->image4. ' id="Myid3" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
      <img src= ' .$animes[$days]->image5. ' id="Myid4" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
      <form method="post" autocomplete="off"  class = "autocomplete" action="'.route('anime.guess').'" style="">
          '.csrf_field().'
          <input type="text" id="search" name="guess"/>
          <input type="hidden" name="animu" value= "' .$animes[$days]->name. '">
          <input type="hidden" name="days" value= "' .$days. '">
          <input onClick="onClick()" type="submit" name="SubmitButton"/>
      </form>
      </div>

      

      ';
  }
  if($_COOKIE["guessno"] == 5){
    $guessnotwo = $_COOKIE["guessno"] + 1;
    echo '<div style="  margin: auto; width: 50%; text-align: center;">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
    <button onclick="toggle2()" style=""><img src='.asset("img/box.jpg") . ' id="btn2" class="img-btn"></button>
    <button onclick="toggle3()" style=""><img src='.asset("img/box.jpg") . ' id="btn3" class="img-btn"></button>
    <button onclick="toggle4()" style=""><img src='.asset("img/box.jpg") . ' id="btn4" class="img-btn"></button>
    <button onclick="toggle5()" style=""><img src='.asset("img/box.jpg") . ' id="btn5" class="img-btn"></button>
    <button onclick="toggle6()" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn6" class="img-btn"></button>';
    echo '<h2 style="color: white;">This is guess number: '. $guessnotwo. ' out of 6 </h2><br>' ;
    echo '
    <img src= ' .$animes[$days]->image. ' id="Myid6" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image4. ' id="Myid3" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image5. ' id="Myid4" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image6. ' id="Myid5" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">   
    <form method="post" autocomplete="off"  class = "autocomplete" action="'.route('anime.guess').'" style="">
        '.csrf_field().'
        <input type="text" id="search" name="guess"/>
        <input type="hidden" name="animu" class="typeahead form-control" value= "' .$animes[$days]->name. '">
        <input type="hidden" name="days" value= "' .$days. '">
        <input onClick="onClick()" type="submit" name="SubmitButton"/>
    </form>
    </div>

    

    ';
}


}if ($_COOKIE["fail"] == 1 || $_COOKIE["guessno"] > 5 ){
  echo '<div style="  margin: auto; width: 50%; text-align: center;">
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <button onclick="toggleText()" id="Stupoo" style=""><img src='.asset("img/box.jpg") . ' id="btn1" class="img-btn"></button>
  <button onclick="toggle2()" style=""><img src='.asset("img/box.jpg") . ' id="btn2" class="img-btn"></button>
  <button onclick="toggle3()" style=""><img src='.asset("img/box.jpg") . ' id="btn3" class="img-btn"></button>
  <button onclick="toggle4()" style=""><img src='.asset("img/box.jpg") . ' id="btn4" class="img-btn"></button>
  <button onclick="toggle5()" style=""><img src='.asset("img/box.jpg") . ' id="btn5" class="img-btn"></button>
  <button onclick="toggle6()" style=""><img src='.asset("img/greenbox.jpg") . ' id="btn6" class="img-btn"></button>';

    echo '<p style="color:white;">Sorry you lost! the answer was: '. $animes[$days]->name. '</p>';
    echo '<br><br><img src= ' .$animes[$days]->image. ' id="Myid6" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image2. ' id="Myid" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image3. ' id="Myid2" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image4. ' id="Myid3" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image5. ' id="Myid4" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;">
    <img src= ' .$animes[$days]->image6. ' id="Myid5" class="aniimg" width="600" height="400" style="position: absolute; top: 125px; right: 650px;"> 

    </div>


    ';
}

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
  
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
  
</script>

<style>
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


</style>





<script type="text/javascript">
  function toggleText(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn1").src = "img/greenbox.jpg"; 
    

    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid6").style.display = "block";

  
  }
  function toggle2(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn2").src = "img/greenbox.jpg"; 

    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid").style.display = "block";
 
  
  }
  function toggle3(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn3").src = "img/greenbox.jpg"; 

    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid2").style.display = "block";

  
  }
  function toggle4(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn4").src = "img/greenbox.jpg"; 

    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid3").style.display = "block";
  
  }
  function toggle5(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn5").src = "img/greenbox.jpg"; 
    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid4").style.display = "block";
  
  }
  function toggle6(){
    const buttons = document.getElementsByClassName('img-btn');
    for (var i = 0; i < buttons.length; i++) {
      const buttonImage = buttons[i].src = "img/box.jpg";
    }
    document.getElementById("btn6").src = "img/greenbox.jpg"; 
    const images = document.getElementsByClassName('aniimg');
    for (var i = 0; i < images.length; i++) {
      const Images = images[i].style.display = "none";
    }
    document.getElementById("Myid5").style.display = "block";

  
  }


</script>



@stop

