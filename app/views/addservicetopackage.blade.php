@extends('layout')

@section('content')
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}

    <html>
    <body>
    <h1><center> Select a Package and Service to Add to it </center></h1>
    <div class="container">
        <div class="row">
            <div><center>
                    {{ Form::open(array('action' => 'DashboardController@addServiceToPackage')) }}
                    <p>
                        {{ Form::label('packagename', 'Package Name') }}
                        {{ Form::text('packagename', Input::old('packagename'), array('class'=>'form-control focus', 'placeholder' => 'Package')) }}
                    </p>

                    <p>
                        {{ Form::label('servicename', 'Service Name') }}
                        {{ Form::text('servicename', Input::old('servicename'), array('class'=>'form-control focus', 'placeholder' => 'Service')) }}
                    </p>

                    {{ Form::submit('Add Service to Package!', array('class'=> 'btn btn-info')) }}
                    {{ Form::close() }}
                </center></div>

        </div>
    </div>
    </body>


    </html>