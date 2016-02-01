<?php

class PodBattery extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 
		 'brand' => 'required',
		 'installed_date' => 'required|date',
		 'capacity' => 'required',
		 'pod_inventory_id' =>'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['installed_date','capacity','brand','pod_inventory_id'];

	public function  podInventory(){

		 return $this->belongsTo('PodInventory','pod_inventory_id','id');

	}

	public function podBatteryReport(){


		 return $this->belongsToMany('Visit','pod_battery_report_visit','pod_battery_id','visit_id')
							        ->withPivot('water_level');
							  
	}

	public function podBatteryWaterAdded(){


		 return $this->belongsToMany('Visit','pod_battery_water_added','pod_battery_id','visit_id');
							        
							  
	}

	public function podBatteryInstallLog(){


		 return $this->belongsToMany('Visit','pod_battery_install_log','pod_battery_id','visit_id');
							        
							  
	}


}