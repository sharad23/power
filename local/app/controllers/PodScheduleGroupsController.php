<?php

class PodScheduleGroupsController extends \BaseController {

	/**
	 * Display a listing of podschedulegroups
	 *
	 * @return Response
	 */
	public function index()
	{
		$podschedulegroups = PodScheduleGroup::all();
        /*foreach($podschedulegroups as $podschedulegroup){

        	   echo '<pre>';
        	   print_r($podschedulegroup);
        	   echo '</pre>';
               
               echo '<pre>';
        	   print_r($podschedulegroup->pod);
        	   echo '</pre>';

        	   echo "--------------------------------------------------";

        }
        */
		return View::make('pod_schedule_groups.index', compact('podschedulegroups'));
	}

	/**
	 * Show the form for creating a new podschedulegroup
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pod_schedule_groups.create');
	}

	/**
	 * Store a newly created podschedulegroup in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PodScheduleGroup::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Podschedulegroup::create($data);

		return Redirect::route('pod_schedule_groups.index');
	}

	/**
	 * Display the specified podschedulegroup.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podschedulegroup = PodScheduleGroup::findOrFail($id);

		return View::make('pod_schedule_groups.show', compact('podschedulegroup'));
	}

	/**
	 * Show the form for editing the specified podschedulegroup.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podschedulegroup = PodScheduleGroup::find($id);

		return View::make('pod_schedule_groups.edit', compact('podschedulegroup'));
	}

	/**
	 * Update the specified podschedulegroup in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podschedulegroup = PodScheduleGroup::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodScheduleGroup::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podschedulegroup->update($data);

		return Redirect::route('pod_schedule_groups.index');
	}

	/**
	 * Remove the specified podschedulegroup from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodScheduleGroup::destroy($id);

		return Redirect::route('pod_schedule_groups.index');
	}

}
