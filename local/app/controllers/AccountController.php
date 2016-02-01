<?php
		
		class AccountController extends BaseController {
			 
			
			public function login() {
				
				$data = Input::all();
				$rules = array(
					'staff_username' => 'required|min:2',
					'staff_password' => 'required|min:6',
				);
					 
				$messages = array(
					'required' => 'please enter :attribute'
				);
					
				$validator = Validator::make($data, $rules, $messages);
			    if($validator->fails()){
				
					Session::flash('error', 'Login Failed'); 
				    return Redirect::to('/login')->withInput(Input::except('staff_password'))->withErrors($validator);
				}
				else {
								 
					 $credentials = Input::only('staff_username');
					 $credentials['password'] =Input::get('staff_password');
		             if(Auth::attempt($credentials)) {
						
							/*echo '<pre>';
							print_r(Auth::user());
							echo '</pre>';die;*/
							//Notification::where('user_id','=',Auth::user()->staff_user_id);die;
					        return Redirect::to('/')->with('success', 'You are now logged in.');
					 } 
					 else 
					 {
							return Redirect::to('/login')->withErrors(array('password' => 'Password invalid'))->withInput(Input::except('password'));
					 }
						
				}
			}
			  
			public function logout() {
				  
				  Auth::logout();
				  return Redirect::to('/login'); 
			
			}
			
		}