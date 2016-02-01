<?php 

 namespace App\Extension\Validation;
 class CustomValidator extends \Illuminate\Validation\Validator {
      
      private $_custom_messages = array(
		"my_time" => "The :attribute should be in 24 hours format",
		"my_ip" => "The :attribute should be in IPV4 format"
		
	  );
	  public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
		parent::__construct( $translator, $data, $rules, $messages, $customAttributes );

		$this->_set_custom_stuff();
	  }

	  protected function _set_custom_stuff() {
		//setup our custom error messages
		$this->setCustomMessages( $this->_custom_messages );
	  }
	  public function validateMyTime($attribute, $value, $parameters)
		  {
		    if(preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $value))
			    {
			      return true;
			    }
		   
		    return false;
		  }
      
       public function validateMyIp($attribute, $value, $parameters)
		  {
		    if(preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $value))
			    {
			      return true;
			    }
		   
		    return false;
		  }
	  


}