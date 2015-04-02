@extends('layout')

@section('content')
{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

<html>
<body>
    <h1><center> Add a Package </center></h1>
    <div class="container">
        <div class="row">
            <div><center>
				{{ Form::open(array('action' => 'DashboardController@addNewPackage')) }}
				{{$errors->first('name')}}
				{{$errors->first('cost')}}
				<p>Enter Package Name: {{ Form::text('package_name') }}</p>
				
				<p>Check which services to include in this package:</p>
				@foreach ($services as $service)
					@if ($service->active == 1)
						<p>{{ Form::checkbox($service->name, 1) }} {{$service->name}}</p>
					@endif
				@endforeach
				
				<p>Enter Package Price: {{ Form::text('price') }}</p>
				<p>Enter Package Cancellation Fee: {{ Form::text('cancel_fee') }}</p>
                <p>Duration: {{ Form::text('duration') }}</p>
				<p>Description: {{ Form::text('description') }}</p>
				<p>{{ Form::submit('Add Package!', array('class'=> 'btn btn-info')) }}</p>						
				{{ Form::close() }}				
            </center></div>
        </div>
    </div>
</body>


</html>