<?php

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::prefix('manage')
		 ->middleware('role:superadministrator|administrator|user')
		 ->group(function () {
  Route::get('/dashboard', 'ManageController@dashboard')->name('dashboard');
  Route::resource('/products', 'ProductController');
  Route::resource('/productCategories', 'ProductCategoryController');
});

Route::get('/home', 'HomeController@index')->name('home');
