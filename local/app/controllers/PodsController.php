<?php

class PodsController extends \BaseController {

	/**
	 * Display a listing of pods
	 *
	 * @return Response
	 */
	public function index()
	{     

         /*$pods =  Pod::all();
         foreach($pods as $pod){
              
              //use this
         	  $group_schedule = $pod->groupSchedules()->get()->toArray();
         	  echo '<pre>';
         	  print_r($group_schedule);
         	  echo '</pre>';

         	  $exp_schedule = $pod->expSchedules()->get()->toArray();
         	  echo '<pre>';
         	  print_r($exp_schedule);
         	  echo '</pre>';
         	  
              
              //do not use
             // $group_schedule = $pod->groupSchedules[0]->toArray();
         	

         	    
         }

         die();
         */

        
        
       
		/*foreach($pods as $pod){
              
              echo '<pre>';
              print_r($pod);
              echo '</pre>';

              foreach($pod->groupSchedules as $group_schedule){
                     
                      echo '<pre>';
                      print_r($group_schedule);
                      echo '</pre>';
              }
              foreach($pod->expSchedules as  $exp_schedule){

              	      echo '<pre>';
                      print_r($exp_schedule);
                      echo '</pre>';
              }

		}*/
		

		$pods = Pod::all();
        return View::make('pods.index', compact('pods'));

	}

	/**
	 * Show the form for creating a new pod
	 *
	 * @return Response
	 */
	public function create()
	{  
		$apiPods = DB::connection('mysql2')->select('select * from tbl_pods order by pod');
		foreach($apiPods as $pod){

            $poddata[$pod->id] = $pod->pod;
			
		}
	
		return View::make('pods.create',array('poddata'=>$poddata));
	}

	/**
	 * Store a newly created pod in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Pod::$rules);
        if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		
        //push from here
		if(Input::get('schedule_type') == 0){
           
           //1st method  
           $validator_group = Validator::make(array('group_id'=>Input::get('group_id')), array('group_id'=>"required"));
           if ($validator_group->fails())
		    {
			   return Redirect::back()->withErrors($validator_group)->withInput();
		    }
           $pod = Pod::create($data);
           //create many work with hasOne as well as hasMany
           $pod->groupSchedules()->create(array('group_id' => Input::get('group_id')));
           

        }
		else{
            
            $validator_exec = Validator::make(array('timespan'=>Input::get('timespan')), array('timespan'=>"required"));
            if ($validator_exec->fails())
		    {
			   return Redirect::back()->withErrors($validator_exec)->withInput();
		    }
            $pod = Pod::create($data);
            $pod->expSchedules()->create(array('timespan' => Input::get('timespan')));
		}

		return Redirect::route('pods.index');
	}

	/**
	 * Display the specified pod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pod = Pod::findOrFail($id);
        return View::make('pods.show', compact('pod'));
	}

	/**
	 * Show the form for editing the specified pod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{   

		$pod = Pod::find($id);
		$apiPods = DB::connection('mysql2')->select('select * from tbl_pods');
		foreach($apiPods as $apiPod){

            $poddata[$apiPod->id] = $apiPod->pod;
			
		}
		
        return View::make('pods.edit', compact('pod','poddata'));
	}

	/**
	 * Update the specified pod in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pod = Pod::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Pod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if(Input::get('schedule_type') == 0){
           
            $validator_group = Validator::make(array('group_id'=>Input::get('group_id')), array('group_id'=>"required"));
	        if ($validator_group->fails())
		    {
				return Redirect::back()->withErrors($validator_group)->withInput();
			}

			$pod->pod_api_id = Input::get('pod_api_id');
		    $pod->schedule_type = Input::get('schedule_type');
		    $pod->save();
		    $groupSchedule = isset($pod->groupSchedules[0]) ? PodScheduleGroup::find($pod->groupSchedules[0]->id) : new PodScheduleGroup;
		    $groupSchedule->group_id = Input::get('group_id');
		    $pod->groupSchedules()->save($groupSchedule);
		}
		else{

			$validator_exec = Validator::make(array('timespan'=>Input::get('timespan')), array('timespan'=>"required"));
            if ($validator_exec->fails())
		    {
			   return Redirect::back()->withErrors($validator_exec)->withInput();
		    }

		    $pod->pod_api_id = Input::get('pod_api_id');
		    $pod->schedule_type = Input::get('schedule_type');
		    $pod->save();
		    $expSchedule = isset($pod->expSchedules[0]) ? PodScheduleException::find($pod->expSchedules[0]->id):new PodScheduleException;
		    $expSchedule->timespan = Input::get('timespan');
		    $pod->expSchedules()->save($expSchedule);

            
           
		}

		

        return Redirect::route('pods.index');
	}

	/**
	 * Remove the specified pod from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Pod::destroy($id);		
		return Redirect::route('pods.index');
	}


	
          	  
	              
	     


         
	

}
