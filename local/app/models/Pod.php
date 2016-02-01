<?php

class Pod extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
	      'pod_api_id' => 'required',
	      'schedule_type' => 'required'
	];


    public static function boot()
    {
        parent::boot();
 
        static::deleted(function($pod)
        {
            PodScheduleGroup::destroy($pod->groupSchedules()->lists('id'));
            PodScheduleException::destroy($pod->expSchedules()->lists('id'));
            PodInventory::where('pod_api_id', '=', $pod->id)->delete();

        });
 
    }

	// Don't forget to fill this array
	protected $fillable = ['pod_api_id','schedule_type'];
	
	public function apiPod(){

        return $this->belongsTo('ApiPod','pod_api_id','id');
    }
	public function groupSchedules()
    {    
    	//$this->hasMany('Comment', 'foreign_key', 'local_key');
        return $this->hasMany('PodScheduleGroup','pod_id','id');
    }

    public function expSchedules()
    {    
    	//$this->hasMany('Comment', 'foreign_key', 'local_key');
        return $this->hasMany('PodScheduleException','pod_id','id');
    }

    public function offPod(){

        return $this->hasMany('OffPod','pod_id','id');
    
    }

    public function getApiPodNameAttribute(){
     
        return $this->apiPod->pod;
    
    }

}