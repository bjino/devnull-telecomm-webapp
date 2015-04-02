@extends('layout')

<head>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
</head>
<body>

<div class="container">
    <h3> Credit Card Form</h3>
</div>

<div class="container">
   <p class="bg-danger">
       {{ $errors->first('holdername') }}
       {{ $errors->first('card') }}
       {{ $errors->first('month') }}
       {{ $errors->first('year') }}
       {{ $errors->first('cvv') }}

   </p>
</div>

{{ Form::open(array('action' => 'DashboardController@payCreditCard')) }}

<div class="container">

                {{ Form::label('holdername', 'Name on Card', array('class'=>'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::text('holdername', Input::old('holdername'), array('class'=>'form-control focus', 'placeholder'=>'Name')) }}
                </div>
                {{ Form::label('card', 'Card Number', array('class'=>'col-sm-3 control-label'))}}
                <div class="col-sm-9">
                    {{ Form::text('card', Input::old('card'), array('class'=>'form-control focus', 'placeholder'=>'Debit/Credit')) }}
                </div>
                {{ Form::label('expiration', 'Expiration Date', array('class'=>'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-xs-3">
                            {{ Form::select('month', array(0 => 'Month',
                                                           1 => '01',
                                                           2 => '02',
                                                           3 => '03',
                                                           4 => '04',
                                                           5 => '05',
                                                           6 => '06',
                                                           7 => '07',
                                                           8 => '08',
                                                           9 => '09',
                                                           10 => '10',
                                                           11 => '11',
                                                           12 => '12'),
                                                           Input::old('month'), array('class'=>'form-control col-sm-2')) }}
                        </div>
                        <div class="col-xs-3">
                            {{ Form::select('year', array('default' => 'Year',
                                                           '13' => '2013',
                                                           '14' => '2014',
                                                           '15' => '2015',
                                                           '16' => '2016',
                                                           '17' => '2017',
                                                           '18' => '2018',
                                                           '19' => '2019',
                                                           '20' => '2020',
                                                           '21' => '2021',
                                                           '22' => '2022',
                                                           '23' => '2023',
                                                           '24' => '2024'),
                                                           Input::old('year'), array('class'=>'form-control col-sm-2')) }}
                        </div>
                    </div>
                </div>
                {{ Form::label('cvv', 'Card CVV', array('class'=>'col-sm-3 control-label')) }}
                <div class="col-sm-3">
                    {{ Form::text('cvv', Input::old('CVV'), array('class'=>'form-control focus', 'placeholder'=>'Security Number')) }}
                </div>
                <div class="col-sm-offset-3 col-sm-9">
                    {{ Form::submit('Pay Bill Now', array('class'=> 'btn btn-success')) }}
                </div>

</div>


</body>

