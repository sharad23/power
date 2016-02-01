<?php

class PodScheduleException extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'pod_id' => 'required',
		 'timespan' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_id','timespan'];

	public function pod()
    {  
    	//return $this->belongsTo('User', 'local_key', 'parent_key');
        return $this->belongsTo('Pod','pod_id','id');
    }


}