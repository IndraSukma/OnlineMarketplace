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
}