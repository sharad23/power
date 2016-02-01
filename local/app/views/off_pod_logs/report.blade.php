
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pod-off-report')}}"> Report</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Report</h3>
                </div>
                <div class="box-body">

					 {{ Form::open(array('url' =>"pod-off-report", 'method' => 'post','id' =>'test')) }}
						<div class="form-group">
							{{ Form::label('pod_api_id', 'Pod') }}
							{{ Form::select('pod_api_id', array(null=>'Please Select')+Pod::get()->lists('apiPodName', 'id'),null,array('class'=>'form-control')) }}
							<p class="errors">{{$errors->first('pod_api_id')}}</p>
						</div>
						
						 <div class='col-sm-6'>
							<div class="form-group">
							{{ Form::label('from_date', 'From Date') }}
								<div class='input-group date' id='datetimepicker1'>
									{{ Form::text('from_date','0000-00-00',array('class'=>'form-control')) }}
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="bootstrap-timepicker">
								<div class="form-group">
									{{ Form::label('from_time', 'From Time') }}
									<div class="input-group">
									{{ Form::text('from_time','00:00:00',array('class'=>'form-control timepicker')) }}
											<div class="input-group-addon">
											  <i class="fa fa-clock-o"></i>
											</div>
									  </div>
									  <p class="errors">{{$errors->first('from_time')}}</p>
								</div>
							</div>
						</div>
						
						 <div class='col-sm-6'>
							<div class="form-group">
							{{ Form::label('to_date', 'To Date') }}
								<div class='input-group date' id='datetimepicker2'>
									{{ Form::text('to_date',date('Y-m-d'),array('class'=>'form-control')) }}
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="bootstrap-timepicker">
								<div class="form-group">
									{{ Form::label('to_time', 'To Time') }}
									<div class="input-group">
									{{ Form::text('to_time','23:59:59',array('class'=>'form-control timepicker1')) }}
											<div class="input-group-addon">
											  <i class="fa fa-clock-o"></i>
											</div>
									  </div>
									  <p class="errors">{{$errors->first('from_time')}}</p>
								</div>
							</div>
						</div>
						
						
						 <div class="form-group">
							{{ Form::label('state', 'State') }}
							{{ Form::select('state', array(null=>'Please Select','3' => 'Red', '2' => 'Yellow','1' => 'Blue'),null,array('class'=>'form-control')) }}
							<p class="errors">{{$errors->first('brand')}}</p>
						</div>
							{{ Form::submit('submit',array('class'=>'btn btn-primary','name'=>'submit')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Pod</th>
						<th>Off Time</th>
						<th>On Time</th>
						<th>Total off Time</th>
						<th>State</th>
						<th>Group</th>
						<th>Schedule Time</th>
					</thead> 
					<tbody>
						<?php $i=1; ?>
						@foreach($logs as $log)
						<tr>
						    <td>{{ $i++;}}</td>
							<td>{{ $log['pod']['api_pod']['pod'] }}</td>
							<td>{{ $log['from_time'] }}</td>
							<td>{{ $log['to_time'] }}</td>
							<?php $difftime = strtotime($log['to_time']) - strtotime($log['from_time']) ?>
							<td>{{ date('H:i:s',$difftime) }}</td>
							@if($log['state'] == 0||$log['state'] == 1)
									<td class="bg-primary">	{{'Blue'}} </td>
									@elseif($log['state'] == 2)
									<td class="bg-yellow">	{{'Yellow'}} </td>
									@else
									<td class="bg-red">	{{'Red'}} </td>
									@endif
									
							@if($log['pod']['schedule_type'] == 0)
							 <?php 	$group_id=$log['pod']['group_schedules'][0]['group']['id'];
										?> 
							  <td> {{HTML::link("groups/$group_id",'Group-'.$log['pod']['group_schedules'][0]['group']['name'])}}</td>
							@else
							  <td></td>
							@endif
							<td>{{ $log['schedule_from_time'] }} - {{ $log['schedule_to_time']  }}</td>
					    </tr>
					    @endforeach
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


 
@stop
