<?php
class ServiceRep extends Eloquent {
	protected $table = 'service_rep';

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}
}

