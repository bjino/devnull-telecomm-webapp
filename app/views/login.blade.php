<!doctype html>
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

<body style="background:#eaeaea" data-spy="scroll" data-target="#navbar" id="top"> 

<!--Navbar Section -->
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
          <ul class="nav navbar-nav navbar-right" role="tablist">
            <li><a href="#top" id="gotoHome">Home</a></li>
            <li><a href="#about" id="gotoAbout">About</a></li>
            <li><a href="#contact" id="gotoContact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>
<!--Smoothscroll Section -->
<script type="text/javascript">
$('#gotoHome').click(function(){
  $('html, body').animate({
    scrollTop: $( $.attr(this, 'href') ).offset().top
  }, 500);
  return false;
});

$('#gotoAbout').click(function(){
  $('html, body').animate({
    scrollTop: $( $.attr(this, 'href') ).offset().top
  }, 500);
  return false;
});

$('#gotoContact').click(function(){
  $('html, body').animate({
    scrollTop: $( $.attr(this, 'href') ).offset().top
  }, 500);
  return false;
});
</script>


<!--Form Section -->
<div style="height:100vh;background-image:url('http://hdwallpaperfun.com/wp-content/uploads/2014/08/Hi-Res-Satellite-Global-Background-For-Wallpaper.jpg')" id="form-bg">
	<div class="container">
	    <div class="row">
	        <div style="margin-top:20vh;background:white;" class="col-md-4 col-md-offset-4 " id="log-in"> 

<!-- above div to later be replaced by a #00aeef color scheme background -->

            <div class="text-center">
    				  <h1>Login</h1>
            </div>

		<!-- if there are login errors, show them here -->
						<p style="color:red">
              {{ Session::get('message') }}
						</p>

            {{ Form::open(array('url' => 'login')) }}
						<p>
		    				{{ Form::label('email', 'Email Address') }}
		    				{{ Form::text('email', Input::old('email'), array('class'=>'form-control focus', 'placeholder' => 'email@example.com')) }}
						</p>

						<p>
		    				{{ Form::label('password', 'Password') }}
		    				{{ Form::password('password', array('class'=>'form-control focus', 'placeholder' => 'Password:')) }}
						</p>
        		<div class="text-center">
						<p>{{ Form::submit('Log in!', array('class'=> 'btn btn-info')) }}
							<a href="{{URL::to('signup')}}" class="btn btn-primary">Sign up</a></p>
            </div>
					  {{ Form::close() }}
			   </div>
		  </div>
      <div style="text-align:center;padding-top:20vh;">
        <a href="#about" id="arrowDown"><i class="fa fa-chevron-circle-down" style="font-size:4.0em;color:white;"></i></a>
        <script type="text/javascript">
          $('#arrowDown').click(function(){
            $('html, body').animate({
              scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 500);
            return false;
          });
        </script>
      </div>
	</div>
</div>

   <!-- About Section -->
    <section style="height:80vh;background:white;padding-top:30px;" class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Who Devnull Telecommunications is...</h2>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-center">
				<iframe width="380" height="315"
				src="https://www.youtube.com/embed/ZsUXcmZso9g">
				</iframe>
              <p class-"text-center"><h3><small>Here at Devnull Telecommunications we strive to push the boundary of possibility and innovation. When you purchase one of our services, you are purchasing yourself cutting edge technology that is constantly shaping and improving your daily life--you are purchasing the future.</h3></small></p>
              <br>
              <br>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
 <section style="height:80vh;" id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="portfolio-item">
                              
                                    <h3>Land Lines</h3>
                                    <img class="img-portfolio img-responsive" src="img/1land.jpg">

                                    <p><h4><small> Feelin old fashioned? Want to be be restrained physically to a 5 foot cable length as you talk on the phone? Perhaps even get one of those fancy Cordless handsets? Our advanced land line service is perfect for you.</small></h4></p>

                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="portfolio-item">
                             
                                	<h3>Smoke Signals</h3>
                                    <img class="img-portfolio img-responsive" src="img/1fire.jpg">
                                    <p><h4><small>Need instant communication between your villages and tribes? Our Smoke Signal division pushes the boundaries on smoke signal communication. Defend your barricade walls in style!</small></h4></p>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="portfolio-item">
                           
                                    <h3>Carrier Pigeons</h3>
                                    <img class="img-portfolio img-responsive" src="img/1pigeon.jpg">
                                        <p><h4><small>Do you require the latest in technology to meet your daily needs? Subscribe to our carrier pigeon services for cutting edge carrier-pigeon technology. Our cyborg pigeons are installed with advanced hyper propulsion jets for quicker delivery and mini sub machine guns for extra security!</small></h4></p>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="portfolio-item">
                             		<h3>Wireless</h3>
                                    <img class="img-portfolio img-responsive" src="img/1wire.jpg">
                                <p><h4><small>Do you feel constrained by the world? Do you like magic? Do you like French bulldogs? Our wireless package is perfect for you! </small></h4></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

     <!--- About Section -->
    <section class ="about" id="portfolio" style="background:black;color:white">
    	<div class="container text-center" >
    		<div class="row">
				<div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2>About us</h2>
                        <hr class="star-light">
                         <h4> Team Devnull </h4>
                        <div class="row">
                          <div class="col-sm-2 col-sm-offset-3">
                    	 	 <h4 style="padding-top:15px"><small>Byron Jay Inocencio</small></h4>
                     	  	 <h4><small>Ryan Hill</small></h4>
					 	  </div>
                          <div class="col-sm-2">
                             <h4><small>Jesse Gallaway</small></h4>
                             <h4><small>Melvin Zelaya</small></h4>
                             <h4><small>Stanley Yip</small></h4>
                          </div>
					 	  <div class="col-sm-2">
					 	  	 <h4 style="padding-top:15px"><small>Jeffery Wang</small></h4>
					 	  	 <h4><small>Annie Phan</small></h4>
					 	  </div>

					 	 </div>


    		</div>
    	</div>

    </section>
    
      <!-- Contact Us Section -->
    <section class="success" id="contact" style="background:black;">
    <p style="text-align:center;color:white"><strong/>Need to reach us? E-mail us at customerservice@devnulltelecoms.com</p>
    </section>
    
    



</body>
</html>