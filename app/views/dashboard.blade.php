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



<!-- WELCOME MEMO -->
<div class="container">
    <div class="row">
        <div>

            @section('content')

            <div>

                <h1>Welcome, {{ Auth::user()->firstname }}! </h1>
                <h3>Customer Type: {{$customerType}}</h3>


            <!--    <a href="{{ URL::to('billing') }}" class="btn btn-primary">Pay Bill</a> -->
            </div>
        </div>

    </div> <!-- end of the Welcome, User! memo -->

<!-- CURRENT BILL -->
    <div class="row" style="padding-bottom:5px;">
        @if($total == NULL)
            <h4 style="float:left;display:inline;">Current Bill: $0</h4>
        @else
            <h4 style="float:left;display:inline;" >Current Bill: ${{$total}} </h4>
        @endif

        <li style="float:right;padding-right:30px;display:inline;">
          <a href="{{URL::to('payment')}}"><button class="btn btn-primary btn-sm">Pay Bill</button></a>
        </li>
        <li style="float:right;padding-right:30px">
          @if ($threshold != null)
          @if ($total > $user->thresholds->first()->cost )
            <h4 style="color:red;" >Total exceeded threshold {{$threshold}}! A notification email has been sent to {{$user->email}}.</h4>
            <?php App::make("DashboardController")->sendNotification(); ?>
          @endif
          @endif
        </li>
    </div>

<!-- THRESHOLD SECTION -->
    <div class="row">
        @if ( $threshold === null)
            <h4 style="float:left">Would you like to set notifications for your billing statement?</h4>
        @else 
            <h4 style="float:left">Notify me when my bill exceeds: ${{ $user->thresholds->first()->cost }}</h4>
        @endif
        <li style="float:right;padding-right:30px">

         <!-- Button trigger modal -->
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#threshModal">Set your limit</button></p>

          <!-- Modal -->
          <div class="modal fade" id="threshModal" tabindex="-1" role="dialog" aria-labelledby="threshModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Set the threshold for a notification</h4>
                </div>
                <div class="modal-body">
                    <div>
                      {{ Form::open(array('action' => 'DashboardController@doThreshold')) }}
                      {{ Form::text('threshold', Input::old('threshold'), array('class'=>'form-control focus', 'placeholder' => '0')) }}
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('Set limit', array('class'=> 'btn btn-info')) }}
                {{ Form::close() }}

              </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </li>
    </div>



<!-- BREAKDOWN TITLE -->
    <div class="row">
       <h3>Breakdown:</h3>
    </div>

<!-- MY PACKAGES TITLE -->
    <div class="row">
        <h4 style="float:left">My Packages:</h4>
        <li style="float:right;padding-right:30px">
          <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#packageModal">+Add</button>
        </li>

          <!-- Modal -->
          <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
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
                      {{ Form::select('package', $packages, Input::old('package')) }} 
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

<!-- MY PACKAGES SECTION -->
    <div class="row">
        <div>
        <div>
            @foreach ($user->packages as $p)
                
                <div style="background-color:lightgrey;margin:5px;padding:3px">
                    <li style="float:left">
                        <b>{{ $p->name }}</b> : Cost ${{ $p->cost }}, Cancellation Fee ${{$p->cancel_fee}}</li>
                    <li style="float:right;padding-right:30px">
                        <a href="deletepackage/{{$user->id}}">-delete</a>
                    </li></br>
                    {{ $p->getDescription() }}
                </div>

            @endforeach
        </div>
        </div>

    </div> <!-- end of the My Packages section -->		

<!-- MY SERVICES TITLE -->
    <div class="row">
        <h4 style="float:left">My Services:</h4>
        <li style="float:right;padding-right:30px">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#serviceModal">+Add</button>
        </li>

          <!-- Modal -->
          <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
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
                        {{ Form::select('service', $services, Input::old('service')) }}
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
                        <b>{{ $us->name }}</b> : Cost ${{  $us->cost  }}, Cancellation Fee ${{$us->cancel_fee}}</li>
                    <li style="float:right;padding-right:30px">
                        <a href="/deleteservice/{{$user->id}}/{{$us->id}}">-delete</a>
                    </li></br>
                    {{ $us->getDescription() }}
                </div>
            @endforeach
        </div>

    </div> <!-- end of the My Services section -->

</div> <!-- end of the window -->

@stop
