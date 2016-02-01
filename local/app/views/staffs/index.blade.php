
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Staffs
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Staffs</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("staffs/create", 'Create Staffs') }}
                </div>
                <div class="box-body">			
						
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>username</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($staffs as $staff)
							<tr>
								<td>{{$i}}</td>
								<td>{{$staff->username}}</td>
								
								<td>
									{{ HTML::link("staffs/$staff->id/edit/", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
									{{ Form::open(array('url'=>"staffs/$staff->id",'method' => 'delete')) }}	
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

