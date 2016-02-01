<!DOCTYPE html>
<html lang="en">
  <head>
  
		<title>Power</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Favicon -->
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		
		
		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}
		{{ HTML::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}
		{{ HTML::style('packages/dist/css/AdminLTE.min.css') }}
		{{ HTML::style('packages/dist/css/skins/_all-skins.min.css') }}
		{{ HTML::style('packages/plugins/iCheck/flat/blue.css') }}
		{{ HTML::style('packages/plugins/morris/morris.css') }}		
		{{ HTML::style('packages/plugins/datatables/dataTables.bootstrap.css') }}
		
		{{ HTML::style('packages/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
		{{ HTML::style('packages/plugins/datepicker/datepicker3.css') }}		
		{{ HTML::style('packages/plugins/daterangepicker/daterangepicker-bs3.css') }}
		{{ HTML::style('packages/plugins/timepicker/bootstrap-timepicker.min.css') }}
		{{ HTML::style('packages/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
		
				
	
		<style>
		td{			
			max-width: 200px !important;
			}
		</style>
	</head>
	
	
</head>
 <body class="hold-transition skin-blue sidebar-mini" data-url="<?php echo URL::to('/'); ?>">
 
 
	@if(!Request::is('login'))
	    @include('layouts.main_body')
	@else
		@yield('content')
	@endif
	
	
		{{ HTML::script('packages/plugins/jQuery/jQuery-2.1.4.min.js') }}
		{{ HTML::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') }}
		<script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script>
		{{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
		{{ HTML::script('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js') }}
		{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}
		{{--{{ HTML::script('packages/plugins/morris/morris.min.js') }}--}}
		{{ HTML::script('packages/plugins/sparkline/jquery.sparkline.min.js') }}
		{{ HTML::script('packages/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
		{{ HTML::script('packages/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}		
		
		{{ HTML::script('packages/plugins/datatables/jquery.dataTables.min.js') }}
		{{ HTML::script('packages/plugins/datatables/dataTables.bootstrap.min.js') }}
		
		
		{{ HTML::script('packages/plugins/knob/jquery.knob.js') }}
		{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}
		{{ HTML::script('packages/plugins/daterangepicker/daterangepicker.js') }}
		{{ HTML::script('packages/plugins/timepicker/bootstrap-timepicker.min.js') }}
		{{ HTML::script('packages/plugins/datepicker/bootstrap-datepicker.js') }}
		{{ HTML::script('packages/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
		{{ HTML::script('packages/plugins/slimScroll/jquery.slimscroll.min.js') }}
		{{ HTML::script('packages/plugins/fastclick/fastclick.min.js') }}
		{{ HTML::script('packages/dist/js/app.min.js') }}
		{{--{{ HTML::script('packages/dist/js/pages/dashboard.js') }}--}}
		{{ HTML::script('packages/dist/js/demo.js') }}
		
		<script>		
      	
        //Timepicker
        $(".timepicker").timepicker({
			
			showInputs: false,
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false,
			//defaultTime: 'value'
        });
		 $(".timepicker1").timepicker({
			
			showInputs: false,
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false,
			//defaultTime: 'value'
        });
		//Datepicker
		//Date range picker
        $('.datepicker').datepicker({
		format:"yyyy-mm-dd"
		});
		
		 $('#datetimepicker1').datepicker({
		  viewMode: 'years',
		  format:"yyyy-mm-dd"
		});
		
		 $('#datetimepicker2').datepicker({
		  viewMode: 'years',
		  format:"yyyy-mm-dd"
		});
		
    </script>
	
	
		
		 <script>
$(function () {	

			var id;
			$('.box-header h4 a input[type=checkbox]').on('click', function(e){
				e.stopPropagation();
				$(this).parent().trigger('click');				
				
				/*id=$(this).parent().attr('href');			
				id = id.replace('-install','');
				
				$(id).on('show.bs.collapse', function(e){
					if( ! $('.box-header h4 a input[type=checkbox]').is(':checked') )
					{
						return false;
					}
				});	*/
			});
			
			
			$(".battery-install").on('click',function(){
					id=$(this).attr('href');			
					id = id.replace('-install','');
					$(id).on('show.bs.collapse', function(e){
						if( ! $('.box-header h4 a input[type=checkbox]').is(':checked') )
						{
							return false;
						}
					});	
				
			});

			
		
		  
			/*var battery=$(".box-info h4 a").attr("href"); 
		 
			$('.box-header h4 a input[type=checkbox]').on('click', function(e){
				e.stopPropagation();
				$(this).parent().trigger('click');
			});*/
			
			var hidden_val = 0;
			$('.addbattery').click(function(){
				$( "#battery_detail" ).clone().removeAttr("id")
						.find("input:hidden").val(hidden_val).end()
						.find("input:text").val("").end()
						//.prepend( $('<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>'))
						.appendTo("#additionalbattery");
						
				if( $(".battery_detail").length > 1){
							$('.battery_detail >.removeButton').show();
					}else {
						$('.battery_detail >.removeButton').hide();
					 }
					
			});
			if( $(".battery_detail").length > 1){
					$('.battery_detail >.removeButton').show();
			}else {
				$('.battery_detail >.removeButton').hide();
			 }
				
			
			
			 $("body").on('click',".removeButton", function() {
				$(this).closest(".battery_detail").remove();
								
				if( $(".battery_detail >.removeButton").length < 2){
				   $(".battery_detail >.removeButton").hide()
				} 
				
			});
			
			
			$('.addups').click(function(){
				$( "#ups_detail" ).clone().removeAttr("id")
						.find("input:hidden").val(hidden_val).end()
						.find("input:text").val("").end()
						//.prepend( $('<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>'))
						.appendTo("#additionalups");
						
				if( $(".ups_detail").length > 1){
					$('.ups_detail >.removeButton').show();
				}else {
					$('.ups_detail >.removeButton').hide();
				}
								
			});
			
			if( $(".ups_detail").length > 1){
				$('.ups_detail >.removeButton').show();
			}else {
				$('.ups_detail >.removeButton').hide();
			}
			
			 $("body").on('click',".removeButton", function() {
				$(this).closest(".ups_detail").remove();
				
				if( $(".ups_detail >.removeButton").length < 2){
				   $(".ups_detail >.removeButton").hide()
				} 
				
				
			});
			
			$('.addcord').click(function(){
				$( "#cord_detail" ).clone().removeAttr("id")
						.find("input:hidden").val(hidden_val).end()
						.find("input:text").val("").end()
						//.prepend( $('<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>'))
						.appendTo("#additionalcord");
						
				if( $(".cord_detail").length > 1){
					$('.cord_detail >.removeButton').show();
				}else {
					$('.cord_detail >.removeButton').hide();
				 }
			});
			
			if( $(".cord_detail").length > 1){
				$('.cord_detail >.removeButton').show();
			}else {
				$('.cord_detail >.removeButton').hide();
			 }
				 
				 
			 $("body").on('click',".removeButton", function() {
				$(this).closest(".cord_detail").remove();
				
				if( $(".cord_detail >.removeButton").length < 2){
				   $(".cord_detail >.removeButton").hide()
				} 
				
			});
			
			
			
			
			
			$('.addcharger').click(function(){
				$( "#charger_detail" ).clone().removeAttr("id")
						.find("input:hidden").val(hidden_val).end()
						.find("input:text").val("").end()
						//.prepend( $('<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>'))
						.appendTo("#additionalcharger");
						
				if( $(".charger_detail").length > 1){
					$('.charger_detail >.removeButton').show();
				}else {
					$('.charger_detail >.removeButton').hide();
				 }
				
			});
			
			if( $(".charger_detail").length > 1){
					$('.charger_detail >.removeButton').show();
				}else {
					$('.charger_detail >.removeButton').hide();
				 }
			
			 $("body").on('click',".removeButton", function() {
				$(this).closest(".charger_detail").remove();
				
				if( $(".charger_detail >.removeButton").length < 2){
				   $(".charger_detail >.removeButton").hide()
				} 
			});
			
			$('body').on('focus',".datepicker_recurring_start", function(){
				$(this).datepicker({
				  format:"yyyy-mm-dd"
				});
			});
			
			
			/*jQuery(function($){
				$(".add").click(function() {
					$("#select").clone()
						.removeAttr("id")
						.append( $('<a class="delete" href="#">Remove</a>') )
						.appendTo("#additionalselects");
				});
				$("body").on('click',".delete", function() {
					$(this).closest(".input").remove();
				});
			});*/
			
			$('#example1').DataTable({
			  "pageLength": 50
			});
			$('#example2').DataTable();
			
			
			
		

	$("#podoff_notification").click(function(e){
			e.preventDefault();
			var baseurl = $('body').attr('data-url');
			var current_user = "<?php if(Auth::user()){echo Auth::user()->staff_user_id;} ?>";
			fullurl=baseurl+'/pod-off-notification/'+current_user,
			
            $.ajax({
					url:fullurl,
					//data: 'id='+current_user,
					type: "GET",
					success: function(data){
						$("#sharad_off").html("0");
					}
				});
		});
		
		$("#podon_notification").click(function(e){
			e.preventDefault();
				var baseurl = $('body').attr('data-url');
			var current_user = "<?php if(Auth::user()){echo Auth::user()->staff_user_id;} ?>";
            $.ajax({
					url:"http://devtest.websurfer.com.np/webpower/power/pod-on-notification/"+current_user,
					//data: 'id='+current_user,
					type: "GET",
					success: function(data){
						$("#sharad_on").html("0");
						
					}
				});
		});

});
			
		
		</script>
 
</body>
</html>