@extends('layout')

@section('content')

<header>
    <style type="text/css">
        body { padding-top: 50px; }
    </style>

</header>
<html>

<body>
    <h1> Add a Service </h1>
    <div class="container">
        <div class="row">
            <div>
				{{ Form::open(array('action' => 'DashboardController@addService')) }}
			    {{ Form::hidden('user_id', $user) }}
				{{ Form::select('service', $services, Input::old('service')) }}
				{{ Form::submit('Add Service!', array('class'=> 'btn btn-info')) }}
				{{ Form::close() }}				
            </div>
        </div>
    </div>
</body>


</html>

