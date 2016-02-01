<?php

class SchedulesController extends \BaseController {

	/**
	 * Display a listing of schedules
	 *
	 * @return Response
	 */
	public function index()
	{   
		//$schedules = Schedule::orderBy('group_id')->orderBy('day')->orderBy('to_time')->get();	
		$schedules = Schedule::orderBy('group_id')->orderBy('day')->orderBy('to_time')->get();
		
		/*echo '<pre>';
		print_r($schedules);
		echo '</pre>';die;*/
		
		$group=Group::orderBy('name')->max('name');
						
		$grp_schedule=null;
			
			for($i=1;$i<=$group;$i++){
				for($j=0;$j<7;$j++){
					$k=0;
					foreach($schedules as $sch){
					
						if($sch->group->name==$i){
							if($sch->day==$j){
									
							$grp_schedule[$i][$j][$k]['id']=$sch['id'];
							$grp_schedule[$i][$j][$k]['group_id']=$sch['group_id'];
							$grp_schedule[$i][$j][$k]['day']=$sch['day'];				
							$grp_schedule[$i][$j][$k]['from']=$sch['from_time'];
							$grp_schedule[$i][$j][$k]['to']=$sch['to_time'];
							$k++;
							
							}
						}
					}
				}
			}
			/*
			echo '<pre>';
			print_r($grp_schedule);
			echo '</pre>';*/
		
		
        return View::make('schedules.index', compact('grp_schedule'));
	}

	/**
	 * Show the form for creating a new schedule
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('schedules.create');
	}

	/**
	 * Store a newly created schedule in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Schedule::$rules,Schedule::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Schedule::create($data);
        return Redirect::route('schedules.index');
	}

	/**
	 * Display the specified schedule.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$schedule = Schedule::findOrFail($id);

		return View::make('schedules.show', compact('schedule'));
	}

	/**
	 * Show the form for editing the specified schedule.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{   

		$schedule = Schedule::find($id);
        return View::make('schedules.edit', compact('schedule'));
	}

	/**
	 * Update the specified schedule in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{  
		
		$schedule = Schedule::findOrFail($id);
        $validator = Validator::make($data = Input::all(), Schedule::$rules,Schedule::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$schedule->update($data);
		return Redirect::route('schedules.index');
		

		
	}

	/**
	 * Remove the specified schedule from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{   


		Schedule::destroy($id);
        return Redirect::route('schedules.index');
	}
	
	

}
