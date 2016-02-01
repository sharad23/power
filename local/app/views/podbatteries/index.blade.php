
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Pod Battery
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pod Battery</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("pod_batteries/create", 'Create Pods Battery') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Installed Date</th>
						<th>Capacity</th>
						<th>Pod Inventory</th>
						<th>Brand</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($podbatteries as $podbattery)
							@if($podbattery->podInventory)
								@if($podbattery->podInventory->pod)
								<tr>
									<td>{{$i}}</td>
									<td>{{$podbattery->installed_date}}</td>
									<td>{{$podbattery->capacity}}</td>
									<td>
										@if(is_object($podbattery->podInventory))
											@if(is_object($podbattery->podInventory->pod))
												{{$podbattery->podInventory->pod->apiPod->pod }}
											@endif
										@endif
									</td>
									<td>{{$podbattery->brand}}</td>
									<td>
										{{ HTML::link("pod_batteries/$podbattery->id/edit", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
										{{ Form::open(array('url'=>"pod_batteries/$podbattery->id",'method' => 'delete')) }}	
											{{ Form::submit('Delete',array('class'=>'btn btn-primary pull-left'))}}	
										{{ Form::close() }}
									</td>				
								</tr>							
								<?php $i++;?>
								@endif
							@endif
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

