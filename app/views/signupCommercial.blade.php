<!-- app/views/signup.blade.php -->
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->

<!doctype html>
<html>
<head>
    <title>TELECOM LLC</title>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1> Sign up Commercial Customer</h1>
            {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}
            {{ Form::open(array('action' => 'HomeController@doSignupCommercial')) }}

            {{ $errors->first('email') }}
            {{ $errors->first('address') }}
            {{ $errors->first('city') }}
            {{ $errors->first('state') }}
            {{ $errors->first('phone') }}
            {{ $errors->first('password') }}
            <p>
                {{ Form::label('firstname', 'First Name') }}
                {{ Form::text('firstname', Input::old('firstname'), array('class'=>'form-control focus', 'placeholder' => 'John')) }}
            </p>

            <p>
                {{ Form::label('lastname', 'Last Name') }}
                {{ Form::text('lastname', Input::old('lastname'), array('class'=>'form-control focus', 'placeholder' => 'Smith')) }}
            </p>


            <p>
                {{ Form::label('email', 'Email Address') }}
                {{ Form::text('email', Input::old('email'), array('class'=>'form-control focus', 'placeholder' => 'example@example.com')) }}
            </p>

            <p>
                {{ Form::label('address', 'Street Address') }}
                {{ Form::text('address', Input::old('address'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('city', 'City') }}
                {{ Form::text('city', Input::old('city'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('state', 'State') }}
                {{ Form::text('state', Input::old('state'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('phone', 'Phone number') }}
                {{ Form::text('phone', Input::old('phone'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('class'=>'form-control focus', 'placeholder' => 'Password:')) }}
            </p>

            <p>
                {{ Form::label('companyName', 'Company name') }}
                {{ Form::text('companyName', Input::old('companyName'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('businessUnit', 'Business Unit Name') }}
                {{ Form::text('businessUnit', Input::old('businessUnit'), array('class'=>'form-control focus')) }}
            </p>

            <p>
                {{ Form::label('division', 'Division') }}
                {{ Form::text('division', Input::old('division'), array('class'=>'form-control focus')) }}
            </p>

            <div class="text-center">
                <p>{{ Form::submit('Sign Up!', array('class'=> 'btn btn-info')) }}
                    <a href="{{URL::to('users')}}" class="btn btn-primary">Close</a>
                </p>
            </div>
            {{ Form::close() }}
        </div></div></div>

</body>
</html>