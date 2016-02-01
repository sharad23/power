<?php

class VisitsController extends \BaseController {

	/**
	 * Display a listing of visits
	 *
	 * @return Response
	 */
	public function index()
	{
		
       $visits = Visit::all();
	   return View::make('visits.index', compact('visits'));

	}

	/**
	 * Show the form for creating a new visit
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('visits.create');
		
	}

	/**
	 * Store a newly created visit in storage.
	 *
	 * @return Response
	 */
	public function store()
	{   
        
       
		$data = array('type'=>Input::get('type'),'visit_date'=>Input::get('visit_date'),'purpose'=>Input::get('purpose'),'remarks'=>Input::get('remarks'),'status'=>0);
		$validator = Validator::make($data, Visit::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        
        $visit = Visit::create($data);
        $visit->staffs()->attach(Input::get('staff_id'));
        $visit->pods()->attach(Input::get('pod_inventory_id'));
        
        if(Input::get('status') == 1){

                //redirect to the report
        	    return Redirect::action('VisitsReportController@report', array($visit->id));
        }
	    return Redirect::route('visits.index');
	}

	/**
	 * Display the specified visit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$visit = Visit::findOrFail($id);
		
		/*echo '<pre>';
		print_r($visit);
		echo '</pre>';die;*/
		
		
        return View::make('visits.show', compact('visit'));
	}

	/**
	 * Show the form for editing the specified visit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$visit = Visit::find($id);
		return View::make('visits.edit', compact('visit'));
	}

	/**
	 * Update the specified visit in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{   


		$visit = Visit::findOrFail($id);
		$data = array('type'=>Input::get('type'),'visit_date'=>Input::get('visit_date'),'purpose'=>Input::get('purpose'),'remarks'=>Input::get('remarks'));
        $validator = Validator::make($data, Visit::$rules);
        if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$visit->update($data);
		$visit->staffs()->sync(Input::get('staff_id'));
		$visit->pods()->sync(Input::get('pod_inventory_id'));
		if(Input::get('status') == 1){
                
                if($visit->status == 0){
                   
                    return Redirect::action('VisitsReportController@report', array($visit->id));
                
                }
                else{

                   return Redirect::action('VisitsReportController@editReport', array($visit->id));
                }
        }
		return Redirect::route('visits.index');
	}

	/**
	 * Remove the specified visit from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Visit::destroy($id);
        return Redirect::route('visits.index');
	}

	

}
