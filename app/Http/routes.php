<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Show Task Dashboard
 */
Route::get('/', function () {
    return View('welcome');
});
Route::get('/profile', ['middleware'=>'auth',function() {
  return View('profile');
}]);

Route::auth();
Route::get('/home', 'HomeController@index');
