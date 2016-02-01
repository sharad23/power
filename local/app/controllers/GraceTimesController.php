<?php

class GraceTimesController extends \BaseController {

	/**
	 * Display a listing of gracetimes
	 *
	 * @return Response
	 */
	public function index()
	{
		$gracetimes = GraceTime::all();

		return View::make('grace_times.index', compact('gracetimes'));
	}

	/**
	 * Show the form for creating a new gracetime
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('grace_times.create');
	}

	/**
	 * Store a newly created gracetime in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), GraceTime::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		GraceTime::create($data);

		return Redirect::route('grace_times.index');
	}

	/**
	 * Display the specified gracetime.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$gracetime = GraceTime::findOrFail($id);

		return View::make('grace_times.show', compact('gracetime'));
	}

	/**
	 * Show the form for editing the specified gracetime.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$gracetime = GraceTime::find($id);

		return View::make('grace_times.edit', compact('gracetime'));
	}

	/**
	 * Update the specified gracetime in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$gracetime = GraceTime::findOrFail($id);

		$validator = Validator::make($data = Input::all(), GraceTime::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$gracetime->update($data);

		return Redirect::route('grace_times.index');
	}

	/**
	 * Remove the specified gracetime from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		GraceTime::destroy($id);

		return Redirect::route('grace_times.index');
	}

}
