@extends('layout')

@section('content')
{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

<html>
<body>
    <h1><center> Delete a Package </center></h1>
    <div class="container">
        <div class="row">
            <div><center>
				{{ Form::open(array('action' => 'DashboardController@deletePackage')) }}
				{{ Form::hidden('user_id', $user) }}
				{{ Form::select('package', $packages, Input::old('package')) }}
				{{ Form::submit('Submit', array('class'=> 'btn btn-info')) }}
				{{ Form::close() }}			
            </center></div>
        </div>
    </div>
</body>


</html>