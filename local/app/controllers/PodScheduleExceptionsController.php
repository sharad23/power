<?php

class PodScheduleExceptionsController extends \BaseController {

	/**
	 * Display a listing of podscheduleexceptions
	 *
	 * @return Response
	 */
	public function index()
	{
		$podscheduleexceptions = PodScheduleException::all();
		/*foreach($podscheduleexceptions as $podscheduleexception){

        	   echo '<pre>';
        	   print_r($podscheduleexception);
        	   echo '</pre>';
               
               echo '<pre>';
        	   print_r($podscheduleexception->pod);
        	   echo '</pre>';

        	   echo "--------------------------------------------------";

        }
        */
		return View::make('pod_schedule_exceptions.index', compact('podscheduleexceptions'));
	}

	/**
	 * Show the form for creating a new podscheduleexception
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pod_schedule_exceptions.create');
	}

	/**
	 * Store a newly created podscheduleexception in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PodScheduleException::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		PodScheduleException::create($data);

		return Redirect::route('pod_schedule_exceptions.index');
	}

	/**
	 * Display the specified podscheduleexception.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podscheduleexception = PodScheduleException::findOrFail($id);

		return View::make('pod_schedule_exceptions.show', compact('podscheduleexception'));
	}

	/**
	 * Show the form for editing the specified podscheduleexception.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podscheduleexception = PodScheduleException::find($id);

		return View::make('pod_schedule_exceptions.edit', compact('podscheduleexception'));
	}

	/**
	 * Update the specified podscheduleexception in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podscheduleexception = PodScheduleException::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodScheduleException::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podscheduleexception->update($data);

		return Redirect::route('pod_schedule_exceptions.index');
	}

	/**
	 * Remove the specified podscheduleexception from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodScheduleException::destroy($id);

		return Redirect::route('pod_schedule_exceptions.index');
	}

}
