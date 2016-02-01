
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
					<h3 class="box-title">Create</h3>
                </div>
                <div class="box-body">

					 {{ Form::open(array('url' => "pods", 'method' => 'post','id' =>'test')) }}
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
							{{ Form::select('group_id',array(null=>'Please Select')+ Group::orderBy('name')->lists('name', 'id'),null,array('name'=>'group_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('group_id')}}</p>
						</div>
							
					   <div class="form-group">
							 {{ Form::label('timespan', 'Timespan') }}
							{{ Form::text('timespan',null,array('name'=>'timespan','class'=>'form-control')) }}
							 <p class="errors">{{$errors->first('day')}}</p>   
						</div>
						
							{{ Form::submit('Create',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("pods/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop

