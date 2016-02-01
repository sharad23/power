@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Visit
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
					{{ Form::model($visit,array('url' => "visits/$visit->id", 'method' => 'put','id' =>'test')) }}
						
						<div class="form-group">
							{{ Form::label('visit_date', 'Visit Date') }}
							<div class="input-group">								
								{{ Form::text('visit_date',null,array('class'=>'form-control datepicker')) }}
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<p class="errors">{{$errors->first('visit_date')}}</p>
						</div>
						
						
					   <div class="form-group">
							{{ Form::label('type','Type') }}
							{{ Form::select('type',array(null=>'Please Select')+array('0'=>'Routine Visit','1'=>'Emergency Visit'),null,array('name'=>'type','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('type')}}</p>
						</div>

						<div class="form-group">
						
							{{ Form::label('staffs', 'Staffs') }}
							{{ Form::select('staff_id[]',Staff::lists('username','id'),$visit->staffs->lists('id'),array('multiple'=>'multiple','name'=>'staff_id[]','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('staff_id')}}</p>
						</div>
							
					   <div class="form-group">
							{{ Form::label('pods', 'Pods') }}
							{{ Form::select('pod_inventory_id[]',PodInventory::get()->lists('apiPodName','id'),$visit->getPodId(),array('multiple'=>'multiple','name'=>'pod_inventory_id[]','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('pod_inventory_id')}}</p>   
						</div>
						
						 <div class="form-group">
							{{ Form::label('status', 'Status') }}
							{{ Form::select('status',array(null=>'Please Select')+array('0'=>'Pending','1'=>'Completed'),null,array('name'=>'status','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('status')}}</p>   
						</div>
						
						
						 <div class="form-group">
							{{ Form::label('purpose', 'Purpose') }}
							{{ Form::text('purpose',null,array('name'=>'purpose','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('purpose')}}</p>   
						</div>
						
						
						<div class="form-group">
							{{ Form::label('remarks', 'Remarks') }}
							{{ Form::text('remarks',null,array('name'=>'remarks','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('remarks')}}</p>   
						</div>
						
							{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("visits/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}	
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop

