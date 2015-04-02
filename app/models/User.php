<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    //protected $fillable = array('firstname','lastname','email','address','city', 'state', 'phone', 'password');
	protected $guarded = array();

	public function __construct($attr = array(), $exists = false) {
          parent::__construct($attr, $exists);
	}

    public function thresholds()
    {
        return $this->belongsToMany('Threshold');
    }

	/**
	 * Service relationship
	 */
	public function services()
	{
		return $this->belongsToMany('Service');
	}

    public function packages()
    {
        return $this->belongsToMany('Package');
    }

	public function userable()
	{
		return $this->morphTo();
	}

	public function availableServices()
	{
		$ids = DB::table('service_user')->where('user_id', '=', $this->id)->lists('service_id');
		if (!$ids) {
			$services = Service::all();
		} else {
			$services = Service::whereNotIn('id', $ids)->get();
		}

		$display = [];
		foreach ($services as $service) {
			$toAdd = True;
			foreach ($this->packages as $package) {
				if ($package->containsService($service->id))
					$toAdd = False;
			}

			if ($toAdd && $service->active == 1)
				$display[$service->id] = $service->name;
		}
		return $display;
	}
	
	public function getServices()
	{
		$services = $this->services;
		$display = [];
		foreach ($services as $service) {
			$display[$service->id] = $service->name;
		}
		return $display;
	}
	
	public function availablePackages()
    {
        $ids = DB::table('package_user')->where('user_id', '=', $this->id)->lists('package_id');
        if (!$ids) {
            $packages = Package::all();
        } else {
            $packages = Package::whereNotIn('id', $ids)->get();
        }

        $display = [];
        foreach ($packages as $package) {
            if ($package->active == 1)
                $display[$package->id] = $package->name;
        }
        return $display;
    }


    public function getServiceCost()
    {
        $ids = DB::table('service_user')->where('user_id', '=', $this->id)->lists('service_id');
        if ($ids) {
            $services = Service::whereIn('id', $ids)->get();
        } else {
            $services = [];
        }

        $display = [];
        foreach ($services as $service) {
            $display[$service->id] = $service;
        }
        return $display;
    }
    

    public function getCost()
    {
		/*$services = $this->services;
		$packages = $this->packages;

        $total = 0;
        foreach ($services as $service) {
            $total = $total + $service->cost;
        }
        foreach ($packages as $package){
            $total = $total + $package->cost;
        }

        return $total;*/
		return $this->bill;
    }
	
	public function updateCost($service, $table, $add)
	{
		$p = 0;
		$s = DB::table($table)->where('id', '=', $service)->pluck('cost');
		if (!$add) {
			$p = DB::table($table)->where('id', '=', $service)->pluck('cancel_fee');
			$s = 0-$s;
		}
		$cost = DB::table('users')->where('id', '=', $this->id)->pluck('bill');
		$cost += $s + $p;
		DB::table('users')->where('id', '=', $this->id)->update(array('bill' => $cost));
	}

	public function getPackages()
	{
		$packages = $this->packages;
		$display = [];
		foreach ($packages as $package) {
			$display[$package->id] = $package->name;
		}
		return $display;
	}
	
	public function getThreshold() {
		$threshold_id = DB::table('threshold_user')->where('user_id', '=', $this->id)->pluck('threshold_id');
		$threshold = DB::table('threshold')->where('id', '=', $threshold_id)->pluck('cost');
		return $threshold;
	}

    public function getCustomerType(){
        $userableType = "";
        if ($this->userable_type === "Customer") {
            $userableType = DB::table('customer')->where('id', $this->userable_id)->pluck('userable_type');
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

        return $customerType;
    }
}
