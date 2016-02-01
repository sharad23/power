
@extends('layouts.main')
@section('content')
		
        <section class="content-header">
         <h1> Groups </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Groups</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("groups/create", 'Create Group') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Name</th>
						<th>Created Date</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($groups as $group)
						<tr>
							<td>{{ $i }}</td>
							<td>{{  HTML::link("groups/$group->id",'Group-'.$group->name)}}</td>
							<td>{{ $group->created_at->format('M j, Y h:i:s A') }}</td>						
							<td>
								{{ HTML::link("groups/$group->id/edit/", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
								{{ Form::open(array('url'=>"groups/$group->id",'method' => 'delete')) }}	
									{{ Form::submit('Delete',array('class'=>'btn btn-primary pull-left'))}}	
								{{ Form::close() }}
							</td>
						</tr>
						<?php $i++; ?>
						@endforeach						
					</tbody>
					</table>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<!--
					
						<table id="example2" class="table table-bordered table-hover table-striped">
						<thead>
							<th>Id</th>
							<th>Name</th>
							<th>Created Date</th>
							<th>Updated Date</th>
							<th>Action</th>
						</thead> 
						<tbody>
						<?php $i =1; ?>
							@foreach($groups as $group)
						<tr>
							<td>{{ $i }}</td>
							<td>{{  HTML::link("groups/$group->id",'Group-'.$group->name)}}</td>
							<td>{{ $group->created_at->format('M j, Y h:i:s A') }}</td>
							<td>{{ $group->updated_at->format('F j, Y h:i:s A') }}</td>							
							<td>
								{{ HTML::link("groups/$group->id/edit/", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
								{{ Form::open(array('url'=>"groups/$group->id",'method' => 'delete')) }}	
									{{ Form::submit('Delete',array('class'=>'btn btn-primary pull-left'))}}	
								{{ Form::close() }}
							</td>
						<tr>
						<?php $i++; ?>
						@endforeach
						</tbody>
						</table>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
