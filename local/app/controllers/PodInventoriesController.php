<?php

class PodInventoriesController extends \BaseController {

	/**
	 * Display a listing of podinventories
	 *
	 * @return Response
	 */
	public function index()
	{   
		$podinventories = PodInventory::all();
	    return View::make('podinventories.index', compact('podinventories'));
	}

	/**
	 * Show the form for creating a new podinventory
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('podinventories.create');
	}

	/**
	 * Store a newly created podinventory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{   
		
		$validator = Validator::make($data = Input::all(), PodInventory::$rules['new']);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$pod_inventory = Podinventory::create($data);
		
		
		/*echo '<pre>';
		print_r($pod_inventory->id);
		echo '</pre>';die;*/
        //return Redirect::route('pod_inventories.index');
		
		return Redirect::to('add-pod-battery/'.$pod_inventory->id);

	}

	/**
	 * Display the specified podinventory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podinventory = PodInventory::findOrFail($id);
	    return View::make('podinventories.show', compact('podinventory'));
	}

	/**
	 * Show the form for editing the specified podinventory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podinventory = PodInventory::find($id);

        return View::make('podinventories.edit', compact('podinventory'));
	}

	/**
	 * Update the specified podinventory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podinventory = PodInventory::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodInventory::$rules['edit']);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podinventory->update($data);
		return Redirect::to('add-pod-battery/'.$id);		
        //return Redirect::route('pod_inventories.index');
	}

	/**
	 * Remove the specified podinventory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodInventory::destroy($id);

		return Redirect::route('pod_inventories.index');
	}

}
