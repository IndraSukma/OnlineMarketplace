<?php

Route::get('/', function () {
  return view('welcome');
});

Route::get('admin', function () {
  return view('admin');
})->middleware('role:superadministrator|administrator')->name('admin');

Auth::routes();

Route::prefix('manage')
		 ->middleware('role:superadministrator|administrator|user')
		 ->group(function () {
  Route::get('/dashboard', 'ManageController@dashboard')->name('dashboard');
  Route::resource('/user', 'UserController')->only('index', 'edit', 'update');
  // Route::get('/user', 'UserController@index')->name('user.index');
  // Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
  // Route::put('/user/{user}', 'UserController@update')->name('user.update');
  Route::resource('/address', 'AddressController');
  Route::resource('/products', 'ProductController');
  Route::resource('/productCategories', 'ProductCategoryController');
});

Route::get('/home', 'HomeController@index')->name('home');
