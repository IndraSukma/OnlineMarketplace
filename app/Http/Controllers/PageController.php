<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Wishlist;
use App\Product;
use App\Address;
use App\Provinces;
use App\City;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PageController extends Controller
{
  public function index()
  {
	  $products = Product::orderBy('id', 'asc')->limit(4)->get();

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

    return view('cart', compact('mightLikeProducts', 'cart', 'wishlist', 'subTotal'));
  }

  public function checkout()
  {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    $wishlist = Wishlist::where('user_id', $user->id)->first();
    $addresses = Address::where('user_id', $user->id)->get();
    $provinces = Provinces::get();
    $subTotal = Product::whereIn('id', $cart->pluck('product_id'))->pluck('price')->sum();

    return view('checkout', compact('cart', 'wishlist', 'subTotal', 'addresses', 'provinces'));
  }


  public function wishlist()
  {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();
    $wishlist = Wishlist::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);

    return view('wishlist', compact('cart', 'wishlist'));
  }

  public function getProvince()
  {
    $client = new Client();

    try {
      $response = $client->get('https://api.rajaongkir.com/starter/province',
        array(
          'headers' => array(
            'key' => 'fd9bf09f28befa28c7fe043f4fe52f27',
          )
        )
      );
    } catch (RequestException $e) {
      var_dump($e->getResponse()->getBody()->getContents());
    }
    $json = $response->getBody()->getContents();
    $array_result = json_decode($json, true);
    //print_r($array_result);

    for($i = 0; $i < count($array_result["rajaongkir"]["results"]); $i++) {
      $province = new Provinces;
      $province->id = $array_result["rajaongkir"]["results"][$i]["province_id"];
      $province->name = $array_result["rajaongkir"]["results"][$i]["province"];
      $province->save();
    }
  }

  public function getCity()
  {
    $client = new Client();

    try {
      $response = $client->get('https://api.rajaongkir.com/starter/city',
        array(
          'headers' => array(
            'key' => 'fd9bf09f28befa28c7fe043f4fe52f27',
          )
        )
      );
    } catch (RequestException $e) {
      var_dump($e->getResponse()->getBody()->getContents());
    }

    $json = $response->getBody()->getContents();

    $array_result = json_decode($json, true);
    //print_r($array_result);

    for($i = 0; $i < count($array_result["rajaongkir"]["results"]); $i++) {
      $city = new City;
      $city->id = $array_result["rajaongkir"]["results"][$i]["city_id"];
      $city->name = $array_result["rajaongkir"]["results"][$i]["city_name"];
      $city->province_id = $array_result["rajaongkir"]["results"][$i]["province_id"];
      $city->save();
    }

  }

  public function processShipping(Request $request)
  {
    $client = new Client();
    try {
      $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost',
        [
          'body' => 'origin='.$request->origin.'&destination='.$request->destination.'&weight='.$request->weight.'&courier='.$request->courier,
          'headers' => [
            'key' => 'fd9bf09f28befa28c7fe043f4fe52f27',
            'content-type' => 'application/x-www-form-urlencoded',
          ]
        ]
      );
    } catch (RequestException $e) {
      var_dump($e->getResponse()->getBody()->getContents());
    }

    $json = $response->getBody()->getContents();
    $array_result = json_decode($json, true);

    //  print_r($array_result);
    $cost =  $array_result['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

    return response($cost);
  }

}
