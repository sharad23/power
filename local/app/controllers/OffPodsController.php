<?php

class OffPodsController extends \BaseController {

	
	public function index()
	{
		$offpods = OffPod::orderBy('updated_at', 'DESC')->get();
		//echo '<pre>';
		//print_r($offpods);
		//echo '</pre>';
	    return View::make('off_pods.index', compact('offpods'));
	}

	/**
	 * Show the form for creating a new offpod
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('off_pods.create');
	}

	/**
	 * Store a newly created offpod in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), OffPod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		OffPod::create($data);

		return Redirect::route('off_pods.index');
	}

	/**
	 * Display the specified offpod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$offpod = OffPod::findOrFail($id);

		return View::make('off_pods.show', compact('offpod'));
	}

	/**
	 * Show the form for editing the specified offpod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$offpod = OffPod::find($id);

		return View::make('off_pods.edit', compact('offpod'));
	}

	/**
	 * Update the specified offpod in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$offpod = OffPod::findOrFail($id);

		$validator = Validator::make($data = Input::all(), OffPod::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$offpod->update($data);

		return Redirect::route('off_pods.index');
	}

	/**
	 * Remove the specified offpod from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		OffPod::destroy($id);
		return Redirect::route('off_pods.index');
	}

	public function podOff($ip_address="172.20.16.5",$podname="Dhading"){
          
          date_default_timezone_set('Asia/Kathmandu');
          //echo date('H:i:s');
          
		  $apiPod = ApiPod::where('pod','=',$podname)->first();
          if(is_object($apiPod)){
		  	    
		  	    $apiPod_array = $apiPod->toArray();
		  	    $pod = Pod::where('pod_api_id','=',$apiPod_array['id'])->first();
		  	    if(is_object($pod)){
		            $pod_array = $pod->toArray();
		            if($pod['schedule_type'] == 1){

                        $podlog['state'] = "0";
                        $podlog['pod_id'] = $pod_array['id'];
                        $podlog['from_time'] = date('H:i:s');
                        $this->sendNotification($param = array('type'=>'off','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." went down unexpectedly" ));
                            


		            }
	                else{
	                   
	                    $currentTime = date('H:i:s');
	               	    $currentDay = date('w');
	               	    $podlog['pod_id'] = $pod_array['id'];
                        $podlog['from_time'] = $currentTime;
	                    $groupSchedules = $pod->groupSchedules()->first();
	                    if(is_object($groupSchedules)){
	                    
		                    $schedules = $groupSchedules->schedules()->where('day','=',$currentDay)
                                                                     ->where('from_time','<=',$currentTime)
                                                                     ->where('to_time','>=',$currentTime)
		                                                             ->get();
		                    $schedules_array = $schedules->toArray();
		                    if(!empty($schedules_array)){

		                    	  $podlog['state'] =  "1";
		                    	  $podlog['schedule_id'] = $schedules_array['0']['id'];
		                    	  $this->sendNotification($param = array('type'=>'off','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." went according to its schedule" ));
		                    }
		                    else{

		                    	  $podlog['state'] =  "2";
		                    	  $this->sendNotification($param = array('type'=>'off','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." went off out of its schedule" ));
		                    	 // $this->send_sms('9849306373',$apiPod_array['pod'].' pod went down unexpectedly');
						    }
                        }                

	                }

	                 //check if th off pod alreday exists
                     $offpod = OffPod::where('pod_id','=',$pod_array['id'])->first();
                     if(!is_object($offpod)){
                           
                           $offPod = OffPod::create($podlog);
	                 }
	               
	                 
	            }
          	  }


          	   
          
    }

    public function podOn($ip_address="172.20.16.5",$podname="Dhading"){
          
          date_default_timezone_set('Asia/Kathmandu');
          $apiPod = ApiPod::where('pod','=',$podname)->first();
          if(is_object($apiPod)){
		  	    
		  	    $apiPod_array = $apiPod->toArray();
		  	    $pod = Pod::where('pod_api_id','=',$apiPod_array['id'])->first();
                if(is_object($pod)){
		             
                     $pod_array = $pod->toArray();
                     $down = OffPod::where('pod_id','=',$pod_array['id'])->first();
                     if(is_object($down)){
				             

				             $down->delete();
		                     $downPod = $down->toArray();
		                    
		                     //insert into pod logs
		                     $downPodLog = array();
		                     $downPodLog['pod_id'] = $downPod['pod_id'];
		                     $downPodLog['from_time'] = $downPod['created_at'];
		                     $downPodLog['to_time'] = date('Y-m-d H:i:s');
		                     $downPodLog['state'] = $downPod['state'];
		                     if($downPod['schedule_id'] != 0){
			                     
			                     $downPodLog['schedule_from_time'] = $down->schedule->from_time ;
			                     $downPodLog['schedule_to_time'] = $down->schedule->to_time;

		                     }
		                     
		                 
		                     $offPodLog = OffPodLog::create($downPodLog);
                             if($downPod['state'] == '3'){
		                        
		                           $this->sendNotification($param = array('type'=>'on','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." which was in red zone is on "));
		                     }
		                     elseif($downPod['state'] == '2'){

                                  $this->sendNotification($param = array('type'=>'on','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." which was in yellow zone is on "));
		                     }
		                     elseif($downPod['state'] == '1' or $downPod['state'] == '0'){

                                  $this->sendNotification($param = array('type'=>'on','pod_id'=>$pod_array['id'],'description'=>$apiPod_array['pod']." which was in blue zone is on "));
		                     }
		             }

		        }

          }

     

    }

    public function quickIntervalCron(){
         
         date_default_timezone_set('Asia/Kathmandu');
         $podsOff = OffPod::all();
         $grace_time = GraceTime::first()->period;
         $currentDay = date('w');
         $currentTime = date("H:i:s");
         foreach($podsOff as $podOff){

         	   //check the schedule
         	   if($podOff->pod->schedule_type == 0){
                       
                       //check whether the pods are within schedule or not
         	   	       if($podOff->schedule_id == 0 or $podOff->schedule_id == null){
                               
                                $pod_off_from_time = $podOff->from_time;
                                $added_to_grace_time = date('H:i:s',strtotime("+$grace_time minutes", strtotime($pod_off_from_time)));
                                if($currentTime <= $added_to_grace_time){

                                 //do nothing
                                	
                                }
                                else{
                                     
                                    //check whether now it lies within someschedule or not
                                	$schedule = $podOff->pod()->first()->groupSchedules()->first()->schedules()->where('day','=',$currentDay)
                                                                                                               ->where('from_time','<=',$currentTime)
                                                                                                               ->where('to_time','>=',$currentTime)
		                                                                                                       ->first();
		                            
		                            if(is_object($schedule)){
                                     
                                             //change to state 1 and add schedule
                                             $podOff->schedule_id = $schedule->id;
                                             $podOff->state = "1";
                                             $podOff->save();
                                    }
		                            else{

                                             //change to state 3 and send notification
		                            	     $podOff->state = "3";
                                             $podOff->save();
                                             //$this->send_sms('9808103913',$podOff->pod->apiPod->pod.' pod has entered in red zone.');
                                    } 
                                }
                                 
         	   	       }
         	   	       else{


	         	   	       
	         	   	       $schedule_to_time = $podOff->schedule->to_time;
	         	   	       if($currentTime <= $schedule_to_time){
	                               
	                            //do nothing
	         	   	       	    

	         	   	       }
	         	   	       else{
	                             
	                            //check for the garce time
	         	   	       	    $added_time = date('H:i:s',strtotime("+$grace_time minutes", strtotime($schedule_to_time)));
	         	   	       	    if($currentTime <= $added_time){

	         	   	       	    	   //change the state to 2
	         	   	       	    	    $podOff->state = "2";
	         	   	       	    	    $podOff->save();

	         	   	       	    }
	         	   	       	    else{

	         	   	       	    	   //change the state to 3
	         	   	       	    	    $podOff->state = "3";
	         	   	       	    	    $podOff->save();

	         	   	       	    }
	         	   	       }

         	   	       }

         	   }
         	   else{   

         	   	      
                      
                      //check the grace time
         	   	      $exceptionTime = $podOff->pod()->first()->expSchedules()->first()->timespan;
                      $added_to_exp_time = date('H:i:s',strtotime("+$exceptionTime minutes", strtotime($podOff->from_time)));
                      echo $currentTime.' '.$added_to_exp_time;
                      if($currentTime <= $added_to_exp_time){

         	   	      	     //do nothing
                      	
         	   	      }else{

                            $added_to_grace_time = date('H:i:s',strtotime("+$grace_time minutes", strtotime($added_to_exp_time)));
                            echo " ".$added_to_grace_time;
                            if($currentTime <= $added_to_grace_time){
                                 
                                  $podOff->state = "2";
	         	   	       	      $podOff->save();


                            }
                            else{

                                  $podOff->state = "3";
	         	   	       	      $podOff->save();
	         	   	       	      //send sms
								   //$this->send_sms('9808103913',$podOff->pod->apiPod->pod.' pod has entered in red zone.');
                            }

         	   	      }
         	   
     

         	   }
         

         }

    }

    private function getPowerStaffs(){


    	 $users = DB::connection('login');
                $user = $users->table('ag_staff_official_status')->where('department_id',11)
                 ->join('ag_personal_info', 'ag_staff_official_status.staff_id', '=', 'ag_personal_info.staff_id')->get();

         return $user;
    }

    private function sendNotification($param=array()){
         
         $users = $this->getPowerStaffs();
         foreach($users as $user){
                                      
            if($param['type'] == 'off'){ 
                 
                 Notification::create(array('pod_id'=>$param['pod_id'],'user_id'=>$user->staff_login_id,'descriptions'=>$param['description'],'notification_status'=>'0'));
		    }
		    else{

		    	 PodUpNotification::create(array('pod_id'=>$param['pod_id'],'user_id'=>$user->staff_login_id,'descriptions'=>$param['description'],'notification_status'=>'0'));
		    }

		}

    }
	
	
	Public function send_sms($to,$message)
	{
			/*
			//sms through sparrow sms
			 $api_url = "http://api.sparrowsms.com/v2/sms/?".
			  http_build_query(array(
				'token' =>'k6gfjH56tSWGO9i8vXfU',
				 'from' => 'websurfer',
				'to'    => $to,
				'text'  => $message));

			 $response = file_get_contents($api_url); 
			 */
			 
			//sms through f1soft sms 
			$data = array("esmeid"=>"39","appReferenceId"=>"100034", "number" =>$to, "message" =>$message);
				$data_string = json_encode($data); 
				//print_r($data_string);die;

				$ch = curl_init('http://web-sms.f1soft.com.np/sms-server/api/sendsms');                                                                      
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
						'Content-Type: application/json',                                                                                
						'Content-Length: ' . strlen($data_string))  
				);                                                                                                                   
				$result = curl_exec($ch);

			
	}

   

}
