@extends('layout')

@section('content')
{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

<html>
<body>
    <h1> Add a Package </h1>
    <div class="container">
        <div class="row">
            <div>
				{{ Form::open(array('action' => 'DashboardController@addPackage')) }}
			    {{ Form::hidden('user_id', $user) }}
				{{ Form::select('package', $packages, Input::old('package')) }}
				{{ Form::submit('Add Package!', array('class'=> 'btn btn-info')) }}
				{{ Form::close() }}				
            </div>
        </div>
    </div>
</body>


</html>