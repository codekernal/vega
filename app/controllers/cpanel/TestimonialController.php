<?php

namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;


class TestimonialController extends BaseController {

	public function postTestimonial()
	{
		$client_id = Input::get('client_id');
		$project_id = Input::get('project_id');
		$testimonial = Input::get('testimonial');
		$date_added = date("Y-m-d h-i-s");


		$data = Input::all();
		$rules = array(
	        'client_id' => array('required'),
	        'project_id' => array('required'),
	        'testimonial' => array('required')
	  	 );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$client = Testimonial::where('client_id','=',$client_id)->where('project_id','=',$project_id)->where('testimonial','=',$testimonial)->count();
			//var_dump($testimonial);
			if($client > 0)
			{
				$status1 = 'error';
				$msg = 'testimonial already exists';
			}
			else 
			{
				$client = Testimonial::create(array('client_id' => $client_id,'project_id' => $project_id,'testimonial' => $testimonial,'date_added' => $date_added));
				$msg = 'record inserted successfully';
				$status1 = 'success';	
			}

			//var_dump($testimonial);
		}
		else
		{
			$status1 = 'error';
			$msg = 'Please fill all the fields!';
		}
		return json_encode(array('status' => $status1, 'msg' => $msg));
	}

	public function putTestimonial()
	{
		$status1 = 'error';
		$msg = 'record not found';

		$id = Input::get('id');
		$client_id = Input::get('client_id');
		$project_id = Input::get('project_id');
		$testimonial = Input::get('testimonial');
		$date_added = date("Y-m-d h-i-s");

		$data = Input::all();
		$rules = array(
			'id' => array('required'),
	        'client_id' => array('required'),
	        'project_id' => array('required'),
	        'testimonial' => array('required')

	  	 );

		$validator = Validator::make($data,$rules);
		if ($validator->passes())
		{

			$testimonials = Testimonial::where('id','=',$id)->count();
			var_dump($testimonials);
			if($testimonials > 0)
			{
				$testimonials = Testimonial::find($id);
				//var_dump($testimonials);
					$testimonials->client_id = $client_id;
					$testimonials->project_id = $project_id;
					$testimonials->testimonial = $testimonial;
					$testimonials->date_added = $date_added;
					$testimonials->save();

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

	public function deleteTestimonial()
	{
		$id = Input::get('id');
		$status = 'error';

		$testimonial = Testimonial::where('id','=',$id)->count();
		if($testimonial > 0)
		{
			$testimonial = Testimonial::where('id','=',$id)->delete();
			$status = 'success';
		}
		return json_encode(array('status' => $status));
	}

	public function getTestimonial()
	{
		$id = Input::get('id');

		if(!empty($id))
		{
			$testimonial = Testimonial::where('id','=',$id)->get();
			$testimonial = $testimonial->toArray();
			//var_dump($testimonial);
		}
		else
		{
			$testimonial = Testimonial::take(10)->skip(0)->get();
			$testimonial = $testimonial->toArray();
			//var_dump($testimonial->toArray());
		}
		if(!empty($testimonial))
		{
			return json_encode($testimonial);
		}
		else
		{
			return json_encode('record not found');
		}

	}
}

?>
