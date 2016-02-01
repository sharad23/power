<?php

class OffPodLog extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'pod_id' => 'required',
		 'from_time' => 'required|my_time',
		 'to_time' => 'required|my_time',
		 'state' => 'required',
		 'schedule_from_time' => 'required|my_time',
		 'schedule_to_time' => 'required|my_time',
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_id','from_time','to_time','state','schedule_from_time','schedule_to_time'];
	
	public function pod(){

		return $this->belongsTo('Pod','pod_id','id');
	}

}