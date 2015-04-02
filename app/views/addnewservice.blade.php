@extends('layout')

@section('content')

<html>
<body>
    <h1><center> Add a Service </center></h1>
    <div class="container">
        <div class="row">
            <div><center>
    				{{ Form::open(array('action' => 'DashboardController@addNewService')) }}
                <p style="color:red">
                    {{$errors->first('servicename')}}
    				{{$errors->first('cost')}}
                    {{$errors->first('cancel_fee')}}
                    {{$errors->first('duration')}}
                    {{$errors->first('description')}}
                </p>
                <p>
                    {{ Form::label('servicename', 'Service Name') }}
                    {{ Form::text('servicename', Input::old('servicename'), array('class'=>'form-control focus', 'placeholder' => 'Service')) }}
                </p>

                <p>
                    {{ Form::label('cost', 'Cost') }}
                    {{ Form::text('cost', Input::old('cost'), array('class'=>'form-control focus', 'placeholder' => '100')) }}
                </p>
				
				<p>
                    {{ Form::label('cancel_fee', 'Cancellation Fee') }}
                    {{ Form::text('cancel_fee', Input::old('cancel_fee'), array('class'=>'form-control focus', 'placeholder' => '10')) }}
                </p>

                <p>
                    {{ Form::label('duration', 'Duration') }}
                    {{ Form::text('duration', Input::old('duration'), array('class'=>'form-control focus', 'placeholder' => '1')) }}
                </p>

                <p>
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', Input::old('description'), array('class'=>'form-control focus',
                                                                            'placeholder'=>'Enter description here...')) }}
                </p>

				{{ Form::submit('Add Service!', array('class'=> 'btn btn-info')) }}						
				{{ Form::close() }}
                <a href="{{ URL::to('marketingrep') }}" class="btn btn-default">Cancel</a>
            </center></div>

        </div>
    </div>
</body>


</html>