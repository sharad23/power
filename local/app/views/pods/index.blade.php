
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Pods
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pods</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("pods/create", 'Create Pods') }}
                </div>
                <div class="box-body">			
						
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Id</th>
						<th>Pod</th>
						<th>Schedule Type</th>
						<th>Group</th>
						<th>Timespan</th>
						<th>Action</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($pods as $pod)
							<tr>
								<td>{{$i}}</td>
								<td>{{$pod->apiPod->pod}}</td>
								<td>{{{ ($pod->schedule_type==0) ? 'Group Schedule': 'Exception Schedule' }}}</td>
								<td>
									@if($pod->schedule_type == 0)
										@foreach($pod->groupSchedules as $group_schedule)
											@if(is_object($group_schedule->group))
												{{ HTML::link("groups/$group_schedule->group_id",'Group-'.$group_schedule->group->name)}}											
											@endif									
										@endforeach
									@endif
								</td>
								<td>
									@if($pod->schedule_type == 1)
										@foreach($pod->expSchedules as  $exp_schedule)
											{{$exp_schedule->timespan}}
										@endforeach					
									@endif
								</td>
								<td>
									{{ HTML::link("pods/$pod->id/edit/", 'Edit',array('class'=>'btn btn-primary pull-left','role'=>'button')) }}
									{{ Form::open(array('url'=>"pods/$pod->id",'method' => 'delete')) }}	
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

