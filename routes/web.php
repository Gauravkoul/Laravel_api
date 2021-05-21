<?php
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});


//backend
Route::post('user/signup','UserApiController@back_signup');    
Route::post('user/login', 'UserApiController@back_login');
Route::post('user/update/{user_id}','UserApiController@back_update');

//frontend
Route::post('signup','UserApiController@store');
Route::post('login/update', 'UserApiController@login');
Route::post('update','UpdateApiController@update');
