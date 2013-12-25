<?php

namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;


class ProjectController extends BaseController {

	public function postProject()
	{
		$project_title 		= Input::get('project_title');
		$description 		= Input::get('description');
		$date_added 		= date("Y-m-d h-i-s");
		$is_featured 		= Input::get('is_featured');
		$status 			= Input::get('status');
		$client_id			= Input::get('client_id');
		$live_url 			= Input::get('live_url');
		$cat_id 			= Input::get('cat_id');
		$services_offered 	= Input::get('services_offered');


		$data = Input::all();
		$rules = array(
	        'project_title' 	=> array('required'),
	        'description' 		=> array('required'),
	        'is_featured' 		=> array('required'),
			'status' 			=> array('required'),
			'client_id'			=> array('required'),
			'live_url' 			=> array('required'),
			'cat_id' 			=> array('required'),
			'services_offered' 	=> array('required')
	  	 );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$project = Project::where('project_title','=',$project_title)->where('description','=',$description)->where('is_featured','=',$is_featured)->where('status','=',$status)->where('client_id','=',$client_id)->where('live_url','=',$live_url)->where('services_offered','=',$services_offered)->where('cat_id','=',$cat_id)->count();
			//var_dump($project);
			if($project > 0)
			{
				$status1 = 'error';
				$msg = 'project already exists';
			}
			else 
			{
				$project = Project::create(array('project_title' => $project_title,'description' => $description,'is_featured' => $is_featured,'status' => $status,'date_added' => $date_added,'client_id' => $client_id,'live_url' => $live_url,'services_offered' => $services_offered,'cat_id' => $cat_id));
				$msg = 'record inserted successfully';
				$status1 = 'success';	
			}

			//var_dump($project);
		}
		else
		{
			$status1 = 'error';
			$msg = 'Please fill all the fields!';
		}
		return json_encode(array('status' => $status1, 'msg' => $msg));
	}

	public function putProject()
	{
		$status1 = 'error';
		$msg = 'record not found';

		$id = Input::get('id');
		$project_title 		= Input::get('project_title');
		$description 		= Input::get('description');
		$date_added 		= date("Y-m-d h-i-s");
		$is_featured 		= Input::get('is_featured');
		$status 			= Input::get('status');
		$client_id			= Input::get('client_id');
		$live_url 			= Input::get('live_url');
		$cat_id 			= Input::get('cat_id');
		$services_offered 	= Input::get('services_offered');

		$data = Input::all();
		$rules = array(
			'id' 				=> array('required'),
	        'project_title' 	=> array('required'),
	        'description' 		=> array('required'),
	        'is_featured' 		=> array('required'),
			'status' 			=> array('required'),
			'client_id'			=> array('required'),
			'live_url' 			=> array('required'),
			'cat_id' 			=> array('required'),
			'services_offered' 	=> array('required')

	  	 );

		$validator = Validator::make($data,$rules);
		if ($validator->passes())
		{

			$project = Project::where('id','=',$id)->count();
			//var_dump($project);
			if($project > 0)
			{
				$project = Project::find($id);
					$project->project_title = $project_title;
					$project->description = $description;
					$project->date_added = $date_added;
					$project->is_featured = $is_featured;
					$project->client_id = $client_id;
					$project->live_url =$live_url;
					$project->cat_id = $cat_id;
					$project->services_offered =$services_offered;
					$project->status = $status;
					$project->save();

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

	public function deleteProject()
	{
		$id = Input::get('id');
		$status = 'error';

		$project = Project::where('id','=',$id)->count();
		if($project > 0)
		{
			$project = Project::where('id','=',$id)->delete();
			$status = 'success';
		}
		return json_encode(array('status' => $status));
	}

	public function getProject()
	{
		$id = Input::get('id');

		if(!empty($id))
		{
			$project = Project::where('id','=',$id)->get();
			$project = $project->toArray();
			//var_dump($project);
		}
		else
		{
			$project = Project::take(10)->skip(0)->get();
			$project = $project->toArray();
			//var_dump($project->toArray());
		}
		if(!empty($project))
		{
			return json_encode($project);
		}
		else
		{
			return json_encode('record not found');
		}

	}
}

?>
