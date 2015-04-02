<html>
    <head>
      <title>TELECOM LLC</title>

      <style type="text/css">
        body { 
            padding-top: 50px;
            position: relative;
        }

        #log-in{
            background-color: white; 
            border-radius: 5px;
          }

      </style>

      <!-- Bootstrap CDN -->
      {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }}
      {{ HTML::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}
      {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
      {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js') }}
    </head>
    <body>

<!-- NAVBAR -->
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">DEVNULL TELECOMM LLC.</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="{{Request::is('dashboard','users','marketingrep') ? 'active' : ''}}"><a href="/dashboard">My Dashboard</a></li>
            <li class="{{Request::is('myaccount') ? 'active' : ''}}"><a href="/myaccount">My Account</a></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>

        @yield('content')
    </body>
</html>
