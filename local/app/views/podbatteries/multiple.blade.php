
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Pod Battery
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pod_batteries')}}"> Pod Battery</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Create/Edit</h3>
					
					
					<a href="{{URL::to('pod_inventories/'.$pod_inventory->id.'/edit')}}" class="btn btn-primary "><b>Edit Pod</b></a>
					<a href="{{URL::to('/add-pod-ups/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Ups</b></a>
					<a href="{{URL::to('/add-cord/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Cord</b></a>
					<a href="{{URL::to('/add-charger/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Charger</b></a>
                </div>
                <div class="box-body">
					
				{{ Form::open(array('url' =>'add-pod-battery/'.$pod_inventory->id, 'method' => 'post','id' =>'test')) }}
					
					@if(empty($pod_batteries))					
						<div id="battery_detail" class="box-body battery_detail">	
						<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>						
						   <div class="form-group">
								{{ Form::label('brand', 'Battery Brand') }}
								{{ Form::text('brand[]',null,array('class'=>'form-control'))}}
								<p class="errors">{{$errors->first('brand')}}</p>
							</div>

							<div class="form-group">
								{{ Form::label('capacity', 'Capacity') }}
								{{ Form::text('capacity[]',null,array('class'=>'form-control')) }}
								<p class="errors">{{$errors->first('capacity')}}</p>
							</div>
							

							<div class="form-group">
							{{ Form::label('installed_date', 'Install Date') }}
								<div class='input-group date datepicker_recurring_start'>
									{{ Form::text('installed_date[]',null,array('class'=>'form-control')) }}
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								<p class="errors">{{$errors->first('installed_date')}}</p> 
							</div>

						{{ Form::hidden('battery_id[]', 0) }}							
						</div>
						
					 
					@else
						@foreach($pod_batteries as $pod_battery)
												
						<div id="battery_detail" class="box-body battery_detail">
						{{ Form::hidden('battery_id[]', $pod_battery['id']) }}
						<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>							
						   
						   <div class="form-group">
								{{ Form::label('brand', 'Battery Brand') }}
								{{ Form::text('brand[]',$pod_battery['brand'],array('class'=>'form-control'))}}
								<p class="errors">{{$errors->first('brand')}}</p>
							</div>

							<div class="form-group">
								{{ Form::label('capacity', 'Capacity') }}
								{{ Form::text('capacity[]',$pod_battery['capacity'],array('class'=>'form-control')) }}
								<p class="errors">{{$errors->first('capacity')}}</p>
							</div>
							

							<div class="form-group">
							{{ Form::label('installed_date', 'Install Date') }}
								<div class='input-group date datepicker_recurring_start'>
									{{ Form::text('installed_date[]',$pod_battery['installed_date'],array('class'=>'form-control')) }}
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								<p class="errors">{{$errors->first('installed_date')}}</p> 
							</div>
							
						</div>	
							
						@endforeach
						
					@endif
					<div id="additionalbattery"></div>
					<button type="button" class="btn btn-default addbattery "><i class="fa fa-plus "></i>Add More</button>
					
					{{ Form::submit('Submit',array('name'=>'submit','class'=>'btn btn-primary')) }}
					{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
					{{ HTML::link("pod_inventories/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop
