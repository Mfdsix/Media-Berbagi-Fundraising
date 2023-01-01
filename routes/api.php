<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/callback/faspay', 'Controller@payment_notification');
Route::group(['namespace' => 'api'], function () {
	Route::get("/", function () {
		return response()->json([
			'message' => "It's works, maybe :)"
		]);
	});

	# auth
	Route::post('/register', 'AuthController@register');
	Route::post('/login', 'AuthController@login');
	Route::post('/token', 'AuthController@token');
	Route::post('/forgot-password', 'ForgotPasswordController@doForgot');
	Route::post('/change-password', 'AuthController@changePassword');

	# Activity
	Route::get('/activities', 'ActivityController@index');
	Route::get('/activity/{id}', 'ActivityController@show');

	# slider
	Route::get('/sliders', 'SliderController@index');

	# category
	Route::get('/categories', 'CategoryController@index');

	# project
	Route::get('/projects', 'ProjectController@index');
	Route::get('/projects/search', 'ProjectController@search');
	Route::get('/project/{id}', 'ProjectController@show');
	Route::get('/project/{id}/donation', 'ProjectController@donation');
	Route::get('/project/{id}/news', 'ProjectController@news');

	Route::post('/upload', 'ProjectController@upload');

	# fundraiser
	Route::get('/fundraisers', 'FundraiserController@index');

	# util
	Route::get('/util/zakat-type', 'UtilController@zakatType');
	Route::get('/util/nishab-price', 'UtilController@nishabPrice');

	# content
	Route::get('/content/about-us', 'ContentController@aboutUs');
	Route::get('/content/term-condition', 'ContentController@termCondition');
	Route::get('/content/help', 'ContentController@help');

	Route::get('/product', 'ProductController@index');
	Route::get('/product/{id}', 'ProductController@show');

	Route::group(['middleware' => 'auth:api'], function () {
		# wa test
		Route::post("/test/wa", "TestController@wa");

		# transaction
		Route::get('/payment/method', 'PaymentController@method');
		Route::post('/payment/request/{id}', 'PaymentController@payment_request');
		Route::get('/transaction', 'TransactionController@index');
		Route::get('/transaction/{id}', 'TransactionController@show');
		Route::get('/transaction/{id}/how-to-pay', 'TransactionController@how_to_pay');
		Route::post('/transaction/{id}/proof', 'TransactionController@proof');

		# notification
		Route::get('/notification', 'NotificationController@index');
		Route::get('/notification/{id}', 'NotificationController@show');

		# profile
		Route::get('/profile', 'ProfileController@show');
		Route::get('/profile/donation', 'ProfileController@donation');
		Route::post('/profile', 'ProfileController@update');
		Route::post('/profile/photo', 'ProfileController@photo');
		Route::post('/profile/password', 'ProfileController@password');

		Route::get('/cart', 'CartController@all');
		Route::post('/cart', 'CartController@store');
		// Route::delete('/cart', 'CartController@destroy');
		Route::post('/cart/{id}', 'CartController@destroy');
	});
});
