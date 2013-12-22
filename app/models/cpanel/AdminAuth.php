<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
namespace Cpanel;

class AdminAuth extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'auth';
	 protected $fillable = array('email', 'password');
	public $timestamps = false;
}

