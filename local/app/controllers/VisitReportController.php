<?php

class VisitsReportController extends \BaseController {

	  
	    public function report($id){

               $visit = Visit::findorfail($id); 
               return View::make('report.create', compact('visit'));
	    }
	
	    public function postReport($id){

              
               $visit = Visit::findorfail($id);
               $battery_water_added = (isset($_POST['battery_water_added']) ? $_POST['battery_water_added'] : array());
               $battery_installation = (isset($_POST['battery_installation']) ? $_POST['battery_installation'] : array());
               $ups_reports = (isset($_POST['ups_main_input_voltage']) ? $_POST['ups_main_input_voltage'] : array()); 
               $submeterReports =  (isset($_POST['submeter_reading']) ? $_POST['submeter_reading'] : array());
               $cordsReports =  (isset($_POST['cords_reading']) ? $_POST['cords_reading'] : array());
               $battery_uninstall =  (isset($_POST['battery_uninstall']) ? $_POST['battery_uninstall'] : array());
               $ups_install = (isset($_POST['ups_installation']) ? $_POST['ups_installation'] : array());
               $ups_uninstall = (isset($_POST['ups_uninstall']) ? $_POST['ups_uninstall'] : array());
               $charger_install = (isset($_POST['charger_installation']) ? $_POST['charger_installation'] : array());
               $charger_uninstall = (isset($_POST['charger_uninstall']) ? $_POST['charger_uninstall'] : array());
               $charger_reports = (isset($_POST['charging_ampere']) ? $_POST['charging_ampere'] : array());
               
               
               //add the existing battery report
               foreach(Input::get('battery_water_level') as $key => $water_level){
                    
               
                        $visit->podBatteryReport()->attach($key,array('water_level'=>$water_level));

               
               }

               foreach($battery_water_added as $key => $water_added){

                        $visit->podBatteryWaterAdded()->attach($key);
               }

               foreach($battery_installation as $key => $install){

                       foreach(Input::get('battery_brand')[$key] as $subkey => $newBattery){

                               $podBattery = new PodBattery();
                               $podBattery->brand = $newBattery;
                               $podBattery->installed_date = Input::get('battery_installed_date')[$key][$subkey];
                               $podBattery->capacity = Input::get('battery_capacity')[$key][$subkey];
                               $podBattery->pod_inventory_id = $key;
                               $podBattery->save();
                               $visit->podBatteryInstallLog()->attach($podBattery->id);
                       }

               }

               //add the uninstall battery log
               foreach($battery_uninstall as $key => $data){

                        $visit->podBatteryUnInstallLog()->attach($key);
                        $battery = Podbattery::find($key);
                        $battery->pod_inventory_id = 0;
                        $battery->save();
               }

               //add  the ups report
               foreach($ups_reports as $key => $up){
                     
                        $visit->podupsReports()->attach($key,array('main_input_voltage'=>$up,'output_voltage_bypass'=>Input::get('ups_output_voltage_bypass')[$key],'output_voltage_backup'=>Input::get('ups_output_voltage_backup')[$key],'charging_ampere'=>Input::get('ups_charging_ampere')[$key],'discharging_ampere'=>Input::get('ups_discharging_ampere')[$key]));

               }

               //add the ups install
               foreach($ups_install as $key => $install){

                       foreach(Input::get('ups_brand')[$key] as $subkey => $newUps){

                               $podUp = new PodUp();
                               $podUp->brand = $newUps;
                               $podUp->installed_date = Input::get('ups_installed_date')[$key][$subkey];
                               $podUp->capacity = Input::get('ups_capacity')[$key][$subkey];
                               $podUp->pod_inventory_id = $key;
                               $podUp->save();

                               $visit->podUpsInstallLog()->attach($podUp->id);
                       }

               }
               

               //add the ups uninstall
               foreach($ups_uninstall as $key => $data){

                        $visit->podUpsUnInstallLog()->attach($key);
                        $ups = PodUp::find($key);
                        $ups->pod_inventory_id = 0;
                        $ups->save();
               }



               //add the cord report
               foreach($cordsReports as $key => $value){

                      $visit->podCordsReport()->attach($key,array('condition'=> $value));
               }


               //add the submmeter report
               foreach($submeterReports as $key => $report){
                     
                        $visit->submeterReports()->attach($key,array('reading'=>$report));

               }

               //add the charger install
               foreach($charger_install as $key => $install){

                       foreach(Input::get('charger_brand')[$key] as $subkey => $newUps){

                               $podCharger = new Charger();
                               $podCharger->brand = $newUps;
                               $podCharger->installed_date = Input::get('charger_installed_date')[$key][$subkey];
                               $podCharger->pod_inventory_id = $key;
                               $podCharger->save();

                               $visit->podChargerInstallLog()->attach($podCharger->id);
                       }

               }



               //add the charger reports
               foreach($charger_reports as $key => $up){
                     
                    $visit->podChargerReport()->attach($key,array('charging_ampere'=> $up));

               }


               //add the charger uninstall
               foreach($charger_uninstall as $key => $data){

                        $visit->podChargerUnInstallLog()->attach($key);
                        $ups = Charger::find($key);
                        $ups->pod_inventory_id = 0;
                        $ups->save();
               }



               //update the  visit to completed from pending
               $visit->status = 1;
               $visit->save();
               //redirect
               return Redirect::route('visits.index');

               
	       }

