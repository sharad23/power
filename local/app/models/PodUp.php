<?php

class PodUp extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 
		 'brand' => 'required',
		 'capacity' => 'required',
		 'pod_inventory_id' =>'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id','brand','capacity','pod_inventory_id'];

	public function  podInventory(){

		 return $this->belongsTo('PodInventory','pod_inventory_id','id');

	}

	public function podupsReports(){


         return $this->belongsToMany('Visit','pod_ups_visit_report','pod_ups_id','visit_id')
         ->withPivot('main_input_volatge','output_voltage_bypass','output_voltage_backup','charging_ampere','discharging_ampere');;
                                    
    }

    public function podUpsInstallLog(){

         return $this->belongsToMany('PodUp','pod_ups_install_log','ups_id','visit_id');
        
    }

    public function podUpsUnInstallLog(){

         return $this->belongsToMany('PodUp','pod_ups_uninstall_log','ups_id','visit_id');
                                    
    }


}