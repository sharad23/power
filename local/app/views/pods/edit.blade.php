
@extends('layouts.main')
@section('content')


 <section class="content-header">
          <h1>
            Pods
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pods')}}">Pods</a></li>
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

					{{ Form::model($pod , array('url' => "pods/$pod->id", 'method' => 'put', 'id' =>'test')) }}
						 @if ($pod->schedule_type  == 0)
							<?php
								$schedule_data = $pod->groupSchedules[0]->group_id;
								$exception_data = null;
							?>							
						@elseif ($pod->schedule_type  == 1)
							<?php
								$exception_data = $pod->expSchedules[0]->timespan;
								$schedule_data =  null;
							?>
						@endif
					
						<div class="form-group">
							{{ Form::label('pod_api_id', 'Pod') }}
							{{ Form::select('pod_api_id', array(null=>'Please Select')+$poddata,null,array('name'=>'pod_api_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('pod_api_id')}}</p>
						</div>
						
					   <div class="form-group"> 
							{{ Form::label('schedule_type', 'Schedule Type') }}
							{{ Form::select('schedule_type',array(null=>'Please Select','0' => 'Group Schedule', '1' => 'Exception Schedule'),null,array('name'=>'schedule_type','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('schedule_type')}}</p>
						</div>

						<div class="form-group">
							{{ Form::label('group_id', 'Group') }}
							{{ Form::select('group_id',array(null=>'Please Select')+ Group::orderBy('name')->lists('name', 'id'),$schedule_data,array('name'=>'group_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('group_id')}}</p>
						</div>
							
					   <div class="form-group">
							{{ Form::label('timespan', 'Timespan') }}
							{{ Form::text('timespan',$exception_data,array('name'=>'timespan','class'=>'form-control')) }}
							 <p class="errors">{{$errors->first('day')}}</p>   
						</div>
						
						{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
						{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
						{{ HTML::link("pods/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
							
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>

@stop
