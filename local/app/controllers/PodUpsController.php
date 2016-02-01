<?php

class PodUpsController extends \BaseController {

	/**
	 * Display a listing of podups
	 *
	 * @return Response
	 */
	public function index()
	{
		$podups = PodUp::all();

		return View::make('pod_ups.index', compact('podups'));
	}

	/**
	 * Show the form for creating a new podup
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pod_ups.create');
	}

	/**
	 * Store a newly created podup in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PodUp::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		PodUp::create($data);

		return Redirect::route('pod_ups.index');
	}

	/**
	 * Display the specified podup.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podup = PodUp::findOrFail($id);
		return View::make('pod_ups.show', compact('podup'));
	}

	/**
	 * Show the form for editing the specified podup.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podup = PodUp::find($id);

		return View::make('pod_ups.edit', compact('podup'));
	}

	/**
	 * Update the specified podup in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podup = PodUp::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodUp::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podup->update($data);

		return Redirect::route('pod_ups.index');
	}

	/**
	 * Remove the specified podup from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodUp::destroy($id);

		return Redirect::route('pod_ups.index');
	}
	
	
	public function addPodUps($id){
         $pod_inventory = PodInventory::find($id);
         if(isset($_POST['submit'])){
                
               
                $podUps_ids = array();
                foreach(Input::get('brand') as $key => $data){

                	  $podUps = PodUp::find(Input::get('ups_id')[$key]) ?: new PodUp;
                	  $podUps->installed_date = Input::get('installed_date')[$key];
                      $podUps->capacity = Input::get('capacity')[$key];
                      $podUps->brand = $data;
                      $podUps->pod_inventory_id = $id;
					  $podUps->save();
                      $podUps_ids[] = $podUps->id;
                        

                }
                PodUp::where('pod_inventory_id', $id)
                           ->whereNotIn('id', $podUps_ids)
                           ->delete();
						   
				return Redirect::to('add-cord/'.$id);
		 
		 }
		 else{
		 	    $pod_ups = $pod_inventory->ups->toArray();
		 	    return View::make('pod_ups.multiple', compact('pod_ups','pod_inventory'));
		 }
	}


}
