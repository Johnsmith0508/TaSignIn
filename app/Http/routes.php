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
Route::post('/profile',['middleware'=>'auth'],function(){
  
})->middleware('Profile');
Route::get('/submitRoute',['middleware'=>'auth',function(){
  return View('submitRoute');
}]);
Route::get('/signout',function(){
  return View('signout');
});
Route::post('/signout',function(){
  return View('signout');
})->middleware('Signout');

Route::get('/signin',function(){
  return View('signin');
});
Route::post('/signin',function(){
  return View('signin');
})->middleware('Signin');
Route::auth();
Route::get('/home', 'HomeController@index');