         public function editReport($id){

               $visit = Visit::find($id);
               /*foreach($visit->pods as $pod){

                     $pod->submeter;
               }
              */
               return View::make('report.edit', compact('visit'));

              
         }

         public function postEditReport($id){
               
             
               $visit = Visit::findorfail($id);
               $battery_report = (isset($_POST['battery_water_level']) ? $_POST['battery_water_level'] : array());
               $battery_water_added = (isset($_POST['battery_water_added']) ? $_POST['battery_water_added'] : array());
               $battery_installation = (isset($_POST['battery_installation']) ? $_POST['battery_installation'] : array());
               $ups_reports = (isset($_POST['ups_main_input_voltage']) ? $_POST['ups_main_input_voltage'] : array()); 
               $submeterReports =  (isset($_POST['submeter_reading']) ? $_POST['submeter_reading'] : array());
               $cordsReports =  (isset($_POST['cords_reading']) ? $_POST['cords_reading'] : array());
               $battery_uninstall =  (isset($_POST['battery_uninstall']) ? $_POST['battery_uninstall'] : array());
               $ups_install = (isset($_POST['ups_installation']) ? $_POST['ups_installation'] : array());
               $ups_uninstall = (isset($_POST['ups_uninstall']) ? $_POST['ups_uninstall'] : array());
               $charger_install = (isset($_POST['charger_installation']) ? $_POST['charger_installation'] : array());
               $charger_uninstall = (isset($_POST['charger_uninstall']) ? $_POST['charger_uninstall'] : array());
               $charger_reports = (isset($_POST['charging_ampere']) ? $_POST['charging_ampere'] : array());
               
               
               //edit the battery report
               $data = array();
               foreach($battery_report as $key => $water_level){
                    
               
                    $data[$key] = array('water_level'=>$water_level);
               
               }
               $visit->podBatteryReport()->sync($data);
               
               //edit the water level
               $data = array();
               foreach($battery_water_added as $key => $water_added){

                    
                    $data[] = $key;
               }
               $visit->podBatteryWaterAdded()->sync($data);

               
               foreach($battery_installation as $key => $install){
                       
                       $batteryIds = array();
                       foreach(Input::get('battery_brand')[$key] as $subkey => $newBattery){

                                $podBattery = PodBattery::find(Input::get('battery_id')[$key][$subkey]) ?: new PodBattery;
                                $podBattery->installed_date = Input::get('battery_installed_date')[$key][$subkey];
                                $podBattery->capacity = Input::get('battery_capacity')[$key][$subkey];
                                $podBattery->brand = $newBattery;
                                $podBattery->pod_inventory_id = $key;
                                $podBattery->save();
                                $batteryIds[] = $podBattery->id;
                       }

                       $changes = $visit->podBatteryInstallLog()->sync($batteryIds);
                       // Delete the unused addresses
                      foreach ($changes['detached'] as $detachedId)
                      {
                           $podBattery = PodBattery::find($detachedId);
                           if(!empty($podBattery))
                           $podBattery->delete();
                      }

               }

               //add the uninstall battery log
               foreach($battery_uninstall as $key => $data){

                        $visit->podBatteryUnInstallLog()->attach($key);
                        $battery = Podbattery::find($key);
                        $battery->pod_inventory_id = 0;
                        $battery->save();
               }
               
               //add  the ups report
               $data = array();
               foreach($ups_reports as $key => $up){
                     
                        
                        $data[$key] = array('main_input_voltage'=>$up,'output_voltage_bypass'=>Input::get('ups_output_voltage_bypass')[$key],'output_voltage_backup'=>Input::get('ups_output_voltage_backup')[$key],'charging_ampere'=>Input::get('ups_charging_ampere')[$key],'discharging_ampere'=>Input::get('ups_discharging_ampere')[$key]);
               }
               $visit->podupsReports()->sync($data);
               
               //add the cord report
               $data = array();
               foreach($cordsReports as $key => $value){

                      //$visit->podCordsReport()->attach($key,array('reading'=> $value));
                        $data[$key] =  array('condition' => $value);
               }
               $visit->podCordsReport()->sync($data);

               //add the submmeter report
               $data = array();
               foreach($submeterReports as $key => $report){
                     
                        
                        $data[$key] = array('reading'=>$report);

               }
               $visit->submeterReports()->sync($data);

                //add the charger install
               foreach($charger_install as $key => $install){
                       
                       $chargerIds = array();
                       foreach(Input::get('charger_brand')[$key] as $subkey => $newUps){

                               $podCharger = Charger::find(Input::get('charger_id')[$key][$subkey]) ?: new Charger();
                               $podCharger->brand = $newUps;
                               $podCharger->installed_date = Input::get('charger_installed_date')[$key][$subkey];
                               $podCharger->pod_inventory_id = $key;
                               $podCharger->save();
                               $chargerIds[] = $podCharger->id;
                              
                       }
                       $changes = $visit->podChargerInstallLog()->sync($chargerIds);
                       // Delete the unused addresses
                       foreach($changes['detached'] as $detachedId)
                       {
                           $podCharger = Charger::find($detachedId);
                           if(!empty($podCharger))
                           $podCharger->delete();
                       }


               }



               //add the charger reports
               $data = array();
               foreach($charger_reports as $key => $up){
                     
                     //$visit->podChargerReport()->attach($key,array('charging_ampere'=> $up));
                     $data[$key] =  array('charging_ampere' => $up);

               }
               $visit->podChargerReport()->sync($data);


               //add the charger uninstall
               foreach($charger_uninstall as $key => $data){

                        $visit->podChargerUnInstallLog()->attach($key);
                        $ups = Charger::find($key);
                        $ups->pod_inventory_id = 0;
                        $ups->save();
               }

                //add the ups install
               foreach($ups_install as $key => $install){
                       
                       $upsIds = array();
                       foreach(Input::get('ups_brand')[$key] as $subkey => $newUps){

                               $podUp = PodUp::find(Input::get('ups_id')[$key][$subkey]) ?:new PodUp();
                               $podUp->brand = $newUps;
                               $podUp->installed_date = Input::get('ups_installed_date')[$key][$subkey];
                               $podUp->capacity = Input::get('ups_capacity')[$key][$subkey];
                               $podUp->pod_inventory_id = $key;
                               $podUp->save();
                               
                               $upsIds[] = $podUp->id;
                               //$visit->podUpsInstallLog()->attach($podUp->id);
                       }

                       $changes = $visit->podUpsInstallLog()->sync($upsIds);
                       // Delete the unused addresses
                       foreach($changes['detached'] as $detachedId)
                       {
                           $podUp = PodUp::find($detachedId);
                           if(!empty($podUp))
                           $podUp->delete();
                       }

               }
               

               //add the ups uninstall
               foreach($ups_uninstall as $key => $data){

                        $visit->podUpsUnInstallLog()->attach($key);
                        $ups = PodUp::find($key);
                        $ups->pod_inventory_id = 0;
                        $ups->save();
               }




               $visit->status = 1;
               $visit->save();
               //return Redirect::route('visits.index');
              


          }

          public function testQuery(){
		  
		          
                /*$visit = Visit::with('pods.pod','staffs')->find(33);
                echo '<pre>';
                print_r($visit->toArray());
                echo  '</pre>';
               

                $visit = Visit::find(33);
                $pods = $visit->pods;
                foreach($pods as $pod){

                    $pod->pod;
                }
                
                echo '<pre>';
                print_r(DB::getQueryLog());
                echo '</pre>';
                */

                // $offpod = OffPod::where('pod_id','=','14')->first()->update(array('from_time'=>"11:00:00"));
                // echo $offpod;
        				$to='9841793035';
        				$message='test';
        				
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
