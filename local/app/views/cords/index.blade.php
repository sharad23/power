
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Cord
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cord</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("cords/create", 'Create Cord') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Name</th>
						<th>Pod Inventory</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($cords as $cord)
								<tr>
									<td>{{$i}}</td>
									<td>{{$cord->name}}</td>
									<td>
									@if(is_object($cord->podInventory))
										@if(is_object($cord->podInventory->pod))
											{{$cord->podInventory->pod->apiPod->pod }}
										@endif
									@endif
									</td>
									<td>
										{{ HTML::link("cords/$cord->id/edit", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
										{{ Form::open(array('url'=>"cords/$cord->id",'method' => 'delete')) }}	
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

