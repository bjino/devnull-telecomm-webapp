<?php

class Service extends Eloquent
{
	public $table = 'services';
    protected $guarded = array();

	public function users()
	{
		return $this->hasMany('User');
	}

	public function getDescription()
	{
		return $this['description'];
	}
	
	public function getCost()
	{
		return $this->cost;
	}

    public function checkDate()
    {
        $date = \Carbon\Carbon::now();
        $userCreate = new \Carbon\Carbon($this->created_at);
        return $date->diff($userCreate)->days;
    }

    public function unActivate(){

    }
}