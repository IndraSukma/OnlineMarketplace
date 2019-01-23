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
	    $cart = Cart::where('user_id', $user->id)->first();
      $wishlist = Wishlist::where('user_id', $user->id)->first();
      // $cart_array = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist_array = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
	  }

	  return view('home', compact('products', 'cart', 'wishlist', 'wishlist_array'));
  }

  public function dashboard()
  {
    return view('manage.dashboard');
  }

  public function cart()
  {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    $wishlist = Wishlist::where('user_id', $user->id)->first();
    $subTotal = Product::whereIn('id', $cart->pluck('product_id'))->pluck('price')->sum();
    $mightLikeProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

    // $inCart = DB::table('products')
    //             ->join('carts', function($join) {
    //               $join->on('products.id', '=', 'carts.product_id')
    //                    ->where('carts.user_id', '=', Auth::user()->id);
    //             })->get();

    // $subTotal = Product::join('carts', function($join) {
        //                   $join->on('products.id', 'carts.product_id')
        //                        ->where('carts.user_id', Auth::user()->id);
        //                 })->pluck('price')->sum();

    return view('cart', compact('mightLikeProducts', 'cart', 'wishlist', 'subTotal'));
  }

  public function wishlist()
  {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();
    $wishlist = Wishlist::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);

    return view('wishlist', compact('cart', 'wishlist'));
  }
}