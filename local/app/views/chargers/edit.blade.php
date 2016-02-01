
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Charger
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pod_chargers')}}"> Charger</a></li>
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
					{{ Form::model($charger,array('url' => "pod_chargers/$charger->id", 'method' => 'put','id' =>'test')) }}
						<div class="form-group">
							{{ Form::label('pod_api_id', 'Pod') }}
							{{ Form::select('pod_inventory_id',array(null=>'Please Select')+PodInventory::get()->lists('apiPodName', 'id'),null,array('name'=>'pod_inventory_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('pod_inventory_id')}}</p>
						</div>
						
						 <div class="form-group">
							{{ Form::label('brand', 'Brand') }}
							{{ Form::text('brand',null,array('name'=>'brand','class'=>'form-control'))}}
							<p class="errors">{{$errors->first('brand')}}</p>
						</div>
						
						<div class="form-group">
						{{ Form::label('installed_date', 'Install Date') }}
							<div class='input-group date' id='datetimepicker1'>
								{{ Form::text('installed_date',null,array('name'=>'installed_date','class'=>'form-control')) }}
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<p class="errors">{{$errors->first('installed_date')}}</p> 
						</div>
						
							{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("cords/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop
