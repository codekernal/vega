<?php

namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;


class ClientController extends BaseController {

	public function postClient()
	{
		$client_name = Input::get('client_name');
		$image_path = Input::get('image_path');
		$web_url = Input::get('web_url');
		$status = Input::get('status');


		$data = Input::all();
		$rules = array(
	        'client_name' => array('required'),
	        'image_path' => array('required'),
	        'web_url' => array('required'),
	        'status' => array('required')
	  	 );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$client = Client::where('client_name','=',$client_name)->where('image_path','=',$image_path)->where('web_url','=',$web_url)->where('status','=',$status)->count();
			//var_dump($client);
			if($client > 0)
			{
				$status1 = 'error';
				$msg = 'category already exists';
			}
			else 
			{
				$client = Client::create(array('client_name' => $client_name,'image_path' => $image_path,'web_url' => $web_url,'status' => $status));
				$msg = 'record inserted successfully';
				$status1 = 'success';	
			}

			//var_dump($client);
		}
		else
		{
			$status1 = 'error';
			$msg = 'Please fill all the fields!';
		}
		return json_encode(array('status' => $status1, 'msg' => $msg));
	}

	public function putClient()
	{
		$status1 = 'error';
		$msg = 'record not found';

		$id = Input::get('id');
		$client_name = Input::get('client_name');
		$image_path = Input::get('image_path');
		$web_url = Input::get('web_url');
		$status = Input::get('status');

		$data = Input::all();
		$rules = array(
			'id' => array('required'),
	        'client_name' => array('required'),
	        'image_path' => array('required'),
	        'web_url' => array('required'),
	        'status' => array('required')

	  	 );

		$validator = Validator::make($data,$rules);
		if ($validator->passes())
		{

			$client = Client::where('id','=',$id)->count();
			//var_dump($client);
			if($client > 0)
			{
				$client = Client::find($id);
					$client->client_name = $client_name;
					$client->image_path = $image_path;
					$client->web_url = $web_url;
					$client->status = $status;
					$client->save();

					$status1 = 'success';
					$msg = 'record updated successfilly';
			}
		}
		else
		{
			$status1 = 'error';
			$msg = 'Please fill all the fields!';
		}
		
			return json_encode(array('status' => $status1,'msg' => $msg));

	}

	public function deleteClient()
	{
		$id = Input::get('id');
		$status = 'error';

		$client = Client::where('id','=',$id)->count();
		if($client > 0)
		{
			$client = Client::where('id','=',$id)->delete();
			$status = 'success';
		}
		return json_encode(array('status' => $status));
	}

	public function getClient()
	{
		$id = Input::get('id');

		if(!empty($id))
		{
			$client = Client::where('id','=',$id)->get();
			$client = $client->toArray();
			//var_dump($client);
		}
		else
		{
			$client = Client::get();
			$client = $client->toArray();
			//var_dump($client->toArray());
		}
		if(!empty($client))
		{
			return json_encode($client);
		}
		else
		{
			return json_encode('record not found');
		}

	}
}

?>
