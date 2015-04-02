@extends('layout')

{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}
<html>

<body>
    <h1><center> Delete a Service </center></h1>
    <div class="container">
        <div class="row">
            <div class="dropdown"><center>
				{{ Form::open(array('action' => 'DashboardController@deleteNewService')) }}
				{{ Form::select('service', $services, Input::old('service')) }}
				{{ Form::submit('Submit', array('class'=> 'btn btn-info')) }}
				{{ Form::close() }}
            </center></div>
        </div>
    </div>
</body>

</html>