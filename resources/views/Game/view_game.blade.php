<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
@extends('master')  
@section('content') 
<div style="margin: auto; width: 100%; text-align: center;    height:90%;padding:10px;">

<img src= '' id="imageBox" style="padding:0; width: 30%; height:350"><br><br>
@for ($i = 0; $i < count($guesses)+1; $i++)
 @if ($i < 6)
    <button onclick="toggle{{$i+1}}()" style="padding:0; width:auto; height:auto" ><img src='{{asset("img/box.jpg")}}' id="btn{{$i+1}}" class="img-btn"></button>
  @endif
@endfor
<script>

  const updateImage = () => {
    document.getElementById("imageBox").src = "{{$anime->value("image$i")}}";
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


<h2 style="color: white;">This is guess number: {{count($guesses)+1}} out of 6 </h2><br>' ; 
<form method="post" autocomplete="off" class = "autocomplete" action="{{route('game.guess')}}" style="">
  @csrf
  <input type="text" id="search" name="guess"/>
  <input onClick="onClick()" type="submit" name="SubmitButton"/>
</form>    
<h3> Previous guesses</h3>
@if($guesses != [])
  @foreach ($guesses as $item)
    <p style="color:white;">{{$item}}&#10060;</p>
  @endforeach
@else
  No guesses
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

  
</script>

@For($k = 1; $k < (count($guesses)+2); $k++)
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
@stop

