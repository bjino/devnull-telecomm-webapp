<?php
class RetailCustomer extends Eloquent {
	protected $table = 'retail';
    protected $guarded = array();

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}
}

