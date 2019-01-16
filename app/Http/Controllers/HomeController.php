<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
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
    $products = Product::orderBy('created_at', 'desc')->limit(4)->get();

    if($user->hasRole('superadministrator|administrator')) {
      return redirect()->route('admin');
    }
    return view('home', compact('products'));
  }

  public function productDetail(Product $product, $slug)
  {
    $product = Product::where('slug', $slug)->first();
    $relatedProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

    return view('product-detail', compact('product', 'relatedProducts'));
  }

  public function products()
  {
    $products = Product::orderBy('created_at', 'desc')->paginate(20);

    return view('products', compact('products'));
  }

  // public function search(Request $request)
  // {
  //   $keyword = $request->keyword;
  //   $products = Product::search($keyword)->paginate(20);

  //   return view('search.index', compact('keyword', 'products'));
  // }
}
