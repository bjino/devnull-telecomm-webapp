@extends('layout')

<head>



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
    <div class="row">
    
    @section('content')

      <!-- error message bar-->
      <div style="padding-top:10px;ext-align:center;color:red">
          {{ $errors->first('password') }}
      </div>
        
      <h1 style="text-align:left">Hi {{ Auth::user()->firstname }}, what would you like to do today? <br></h1>
      <p>Want to change your password? 


      <!-- Button trigger modal -->
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Reset your password</button></p>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Reset your password</h4>
            </div>
            <div class="modal-body">

            <div>
              {{Form::open(array('action' => 'DashboardController@setPass'))}}
              {{ Form::label('password', 'New Password') }}
              {{ Form::password('password', array('class'=>'form-control focus', 'placeholder' => 'New Password:')) }}
            </div>

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {{ Form::submit('Save new password', array('class'=> 'btn btn-primary')) }}
            {{ Form::close() }}
          </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <p>Change your billing method?

    <!-- Button trigger modal -->
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalP"> Change Payment Method </button></p>

    <!-- Modal -->
    <div class="modal fade" id="myModalP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> Change Payment Method </h4>
                </div>
                <div class="modal-body">

                    <div>
                        {{ Form::open(array('action' => 'DashboardController@setPayment')) }}
                        {{ Form::label('payment', 'New Payment') }}
                        {{ Form::select('payment', array('creditcard' => 'Credit Card', 'check' => 'Check'), Input::old('payment')) }}

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ Form::submit('Set new payment method', array('class'=> 'btn btn-primary')) }}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@stop
