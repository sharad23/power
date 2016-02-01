<?php

class PodInventory extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		   
		   'new' => [
					   'pod_api_id' => 'required|unique:pod_inventories,pod_api_id',
					   'submeter' => 'required',
					   'earthing' => 'required',
					   'alternative_source' => 'required',
					   'power_router_ip' => 'my_ip',
					   'rack' => 'required'
					],

		   'edit' => [
					   'pod_api_id' => 'required|exists:pod_inventories,pod_api_id',
					   'submeter' => 'required',
					   'earthing' => 'required',
					   'alternative_source' => 'required',
					   'power_router_ip' => 'my_ip',
					   'rack' => 'required'
					]

	];

	// Don't forget to fill this array
	protected $fillable = ['pod_api_id','submeter','earthing','alternative_source','power_router_ip','rack'];

	public static function boot()
    {
        parent::boot();
 
        static::deleted(function($pod)
        {
            PodBattery::destroy($pod->batteries()->lists('id'));
            PodUp::destroy($pod->ups()->lists('id'));
            Cord::destroy($pod->cords()->lists('id'));
           

        });
 
    }

	public function pod(){

		   return $this->belongsTo('Pod','pod_api_id','id');
	}

	public function getApiPodNameAttribute(){
     
        //return $this->pod->apiPod->pod;
        if(is_object($this->pod)){

        	     return $this->pod->apiPod->pod;
        }
    
    }

    public function visits(){

           return $this->belongsToMany('Visit', 'pod_inventory_visit', 'pod_inventory_id', 'visit_id');

    }

    public function batteries(){

    	   return $this->hasMany('PodBattery','pod_inventory_id','id');
    }

    public function ups(){

    	   return $this->hasMany('PodUp','pod_inventory_id','id');
    }

    public function cords(){

    	   return $this->hasMany('Cord','pod_inventory_id','id');
    }

    public function chargers(){

           return $this->hasMany('Charger','pod_inventory_id','id');
    }

    public function submeterReports(){

    	   return $this->belongsToMany('Visit','pod_submeter_visit_report','pod_inventory_id','visit_id')
    	                         ->withPivot('reading');
    }

}