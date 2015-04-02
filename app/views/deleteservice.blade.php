@extends('layout')

<header>
    
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

    <style>
         body { padding-top: 50px; }
    </style>
</header>
<html>

<body>
    <h1><center> Delete a Service </center></h1>
    <div class="container">
        <div class="row">
            <div class="dropdown"><center>
				{{ Form::open(array('action' => 'DashboardController@deleteService')) }}
				{{ Form::hidden('user_id', $user) }}
				{{ Form::select('service', $services, Input::old('service')) }}
				{{ Form::submit('Submit', array('class'=> 'btn btn-info')) }}
				{{ Form::close() }}
            </center></div>
        </div>
    </div>
</body>

</html>