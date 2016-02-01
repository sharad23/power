<?php

class Notification extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_id','user_id','descriptions','notification_status'];

	public function pod(){
      
        return $this->belongsTo('Pod','pod_id','id');

	}

	public function user(){
       
       //return $this->belongsTo('Pod','pod_id','id');

	}

}