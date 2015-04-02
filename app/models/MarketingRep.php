<?php
class MarketingRep extends Eloquent {
	protected $table = 'marketing_rep';
    protected $guarded = array();

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}
}

