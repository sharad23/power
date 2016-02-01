<?php

class Charger extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['pod_inventory_id','installed_date','brand'];
	
	
	public function  podInventory(){

		 return $this->belongsTo('PodInventory','pod_inventory_id','id');

	}

	public function podChargerInstallLog(){

         return $this->belongsToMany('Charger','pod_charger_install_log','visit_id','charger_id');
        
                                    
    }

    public function podChargerUnInstallLog(){


          return $this->belongsToMany('Charger','pod_charger_uninstall_log','visit_id','charger_id');
                                    
                              
    }
    public function podChargerReport(){


         return $this->belongsToMany('Charger','pod_charger_visit_report','pod_charger_id','visit_id')
                                    ->withPivot('charging_ampere');
                              
    }
	
}