<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

		Config::set('auth.defines', 'admin');
		Route::get('login', 'AdminAuth@login');
		Route::post('login', 'AdminAuth@dologin');
		Route::get('forgot/password', 'AdminAuth@forgot_password');
		Route::post('forgot/password', 'AdminAuth@forgot_password_post');
		Route::get('reset/password/{token}', 'AdminAuth@reset_password');
		Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');
		Route::group(['middleware' => 'admin:admin'], function () {

				Route::resource('admin', 'AdminController');
				Route::delete('admin/destroy/all', 'AdminController@multi_delete');

				Route::resource('users', 'UsersController');
				Route::delete('users/destroy/all', 'UsersController@multi_delete');
				Route::resource('countries', 'CountriesController');
				Route::delete('countries/destroy/all', 'CountriesController@multi_delete');

				Route::resource('cities', 'CitiesController');
				Route::delete('cities/destroy/all', 'CitiesController@multi_delete');

				Route::resource('states', 'StatesController');
				Route::delete('states/destroy/all', 'StatesController@multi_delete');

				Route::resource('trademarks', 'TradeMarksController');
				Route::delete('trademarks/destroy/all', 'TradeMarksController@multi_delete');

				Route::resource('manufacturers', 'ManufacturersController');
				Route::delete('manufacturers/destroy/all', 'ManufacturersController@multi_delete');

				Route::resource('shiping', 'ShipingController');
				Route::delete('shiping/destroy/all', 'ShipingController@multi_delete');

				Route::resource('malls', 'MallsController');
				Route::delete('malls/destroy/all', 'MallsController@multi_delete');

				Route::resource('colors', 'ColorsController');
				Route::delete('colors/destroy/all', 'ColorsController@multi_delete');

				Route::resource('weights', 'WeightsController');
				Route::delete('weights/destroy/all', 'WeightsController@multi_delete');

				Route::resource('sizes', 'SizeController');
				Route::delete('sizes/destroy/all', 'SizeController@multi_delete');

				Route::resource('products', 'ProductsController');
				Route::delete('products/destroy/all', 'ProductsController@multi_delete');
				Route::post('upload/image/{product_id}', 'ProductsController@upload_file');
				Route::post('delete/image', 'ProductsController@deleteImage');

				

				Route::resource('departments', 'DepartmentsController');

				Route::get('/', function () {
						return view('admin.home');
				});

				Route::get('settings', 'Settings@setting');
				Route::post('settings', 'Settings@setting_save');

				Route::any('logout', 'AdminAuth@logout');
			});

		Route::get('lang/{lang}', function ($lang) {
				session()->has('lang') ? session()->forget('lang') :'';
				$lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
				return back();
		});
	});