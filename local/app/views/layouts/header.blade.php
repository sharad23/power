<style>
.slimScrollDiv{
	height:auto !important;
    max-height: 200px !important;
}
ul.menu{	
	height: auto !important;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4{
	margin:0 !important;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4>small{
	font-size:12px !important;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>p{
	margin:0 !important;
}
</style>


<header class="main-header">
    <a href="index2.html" class="logo">
        <span class="logo-mini"><b>POWER</b></span>
          <span class="logo-lg"><b>POWER</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			<?php 
			
			
			
			
			$pod_down_notifications=Notification::where('user_id','=',Auth::user()->staff_user_id)
													   ->orderBy('created_at', 'DESC')
                             ->get();
		
			$pod_down_unseen=Notification::where('user_id','=',Auth::user()->staff_user_id)
													   ->where('notification_status','=',0)
													   ->count();
      
			

			$pod_up_notifications=PodUpNotification::where('user_id','=',Auth::user()->staff_user_id)
													->orderBy('created_at', 'DESC')
													->get();
													
			$pod_up_unseen=PodUpNotification::where('user_id','=',Auth::user()->staff_user_id)
													->where('notification_status','=',0)
                          ->count();
      
			
			
				
			?>
              <li class="dropdown messages-menu">
                <a href="#" id="podoff_notification" class="dropdown-toggle " data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span id="sharad_off" class="label label-danger">{{ $pod_down_unseen }}</span>
                </a>
			
                <ul class="dropdown-menu">
                  <li class="header"></li>
                  <li>
                    <ul class="menu">
					@foreach($pod_down_notifications as $notification)
                      <li>
                        <a href="#">
                          <h4>
                            {{ $notification->pod->apiPod->pod }}
                            <small><i class="fa fa-clock-o"></i>{{ $notification->created_at->format('M j, Y h:i:s A') }} </small>
                          </h4>
                          <p>{{ $notification->descriptions }}</p>
						  @if($notification->notification_status==1)
						  <small><i class="fa fa-eye"></i>seen</small>
						  @endif
                        </a>
                      </li>
          @endforeach
                    </ul>
                  </li>
                  <li class="footer">{{ HTML::link('/all-pod-off-notification', 'View all') }}</li>
                </ul>
				
              </li>
              <li class="dropdown messages-menu">
                <a href="#" id="podon_notification" class="dropdown-toggle " data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span id="sharad_on" class="label label-success">{{ $pod_up_unseen }}</span>
                </a>
			
                <ul class="dropdown-menu">
                  <li class="header"></li>
                  <li>
                    <ul class="menu">
					@foreach($pod_up_notifications as $notification)
                      <li>
                        <a href="#">
                          <h4>
                            {{ $notification->pod->apiPod->pod }}
                            <small><i class="fa fa-clock-o"></i>{{ $notification->created_at->format('M j, Y h:i:s A') }} </small>
                          </h4>
                          <p>{{ $notification->descriptions }}</p>
						  
						   @if($notification->notification_status==1)
						  <small><i class="fa fa-eye"></i>seen</small>
						  @endif
                        </a>
                      </li>
					@endforeach 
                    </ul>
                  </li>
                  <li class="footer">{{ HTML::link('/all-pod-on-notification', 'View all') }}</li>
                </ul>
		
              </li>
           
			  
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{URL::to('/').'/packages/dist/img/profile_pic.jpg'}}" class="user-image" alt="User Image">
					<span class="hidden-xs">  
						@if(Auth::check())
							{{Auth::user()->staff_username}}
						@endif
					</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="{{URL::to('/').'/packages/dist/img/profile_pic.jpg';}}" class="img-circle" alt="User Image">
                    <p>
						@if(Auth::check())
							{{Auth::user()->staff_username}}
						@endif
                    </p>
                  </li>
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{URL::to('/');}}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{URL::to('/logout');}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
    </header>
	  
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{URL::to('/').'/packages/dist/img/profile_pic.jpg';}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>
					
						@if(Auth::check())
							{{Auth::user()->staff_username}}
						@endif
					
					
					</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			
            <li>
              <a href="{{URL::to('/');}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>			
						
			<li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Pods</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
					<a href="{{URL::to('/').'/pods';}}">
						<i class="fa fa-table"></i> <span>Pods</span>
					</a>
				</li>
                <li>
					<a href="{{URL::to('/').'/off_pods';}}">
						<i class="fa fa-table"></i> <span>Off Pods</span>
					</a>
				</li>
				<li>
					<a href="{{URL::to('/').'/off_pod_logs';}}">
						<i class="fa fa-table"></i> <span>Off Pods Logs</span>
					</a>
				</li>
				<li>
          <a href="{{URL::to('/pod-off-report') }}">
            <i class="fa fa-table"></i> <span>Off Pods Report</span>
          </a>
        </li>
				<li>
					<a href="{{URL::to('/').'/schedules';}}">
						<i class="fa fa-table"></i> <span>Schedules</span>
					</a>
				</li>
                <li>
					<a href="{{URL::to('/').'/groups';}}">
						<i class="fa fa-table"></i> <span>Groups</span>
					</a>
				</li>
              </ul>
            </li>
			
			 <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Pod Inventory</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li>
				  <a href="{{URL::to('/').'/pod_inventories';}}">
					<i class="fa fa-table"></i> <span>Pod</span>
				  </a>
				</li>
                <li>
					<a href="{{URL::to('/').'/pod_batteries';}}">
					<i class="fa fa-table"></i> <span>Pod Batteries</span>
					</a>
				</li>
				<li>
					<a href="{{URL::to('/').'/pod_ups';}}">
					<i class="fa fa-table"></i> <span>Pod UPS</span>
					</a>
				</li>
				
				<li>
					<a href="{{URL::to('/').'/cords';}}">
					<i class="fa fa-table"></i> <span>Cord</span>
					</a>
				</li>
				
				<li>
					<a href="{{URL::to('/').'/pod_chargers';}}">
					<i class="fa fa-table"></i> <span>Charger</span>
					</a>
				</li>
              </ul>
            </li>
			
			
			<li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Staffs</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li>
				  <a href="{{URL::to('/').'/staffs';}}">
					<i class="fa fa-table"></i> <span>Staffs</span>
				  </a>
				</li>
				<li>
					<a href="{{URL::to('/').'/visits';}}">
					<i class="fa fa-table"></i> <span>Staff Visit</span>
				  </a>
				</li>
                
              </ul>
            </li>
			
			
			
          </ul>
        </section>
      </aside>  
	  
	  
      <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul>
            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul>

          </div>
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div>
			  
              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div>
            </form>
          </div>
        </div>
      </aside>
	

	 