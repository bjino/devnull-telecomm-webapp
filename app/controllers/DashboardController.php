<?php
/**
 * Created by PhpStorm.
 * User: Stanley
 * Date: 2/8/2015
 * Time: 3:00 PM
 */
class DashboardController extends BaseController
{
    public function showDashboard()
    {
        if(Auth::user()->email == 'marketingRep@devnull.com')
        {
            return Redirect::to('marketingrep');
        }
        if(Auth::user()->email == 'customerServiceRep@devnull.com')
        {
            return Redirect::to('users');
        }
        $user_id = Auth::user()->id;
        $thresholds = Auth::user()->thresholds;
        $threshold = null;
        if (count($thresholds) > 0) {
            $threshold = $thresholds->first()->cost;
        }

        $userableType = "";
        if (Auth::user()->userable_type === "Customer") {
            $userableType = DB::table('customer')->where('id', Auth::user()->userable_id)->pluck('userable_type');
        }

        $customerType = "";
        if($userableType === 'RetailCustomer')
        {
            $customerType = "Retail";
        }

        elseif($userableType === 'CommercialCustomer')
        {
            $customerType = "Commercial";
        }

        return View::make('dashboard')
            ->with('user', Auth::user())
            ->with('total', Auth::user()->getCost()) //gets the current total bill for a user
            ->with('threshold', $threshold)
            ->with('packages', Auth::user()->availablePackages())
            ->with('services', User::find($user_id)->availableServices())
            ->with('customerType', $customerType);
    }

    public function showMyAccount()
    {
        return View::make('myaccount');
    }

    public function setPayment() {

        $user = Auth::user();
//        $validator = Validator::make(Input::all(), $rules);

//        if($validator->fails()) {
//            return Redirect::to('myaccount')->withErrors($validator);
//        }
//        elseif ($user->payment == Input::get('payment')) {
//            echo "Payment plan cannot be old plan.";
//        }
//        else {
            $user->payment = Input::get('payment');
            $user->save();
            return Redirect::to('myaccount');
//        }
    }

