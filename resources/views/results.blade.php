<?php header('X-Frame-Options: ALLOW');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Results</title>

<link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<style type="text/css">
  body{
    background: #3AAFA9;
    font-family: 'Raleway', sans-serif;
    color: white;
  }
    .form-inline {
        display: inline-block;
    }
  .navbar-header.col {
    padding: 0 !important;
  } 
  .navbar {
    font-size: 14px;
    background: #fff;
    padding-left: 16px;
    padding-right: 16px;
    border-bottom: 1px solid #d6d6d6;
    box-shadow: 0 0 4px rgba(0,0,0,.1);   
  }
  .navbar .navbar-brand {
    color: #555;
    padding-left: 0;
    font-size: 20px;
    padding-right: 50px;
    font-family: 'Raleway', sans-serif;
    text-transform: uppercase;
  }
  .navbar .navbar-brand b {
    font-weight: bold;
    color: black;
  }
  .navbar ul.nav li {
    font-size: 96%;
    font-weight: bold;    
    text-transform: uppercase;
  }
  .navbar ul.nav li.active a, .navbar ul.nav li.active a:hover, .navbar ul.nav li.active a:focus {
    color: #f04f01 !important;
    background: transparent !important;
  }
  .navbar .nav-item i {
    font-size: 18px;
  }
  .navbar .navbar-form {
    border: none;
  }
  @media (min-width: 992px){
    .form-inline .input-group .form-control {
      width: 225px;     
    }
  }
  @media (max-width: 992px){
    .form-inline {
      display: block;
    }
  }
</style>

</head>

<body>

<nav class="navbar navbar-default navbar-expand-lg navbar-light">
  <div class="navbar-header d-flex col">
    <a class="navbar-brand" href="#">CSS<b> Testing Tool</b></a>     
    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
      <span class="navbar-toggler-icon"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

  <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
    <ul class="nav navbar-nav">
      <li class="nav-item"><a href="home.html" class="nav-link">Home</a></li>
      <li class="nav-item"><a href="results.html" class="nav-link">Contact</a></li> 
      <li class="nav-item"><a href="#" class="nav-link">Suggested CSS Frameworks</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="row">
      <h1>CSS PERFORMANCE TESTING TOOL <a class="btn btn-default" href="{{url('/')}}">Back</a></h1>

      <div class="col-md-12">
        <h3> Validation results for <a href="{{$url}}" target="_blank">{{$url}}</a></h3>
      </div>
      <div class="col-md-12">

        @if($results->errors->errorcount > 0)
          <div class="alert alert-danger">
            <b>Sorry! We found the following errors ({{$results->errors->errorcount}})</b>
          </div>
          <table class="table" style="background:#fff; color:#000;">
            <tbody>
              @foreach($results->errors->errorlist as $e)
                <tr>
                    <td colspan="3"><b>URI: </b><i><a target="_blank" href="{{$e->uri}}">{{$e->uri}}</a></i></td>
                </tr>
                 @foreach($e->error as $r)
                    <tr>
                        <td>{{$r->line}}</td>
                        <td>{{$r->context}}</td>
                        <td><a href="https://www.google.com/?q={{trim($r->message)}}" target="_blank">{{$r->message}}</a></td>
                    </tr>
                  @endforeach
              @endforeach
            </tbody>
          </table>
        @endif

        @if($results->warnings->warningcount > 0)
          <div class="alert alert-warning">
            <b>Warnings ({{$results->warnings->warningcount}})</b>
          </div>
           <table class="table" style="background:#fff; color:#000;">
            <tbody>
              @foreach($results->warnings->warninglist as $e)
                <tr>
                    <td colspan="3"><b>URI: </b><i><a target="_blank" href="{{$e->uri}}">{{$e->uri}}</a></i></td>
                </tr>
                 @foreach($e->warning as $r)
                    <tr>
                        <td>{{$r->line}}</td>
                        <td>{{$r->context}}</td>
                        <td><a href="https://www.google.ru/?q={{trim($r->message)}}" target="_blank">{{$r->message}}</a></td>
                    </tr>
                  @endforeach
              @endforeach
            </tbody>
          </table>
        @endif

        @if($results->warnings->warningcount <= 0 && $results->errors->errorcount <= 0)
          <div class="alert alert-success">
            <b>Success! No errors found.</b>
          </div>
        @endif
      </div>
  </div>
  </div>


</body>
</html>