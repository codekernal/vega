<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
namespace Cpanel;

class Testimonial extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'testimonial';
	 protected $fillable = array('client_id','project_id','testimonial','date_added');
	public $timestamps = false;
}

