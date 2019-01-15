<?php

use App\Cart;
use App\Wishlist;
use App\Product;

Auth::routes();

Route::get('/', function () {
  $user = Auth::user();
  $carts = Cart::where('id_user', $user->id)->get();
  $wishlist = Wishlist::where('id_user', $user->id)->get();

  $products = Product::orderBy('created_at', 'desc')->limit(4)->get();

  return view('home', compact('products', 'carts', 'wishlist'));
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/productDetail/{product}', 'HomeController@productDetail')->name('productDetail');
Route::get('/products', 'HomeController@products')->name('products');

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
  Route::get('/dashboard', 'ManageController@dashboard')->name('dashboard');
  Route::resource('/user', 'UserController')->only('index', 'edit', 'update');
  Route::resource('/address', 'AddressController');
  Route::resource('/products', 'ProductController');
  Route::resource('/productCategories', 'ProductCategoryController');
});

// Product Operation
Route::get('addToCart', 'ProductController@addToCart');
Route::get('addToWishlist', 'ProductController@addToWishlist');

// Route::get('/manage/address/{address}/edit', 'AddressController@edit')->name('address.edit');
