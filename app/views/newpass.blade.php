@extends('layout')

<header>
   {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}
    
    <style type="text/css">
         body { padding-top: 50px; }
    </style>
</header>

<html>

<body>
    <h1> Reset Password </h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                {{Form::open(array('action' => 'DashboardController@setPass'))}}
                {{ Form::label('password', 'New Password') }}
        {{ Form::password('password', array('class'=>'form-control focus', 'placeholder' => 'New Password:')) }}
        {{ Form::submit('Submit', array('class'=> 'btn btn-info')) }}
            </div>
        </div>
    </div>
</body>
</html>