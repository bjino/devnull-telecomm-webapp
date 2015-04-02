<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin()
	{

        if(Auth::user() == NULL) {
            return View::make('login');
        }
        if(Auth::user() == "marketingRep@devnull.com"){
            return Redirect::to('marketingrep');
        }
        if(Auth::user() == "customerServiceRep@devnull.com"){
            return Redirect::to('users');
        }

        return Redirect::to('dashboard');
	}

	public function showSignup()
	{
		return View::make('signup');
	}

    public function showSignupCommercial()
    {
        return View::make('signupCommercial');
    }

	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
		    'email'         => 'required|email|exists:users,email',
            'password'      => 'required'
		    );
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('login')
                ->with('message', 'Login Failed: incorrect username or password')
		        ->withErrors($validator); // send back all errors to the login form
		} 
		else {
		    // create our user data for the authentication
		    $userdata = array(
		        'email'     => Input::get('email'),
		        'password'  => Input::get('password')
		    );

		    // attempt to do the login
		    if (Auth::attempt($userdata)) {
				if (Auth::user()->email == "customerServiceRep@devnull.com") {
                    return Redirect::to('users');
				}

				if (Auth::user()->email == "marketingRep@devnull.com") {

					return Redirect::to('marketingrep')
					->with('services', Service::all())
					->with('packages', Package::all());
				}
		        return Redirect::to('dashboard');
		    }
			else {
		        return Redirect::to('login')
                ->with('message', 'Login Failed: incorrect username or password')
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		    }
		}
	}

	public function doLogout()
	{
        /*DB::table('users')->where('email', Auth::user()->email) -> update(['remember_token'=> NULL]);*/
	    Auth::logout(); // log the user out of our application
	    return Redirect::to('login'); // redirect the user to the login screen
	}


	public function doSignup()
    {
        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required|integer',
            'password' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('signup')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication

            $userdata = array(
                'factoryType' => 'retail',
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'email' => Input::get('email'),
                'address' => Input::get('address'),
                'city' => Input::get('city'),
                'state' => Input::get('state'),
                'phone' => Input::get('phone'),
                'bill' => 0,
                'password' => Input::get('password'),
            );

            $uf = new UserFactory();
            $uf->populate($userdata);

            Auth::login(User::where('email','=',Input::get('email'))->first());
            return Redirect::to('/');
        }
    }

    public function doSignupCommercial()
    {
        $rules = array(
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'required|email|unique:users',
            'address'	 	 => 'required',
            'city'          => 'required',
            'state'         => 'required',
            'phone'         => 'required|integer',
            'password'      => 'required|alphaNum|min:3',
            'companyName'   => 'required',
            'businessUnit'  => 'required',
            'division'      => 'required',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('signupCommercial')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            $userdata = array(
                'factoryType' => 'commercial',
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'email' => Input::get('email'),
                'address' => Input::get('address'),
                'city' => Input::get('city'),
                'state' => Input::get('state'),
                'phone' => Input::get('phone'),
                'bill' => 0,
                'password' => Input::get('password'),
                'companyName' => Input::get('companyName'),
                'businessUnitName' => Input::get('businessUnit'),
                'division' => Input::get('division'),
            );

            $uf = new UserFactory();
            $uf->populate($userdata);


            return Redirect::to('users');
        }
	}
}
