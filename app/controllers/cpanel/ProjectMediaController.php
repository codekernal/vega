<?php

namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;


class ProjectMediaController extends BaseController {

	public function postProjectmedia()
	{
		$project_id 	= Input::get('project_id');
		$path 			= Input::get('path');
		$media_type 	= Input::get('media_type');


		$data = Input::all();
		$rules = array(
	        'project_id' 	=> array('required'),
	        'path' 		=> array('required'),
	        'media_type' 		=> array('required')
			
	  	 );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$projectmedia = ProjectMedia::where('project_id','=',$project_id)->where('path','=',$path)->where('media_type','=',$media_type)->count();
			//var_dump($projectmedia);
			if($projectmedia > 0)
			{
				$status1 = 'error';
				$msg = 'project_media already exists';
			}
			else 
			{
				$projectmedia = ProjectMedia::create(array('project_id' => $project_id,'path' => $path,'media_type' => $media_type));
				$msg = 'record inserted successfully';
				$status1 = 'success';	
			}

			//var_dump($projectmedia);
		}
		else
		{
			$status1 = 'error';
			$msg = 'Please fill all the fields!';
		}
		return json_encode(array('status' => $status1, 'msg' => $msg));
	}

	public function putProjectmedia()
	{
		$status1 = 'error';
		$msg = 'record not found';

		$id 			= Input::get('id');
		$project_id 	= Input::get('project_id');
		$path 			= Input::get('path');
		$media_type		= Input::get('media_type');
		
		$data = Input::all();
		$rules = array(
			'id' 			=> array('required'),
	        'project_id' 	=> array('required'),
	        'path' 			=> array('required'),
	        'media_type' 	=> array('required')

	  	 );

		$validator = Validator::make($data,$rules);
		if ($validator->passes())
		{

			$projectmedia = ProjectMedia::where('id','=',$id)->count();
			//var_dump($projectmedia);
			if($projectmedia > 0)
			{
				$projectmedia = ProjectMedia::find($id);
					$projectmedia->project_id = $project_id;
					$projectmedia->path = $path;
					$projectmedia->media_type = $media_type;
					$projectmedia->save();
					//var_dump($projectmedia);
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

	public function deleteProjectmedia()
	{
		$id = Input::get('id');
		$status = 'error';

		$projectmedia = ProjectMedia::where('id','=',$id)->count();
		if($projectmedia > 0)
		{
			$project = ProjectMedia::where('id','=',$id)->delete();
			$status = 'success';
		}
		return json_encode(array('status' => $status));
	}

	public function getProjectmedia()
	{
		$id = Input::get('id');

		if(!empty($id))
		{
			$projectmedia = ProjectMedia::where('id','=',$id)->get();
			$projectmedia = $projectmedia->toArray();
			//var_dump($projectmedia);
		}
		else
		{
			$projectmedia = ProjectMedia::take(10)->skip(0)->get();
			$projectmedia = $projectmedia->toArray();
			//var_dump($projectmedia->toArray());
		}
		if(!empty($projectmedia))
		{
			return json_encode($projectmedia);
		}
		else
		{
			return json_encode('record not found');
		}

	}
}

?>
