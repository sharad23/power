
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Cords
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/chargers')}}"> Cords</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Create/Edit</h3>
					
					<a href="{{URL::to('pod_inventories/'.$pod_inventory->id.'/edit')}}" class="btn btn-primary "><b>Edit Pod</b></a>
					<a href="{{URL::to('/add-pod-battery/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Battery</b></a>
					<a href="{{URL::to('/add-pod-ups/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Ups</b></a>
					<a href="{{URL::to('/add-charger/'.$pod_inventory->id)}}" class="btn btn-primary "><b>Edit Charger</b></a>
                </div>
                <div class="box-body">
					
				{{ Form::open(array('url' =>'add-cord/'.$pod_inventory->id, 'method' => 'post','id' =>'test')) }}
					
					@if(empty($cords))					
						<div id="cord_detail" class="box-body cord_detail">			
						<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>												
						   <div class="form-group">
								{{ Form::label('name', 'Cord Name') }}
								{{ Form::text('name[]',null,array('class'=>'form-control'))}}
								<p class="errors">{{$errors->first('name')}}</p>
							</div>

						{{ Form::hidden('cord_id[]', 0) }}							
						</div>
						
					 
					@else
						@foreach($cords as $cord)
												
						<div id="cord_detail" class="box-body cord_detail">
						{{ Form::hidden('cord_id[]', $cord['id']) }}
						<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>							
						   
						   <div class="form-group">
								{{ Form::label('name', 'Cord Name') }}
								{{ Form::text('name[]',$cord['name'],array('class'=>'form-control'))}}
								<p class="errors">{{$errors->first('name')}}</p>
							</div>

						</div>	
							
						@endforeach
						
					@endif
					<div id="additionalcord"></div>
					<button type="button" class="btn btn-default addcord "><i class="fa fa-plus "></i>Add More</button>
					
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
