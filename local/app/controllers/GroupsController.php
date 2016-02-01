<?php

class GroupsController extends \BaseController {

	/**
	 * Display a listing of groups
	 *
	 * @return Response
	 */
	public function index()
	{    
	//print_r( Auth::user());die;
		$groups = Group::all();
		return View::make('groups.index', compact('groups'));
		

	}

	/**
	 * Show the form for creating a new group
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('groups.create');
	}

	/**
	 * Store a newly created group in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Group::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Group::create($data);

		return Redirect::route('groups.index');
	}

	/**
	 * Display the specified group.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$group = Group::findOrFail($id);	
		$group_schedule=$group->schedules()->orderBy('day')->orderBy('to_time')->get();
		
		/*echo '<pre>';
		print_r($group['name']);
		echo '</pre>';die;*/
		
			$schedule=null;
			
			$schedule['id']=$group['name'];
			
			for($i=0;$i<7;$i++){
			
				$j=0;
				foreach($group_schedule as $grp_sch)
				{
					
					if($grp_sch->group_id==$id){
						if($grp_sch->day==$i){
							$schedule[$i][$j]['id']=$grp_sch['id'];
							$schedule[$i][$j]['group_id']=$grp_sch['group_id'];
							$schedule[$i][$j]['day']=$grp_sch['day'];				
							$schedule[$i][$j]['from']=$grp_sch['from_time'];
							$schedule[$i][$j]['to']=$grp_sch['to_time'];
							$j++;
						}
					}
				}
			}
			
			/*			
			echo '<pre>';
			print_r($schedule);
			echo '</pre>';
			*/
			
		
		
		return View::make('groups.show', compact('schedule'));
	}

	/**
	 * Show the form for editing the specified group.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = Group::find($id);

		return View::make('groups.edit', compact('group'));
	}

	/**
	 * Update the specified group in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$group = Group::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Group::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$group->update($data);

		return Redirect::route('groups.index');
	}

	/**
	 * Remove the specified group from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Group::destroy($id);

		return Redirect::route('groups.index');
	}

}
