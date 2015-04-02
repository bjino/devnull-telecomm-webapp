<?php
class Threshold extends Eloquent {
   public $table = 'threshold';
    protected $guarded = array();
  
    public function users()
   {
      return $this->hasMany('User');
   }

}

