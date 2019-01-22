<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Wishlist;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index()
  {
	  $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
	  
	  if (Auth::check()) {
	  	$user = Auth::user();
	    $cart = Cart::where('user_id', $user->id)->get();
	    $cart_added = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist = Wishlist::where('user_id', $user->id)->get();
      $wishlist_added = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
	  }

	  return view('home', compact('products', 'cart', 'cart_added', 'wishlist', 'wishlist_added'));
  }

  public function dashboard()
  {
    return view('manage.dashboard');
  }

  public function cart()
  {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->get();
    $wishlist = Wishlist::where('user_id', $user->id)->get();
    $subTotal = Product::whereIn('id', $cart->pluck('product_id'))->pluck('price')->sum();
    $mightLikeProduct = Product::orderBy('created_at', 'desc')->limit(4)->get();

    // $inCart = DB::table('products')
    //             ->join('carts', function($join) {
    //               $join->on('products.id', '=', 'carts.product_id')
    //                    ->where('carts.user_id', '=', Auth::user()->id);
    //             })->get();

    // $subTotal = Product::join('carts', function($join) {
				//                   $join->on('products.id', 'carts.product_id')
				//                        ->where('carts.user_id', Auth::user()->id);
				//                 })->pluck('price')->sum();

    return view('cart', compact('mightLikeProduct', 'cart', 'wishlist', 'subTotal'));
  }
}