@extends('layout')

<head>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
</head>
<body>

<div class="container">
    <h3> Pay with Check </h3>
    <h4> Account balance: ${{Auth::user()->bill}} </h4>

    You selected to pay your bill with a check!
<br>
    Please make the check out to "Devnull Telecom, LLC." in the amount of your current account balance.
<br><br>

    Mail the signed, dated, check to our office at: <br> <br>

    <p>
        Devnull Telecom, LLC. <br>
        110 Main Street <br>
        La Jolla, CA 92037
    </p>

    <a href="{{URL::to('dashboard')}}"><button class="btn btn-primary btn-success">return to Dashboard</button></a>
</div>


</body>

