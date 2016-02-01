<?php

class Cord extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','condition','pod_inventory_id'];
	
	public function  podInventory(){

		 return $this->belongsTo('PodInventory','pod_inventory_id','id');

	}
	

}