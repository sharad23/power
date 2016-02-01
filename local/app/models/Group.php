<?php

class Group extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required|unique:groups,name'
	];
	
	public static function boot()
    {
        parent::boot();
 
        static::deleted(function($group)
        {
            
             Schedule::destroy($group->schedules()->lists('id'));   
        
        });
 
    }

	// Don't forget to fill this array
	protected $fillable = ['name'];

	public function schedules()
    {    
    	//$this->hasMany('Comment', 'foreign_key', 'local_key');
        return $this->hasMany('Schedule','group_id','id');
    }

}