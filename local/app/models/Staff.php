<?php
		
class Staff extends \Eloquent {

	protected $connection = 'intranet';
    protected $table = 'staffs';
	
	public $timestamps = false;
	
	 public static $rules = array(
        'username' => 'required'
    );
	

   // Don't forget to fill this array
	protected $fillable = ['username'];
}


