<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
namespace Cpanel;

class ProjectMedia extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_media';
	 protected $fillable = array('project_id','path','media_type');
	public $timestamps = false;
}

