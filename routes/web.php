<?php

Auth::routes();

Route::get('/', 'PageController@index')->name('home');
Route::get('/cart', 'PageController@cart')->name('cart');
Route::get('/checkout', 'PageController@checkout')->name('checkout');
Route::get('/wishlist', 'PageController@wishlist')->name('wishlist');

// Route::get('/home', 'HomeController@index')->name('home');

// Product Operation
Route::get('/products', 'ProductController@indexFront')->name('products.indexFront');
Route::get('/products/{slug}', 'ProductController@detail')->name('products.detail');
Route::get('/search', 'ProductController@search')->name('products.search');
Route::post('/addToCart', 'ProductController@addToCart')->name('products.addToCart');
Route::post('/addToWishlist', 'ProductController@addToWishlist')->name('products.addToWishlist');
Route::delete('/removeFromCart', 'ProductController@removeFromCart')->name('products.removeFromCart');
Route::delete('/removeFromWishlist', 'ProductController@removeFromWishlist')->name('products.removeFromWishlist');

// Route::get('/removeFromCart', 'CartController@removeFromCart');

Route::prefix('admin')
     ->middleware('role:superadministrator|administrator')
     ->group(function () {
  Route::get('/', function () {
    return view('admin');
  })->name('admin');
  Route::get('/address', 'AddressController@indexAdmin')->name('address.indexAdmin');
});

Route::prefix('manage')
		 ->middleware('role:superadministrator|administrator|user')
		 ->group(function () {
  Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');
  Route::resource('/user', 'UserController')->only('index', 'edit', 'update');
  Route::resource('/address', 'AddressController');
  Route::resource('/products', 'ProductController');
  Route::resource('/productCategories', 'ProductCategoryController');
});

// JSON
Route::get('/productsJson', 'ProductController@json');
