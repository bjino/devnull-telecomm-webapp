<?php
class CommercialCustomer extends Eloquent {
	protected $table = 'commercial';
    protected $guarded = array();

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}

}
