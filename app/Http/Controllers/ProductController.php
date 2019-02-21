<?php

namespace App\Http\Controllers;

use Image;
use DataTables;
use File;
use Session;
use Auth;
use App\Cart;
use App\Wishlist;
use App\ProductCategory;
use App\Product;
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
    $products = Product::orderBy('id')->get();
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
      'stock'       => 'required|numeric',
      'weight'       => 'required|numeric'
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
    $product->weight = $request->weight;
    
    // thumbnail
    if (!empty($request->product_thumbnail)) {
      $thumbnail = $request->product_thumbnail;
      $imageNameArray = [];
      
      $file          = Image::canvas(250, 250, '#fff');
      $thumbnail     = Image::make($thumbnail);
      $width         = $thumbnail->width();
      $height        = $thumbnail->height();
      $mime          = explode('/', $thumbnail->mime());
      $extension     = $mime[1];
      $thumbnailName = time() . '.' . $extension;
      $location      = public_path('img/product-thumbnail/' . $thumbnailName);

      if ($width > $height) {
        $thumbnail->resize(250, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } elseif ($width < $height) {
        $thumbnail->resize(null, 250, function ($constraint) {
          $constraint->aspectRatio();
        });
      } elseif ($width = $height) {
        $thumbnail->resize(250, 250);
      }

      $thumbnail->resizeCanvas(250, 250, 'center', false, 'fff');
      $file->fill($thumbnail)->save($location);

      $product->thumbnail = $thumbnailName;
    }

    // images
    if (!empty($request->product_images)) {
      $images = json_decode($request->product_images);
      $i = 0;

      foreach ($images as $image) {
        $file      = Image::canvas(500, 500, '#fff');
        $image     = Image::make($image);
        $width     = $image->width();
        $height    = $image->height();
        $mime      = explode('/', $image->mime());
        $extension = $mime[1];
        $imageName = time() . $i++ . '.' . $extension;
        $location  = public_path('img/product-img/' . $imageName);

        if ($width > $height) {
          $image->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
          });
        } elseif ($width < $height) {
          $image->resize(null, 500, function ($constraint) {
            $constraint->aspectRatio();
          });
        } elseif ($width = $height) {
          $image->resize(500, 500);
        }

        $imageNameArray[] = $imageName;
        $image->resizeCanvas(500, 500, 'center', false, 'fff');
        $file->fill($image)->save($location);
      }

      $product->images = json_encode($imageNameArray);
    }

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
      'stock'       => 'required|numeric',
      'weight'       => 'required|numeric'
    ]);

    $slug = str_replace(' ', '-', $request->name);

    $product->name = $request->name;
    $product->slug = $slug;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->category_id = $request->category;
    $product->condition = $request->condition;
    $product->stock = $request->stock;
    $product->weight = $request->weight;

    // thumbnail
    if (!empty($request->product_thumbnail)) {
      $thumbnail = $request->product_thumbnail;
      $imageNameArray = [];
      
      $file          = Image::canvas(250, 250, '#fff');
      $thumbnail     = Image::make($thumbnail);
      $width         = $thumbnail->width();
      $height        = $thumbnail->height();
      $mime          = explode('/', $thumbnail->mime());
      $extension     = $mime[1];
      $thumbnailName = time() . '.' . $extension;
      $location      = public_path('img/product-thumbnail/' . $thumbnailName);

      if ($width > $height) {
        $thumbnail->resize(250, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } elseif ($width < $height) {
        $thumbnail->resize(null, 250, function ($constraint) {
          $constraint->aspectRatio();
        });
      } elseif ($width = $height) {
        $thumbnail->resize(250, 250);
      }

      $thumbnail->resizeCanvas(250, 250, 'center', false, 'fff');
      $file->fill($thumbnail)->save($location);

      // Delete old Thumbnail
      if ($product->thumbnail != null) {
        $thumbnailName = $product->thumbnail;
        $thumbnailFile = public_path('img/product-thumbnail/' . $thumbnailName);
        File::delete($thumbnailFile);
      }

      $product->thumbnail = $thumbnailName;
    }

    // images
    if (!empty($request->product_images)) {
      $images = json_decode($request->product_images);
      $i = 0;

      foreach ($images as $image) {
        $file      = Image::canvas(500, 500, '#fff');
        $image     = Image::make($image);
        $width     = $image->width();
        $height    = $image->height();
        $mime      = explode('/', $image->mime());
        $extension = $mime[1];
        $imageName = time() . $i++ . '.' . $extension;
        $location  = public_path('img/product-img/' . $imageName);

        if ($width > $height) {
          $image->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
          });
        } elseif ($width < $height) {
          $image->resize(null, 500, function ($constraint) {
            $constraint->aspectRatio();
          });
        } elseif ($width = $height) {
          $image->resize(500, 500);
        }

        $imageNameArray[] = $imageName;
        $image->resizeCanvas(500, 500, 'center', false, 'fff');
        $file->fill($image)->save($location);
      }

      // Delete old Images
      if ($product->images != null) {
        $imageNames = json_decode($product->images);

        foreach ($imageNames as $imageName) {
          $imageFile = public_path('img/product-img/' . $imageName);
          File::delete($imageFile);
        }
      }

      $product->images = json_encode($imageNameArray);
    }

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
    $thumbnailName = $product->thumbnail;
    $imageNames = json_decode($product->images);

    $thumbnailFile = public_path('img/product-thumbnail/' . $thumbnailName);
    File::delete($thumbnailFile);

    foreach ($imageNames as $imageName) {
      $imageFile = public_path('img/product-img/' . $imageName);
      File::delete($imageFile);
    }

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
    $product_images = json_decode($product->images);
    $relatedProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

    if (Auth::check()) {
      $user = Auth::user();
      $cart = Cart::where('user_id', $user->id)->first();
      $wishlist = Wishlist::where('user_id', $user->id)->first();
      // $cart_array = Cart::where('user_id', $user->id)->pluck('product_id')->toArray();
      $wishlist_array = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
    }

    return view('productDetail', compact('product', 'product_images', 'relatedProducts', 'cart', 'wishlist', 'wishlist_array'));
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
      $product_price = Product::where('id', $request->product_id)->value('price');
      
      $cart = new Cart;
      $cart->user_id = $user->id;
      $cart->product_id = $request->product_id;
      $cart->subtotal = $product_price;
      $cart->save();

      return response('Item has been added to the cart.');
    }
  }

  public function updateQuantity(Request $request)
  {
    $user = Auth::user();
    $product_price = Product::where('id', $request->product_id)->value('price');
    $subtotal = $product_price * $request->quantity;

    $updateDetails = [
      'amount_of_item' => $request->quantity,
      'subtotal' => $subtotal
    ];

    Cart::where([
      ['user_id', $user->id],
      ['product_id', $request->product_id]
    ])->update($updateDetails);

    return response('Success');
  }

  public function removeFromCart(Request $request)
  {
    $user = Auth::user();

    Cart::where([
      ['user_id', $user->id],
      ['product_id', $request->product_id]
    ])->delete();

    $amountOfItem = Cart::where('user_id', $user->id)->count();

    return response($amountOfItem);
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
