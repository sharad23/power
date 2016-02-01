
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Charger
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Charger</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("pod_chargers/create", 'Create Charger') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Installed Date</th>
						<th>Pod Inventory</th>
						<th>Brand</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($chargers as $charger)
								<tr>
									<td>{{$i}}</td>
									<td>{{$charger->installed_date}}</td>
									<td>
									@if(is_object($charger->podInventory))
										@if(is_object($charger->podInventory->pod))
											{{$charger->podInventory->pod->apiPod->pod }}
										@endif
									@endif
									</td>																	
									<td>{{$charger->brand}}</td>
									<td>
										{{ HTML::link("pod_chargers/$charger->id/edit", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
										{{ Form::open(array('url'=>"pod_chargers/$charger->id",'method' => 'delete')) }}	
											{{ Form::submit('Delete',array('class'=>'btn btn-primary pull-left'))}}	
										{{ Form::close() }}
									</td>				
								</tr>							
								<?php $i++;?>
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

