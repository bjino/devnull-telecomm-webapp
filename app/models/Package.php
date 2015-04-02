<?php

/**
 * Created by PhpStorm.
 * User: thejgall
 * Date: 2/24/15
 * Time: 5:45 PM
 */
class Package extends Eloquent {
    public $table = 'packages';
    protected $guarded = array();

    public function users()
    {
        return $this->hasMany('User');
    }

	public function getDescription()
	{
		return $this['description'];
	}
	
    public function services()
    {
        return $this->belongsToMany('Service');
    }
	
	public function availableServices()
	{
		$ids = DB::table('package_service')->where('package_id', '=', $this->id)->lists('service_id');
		if (!$ids) {
			$services = Service::all();
		} else {
			$services = Service::whereNotIn('id', $ids)->get();
		}

		$display = [];
		foreach ($services as $service) {
			if ($service->active == 1)
			{
				$display[$service->id] = $service->name;
			}
		}
		return $display;
	}
	
	public function containsService($serviceId)
	{
		foreach ($this->services as $pService) {
			if ($pService->id == $serviceId)
				return True;
		}

		return False;
	}
	
	public function getServices()
	{
		$packages = $this->services;
		
		$display = [];
		foreach ($packages as $package) {
			$display[$package->id] = $package->name;
		}
		return $display;
	}

    public function checkDate()
    {
        $date = \Carbon\Carbon::now();
        $userCreate = new \Carbon\Carbon($this->created_at);
        return $date->diff($userCreate)->days;
    }
}