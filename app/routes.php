<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('hello');
});
*/
/*
	Route::controller('/', 'HomeController');


Route::get('cpanel/index', function()
{
	return View::make('cpanel.index');
});

Route::get('cpanel/dashboard', function()
{
	return View::make('cpanel.dashboard');
});
*/


/*
* Define all cpanel routes here.
* Call structure: http://localhost/vega/public/cpanel/login/auth
*                                              --Route---- Method name
*/


Route::group(['prefix' => 'cpanel'], function () {
	// View Routes
	Route::get('/index', function()
	{
		return View::make('cpanel.index');
	});

	// Api Routes
	Route::controller('/login', 'Cpanel\AuthController');

});


