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

  // public function index()
  // {
  //   $user = Auth::user();

  //   if($user->hasRole('superadministrator|administrator')) {
  //     return redirect()->route('admin');
  //   }

  //   $carts = Cart::where('user_id', $user->id)->get();
  //   $wishlist = Wishlist::where('user_id', $user->id)->get();

  //   $products = Product::orderBy('created_at', 'desc')->limit(4)->get();

  //   return view('home', compact('products', 'wishlist', 'carts'));
  // }
}
