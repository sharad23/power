<?php

class PodUpNotification extends \Eloquent {
	
	protected $fillable = ['user_id','pod_id','descriptions','notification_status'];

    public function pod(){

         return $this->belongsTo('Pod','pod_id','id');
	}

	public function user(){

		
	}

}