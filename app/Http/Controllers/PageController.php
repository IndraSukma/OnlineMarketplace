<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Wishlist;
use App\Product;
use App\Address;
use App\Provinces;
use App\City;
use App\ProductOrder;
use App\Orders;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PageController extends Controller
{
  public function index()
  {
	  $products = Product::orderBy('id', 'desc')->limit(4)->get();

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

  // Shipping API

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

  // Order Id Generator
  function generateBarcodeNumber() {
    $number = mt_rand(1000000000, 9999999999); // better than rand()

    // call the same function if the barcode exists already
    if ($this->barcodeNumberExists($number)) {
        return $this->generateBarcodeNumber();
    }

    // otherwise, it's valid and can be used
    return $number;
  }

  function barcodeNumberExists($number) {
    $query = \DB::table('orders')->where('id', $number)->first();

    if (isset($query)) {
        return true;
    } else {
        return false;
    }
  }

  // Place Order Process
  public function processOrder(Request $request)
  {
    $user = Auth::user();
    $carts = Cart::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    $orderId = $this->generateBarcodeNumber();
    $order = new Orders;

    $order->id = $orderId;
    $order->user_id = $user->id;
    $order->address_id = $request->address_id;
    $order->total_price = $request->total_price;
    $order->status = 'Menunggu Konfimasi Transfer';
    $order->save();

    foreach ($carts as $cart) {
      // Insert to Product Order Table
      $productOrders = new ProductOrder;
      $productOrders->order_id = $orderId;
      $productOrders->product_id = $cart->product_id;
      $productOrders->quantity = $cart->amount_of_item;
      $productOrders->note = $cart->note;
      $productOrders->single_price = $cart->product->price;
      $productOrders->save();

      // Updating product quantity
      $stock = \DB::table('products')->where('id', $cart->product_id)->first()->stock;
      $stockUpdate = $stock - $cart->amount_of_item;
      Product::where('id', $cart->product_id)->update(['stock' => $stockUpdate]);

      // Clearing the cart
      Cart::where([
        ['user_id', $cart->user_id],
        ['product_id', $cart->product_id]
      ])->delete();
    }

    return redirect()->route('manage.transactionDetail', $orderId);
  }

  /*
  public function confirmPayment(Request $request)
  {
    $this->validate($request, [
      'order_id'       => 'required|string|max:255',
      'bank'           => 'required|string',
      'paid_by'        => 'required|string|max:255',
      'total_payment'  => 'required|numeric',
      'payment_date'   => 'required',
    ]);

    $order = new PaymentOrder;
    $user = Auth::user();

    $date = explode('-', $request->payment_date);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];

    $order->user_id       = $user->id;
    $order->order_id      = $request->order_id;
    $order->bank          = $request->bank;
    $order->paid_by       = $request->paid_by;
    $order->total_payment = $request->total_payment;
    $order->day_of_pay   = $day;
    $order->month_of_pay = $month;
    $order->year_of_pay  = $year;
    $order->save();

    Session::flash('success', 'Payment Confirmed');

    return redirect()->back();
  }
  */

}
