
@extends('layouts.main')
@section('content')


 <section class="content-header">
          <h1>
            Schedules
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/schedules')}}">Schedules</a></li>
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

				{{ Form::model($schedule, array('url' => "schedules/$schedule->id", 'method' => 'put')) }}
				
				
				
						<div class="bootstrap-timepicker">
							<div class="form-group">
								{{ Form::label('from_time', 'From') }}
								<div class="input-group">
								{{ Form::text('from_time',null,array('class'=>'form-control timepicker')) }}
										<div class="input-group-addon">
										  <i class="fa fa-clock-o"></i>
										</div>
								  </div>
								  <p class="errors">{{$errors->first('from_time')}}</p>
							</div>
						</div>
						
						
						<div class="bootstrap-timepicker">
							<div class="form-group">
								{{ Form::label('to_time', 'To') }}
								<div class="input-group">
								{{ Form::text('to_time',null,array('class'=>'form-control timepicker')) }}
										<div class="input-group-addon">
										  <i class="fa fa-clock-o"></i>
										</div>
								  </div>
								  <p class="errors">{{$errors->first('to_time')}}</p>
							</div>
						</div>
						
						
						<div class="form-group">
							{{ Form::label('group_id', 'Group') }}
							{{ Form::select('group_id',array(null=>'Please Select')+ Group::orderBy('name')->lists('name', 'id'),null,array('name'=>'group_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('group_id')}}</p>
						</div>
							
					   <div class="form-group">
							 {{ Form::label('day', 'Day') }}
							 {{ Form::select('day', array(null=>'Please Select','0' => 'Sun', '1' => 'Mon','2' => 'Tue', '3' => 'Wed','4' => 'Thu', '5' => 'Fri', '6' => 'Sat'),null,array('name'=>'day','class'=>'form-control'))}}
							 <p class="errors">{{$errors->first('day')}}</p>   
						</div>
						
							{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
							
					{{ Form::close() }}
					
					{{ Form::open(array('url'=>"schedules/$schedule->id",'method' => 'delete')) }}	
						{{ Form::submit('Delete',array('class'=>'btn btn-primary'))}}	
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>

@stop