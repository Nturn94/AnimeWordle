<html> 
<body>
<div style="margin:auto;min-width:100%; text-align: center;     border-bottom: 3px solid #FFA766;margin-bottom: -1px;"> 
<button onclick="on()" id="info">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="10"></circle>
  <line x1="12" y1="16" x2="12" y2="12"></line>
  <line x1="12" y1="8" x2="12.01" y2="8"></line>
</svg>
</button>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
<img src="{{ asset('/img/title.png') }}">
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

</body>
<style>
    body {
/* Created with https://www.css-gradient.com */
background: rgb(0,0,0);
background: linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(69,69,69,0.8827906162464986) 35%);
    }
    #overlay {
  position: fixed; 
  display: none; 
  height: 25%; 
  top: 200;
  left: 0;
  right: 0;
  background-color: rgba(0,0,0,0.90); 
  z-index: 2; 
  cursor: pointer;
}
#info{
  background: none;
    border: none;
    display: fixed;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    color: var(--color-fg);
    margin: 0px;
    padding: 0px 12px;
}
#infotext{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 15px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
.img-btn{
    background: none;
    border: 0;
    outline: 0;
    display: fixed;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    color: var(--color-fg);
    margin: 0px;
    padding: 0px;
    }
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


#x {
    position: absolute;
    color: white;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    display: fixed;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    margin: 0px;
    padding: 0px 12px;
}
#text{
  position: absolute;
  top: 15%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}

</style>

<head>

    <title> Master Page Layout </title>  
    
    
</head>  
<body>  
    <div class="container-fluid">  
        @yield('content')  
    </div>  
    @yield('footer')  
</body>  
</html>  