<?php
class Customer extends Eloquent {
	protected $table = 'customer';
    protected $guarded = array();

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}

}

