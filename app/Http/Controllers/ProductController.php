<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Cart;
use App\Wishlist;
use App\ProductCategory;
use App\Product;
use DataTables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::orderBy('id', 'asc')->get();
    $productCategories = ProductCategory::orderBy('name')->get();

    return view('manage.products.index', compact('products', 'productCategories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $productCategories = ProductCategory::orderBy('name')->get();

    return view('manage.products.create', compact('productCategories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name'        => 'required|min:2|max:255|unique:products',
      'price'       => 'required|numeric',
      'description' => 'required',
      'category'    => 'required',
      'condition'   => 'required',
      'stock'       => 'required|numeric'
    ]);

    $slug = str_replace(' ', '-', $request->name);

    $product = new Product;
    $product->name = $request->name;
    $product->slug = $slug;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->category_id = $request->category;
    $product->condition = $request->condition;
    $product->stock = $request->stock;
    $product->save();

    Session::flash('success', 'Produk berhasil ditambahkan.');

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    return view('manage.products.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    $productCategories = ProductCategory::orderBy('name')->get();

    return view('manage.products.edit', compact('product', 'productCategories'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    $this->validate($request, [
      'name'        => 'required|min:2|max:255|unique:products,id',
      'price'       => 'required|numeric',
      'description' => 'required',
      'category'    => 'required',
      'condition'   => 'required',
      'stock'       => 'required|numeric'
    ]);

    $slug = str_replace(' ', '-', $request->name);

    $product->name = $request->name;
    $product->slug = $slug;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->category_id = $request->category;
    $product->condition = $request->condition;
    $product->stock = $request->stock;
    $product->save();

    Session::flash('success', 'Produk berhasil diubah.');

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    $product->delete();

    Session::flash('success', 'Produk Berhasil dihapus.');

    return redirect()->back();
  }

  public function indexFront()
  {
    $products = Product::orderBy('created_at', 'desc')->paginate(20);

    if (Auth::check()) {
      $user = Auth::user();
      $cart = Cart::where('user_id', $user->id)->first();
      $wishlist = Wishlist::where('user_id', $user->id)->first();
      // $cart_array = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist_array = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
    }

    return view('products', compact('products', 'cart', 'wishlist', 'wishlist_array'));
  }

  public function detail(Product $product, $slug)
  {
    $product = Product::where('slug', $slug)->first();
    $relatedProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

    if (Auth::check()) {
      $user = Auth::user();
      $cart = Cart::where('user_id', $user->id)->first();
      $wishlist = Wishlist::where('user_id', $user->id)->first();
      // $cart_array = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist_array = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
    }

    return view('productDetail', compact('product', 'relatedProducts', 'cart', 'wishlist', 'wishlist_array'));
  }

  public function search(Request $request)
  {
    $keyword = $request->keyword;
    $products = Product::search($keyword)->paginate(20);
    // $products = Product::where('name', 'Like', '%' .$keyword. '%')->paginate(20);

    if (Auth::check()) {
      $user = Auth::user();
      $cart = Cart::where('user_id', $user->id)->first();
      $wishlist = Wishlist::where('user_id', $user->id)->first();
      // $cart_array = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist_array = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
    }

    return view('search.index', compact('keyword', 'products', 'cart', 'wishlist', 'wishlist_array'));
  }

  public function addToCart(Request $request)
  {
    $user = Auth::user();

    if (Cart::where([['user_id', $user->id], ['product_id', $request->product_id]])->exists()) {
      return response('Item is already in the cart');
    } else {
      $cart = new Cart;
      $cart->user_id = $user->id;
      $cart->product_id = $request->product_id;
      $cart->save();

      return response('Item has been added to the cart.');
    }
  }

  public function removeFromCart(Request $request)
  {
    $user = Auth::user();

    Cart::where([
      ['user_id', $user->id],
      ['product_id', $request->product_id]
    ])->delete();

    return response('Item has been removed from the cart.');
  }

  public function addToWishlist(Request $request)
  {
    $user = Auth::user();

    $wishlist = new Wishlist;
    $wishlist->user_id = $user->id;
    $wishlist->product_id = $request->product_id;
    $wishlist->save();

    return response('Item has been added to the wish list.');
  }

  public function removeFromWishlist(Request $request)
  {
    $user = Auth::user();

    Wishlist::where([
      ['user_id', $user->id],
      ['product_id', $request->product_id]
    ])->delete();

    return response('Item has been removed from the wish list.');
  }

  public function json()
  {
    $products = Product::query();

    return DataTables::of($products)
                     ->addColumn('action', function($products){
                        return '
                          <center>
                            <a href="{{route('."products.show".', $product->id)}}" class="btn btn-primary mx-0"> Show</a>
                            <a href="#edit-'.$products->id.'" class="btn btn-warning mx-0"> Edit</a>
                            <a href="#edit-'.$products->id.'" class="btn btn-danger mx-0"> Delete</a>
                          </center>
                        ';
                      })
                     ->make(true);
  }
}