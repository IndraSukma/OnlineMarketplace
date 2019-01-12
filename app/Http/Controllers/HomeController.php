<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
    return view('home');
  }

  public function productDetail()
  {
    return view('product-detail');
  }

  public function products()
  {
    return view('products');
  }
}
