<?php

class Schedule extends \Eloquent {

	// Add your validation rules here


	public static $rules = [
		 'from_time' => 'required|my_time',
		 'to_time' => 'required|my_time',
		 'group_id' => 'required|integer',
		 'day' => 'required|between:1,7',
	];

	public static $messages = array('required' => 'The :attribute field is required.'
                                   );


	// Don't forget to fill this array
	protected $fillable = ['from_time','to_time','group_id','day'];
    
    public function group()
    {  
    	//return $this->belongsTo('User', 'local_key', 'parent_key');
        return $this->belongsTo('Group','group_id','id');
    }


}