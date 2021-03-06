<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'PagesController@index');
Route::get('/mangas', 'PagesController@mangas');
Route::get('/blogpage', 'PagesController@blogpage');
Route::get('/venue', 'PagesController@venue');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/profile', 'PagesController@profile');
Route::get('/admin2', 'PagesController@admin2');
Route::get('/adminlogin', 'PagesController@adminlogin');
Route::get('/blogadmin', 'PagesController@blogadmin');
Route::get('/useradmin', 'PagesController@useradmin');
Route::get('/home', 'HomeController');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/login/ajax',[
  'as'   => 'login.ajax',
  'uses' => '\App\Http\Controllers\Auth\LoginController@ajaxShowForm'
]);

Route::get('/register/ajax',[
  'as'   => 'register.ajax',
  'uses' => '\App\Http\Controllers\Auth\RegisterController@ajaxShowForm'
]);

Route::get('/resetpassword',[
  'as'   => 'password.reset.ajax',
  'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@ajaxShowForm'
]);

Route::group(['middleware' => 'auth'], function(){
  Route::group(['middleware' => 'role:admin'], function(){
      Route::get('/admin', 'PagesController@admin');

      Route::get('/admin/users', 'UserController@index');

      Route::post('/admin/users/bulk-delete', 'UserController@bulkDelete');
      Route::get('/admin/users/bulk-delete', function(){
        abort(404);
      });

      Route::post('/admin/users/bulk-suspend', 'UserController@bulkSuspend');
      Route::get('/admin/users/bulk-suspend', function(){
        abort(404);
      });

      Route::get('/admin/users/edit/{id}', 'UserController@edit');
      Route::post('/admin/users/update/{id}', 'UserController@update');

      Route::get('/admin/users/suspend/{id}', 'UserController@suspend');
      Route::get('/admin/users/activate/{id}', 'UserController@activate');

      Route::get('/admin/users/delete/{id}', 'UserController@destroy');
  });
});