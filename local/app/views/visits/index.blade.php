
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
           Visits
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Visits</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("visits/create", 'Create Visit') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Visit Date</th>
						<th>Type</th>
						<th>Purpose</th>
						<th>Status</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($visits as $visit)
							<tr>
								<td>{{$i}}</td>
								<td>{{$visit->visit_date}}</td>
								<td>{{($visit->type==0)?'Regular':'Urgent'}}</td>
								<td>{{$visit->purpose}}</td>
								<td>{{($visit->status==1)?'completed':'Pending'}}</td>
								<td>
									{{ HTML::link("visits/$visit->id", 'View',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}	
									{{ HTML::link("visits/$visit->id/edit", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
									{{ Form::open(array('url'=>"visits/$visit->id",'method' => 'delete')) }}	
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

