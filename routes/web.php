<?php

Route::get('/', function () {
  return view('welcome');
});

Route::prefix('admin')
     ->middleware('role:superadministrator|administrator')
     ->group(function () {

  Route::get('/', function () {
    return view('admin');
  })->name('admin');

  Route::get('/address', 'AddressController@indexAdmin')->name('address.indexAdmin');
});


Auth::routes();

Route::prefix('manage')
		 ->middleware('role:superadministrator|administrator|user')
		 ->group(function () {
  Route::get('/dashboard', 'ManageController@dashboard')->name('dashboard');
  Route::resource('/user', 'UserController')->only('index', 'edit', 'update');
  Route::resource('/address', 'AddressController');
  Route::resource('/products', 'ProductController');
  Route::resource('/productCategories', 'ProductCategoryController');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/productDetail', 'HomeController@productDetail')->name('product-detail');
Route::get('/products', 'HomeController@products')->name('products');

// Route::get('/manage/address/{address}/edit', 'AddressController@edit')->name('address.edit');
