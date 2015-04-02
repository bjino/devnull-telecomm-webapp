@extends('layout')

<head>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            @section('content')

                {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}
                <div>
                    Hello {{ Auth::user()->firstname }}! <br>

                </div>

                <hr style="height:30pt; visibility:hidden;" />

                <div>
                    <h3>My Services:</h3>
                    @foreach ($users_service_cost as $us)
                        <p>{{ $us->name}} : ${{  $us->cost  }}</p>
                    @endforeach
                </div>

                <div>
                    <h2>Total: ${{$total}}</h2>
                </div>

                <hr style="height:30pt; visibility:hidden;" />
                <div>
                    <a href="{{URL::to('dashboard')}}" class="btn btn-primary">Dashboard</a>
                </div>
        </div>
    </div>
</div>

@stop