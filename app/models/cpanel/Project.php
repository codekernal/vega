<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
namespace Cpanel;

class Project extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';
	 protected $fillable = array('project_title','description','date_added','status','is_featured','client_id','live_url','services_offered','cat_id');
	public $timestamps = false;
}

