<?php

class GraceTime extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'period' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['period'];

}