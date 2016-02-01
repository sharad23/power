<?php

class OffPodLogsController extends \BaseController {

	/**
	 * Display a listing of offpodlogs
	 *
	 * @return Response
	 */
	public function index()
	{
		$offpodlogs = OffPodLog::orderBy('updated_at', 'DESC')->get();

		return View::make('off_pod_logs.index', compact('offpodlogs'));
	}

	/**
	 * Show the form for creating a new offpodlog
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('off_pod_logs.create');
	}

	/**
	 * Store a newly created offpodlog in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), OffPodLog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Offpodlog::create($data);

		return Redirect::route('off_pod_logs.index');
	}

	/**
	 * Display the specified offpodlog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$offpodlog = OffPodLog::findOrFail($id);

		return View::make('off_pod_logs.show', compact('offpodlog'));
	}

	/**
	 * Show the form for editing the specified offpodlog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$offpodlog = OffPodLog::find($id);

		return View::make('off_pod_logs.edit', compact('offpodlog'));
	}

	/**
	 * Update the specified offpodlog in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$offpodlog = OffPodLog::findOrFail($id);

		$validator = Validator::make($data = Input::all(), OffPodLog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$offpodlog->update($data);

		return Redirect::route('off_pod_logs.index');
	}

	/**
	 * Remove the specified offpodlog from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		OffPodLog::destroy($id);

		return Redirect::route('off_pod_logs.index');
	}
    
    public function report(){
        
        $logs =  array();

        if(isset($_POST['submit'])){
            
           $pod = Input::get('pod_api_id');  // "43"; //Input::get('pod');
           $from = Input::get('from_date').' '.Input::get('from_time');  //"2016-01-20 15:29:44"; // Input::get('from_date');
           $to = Input::get('to_date').' '.Input::get('to_time'); // "3000-00-00 00:00:00"; //Input::get('to_date');
           $state = Input::get('state');  //"2"; // Input::get('state');
           $logs = OffPodLog::with(array('pod'=>function($query){
                                  
                                   $query->with('apiPod');
                                   $query->with(array('groupSchedules' => function($query){

                                   	            $query->with('group');
                                   }));
                                   $query->with('expSchedules');
                              }))
                              ->where('pod_id','LIKE',"%$pod%")
                              ->where('state','LIKE',"%$state%")
                              ->where('from_time','>=',$from)
                              ->where('to_time','<=',$to)
                              ->get()
                              ->toArray();
          
          }
        return View::make('off_pod_logs.report',compact('logs'));

    }


}
