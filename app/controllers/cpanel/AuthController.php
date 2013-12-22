<?php
namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;
use \Hash;
use \Session;


class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	function getHashedString($string)
	{
		return md5($string);
	}

	public function postAuth()
	{
		$email = Input::get('email');
		$password =  $this->getHashedString(Input::get('password'));
		$data = Input::all();
		$rules = array(
        	'email' => array('required', 'min:3'),
        	'password' => array('required', 'min:3')

	    );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$admin = AdminAuth::where('email', '=', $email)->where('password', '=', $password)->first();

			if(!empty($admin))
			{
				$admin = $admin->toArray();
				// Put data in laravel session
				Session::put('id', $admin['id']);
				Session::put('email', $admin['email']);

				$resp = array('status'=>'success','msg'=>'Record exists','data'=>$admin);
			}
			else
			{
				$resp = array('status'=>'error','msg'=>'Record not exist','data'=>'');
			}
		}
		else
		{
			$resp = array('status'=>'error','msg'=>'Please fill all the fields','data'=>'');
		}

		echo json_encode($resp);
	}

}