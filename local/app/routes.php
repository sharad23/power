<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('ppp', array('before'=>'auth.basic',function(){  
	 
	 echo '<pre>'; 
	 print_r(Session::all()); 
     echo '</pre>';
     
     echo '<pre>';
     print_r(Auth::user());
     echo '</pre>';
     
     echo '<pre>';
     print_r(DB::getQueryLog());
     echo '</pre>';

}));
Route::get('login', function() {  return View::make('users.login'); });
Route::post('login', 'AccountController@login');
Route::get('podoff/{ip}/{pod}','OffPodsController@podOff');
Route::get('podon/{ip}/{pod}','OffPodsController@podOn');
Route::get('cron','OffPodsController@quickIntervalCron');
Route::group(array('before' => 'auth'), function()
{
		Route::get('/', function(){  return View::make('home');	});
		Route::get('/logout', array('uses' => 'AccountController@logout'));
        Route::get('check','OffPodsController@check');
		Route::get('pod_schedule','SchedulesController@getschedule');
		Route::get('visit-report/{id}','VisitsReportController@report');
		Route::post('visit-report/{id}', 'VisitsReportController@postReport');
		Route::get('edit-visit-report/{id}','VisitsReportController@editReport');
		Route::post('edit-visit-report/{id}', 'VisitsReportController@postEditReport');
		Route::get('test-report','VisitsReportController@testQuery');
		Route::resource('groups', 'GroupsController');
		Route::resource('schedules', 'SchedulesController');
		Route::resource('pods', 'PodsController');
		Route::resource('pod_schedule_groups', 'PodScheduleGroupsController');
		Route::resource('pod_schedule_exceptions', 'PodScheduleExceptionsController');
		Route::resource('grace_times', 'GraceTimesController');
		Route::resource('off_pods', 'OffPodsController');
		Route::resource('off_pod_logs', 'OffPodLogsController');
		Route::resource('pod_off_reasons', 'PodOffReasonsController');
		Route::resource('pod_inventories', 'PodInventoriesController');
		Route::resource('pod_batteries', 'PodBatteriesController');
		Route::resource('cords', 'CordsController');
		Route::resource('pod_ups', 'PodUpsController');
		Route::resource('visits', 'VisitsController');
		Route::resource('pod_chargers', 'ChargersController');
		Route::resource('staffs', 'VisitStaffController');
		Route::get('all-pod-off-notification','NotificationsController@podoffNotification');
		Route::get('all-pod-on-notification','NotificationsController@podOnNotification');
		Route::get('pod-on-notification/{id}','NotificationsController@podOnSeen');
		Route::get('pod-off-notification/{id}','NotificationsController@podOffSeen');
		Route::any('pod-off-report','OffPodLogsController@report');		
		Route::any('add-pod-battery/{id}','PodBatteriesController@addPodBattery');
		Route::any('add-pod-ups/{id}','PodUpsController@addPodUps');			
		Route::any('add-charger/{id}','ChargersController@addCharger');
		Route::any('add-cord/{id}','CordsController@addCord');

});		
		
