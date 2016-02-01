<?php

class ChargersController extends \BaseController {

	/**
	 * Display a listing of chargers
	 *
	 * @return Response
	 */
	public function index()
	{
		$chargers = Charger::all();

		return View::make('chargers.index', compact('chargers'));
	}

	/**
	 * Show the form for creating a new charger
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('chargers.create');
	}

	/**
	 * Store a newly created charger in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Charger::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Charger::create($data);

		return Redirect::route('pod_chargers.index');
	}

	/**
	 * Display the specified charger.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$charger = Charger::findOrFail($id);

		return View::make('chargers.show', compact('charger'));
	}

	/**
	 * Show the form for editing the specified charger.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$charger = Charger::find($id);

		return View::make('chargers.edit', compact('charger'));
	}

	/**
	 * Update the specified charger in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$charger = Charger::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Charger::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$charger->update($data);

		return Redirect::route('pod_chargers.index');
	}

	/**
	 * Remove the specified charger from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Charger::destroy($id);

		return Redirect::route('pod_chargers.index');
	}

	public function addCharger($id){
         $pod_inventory = PodInventory::find($id);
         if(isset($_POST['submit'])){
                
               
                $podCharger_ids = array();
                foreach(Input::get('brand') as $key => $data){

                	  $Charger = Charger::find(Input::get('charger_id')[$key]) ?: new Charger;
                	  $Charger->brand = $data;
                      $Charger->installed_date = Input::get('installed_date')[$key];
                      $Charger->pod_inventory_id = $id;
                      $Charger->save();
                      $Charger_ids[] = $Charger->id;
                        

                }
                Charger::where('pod_inventory_id', $id)
                           ->whereNotIn('id', $Charger_ids)
                           ->delete();
						   
				return Redirect::route('pod_inventories.index');
		 
		 }
		 else{
		 	    $chargers = $pod_inventory->chargers->toArray();
		 	    return View::make('chargers.multiple', compact('chargers','pod_inventory'));
		 }
	}

}
