@extends('layout')

<head>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}

    <style type="text/css">
    body { padding-top: 50px; }

    #log-in{
       background-color: white;
       border-radius: 5px;
    }

</style>
</head>
<body>


<div class="container">

	<h1>Customer Service Dashboard</h1>

    @section('content')
		<p>
			<h3 style="display:inline">Add a new corporate customer: </h3>
	        <a style="float:right" href="{{URL::to('signupCommercial')}}" class="btn btn-primary">Sign up</a>
		</p>
		<h3>Current Customers:</h3>
    @foreach($users as $user)
		@if ($user->email != 'customerServiceRep@devnull.com' & $user->email != 'marketingRep@devnull.com')
		
		<div style="border: 2px solid black;padding:30px;padding-top:5px">
		    <div class="row">
				<!-- MY SERVICES TITLE -->
		    	<h3>{{ $user->firstname }} {{$user->lastname}}, {{ $user->email}}:</h3>	  
                @if($user->bill == NULL)
                    <h3>Current Bill: 0</h3>

		    	<!-- CURRENT BILL -->
                @else
 		            <h3>Current Bill: ${{$user->bill}}</h3>

                @endif

                <h3>Customer Type: {{$user->getCustomerType()}}</h3>

		        <h4 style="float:left">My Services:</h4>
		        
		        <li style="float:right;padding-right:30px">
		            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#serviceModal{{$user->id}}">+Add</button>
		        </li>
                  

		          <div class="modal fade" id="serviceModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
		            <div class="modal-dialog">
		              <div class="modal-content">
		                <div class="modal-header">
		                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                  <h4 class="modal-title" id="myModalLabel">Add a service</h4>
		                </div>
		                <div class="modal-body">
		                    <div>

		                        {{ Form::open(array('action' => 'DashboardController@addService')) }}
		                        {{ Form::hidden('user_id', $user->id) }}
		                        {{ Form::select('service', $user->availableServices(), Input::old('service')) }}
		                    </div>                  
		                </div>
		              <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                    {{ Form::submit('Add Service!', array('class'=> 'btn btn-info')) }}
		                    {{ Form::close() }} 
		              </div>
		              </div><!-- /.modal-content -->
		            </div><!-- /.modal-dialog -->
		          </div><!-- /.modal -->
		    </div>

			<!-- MY SERVICES SECTION -->
		    <div class="row">
		        <div>
		            @foreach ($user->services as $us)
		                <div style="background-color:lightgrey;margin:5px;padding:3px">
		                    <li style="float:left">
		                        <b>{{ $us->name }}</b> : ${{  $us->cost  }}</li>
		                    <li style="float:right;padding-right:30px">
		                        <a href="/deleteservice/{{$user->id}}/{{$us->id}}">-delete</a>
		                    </li></br>
		                    {{ $us->getDescription() }}
		                </div>
		            @endforeach
		        </div>

		    </div> <!-- end of the My Services section -->

			<!-- MY PACKAGES TITLE -->
		    <div class="row">
		        <h4 style="float:left">My Packages:</h4>
	        <li style="float:right;padding-right:30px">
	          <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#packageModal{{$user->id}}">+Add</button>
	        </li>

	          <!-- Modal -->
	          <div class="modal fade" id="packageModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
	            <div class="modal-dialog">
	              <div class="modal-content">
	                <div class="modal-header">
	                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                  <h4 class="modal-title" id="myModalLabel">Add a package</h4>
	                </div>
	                <div class="modal-body">
	                    <div>
	                      {{ Form::open(array('action' => 'DashboardController@addPackage')) }}
	                      {{ Form::hidden('user_id', $user->id) }}
	                      {{ Form::select('package', $user->availablePackages(), Input::old('package')) }} 
	                    </div>                  
	                </div>
	              <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                {{ Form::submit('Add Package!', array('class'=> 'btn btn-info')) }}
	                {{ Form::close() }} 
	              </div>
	              </div><!-- /.modal-content -->
	            </div><!-- /.modal-dialog -->
	          </div><!-- /.modal -->
		    </div>

		    <div class="row">

				@foreach($user->packages as $p)
                <div style="background-color:lightgrey;margin:5px;padding:3px">
                    <li style="float:left">
                        <b>{{ $p->name }}</b> : ${{ $p->cost }}</li>
                    <li style="float:right;padding-right:30px">
                        <a href="deletepackage/{{$user->id}}">-delete</a>
                    </li></br>
                    {{ $p->getDescription() }}
                </div>

			    @endforeach
			
			</div>
		</div>


			<br>
			@endif
    @endforeach
</div>	

@stop