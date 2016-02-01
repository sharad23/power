
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Cord
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/cords')}}"> Cord</a></li>
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
					{{ Form::model($cord,array('url' => "cords/$cord->id", 'method' => 'put','id' =>'test')) }}
						<div class="form-group">
							{{ Form::label('pod_api_id', 'Pod') }}
							{{ Form::select('pod_inventory_id',array(null=>'Please Select')+PodInventory::get()->lists('apiPodName', 'id'),null,array('name'=>'pod_inventory_id','class'=>'form-control')) }}
							<p class="errors">{{$errors->first('pod_inventory_id')}}</p>
						</div>
						
					   <div class="form-group">
							{{ Form::label('name', 'Name') }}
							{{ Form::text('name',null,array('name'=>'name','class'=>'form-control'))}}
							<p class="errors">{{$errors->first('brand')}}</p>
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
