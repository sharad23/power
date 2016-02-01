
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Pod Ups
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
                 {{ HTML::link("pod_ups/create", 'Create Pods Ups') }}
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
						@foreach($podups as $podup)
							@if($podup->podInventory)
								@if($podup->podInventory->pod)
								<tr>
									<td>{{$i}}</td>
									<td>{{$podup->installed_date}}</td>
									<td>{{$podup->capacity}}</td>
									<td>
									@if(is_object($podup->podInventory))
										@if(is_object($podup->podInventory->pod))
											{{$podup->podInventory->pod->apiPod->pod }}
										@endif
									@endif
									</td>
									<td>{{$podup->brand}}</td>
									<td>
										{{ HTML::link("pod_ups/$podup->id/edit", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
										{{ Form::open(array('url'=>"pod_ups/$podup->id",'method' => 'delete')) }}	
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
