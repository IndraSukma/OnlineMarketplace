<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Cart;
use App\Wishlist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  public function index()
  {
    $user = Auth::user();

    if($user->hasRole('superadministrator|administrator')) {
      return redirect()->route('admin');
    }

    $carts = Cart::where('id_user', $user->id)->get();
    $wishlist = Wishlist::where('id_user', $user->id)->get();

    $products = Product::orderBy('created_at', 'desc')->limit(4)->get();

    return view('home', compact('products', 'wishlist', 'carts'));
  }

  public function productDetail(Product $product)
  {
    $user = Auth::user();
    $carts = Cart::where('id_user', $user->id)->get();
    $wishlist = Wishlist::where('id_user', $user->id)->get();

    $relatedProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

    return view('product-detail', compact('product', 'relatedProducts', 'carts', 'wishlist'));
  }

  public function products()
  {
    $user = Auth::user();
    $carts = Cart::where('id_user', $user->id)->get();
    $wishlist = Wishlist::where('id_user', $user->id)->get();

    $products = Product::orderBy('created_at', 'desc')->paginate(20);

    return view('products', compact('products', 'carts', 'wishlist'));
  }
}
