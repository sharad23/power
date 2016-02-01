<?php
		
		class UserEventSubscriber {
 
			  /**
			   * When a user is created
			   */
			  public function onCreate($event)
			  {
			    //

			      return "Test Exceuted";
			  }
			 
			  /**
			   * When a user is updated
			   */
			  public function onUpdate($event)
			  {
			    //
			  }
			 
			  /**
			   * Register the listeners for the subscriber.
			   *
			   * @param  Illuminate\Events\Dispatcher  $events
			   * @return array
			   */
			  public function subscribe($events)
			  {
			    $events->listen('user.create', 'UserEventSubscriber@onCreate');
			 
			    $events->listen('user.update', 'UserEventSubscriber@onUpdate');
			  }
 
        }

?>