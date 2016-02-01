<?php

class CordsController extends \BaseController {

	/**
	 * Display a listing of cords
	 *
	 * @return Response
	 */
	public function index()
	{
		$cords = Cord::all();
		
	
		return View::make('cords.index', compact('cords'));
	}

	/**
	 * Show the form for creating a new cord
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('cords.create');
	}

	/**
	 * Store a newly created cord in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Cord::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Cord::create($data);

		return Redirect::route('cords.index');
	}

	/**
	 * Display the specified cord.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cord = Cord::findOrFail($id);

		return View::make('cords.show', compact('cord'));
	}

	/**
	 * Show the form for editing the specified cord.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cord = Cord::find($id);

		return View::make('cords.edit', compact('cord'));
	}

	/**
	 * Update the specified cord in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$cord = Cord::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Cord::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$cord->update($data);

		return Redirect::route('cords.index');
	}

	/**
	 * Remove the specified cord from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Cord::destroy($id);

		return Redirect::route('cords.index');
	}
     
    public function addCord($id){
         $pod_inventory = PodInventory::find($id);
         if(isset($_POST['submit'])){
                
               
                $podCord_ids = array();
                foreach(Input::get('name') as $key => $data){

                	  $podCord = Cord::find(Input::get('cord_id')[$key]) ?: new Cord;
                	  $podCord->name = $data;
                	  $podCord->pod_inventory_id = $id;
					  
                      $podCord->save();
                      $podCord_ids[] = $podCord->id;
                       
                }
                Cord::where('pod_inventory_id', $id)
                           ->whereNotIn('id', $podCord_ids)
                           ->delete();
						   
				return Redirect::to('add-charger/'.$id);
		 
		 }
		 else{
		 	    $cords = $pod_inventory->cords->toArray();
		 	    return View::make('cords.multiple', compact('cords','pod_inventory'));
		 }
	}
}
