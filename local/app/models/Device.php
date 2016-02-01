<?php

class Device extends \Eloquent {

	protected $connection = 'mysql2';
    protected $table = 'tbl_devices';
	

    public function apiPod(){

        return $this->belongsTo('ApiPod','pods','pod');
    }
   

	

	

}