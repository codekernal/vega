<?php

namespace Cpanel;

use \BaseController;
use \Input;
use \Validator;


class CategoryController extends BaseController {

	public function postCategory()
	{
		$cat_name = Input::get('cat_name');

		$data = Input::all();
		$rules = array(
	        'cat_name' => array('required')

	  	 );

		$validator = Validator::make($data,$rules);

		if ($validator->passes())
		{
			$category = AdminCategory::where('cat_name','=',$cat_name)->count();
			//var_dump($category);
			if($category > 0)
			{
				$status = 'error';
				$msg = 'category already exists';
			}
			else 
			{
				$category = AdminCategory::create(array('cat_name' => $cat_name));
				$msg = 'record inserted successfully';
				$status = 'success';	
			}

			//var_dump($category);
		}
		else
		{
			$status = 'error';
			$msg = 'Please fill all the fields!';
		}
		return json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function putCategory()
	{
		$status = 'error';
		$msg = 'record not found';

		$id = Input::get('id');
		$cat_name = Input::get('cat_name');

		$data = Input::all();
		$rules = array(
			'id' => array('required'),
	        'cat_name' => array('required')

	  	 );

		$validator = Validator::make($data,$rules);
		if ($validator->passes())
		{

			$category = AdminCategory::where('id','=',$id)->count();
			//var_dump($category);
			if($category > 0)
			{
				$category = AdminCategory::find($id);
					$category->cat_name = $cat_name;
					$category->save();

					$status = 'success';
					$msg = 'record updated successfilly';
			}
		}
		else
		{
			$status = 'error';
			$msg = 'Please fill all the fields!';
		}
		
			return json_encode(array('status' => $status,'msg' => $msg));

	}

	public function deleteCategory()
	{
		$id = Input::get('id');
		$status = 'error';

		$category = AdminCategory::where('id','=',$id)->count();
		if($category > 0)
		{
			$category = AdminCategory::where('id','=',$id)->delete();
			$status = 'success';
		}
		return json_encode(array('status' => $status));
	}

	public function getCategory()
	{
		$id = Input::get('id');

		if(!empty($id))
		{
			$category = AdminCategory::where('id','=',$id)->get();
			$category = $category->toArray();
			//var_dump($category);
		}
		else
		{
			$category = AdminCategory::get();
			$category = $category->toArray();
			//var_dump($category->toArray());
		}
		if(!empty($category))
		{
			return json_encode($category);
		}
		else
		{
			return json_encode('record not found');
		}

	}
}

?>
