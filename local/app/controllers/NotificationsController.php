<?php

class NotificationsController extends \BaseController {

	/**
	 * Display a listing of notifications
	 *
	 * @return Response
	 */
	

	public function podOffSeen($id){

         $notifications = Notification::where('user_id','=',$id)->update(array('notification_status' => '1'));
         
         
	}

	public function podOnSeen($id){

         $podUpNotification = PodUpNotification::where('user_id','=',$id)->update(array('notification_status' => '1'));
        
         
	}

	public function podoffNotification(){
        
        $notifications = Notification::where('user_id','=',Auth::user()->staff_user_id)->orderBy('created_at', 'DESC')->get();
		
        return View::make('notifications.podoff', compact('notifications'));

	}

	public function podOnNotification(){

        $notifications = PodUpNotification::where('user_id','=',Auth::user()->staff_user_id)->orderBy('created_at', 'DESC')->get();
		
        return View::make('notifications.podon', compact('notifications'));

	}

}
