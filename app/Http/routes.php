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
Route::get('/submitRoute',['middleware'=>'auth',function(){
  return View('submitRoute');
}]);
Route::get('/signout',function(){
  return View('signout');
});
Route::post('/signout',function(){
  return View('signout');
})->middleware('Signout');
Route::auth();
Route::get('/home', 'HomeController@index');