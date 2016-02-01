<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 
	protected $connection = 'login';
	protected $table = 'ag_staff_login';
	protected $primaryKey = 'staff_user_id';
	
	
	public $remember_token = false;
	//public $timestamps = false;
	

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	
	public function getAuthPassword()
    {	
        return Hash::make($this->staff_password);
    }
    
	
	

}
