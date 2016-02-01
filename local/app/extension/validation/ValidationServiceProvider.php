<?php 

    namespace App\Extension\Validation;
    use Illuminate\Support\ServiceProvider as SharadProv;
 
	class ValidationServiceProvider extends SharadProv {
	 
	  public function register(){

	  	   //this function must be included
	  }
	 
	  public function boot()
		  {
			    $this->app->validator->resolver(function($translator, $data, $rules, $messages)
				    {
				      return new CustomValidator($translator, $data, $rules, $messages);
				    
				    });
		  }
	 
	}