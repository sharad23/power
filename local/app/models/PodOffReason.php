<?php

class PodOffReason extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'pod_log_id' => 'required',
		 'reason' => 'required',
		 'user_id' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_log_id','reason','user_id'];

	public function podLog(){

		 $this->belongsTo('OffPod','pod_log_id','id');
	}

}