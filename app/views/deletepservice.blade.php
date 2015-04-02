@extends('layout')

@section('content')
{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

<html>
<body>
    <h1><center> Delete a Service from {{$package->name}} </center></h1>
    <div class="container">
        <div class="row">
            <div><center>
				{{ Form::open(array('action' => 'DashboardController@deleteServiceFromPackage')) }}
				<p>Select which service(s) to delete from {{$package->name}}:</p>
				{{ Form::hidden('package_id', $package->id) }}
				@foreach ($services as $service)
					<p>{{ Form::checkbox($service, 1) }} {{$service}}</p>
				@endforeach
				{{ Form::submit('Delete Service!', array('class'=> 'btn btn-info')) }} 						
				{{ Form::close() }}					
            </center></div>
        </div>
    </div>
</body>


</html>