
@extends('layouts.main')
@section('content')
		
        <section class="content-header">
         <h1> Pod on Notification </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pod on Notification</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					All Notifications
                </div>
                <div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
						<thead>
							<th>Id</th>
							<th>Pod</th>
							<th>Description</th>
							<th>Status</th>
							<th>Date</th>
						</thead> 
						<tbody>
						<?php $i =1; ?>
							@foreach($notifications as $notification)
								
								<tr>
									<td>{{$i}}</td>								
									<td>
									{{$notification->pod->apiPod->pod}}
									</td>
									<td>{{ $notification->descriptions }}</td>
									<td>@if($notification->notification_status==1)
										 {{ 'seen' }}
										@else
										{{ 'unseen' }}
										  @endif</td>
									<td>{{$notification->created_at->format('M j, Y h:i:s A')}}</td>
												
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
