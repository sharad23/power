

@extends('layouts.main')
@section('content')


 <section class="content-header">
          <h1>
            Visit Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/visits')}}">Visit</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Edit</h3>
                </div>
                <div class="box-body">
					<dl class="dl-horizontal">
						<dt>Visit Date :</dt>
						<dd>{{$visit->visit_date}}</dd>
						<dt>Visit Type :</dt>
						<dd>{{($visit->type ==0)?'Regular':'Urgent'}}</dd>
						<dt>Visit Purpose :</dt>
						<dd>{{$visit->purpose}}</dd>
						<dt>Visit Staff :</dt>
						@foreach($visit->staffs as $staff)        
							<dd>{{ $staff->username }}</dd> 						
						@endforeach
						
					</dl>
				</div>
							
				
				<div class="box box-solid">
					<div class="box-header with-border">
					  <h3 class="box-title">Pod Visit Report</h3>
					</div>
					<div class="box-body">
						{{ Form::open(array('url' => "edit-visit-report/$visit->id", 'method' => 'post','id' =>'test')) }}	

						<div class="box-group" id="accordion">					  
						@foreach($visit->pods as $pod)						
							<div class="panel box box-primary">
								<div class="box-header with-border">
									<h4 class="box-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#{{ $pod->pod->apiPod->pod }}" aria-expanded="false" class="collapsed">
											{{ $pod->pod->apiPod->pod }}
										</a>
									</h4>
								</div>
								<div id="{{ $pod->pod->apiPod->pod }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="box box-solid">
										<div class="box-header with-border">
										</div>
										<div class="box-body">
											<div class="box-group" id="accordion-battery">					  
												<div class="panel box box-info">
													<div class="box-header with-border">
														<h4 class="box-title">
															<a data-toggle="collapse" data-parent="#accordion-battery" href="#{{ $pod->pod->apiPod->pod }}-battery" aria-expanded="false" class="collapsed">
																Battery
															</a>
														</h4>
													</div>  
													<div id="{{ $pod->pod->apiPod->pod }}-battery" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">													
														<div class="box-group" id="accordion-child1">					  
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">																
																		<a class="battery-install" data-toggle="collapse" data-parent="#accordion-child1" href="#{{ $pod->pod->apiPod->pod }}-battery-install" aria-expanded="false" class="collapsed">
																			{{ Form::checkbox("battery_installation[$pod->id][]",1,( $visit->podBatteryInstallLog()->count() >= 1)) }}	Battery Installed															
																			<p class="errors">{{$errors->first('battery_installation')}}</p>
																		</a>
																	</h4>
																</div>
																<?php $newBattery =  array();   ?>
                                                                @if(!empty($visit->podBatteryInstallLog->toArray()))
	                                                            
																@foreach($visit->podBatteryInstallLog as $newBatteryLog)
																	<?php $newBattery[] = $newBatteryLog->id;  ?>
																	<div id="{{ $pod->pod->apiPod->pod }}-battery-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																		<div id="battery_detail" class="box-body battery_detail">
																		<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																			<div class="form-group">
																				{{ Form::label('brand', 'Battery Brand') }}
																				{{ Form::text("battery_brand[$pod->id][$newBatteryLog->id]",$newBatteryLog->brand,array('class'=>'form-control'))}}
																				<p class="errors">{{$errors->first('brand')}}</p>
																			</div>
																																						
																			<div class="form-group">
																				{{ Form::label('capacity', 'Capacity') }}
																				{{ Form::text("battery_capacity[$pod->id][$newBatteryLog->id]",$newBatteryLog->capacity,array('class'=>'form-control')) }}
																				<p class="errors">{{$errors->first('capacity')}}</p>
																			</div>
																			
																			
																			<div class="form-group">
																			{{ Form::label('installed_date', 'Install Date') }}
																				<div class='input-group date datepicker_recurring_start'>
																					{{ Form::text("battery_installed_date[$pod->id][$newBatteryLog->id]",$newBatteryLog->installed_date,array('class'=>'form-control')) }}
																					<span class="input-group-addon">
																						<span class="glyphicon glyphicon-calendar"></span>
																					</span>
																				</div>
																				<p class="errors">{{$errors->first('installed_date')}}</p> 
																			</div>
																			
																		</div>

																		{{ Form::hidden("battery_id[$pod->id][$newBatteryLog->id]",$newBatteryLog->id)}}
																		
																		<div id="additionalbattery"></div>
																		<button type="button" class="btn btn-default addbattery "><i class="fa fa-plus "></i>Add More</button>
																	
																	</div>
																@endforeach
																@else
                                                                  <div id="{{ $pod->pod->apiPod->pod }}-battery-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																	<div id="battery_detail" class="box-body battery_detail">
																	<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																		<div class="form-group">
																			{{ Form::label('brand', 'Battery Brand') }}
																			{{ Form::text("battery_brand[$pod->id][]",null,array('class'=>'form-control'))}}
																			<p class="errors">{{$errors->first('brand')}}</p>
																		</div>
																		
																		<div class="form-group">
																			{{ Form::label('capacity', 'Capacity') }}
																			{{ Form::text("battery_capacity[$pod->id][]",null,array('class'=>'form-control')) }}
																			<p class="errors">{{$errors->first('capacity')}}</p>
																		</div>
																		
																		<div class="form-group">
																		{{ Form::label('installed_date', 'Install Date') }}
																			<div class='input-group date datepicker_recurring_start'>
																				{{ Form::text("battery_installed_date[$pod->id][]",null,array('class'=>'form-control')) }}
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																			<p class="errors">{{$errors->first('installed_date')}}</p> 
																		</div>										   
																		
																		{{ Form::hidden("battery_id[$pod->id][]",0)}}	
																	</div>
																	<div id="additionalbattery"></div>
																	<button type="button" class="btn btn-default addbattery "><i class="fa fa-plus "></i>Add More</button>
																</div>

                                                                @endif
															</div>															  
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">
																	  <a data-toggle="collapse" data-parent="#accordion-child1" href="#{{ $pod->pod->apiPod->pod }}-battery-report" aria-expanded="false" class="collapsed">
																		Existing Battery Report
																	  </a>
																	</h4>
																</div>
																<div id="{{ $pod->pod->apiPod->pod }}-battery-report" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="box-body">
																		@foreach($pod->batteries as $battery)
																			@if(!in_array($battery->id,$newBattery))
																			<div class="box-header with-border">
																				<h3 class="box-title">{{ $battery->brand }}</h3>
																			</div>
																			<div class="box-body">
																				<?php 
																					 
																					 $battery_data = $visit->podBatteryReport()->where('pod_batteries.id','=',$battery->id)->first();

																				?>															
																				<div class="form-group">
																				   {{ Form::label('water_level', 'Water Level') }}
																				   {{ Form::text("battery_water_level[$battery->id]",is_object($battery_data) ? $battery_data->pivot->water_level : null,array('class'=>'form-control'))}}
																					<div class="box-header with-border">
																						<h4 class="box-title">
																						{{  Form::checkbox("battery_water_added[$battery->id]",1, $visit->podBatteryWaterAdded()->where('pod_batteries.id','=',$battery->id)->count() == 1)   }}
																						Water Added													
																						 <p class="errors">{{$errors->first('brand')}}</p>
																						</h4>
																					</div>
																				</div>
																			</div>
																			@endif
																		@endforeach		
																	</div>
																</div>
															</div>
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">
																	  <a data-toggle="collapse" data-parent="#accordion-child1" href="#{{ $pod->pod->apiPod->pod }}-battery-uninstall" aria-expanded="false" class="collapsed">
																		Battery Uninstall
																	  </a>
																	</h4>
																</div>
																<div id="{{ $pod->pod->apiPod->pod }}-battery-uninstall" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="box-body">
																		@foreach($pod->batteries as $battery)
																			@if(!in_array($battery->id,$newBattery))   
																			<div class="box-body">															
																				<div class="form-group">
																				  
																					<h4 class="box-title">
																					
																						 {{  Form::checkbox("battery_uninstall[$battery->id]")  }}   
																						 {{  $battery->brand }}
																																	
																					 
																					</h4>
																				</div>
																			@endif
																			</div>
																		@endforeach		
																	</div>
																</div>
															</div>
														</div>
													</div>		  
													<div class="panel box box-info">
														<div class="box-header with-border">
															<h4 class="box-title">
																<a data-toggle="collapse" data-parent="#accordion-battery" href="#{{ $pod->pod->apiPod->pod }}-ups" aria-expanded="false" class="collapsed">
																	Ups
																</a>
															</h4>
														</div>
														  
														<div id="{{ $pod->pod->apiPod->pod }}-ups" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
															<div class="box-group" id="accordion-child2">				  
																<div class="panel box box-primary">
																	<div class="box-header with-border">
																		<h4 class="box-title">														
																			<a class="battery-install" data-toggle="collapse" data-parent="#accordion-child2" href="#{{ $pod->pod->apiPod->pod }}-ups-install">
																				{{ Form::checkbox("ups_installation[$pod->id][]",1,( $visit->podUpsInstallLog()->count() >= 1)) }}	UPS Install															
																				<p class="errors">{{$errors->first('ups_installation')}}</p>
																			</a>
																		</h4>
																	</div>
																<?php $newUps =  array();   ?>
															    @if(!empty($visit->podUpsInstallLog->toArray()))
																
																@foreach($visit->podUpsInstallLog as $newUpsLog)
																<?php $newUps[] = $newUpsLog->id;  ?>
																	<div id="{{ $pod->pod->apiPod->pod }}-ups-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																		<div id="ups_detail" class="box-body ups_detail">
																		<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																			<div class="form-group">
																				{{ Form::label('ups_brand', 'Ups Brand') }}
																				{{ Form::text("ups_brand[$pod->id][$newUpsLog->id]",$newUpsLog->brand,array('class'=>'form-control'))}}
																				<p class="errors">{{$errors->first('brand')}}</p>
																			</div>
																			
																			<div class="form-group">
																				{{ Form::label('ups_capacity', 'Ups Capacity') }}
																				{{ Form::text("ups_capacity[$pod->id][$newUpsLog->id]",$newUpsLog->capacity,array('class'=>'form-control')) }}
																				<p class="errors">{{$errors->first('capacity')}}</p>
																			</div>
																			
																			
																			<div class="form-group">
																			{{ Form::label('installed_date', 'Install Date') }}
																				<div class='input-group date datepicker_recurring_start'>
																					{{ Form::text("ups_installed_date[$pod->id][$newUpsLog->id]",$newUpsLog->installed_date,array('class'=>'form-control')) }}
																					<span class="input-group-addon">
																						<span class="glyphicon glyphicon-calendar"></span>
																					</span>
																				</div>
																				<p class="errors">{{$errors->first('installed_date')}}</p> 
																			</div>												   

																			{{ Form::hidden("ups_id[$pod->id][$newUpsLog->id]",$newUpsLog->id) }}

																		</div>
																		
																		<div id="additionalups"></div>
																		<button type="button" class="btn btn-default addups "><i class="fa fa-plus "></i>Add More</button>
																	
																	</div>
																@endforeach
																@else

                                                                  <div id="{{ $pod->pod->apiPod->pod }}-ups-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																	<div id="ups_detail" class="box-body ups_detail">
																		<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																		<div class="form-group">
																			{{ Form::label('ups_brand', 'Ups Brand') }}
																			{{ Form::text("ups_brand[$pod->id][]",null,array('class'=>'form-control'))}}
																			<p class="errors">{{$errors->first('brand')}}</p>
																		</div>
																		
																		<div class="form-group">
																			{{ Form::label('ups_capacity', 'Ups Capacity') }}
																			{{ Form::text("ups_capacity[$pod->id][]",null,array('class'=>'form-control')) }}
																			<p class="errors">{{$errors->first('capacity')}}</p>
																		</div>
																		
																		<div class="form-group">
																			{{ Form::label('installed_date', 'Install Date') }}
																				<div class='input-group date datepicker_recurring_start'>
																					{{ Form::text("ups_installed_date[$pod->id][]",null,array('class'=>'form-control')) }}
																					<span class="input-group-addon">
																						<span class="glyphicon glyphicon-calendar"></span>
																					</span>
																				</div>
																				<p class="errors">{{$errors->first('installed_date')}}</p> 
																			</div>	

																		{{ Form::hidden("ups_id[$pod->id][]", 0)}}
																	</div>
																	<div id="additionalups"></div>
																	<button type="button" class="btn btn-default addups "><i class="fa fa-plus "></i>Add More</button>
																</div>

																@endif
																</div>			  
																<div class="panel box box-primary">
																	<div class="box-header with-border">
																		<h4 class="box-title">
																		  <a data-toggle="collapse" data-parent="#accordion-child2" href="#{{ $pod->pod->apiPod->pod }}-ups-report" aria-expanded="false" class="collapsed">
																			Existing UPS Report
																		  </a>
																		</h4>
																	</div>
																	<div id="{{ $pod->pod->apiPod->pod }}-ups-report" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																		<div class="box-body">
																			@foreach($pod->ups as $ups)
																			  @if(!in_array($ups->id,$newUps))
																			<div class="box-header with-border">
																				<h3 class="box-title">{{ $ups->brand }}</h3>
																			</div>
																			<?php 
																				 
																				   $ups_data = $visit->podupsReports()->where('pod_ups.id','=',$ups->id)->first();

																			?>
																			<div class="box-body">
																				<div class="form-group">
																					{{ Form::label('ups_main_input_voltage', 'Input Voltage') }}
																					{{ Form::text("ups_main_input_voltage[$ups->id]",is_object($ups_data) ? $ups_data->pivot->main_input_voltage : null ,array('class'=>'form-control'))}}
																					
																				</div>
																				
																				<div class="form-group">
																					{{ Form::label('ups_output_voltage_bypass', 'Output Voltage Bypass') }}
																					{{ Form::text("ups_output_voltage_bypass[$ups->id]", is_object($ups_data) ? $ups_data->pivot->output_voltage_bypass : null,array('class'=>'form-control')) }}
																					<p class="errors"></p>
																				</div>
													   
																				<div class="form-group">
																					{{ Form::label('ups_output_voltage_backup', 'Output Voltage Backup') }}
																					{{ Form::text("ups_output_voltage_backup[$ups->id]",is_object($ups_data) ? $ups_data->pivot->output_voltage_backup : null ,array('class'=>'form-control')) }}
																					<p class="errors"></p>   
																				</div>
																			
																				<div class="form-group">
																					{{ Form::label('ups_charging_ampere', 'Charging Ampere') }}
																					{{ Form::text("ups_charging_ampere[$ups->id]", is_object($ups_data) ? $ups_data->pivot->charging_ampere : null,array('class'=>'form-control')) }}
																					<p class="errors"></p>   
																				</div>
																				
																				<div class="form-group">
																					{{ Form::label('ups_discharging_ampere', 'Discharging Ampere') }}
																					{{ Form::text("ups_discharging_ampere[$ups->id]", is_object($ups_data) ? $ups_data->pivot->discharging_ampere : null,array('class'=>'form-control')) }}
																					<p class="errors"></p>   
																				</div>
																			</div>
																			  @endif
																			@endforeach
																		</div>
																	</div>													
																</div>					  
																<div class="panel box box-primary">
																	<div class="box-header with-border">
																		<h4 class="box-title">
																			<a data-toggle="collapse" data-parent="#accordion-child2" href="#{{ $pod->pod->apiPod->pod }}-ups-uninstall" aria-expanded="false" class="collapsed">
																				UPS Uninstall
																			</a>
																		</h4>
																	</div>
																	<div id="{{ $pod->pod->apiPod->pod }}-ups-uninstall" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																		<div class="box-body">
																			@foreach($pod->ups as $ups)
																			   @if(!in_array($ups->id,$newUps))																
																				<div class="box-body">															
																					<div class="form-group">
																						<h4 class="box-title">																		
																							 {{  Form::checkbox("ups_uninstall[$ups->id]")  }}   
																							 {{  $ups->brand }}	
																						</h4>
																					</div>
																				</div>
																				@endif
																			@endforeach		
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>				  
												    <div class="panel box box-info">
														<div class="box-header with-border">
										                    <h4 class="box-title">
											                    <a data-toggle="collapse" data-parent="#accordion-battery" href="#{{ $pod->pod->apiPod->pod }}-cord" aria-expanded="false" class="collapsed">
												                   Cords
											                    </a>
										                    </h4>
														</div>  
														<div id="{{ $pod->pod->apiPod->pod }}-cord" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
														@foreach($pod->cords as $cord)
                                                            <?php 
                                                              
                                                                 $cords_data = $visit->podCordsReport()->where('cords.id','=',$cord->id)->first();

                                                            ?>
	                                                        <div class="box-body">
																<div class="form-group">
																	{{ $cord->name }}
																	{{ Form::label('cords_reading', 'Cord Reading') }}
																	{{ Form::text("cords_reading[$cord->id]",is_object($cords_data) ? $cords_data->pivot->condition:null,array('class'=>'form-control'))}}
																	
																</div>
															</div>

                                                        @endforeach
														</div>
	                                                </div>
													
													<div class="panel box box-info">
													<div class="box-header with-border">
														<h4 class="box-title">
															<a data-toggle="collapse" data-parent="#accordion-battery" href="#{{ $pod->pod->apiPod->pod }}-charger" aria-expanded="false" class="collapsed">
															   Chargers
															</a>
														</h4>
													</div>  
													<div id="{{ $pod->pod->apiPod->pod }}-charger" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
														<div class="box-group" id="accordion-child3">				  
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">														
																		<a class="battery-install" data-toggle="collapse" data-parent="#accordion-child3" href="#{{ $pod->pod->apiPod->pod }}-charger-install">
																			{{ Form::checkbox("charger_installation[$pod->id][]",1,( $visit->podChargerInstallLog()->count() >= 1)) }}	Charger Install															
																			
																		</a>
																	</h4>
																</div>
																<?php $newChargers =  array();   ?>
																@if(!empty($visit->podChargerInstallLog->toArray()))
																	@foreach($visit->podChargerInstallLog as $newChargerLog)
																		<?php $newChargers[] = $newChargerLog->id;  ?>
																		<div id="{{ $pod->pod->apiPod->pod }}-charger-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																			<div id="charger_detail" class="box-body charger_detail">
																		<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																				<div class="form-group">
																					{{ Form::label('charger_brand', 'Charger Brand') }}
																					{{ Form::text("charger_brand[$pod->id][$newChargerLog->id]",$newChargerLog->brand,array('class'=>'form-control'))}}
																					<p class="errors">{{$errors->first('charger_brand')}}</p>
																				</div>
																				
																				<div class="form-group">
																				{{ Form::label('installed_date', 'Install Date') }}
																					<div class='input-group date datepicker_recurring_start'>
																						{{ Form::text("charger_installed_date[$pod->id][$newChargerLog->id]",$newChargerLog->installed_date,array('class'=>'form-control')) }}
																						<span class="input-group-addon">
																							<span class="glyphicon glyphicon-calendar"></span>
																						</span>
																					</div>
																					<p class="errors">{{$errors->first('charger_installed_date')}}</p> 
																				</div>	
													   
																				 {{ Form::hidden("charger_id[$pod->id][$newChargerLog->id]",$newChargerLog->id)}}
																			</div>
																			
																			<div id="additionalcharger"></div>
																			<button type="button" class="btn btn-default addcharger "><i class="fa fa-plus "></i>Add More</button>
																		</div>
																	@endforeach
																@else
                                                                <div id="{{ $pod->pod->apiPod->pod }}-charger-install" class="panel-collapse collapse battery_info" aria-expanded="false" style="height: 0px;">
																	<div id="charger_detail" class="box-body charger_detail">
																		<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
																		<div class="form-group">
																			{{ Form::label('charger_brand', 'Charger Brand') }}
																			{{ Form::text("charger_brand[$pod->id][]",null,array('class'=>'form-control'))}}
																			<p class="errors">{{$errors->first('charger_brand')}}</p>
																		</div>
																		
																		<div class="form-group">
																		{{ Form::label('installed_date', 'Install Date') }}
																			<div class='input-group date datepicker_recurring_start'>
																				{{ Form::text("charger_installed_date[$pod->id][]",null,array('class'=>'form-control')) }}
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																			<p class="errors">{{$errors->first('charger_installed_date')}}</p> 
																		</div>	
																		{{ Form::hidden("charger_id[$pod->id][]",0)}}
																	</div>
																	
																	
																	<div id="additionalcharger"></div>
																	<button type="button" class="btn btn-default addcharger "><i class="fa fa-plus "></i>Add More</button>
																		
																</div>
																@endif
															</div>			  
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">
																	  <a data-toggle="collapse" data-parent="#accordion-child3" href="#{{ $pod->pod->apiPod->pod }}-charger-report" aria-expanded="false" class="collapsed">
																		Existing Charger Report
																	  </a>
																	</h4>
																</div>
																<div id="{{ $pod->pod->apiPod->pod }}-charger-report" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="box-body">
																		@foreach($pod->chargers as $charger)
																			@if(!in_array($charger->id,$newChargers)) 

																			    <?php 
                                                                                         $charger_data =  $visit->podChargerReport()->where('chargers.id','=',$charger->id)->first();

																			    ?>                                                       
																				<div class="box-body">
																					<div class="form-group">
																						{{ $charger->brand }}
																						{{ Form::label('charging_ampere', 'Charging Ampere') }}
																						{{ Form::text("charging_ampere[$charger->id]",is_object($charger_data) ? $charger_data->pivot->charging_ampere : null ,array('class'=>'form-control'))}}
																						
																					</div>
																				</div>
																			@endif
																		@endforeach
																	</div>
																</div>													
															</div>					  
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">
																		<a data-toggle="collapse" data-parent="#accordion-child3" href="#{{ $pod->pod->apiPod->pod }}-charger-uninstall" aria-expanded="false" class="collapsed">
																			Charger Uninstall
																		</a>
																	</h4>
																</div>
																<div id="{{ $pod->pod->apiPod->pod }}-charger-uninstall" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="box-body">
																		@foreach($pod->chargers as $charger)
																		    @if(!in_array($charger->id,$newChargers))																
																				<div class="box-body">															
																					<div class="form-group">
																						<h4 class="box-title">																		
																							 {{  Form::checkbox("charger_uninstall[$charger->id]")  }}   
																							 {{  $charger->brand }}	
																						</h4>
																					</div>
																				</div>
																			@endif
																		@endforeach		
																	</div>
																</div>
															</div>
														</div>													
													</div>
												</div>

													@if($pod->submeter == 1)					  
												    <div class="panel box box-info">
														<div class="box-header with-border">
										                    <h4 class="box-title">
											                    <a data-toggle="collapse" data-parent="#accordion-battery" href="#{{ $pod->pod->apiPod->pod }}-submeter" aria-expanded="false" class="collapsed">
												                   Submeter Reading
											                    </a>
										                    </h4>
														</div>  
														<?php 
                                                               $submeter = $visit->submeterReports()->where('pod_inventories.id','=',$pod->id)->first();
														?>
														<div id="{{ $pod->pod->apiPod->pod }}-submeter" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
															<div class="box-body">
																<div class="form-group">
																	{{ Form::label('submeter_reading', 'Submeter Reading') }}
																	{{ Form::text("submeter_reading[$pod->id]",is_object($submeter) ? $submeter->pivot->reading : null ,array('class'=>'form-control'))}}
																</div>
															</div>
														</div>
	                                                </div>
													@endif
												</div>
											</div>	
										</div>
									</div>
								</div>
							@endforeach
						</div>
						{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}		
					</div>
				</div>				
			</div>
		</div>
	</div>
</section>
 
@stop





     