    public function setPass()
    {
        $user = Auth::user();

		// validate the info, create rules for the inputs
		$rules = array(
		    'password'      => 'required'
		    );
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('myaccount')
		        ->withErrors($validator); // send back all errors to the login form
		}
        elseif (Hash::check(Input::get('password'), $user->password)) {
            echo "Password cannot be same as old password";
        }
        else {
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::to('myaccount');
        }
    }

    public function addService()
    {
        $user = User::find(Input::get('user_id'));
        $packages = $user->packages;
        $i = True;

        foreach ($packages as $package) {
            if ($package->containsService(Input::get('service')))
                $i = False;
        }
        //look through all packages that contain this service
        //does the user have this package?

        if ($i) {
            $user->services()->attach(Input::get('service'));
			$user->updateCost(Input::get('service'), 'services', 1);
        }

        if (Auth::user()->id == $user->id) {
            return Redirect::to('dashboard');
        }

        return Redirect::to('users');
    }

    public function showSelectPackage()
    {
        return View::make('addservicetopackage');
    }

    public function addServiceToPackage()
    {
        $package = Package::find(Input::get('package_id'));
        $services = Service::all();
        foreach ($services as $service) {
            if (Input::get($service->name) == 1) {
                $package->services()->attach($service);
            }
        }
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function deleteService($user_id, $service)
    {
        $user = User::find($user_id);
        $user->services()->detach($service);
		$user->updateCost($service, 'services', 0);
        if (Auth::user()->id == $user_id) {
            return Redirect::to('dashboard');
        }
        return View::make('users')
            ->with('users', User::all());
    }

    public function addPackage()
    {
        $user = User::find(Input::get('user_id'));
        $userServices = $user->services;
        $packageServices = Package::find(Input::get('package'))->services;
        $no = True;
        foreach ($packageServices as $pService) {
            foreach ($userServices as $uService) {
                if ($pService->id == $uService->id)
                    $no = False;
            }
        }

        foreach ($user->packages as $uPackage) {
            foreach($packageServices as $pService) {
                if ($uPackage->containsService($pService->id))
                    $no = False;
            }
        }

        if ($no) {
            $user->packages()->attach(Input::get('package'));
			$user->updateCost(Input::get('package'), 'packages', 1);
        }

        if (Auth::user()->id == $user->id) {
            return Redirect::to('dashboard');
        }
        return View::make('users')
            ->with('users', User::all());
    }

    public function showDeletePackage($user_id)
    {
        return View::make('deletepackage')
            ->with('packages', User::find($user_id)->getPackages())
            ->with('user', $user_id);
    }

    public function deletePackage()
    {
        $user = User::find(Input::get('user_id'));
		$user->updateCost(Input::get('package'), 'packages', 0);
        $user->packages()->detach(Input::get('package'));
        if (Auth::user()->id == $user->id) {
            return Redirect::to('dashboard');
        }
        return View::make('users')
            ->with('users', User::all());
    }

    //Should delegate to an AdminController class
    public function showAddNewService()
    {
        return View::make('addnewservice');
    }

    public function addNewService()
    {
        $rules = array(
            'name' => 'required|unique:services',
            'cost' => 'required|integer|min:0',
			'cancel_fee' => 'required|integer|min:0',
            'description' => 'required',
            'duration' => 'required|integer|min:0',
        );

        $validate = array(
            'name' => Input::get('servicename'),
            'cost' => Input::get('cost'),
			'cancel_fee' => Input::get('cancel_fee'),
            'description' => Input::get('description'),
            'duration' => Input::get('duration'),
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($validate, $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return View::make('addnewservice')
                ->withErrors($validator);
        } else {
            $data = array(
                'name' => Input::get('servicename'),
                'active' => 1,
                'cost' => Input::get('cost'),
				'cancel_fee' => Input::get('cancel_fee'),
                'duration' => Input::get('duration'),
                'description' => Input::get('description')
            );
            Service::create($data);
            return Redirect::to('marketingrep')
                ->with('services', Service::all())
                ->with('packages', Package::all());
        }
    }

    public function createMarketingRep()
    {
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function makeMarketingRep()
    {
        $data = array(
            'name' => Input::get('service'),
            'cost' => 20,
            'active' => 1,
        );
        $results = DB::table('services')->where('name', $data['name'])->pluck('name');
        if (!$results) {
            DB::table('services')->insert($data);
        } else {
            DB::table('services')->where('name', '=', $data['name'])->increment('active');
        }
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function showDeleteNewService()
    {
        $services = Service::all();
        $s = [];
        foreach ($services as $service) {
            if ($service->active == 1) {
                $s[$service->name] = $service->name;
            }
        }
        return View::make('deletenewservice')
            ->with('services', $s);
    }

    public function deleteNewService()
    {
        DB::table('services')->where('name', '=', Input::get('service'))->decrement('active');
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function showAddNewPackage()
    {
        return View::make('addnewpackage')
            ->with('services', Service::all());
    }

    public function addNewPackage()
    {
        $rules = array(
            'name' => 'required|unique:packages',
            'cost' => 'required|integer|min:0',
			'cancel_fee' => 'required|integer|min:0',
            'duration' => 'required|integer|min:0'
        );

        $validate = array(
            'name' => Input::get('package_name'),
            'cost' => Input::get('price'),
			'cancel_fee' => Input::get('cancel_fee'),
            'duration' => Input::get('duration'),
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($validate, $rules);

        if ($validator->fails()) {
            return View::make('addnewpackage')
                ->withErrors($validator)
                ->with('services', Service::all());
        }
        $data = array(
            'name' => Input::get('package_name'),
            'cost' => Input::get('price'),
            'active' => 1,
			'cancel_fee' => Input::get('cancel_fee'),
            'duration' => Input::get('duration'),
        );
        Package::create($data);
        $package = Package::find(DB::getPdo()->lastInsertId());

        $services = Service::all();
        foreach ($services as $service) {
            if (Input::get($service->name) == 1) {
                $package->services()->attach($service);
            }
        }
        return Redirect::to('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function showDeleteNewPackage()
    {
        $packages = Package::all();
        $p = [];
        foreach ($packages as $package) {
            if ($package->active == 1) {
                $p[$package->name] = $package->name;
            }
        }
        return View::make('deletenewpackage')
            ->with('packages', $p)
            ->with('p', Package::all());
    }

    public function deleteNewPackage()
    {
        DB::table('packages')->where('name', '=', Input::get('package'))->decrement('active');
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function showAddServiceToPackage($package_id)
    {
        $package = Package::find($package_id);
        return View::make('addpservice')
            ->with('package', Package::find($package_id))
            ->with('services', $package->availableServices());
    }

    public function showDeleteServiceFromPackage($package_id)
    {
        $package = Package::find($package_id);
        return View::make('deletepservice')
            ->with('package', Package::find($package_id))
            ->with('services', $package->getServices());
    }

    public function deleteServiceFromPackage()
    {
        $package = Package::find(Input::get('package_id'));
        $services = Service::all();
        foreach ($services as $service) {
            if (Input::get($service->name) == 1) {
                $package->services()->detach($service);
            }
        }
        return View::make('marketingrep')
            ->with('services', Service::all())
            ->with('packages', Package::all());
    }

    public function doThreshold()
    {
        $user = Auth::user();
        // validate the info, create rules for the inputs
        $rules = array(
            'threshold' => 'required|integer|min:0',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('dashboard')
                ->withErrors($validator); // send back all errors to the login form
        } else {
            //check to see if the user has a threshold set
            $hasThreshold = DB::table('threshold_user')->where('user_id', $user['id'])->pluck('threshold_id');
            $userdata = array(
                'cost' => Input::get('threshold'),
            );
            //check to see if the threshold is in the table
            $alreadyThere = DB::table('threshold')->where('cost', $userdata['cost'])->pluck('id');
            if ($alreadyThere and !($hasThreshold)) {
                $user->thresholds()->attach($alreadyThere);
                return Redirect::to('dashboard');
            } elseif ($alreadyThere and $hasThreshold) {
                DB::table('threshold_user')->where('user_id', $user['id'])->update(array('threshold_id' => $alreadyThere));
                return Redirect::to('dashboard');
            }
            DB::table('threshold')->insert($userdata);
            $results = DB::table('threshold')->where('cost', $userdata['cost'])->pluck('id');
            if ($hasThreshold) {
                DB::table('threshold_user')->where('user_id', $user['id'])->update(array('threshold_id' => $results));
            } else {
                $user->thresholds()->attach($results);
            }
            return Redirect::to('dashboard');
        }

	}

	public function sendNotification() {
		$data = array('email' => Input::get('email'));
		Mail::send('email', $data, function($message) {
			$message->to(Auth::user()->email)->subject('Notification from Devnull!');
		});
		//return View::make('email')->with('email', Input::get('email'));
		return Redirect::to('dashboard');
	}

    public function payCreditCard()
    {
        $rules = array(
            'holdername'=>'required',
            'card' => 'creditcard|numeric',
            'month'=>'required|between:1,12|numeric',
            'year'=>'numeric|required',
            'cvv'=>'numeric|required|digits_between:3,4'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {

            return Redirect::to('payment')
                ->withErrors($validator);
        }
        else {
            $user = Auth::user();
            $user->bill = 0;
            $user->save();
            return Redirect::to('dashboard');
        }

    }
}