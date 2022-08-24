<html>  
<style>
    body {
    background-color: 	#484848;
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
    <div class="container">  
        @yield('content')  
    </div>  
    @yield('footer')  
</body>  
</html>  