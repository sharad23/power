
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Pod Inventory
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pod_inventories')}}"> Pod Inventory</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Edit</h3>
					<a href="{{URL::to('/add-pod-battery/'.$podinventory->id)}}" class="btn btn-primary "><b>Edit Battery</b></a>
					<a href="{{URL::to('/add-pod-ups/'.$podinventory->id)}}" class="btn btn-primary "><b>Edit Ups</b></a>
					<a href="{{URL::to('/add-cord/'.$podinventory->id)}}" class="btn btn-primary "><b>Edit Cord</b></a>
					<a href="{{URL::to('/add-charger/'.$podinventory->id)}}" class="btn btn-primary "><b>Edit Charger</b></a>
                </div>
                <div class="box-body">
					{{ Form::model($podinventory,array('url' => "pod_inventories/$podinventory->id", 'method' => 'put','id' =>'test')) }}
						<div class="form-group">
							{{ Form::label('pod_api_id', 'Pod') }}
							{{ Form::select('pod_api_id',array(null=>'Please Select')+Pod::with('apiPod')->get()->lists('apiPodName', 'id'),null,array('name'=>'pod_api_id','class'=>'form-control')) }}
						<p class="errors">{{$errors->first('pod_api_id')}}</p>
						</div>
						
					   <div class="form-group">
							{{ Form::label('submeter', 'Submeter') }}
							<!--{{ Form::select('submeter',array(null=>'Please Select','1' => 'On', '0' => 'Off'),null,array('name'=>'submeter','class'=>'form-control')) }} -->
							<p>{{ Form::radio('submeter', 1) }} Yes </p>
							<p>{{ Form::radio('submeter', 0) }}  No </p>
							<p class="errors">{{$errors->first('submeter')}}</p>
						</div>

						<div class="form-group">
							{{ Form::label('earthing', 'Earthing') }}
							<!--{{ Form::select('earthing',array(null=>'Please Select','1' => 'Yes', '0' => 'No'),null,array('name'=>'earthing','class'=>'form-control')) }}-->
							<p>{{ Form::radio('earthing', 1, $podinventory->earthing == 1) }} Yes </p>
							<p>{{ Form::radio('earthing', 0, $podinventory->earthing == 0) }}  No </p>
							<p class="errors">{{$errors->first('earthing')}}</p>
						</div>
							
					   <div class="form-group">
							{{ Form::label('alternative_source', 'Alternative Source') }}
							<!--{{ Form::select('alternative_source',array(null=>'Please Select','1' => 'Yes', '0' => 'No'),null,array('name'=>'alternative_source','class'=>'form-control')) }}-->
							<p>{{ Form::radio('alternative_source', 1) }} Yes </p>
							<p>{{ Form::radio('alternative_source', 0) }}  No </p>
							<p class="errors">{{$errors->first('alternative_source')}}</p>   
						</div>
						
						 <div class="form-group">
							{{ Form::label('rack', 'Rack') }}
							<!--{{ Form::select('rack',array(null=>'Please Select','1' => 'Yes', '0' => 'No'),null,array('name'=>'rack','class'=>'form-control')) }} -->
							<p>{{ Form::radio('rack', 1) }} Yes </p>
							<p>{{ Form::radio('rack', 0) }}  No </p>
							<p class="errors">{{$errors->first('rack')}}</p>   
						</div>
						
						
						 <div class="form-group">
							{{ Form::label('power_router_ip', 'Power Router Ip') }}
							{{ Form::text('power_router_ip',null,array('name'=>'power_router_ip','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('power_router_ip')}}</p>   
						</div>
						
							{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("pod_inventories/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop
