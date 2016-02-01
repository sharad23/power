<?php

class PodBatteriesController extends \BaseController {

	/**
	 * Display a listing of podbatteries
	 *
	 * @return Response
	 */
	public function index()
	{
		$podbatteries = PodBattery::all();
		/*foreach($podbatteries as $podbattery){
                 
         
             $podInventorys = $podbattery->podInventory()->get();
             foreach($podInventorys as $podInventory){
                     
                      $pods = $podInventory->pod()->get();
                      foreach($pods as $pod){

                            $apiPod =  $pod->apiPod()->get();
				             echo "<pre>";
				             print_r($apiPod->toArray());
				             echo '</pre>';
                      }
             } 
             
                
                  
            
		}*/
        return View::make('podbatteries.index', compact('podbatteries'));
	}

	/**
	 * Show the form for creating a new podbattery
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('podbatteries.create');
	}

	/**
	 * Store a newly created podbattery in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PodBattery::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		PodBattery::create($data);

		return Redirect::route('pod_batteries.index');
		
	}

	/**
	 * Display the specified podbattery.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$podbattery = PodBattery::findOrFail($id);

		return View::make('podbatteries.show', compact('podbattery'));
	}

	/**
	 * Show the form for editing the specified podbattery.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$podbattery = PodBattery::find($id);

		return View::make('podbatteries.edit', compact('podbattery'));
	}

	/**
	 * Update the specified podbattery in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$podbattery = PodBattery::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PodBattery::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$podbattery->update($data);

		return Redirect::route('pod_batteries.index');
	}

	/**
	 * Remove the specified podbattery from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PodBattery::destroy($id);

		return Redirect::route('pod_batteries.index');
	}

	public function addPodBattery($id){
         $pod_inventory = PodInventory::find($id);
         if(isset($_POST['submit'])){
               
                $podBattery_ids = array();
                foreach(Input::get('brand') as $key => $data){
                       
                      $podBattery = PodBattery::find(Input::get('battery_id')[$key]) ?: new PodBattery;
                	  $podBattery->installed_date = Input::get('installed_date')[$key];
                      $podBattery->capacity = Input::get('capacity')[$key];
                      $podBattery->brand = $data;
                      $podBattery->pod_inventory_id = $id;
					  $podBattery->save();
                      $podBattery_ids[] = $podBattery->id;

                }
                PodBattery::where('pod_inventory_id', $id)
                           ->whereNotIn('id', $podBattery_ids)
                           ->delete();
						   
				return Redirect::to('add-pod-ups/'.$id);
		 
		 }
		 else{
		 	    $pod_batteries = $pod_inventory->batteries->toArray();
		 	     return View::make('podbatteries.multiple', compact('pod_batteries','pod_inventory'));
		 }
	}

}

