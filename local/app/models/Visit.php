<?php

class Visit extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		   //'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['type','visit_date','parent_id','purpose','remarks'];
    
    public function staffs(){

           return $this->belongsToMany('Staff', 'power.staff_visit', 'visit_id', 'staff_id');

    }

    public function pods(){

           return $this->belongsToMany('PodInventory', 'pod_inventory_visit', 'visit_id', 'pod_inventory_id');

    }

    public function getStaffId(){

          $staff = array();
    	    foreach($this->staffs as $staff){
               
                $staffs[] = $staff->id;

        	}

        	return $staffs;
    }
    
    public function getPodId(){

          
          $pods = array();
    	    foreach($this->pods as $pod){
               
                $pods[] = $pod->id;

        	}

        	return $pods;
    }

    public function podBatteryReport(){


         return $this->belongsToMany('PodBattery','pod_battery_report_visit','visit_id','pod_battery_id')
                                    ->withPivot('water_level');
                              
    }

    public function podBatteryWaterAdded(){


         return $this->belongsToMany('PodBattery','pod_battery_water_added','visit_id','pod_battery_id');
                                    
                              
    }

    public function podBatteryInstallLog(){

         return $this->belongsToMany('PodBattery','pod_battery_install_log','visit_id','pod_battery_id');
        
                                    
                              
    }

    public function podBatteryUnInstallLog(){


          return $this->belongsToMany('PodBattery','pod_battery_uninstall','visit_id','pod_battery_id');
                                    
                              
    }

    public function podupsReports(){


         return $this->belongsToMany('PodUp','pod_ups_visit_report','visit_id','pod_ups_id')
                                    ->withPivot('main_input_voltage','output_voltage_bypass','output_voltage_backup','charging_ampere','discharging_ampere');
                                    
                              
    }

    public function submeterReports(){

           return $this->belongsToMany('PodInventory','pod_submeter_visit_report','visit_id','pod_inventory_id')
                                ->withPivot('reading');
    }

    public function podCordsReport(){


         return $this->belongsToMany('Cord','pod_cord_visit_report','visit_id','pod_cord_id')
                                    ->withPivot('condition');
                              
    }

     public function podUpsInstallLog(){

         return $this->belongsToMany('PodUp','pod_ups_install_log','visit_id','ups_id');
        
                                    
    }

    public function podUpsUnInstallLog(){


          return $this->belongsToMany('PodUp','pod_ups_uninstall_log','visit_id','ups_id');
                                    
                              
    }

    public function podChargerInstallLog(){

         return $this->belongsToMany('Charger','pod_charger_install_log','visit_id','charger_id');
        
                                    
    }

    public function podChargerUnInstallLog(){


          return $this->belongsToMany('Charger','pod_charger_uninstall_log','visit_id','charger_id');
                                    
                              
    }

    public function podChargerReport(){


         return $this->belongsToMany('Charger','pod_charger_visit_report','visit_id','pod_charger_id')
                                    ->withPivot('charging_ampere');
                              
    }


    

	
}