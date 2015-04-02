@extends('layout')

{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

		
<br></br>

<div>
<h3>Existing Services:</h3>
    @foreach($services as $service)
        @if($service->duration == NULL)
            @if ($service->active == 1)
            <p>{{$service->name}}</p>
            @endif
        @endif
        @if($service->duration <= $service->checkDate())
            <?php

            $service->active = 0;
            $service->save();
            ?>
        @endif
        @if($service->duration != NULL)
            @if ($service->active == 1)
                <p>{{$service->name}}</p>
            @endif
        @endif
    @endforeach
</div>
	
<div>
<a href="{{ URL::to('addnewservice') }}" class ="btn btn-primary"> Add a Service </a>
<a href="{{ URL::to('deletenewservice') }}" class="btn btn-default">Delete a Service</a>
</div>
	
	
<br></br>
<hr style="height:30pt; visibility:hidden;" />
<div>
<h3>Existing Packages:</h3>
    @foreach($packages as $package)
        @if($package->duration <= $package->checkDate())
            <?php
            $package->active = 0;
            $package->save();
            ?>
        @endif

        @if ($package->active == 1)
        <p>{{$package->name}}, ${{$package->cost}}</p>
            <a href="addpservice/{{$package->id}}" class ="btn btn-primary"> Add a Service to {{$package->name}} </a>
            <a href="deletepservice/{{$package->id}}" class="btn btn-default">Delete a Service from {{$package->name}}</a>
            <br></br>
        @endif
    @endforeach
</div>

<br></br>
<div>
<a href="{{ URL::to('addnewpackage') }}" class ="btn btn-primary"> Add a Package </a>
<a href="{{ URL::to('deletenewpackage') }}" class="btn btn-default">Delete a Package</a>
<br></br>



</div>

@stop