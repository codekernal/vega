<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
namespace Cpanel;

class Client extends \Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'client';
	 protected $fillable = array('client_name','image_path','web_url','status');
	public $timestamps = false;
}

