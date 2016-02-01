<?php

class PodOffReasonsController extends \BaseController {

	/**
	 * Display a listing of podoffreasons
	 *
	 * @return Response
	 */
	public function index()
	{
		$podoffreasons = PodOffReason::all();

		return View::make('pod_off_reasons.index', compact('podoffreasons'));
	}

	/**
	 * Show the form for creating a new podoffreason
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pod_off_reasons.create');
	}

	/**
	 * Store a newly created podoffreason in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PodOffReason::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		PodOffReason::create($data);

		return Redirect::route('pod_off_reasons.index');
	}

	/**
	 * Display the specified podoffreason.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podoffreason = PodOffReason::findOrFail($id);

		return View::make('pod_off_reasons.show', compact('podoffreason'));
	}

	/**
	 * Show the form for editing the specified podoffreason.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podoffreason = PodOffReason::find($id);

		return View::make('ppod_off_reasons.edit', compact('podoffreason'));
	}

	/**
	 * Update the specified podoffreason in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podoffreason = PodOffReason::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodOffReason::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podoffreason->update($data);

		return Redirect::route('pod_off_reasons.index');
	}

	/**
	 * Remove the specified podoffreason from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodOffReason::destroy($id);

		return Redirect::route('pod_off_reasons.index');
	}

}
