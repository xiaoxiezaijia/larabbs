<?php

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

Route::get('/', 'PagesController@root')->name('root');



//Route::get('/home', 'HomeController@index')->name('home');



//Auth::routes();
// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

//
//资源控制器操作处理
//HTTP 方法	URI	动作	路由名称
//GET	    /photos	                index	photos.index
//GET	    /photos/create	        create	photos.create
//POST	    /photos	                store	photos.store
//GET	    /photos/{photo}	        show	photos.show
//GET	    /photos/{photo}/edit	edit	photos.edit
//PUT/PATCH	/photos/{photo}	        update	photos.update
//DELETE	/photos/{photo}	        destroy	photos.destroy
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

//上面代码将等同于：
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

//Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

//Route::resource('replies', 'RepliesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
