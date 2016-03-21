@extends('head')

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>  
  <body class="tile-1-bg">
    <div class="container">
      <div class="row">
        <div style="min-height:630px;margin-top:100px" class="col-sm-12 object-center">        
            <h2 style="font-size:90px;color:#00BCD4" class="lg-title">404<i style="font-size:340px;color:grey" class="fa fa-globe"></i></h2>
            <h3 class="text-center grey-text">oops! the page is missing from our RADAR.</h3>
            <br>
            <div class="text-center">  
              <a href="{{route('home')}}" class="btn btn-primary">Take me home</a>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>