<?php

class PodScheduleGroup extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
	      
	       'pod_id' => 'required',
	       'group_id' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_id','group_id'];

	public function pod()
    {  
    	//return $this->belongsTo('User', 'local_key', 'parent_key');
        return $this->belongsTo('Pod','pod_id','id');
    }

    public function group(){

    	return $this->belongsTo('Group','group_id','id');    
    }

    public function schedules()
    {    
    	//$this->hasMany('Comment', 'foreign_key', 'local_key');
        return $this->hasMany('Schedule','group_id','group_id');
    }

}