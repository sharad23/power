<?php

class OffPod extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'pod_id' => 'required',
		 'state' => 'required',
		 'from_time' => 'required|my_time'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_id','state','from_time','schedule_id'];

	public function pod(){

		return $this->belongsTo('Pod','pod_id','id');
	}

	public function schedule(){

		return $this->belongsTo('Schedule','schedule_id','id');
	}

}