<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Cart;

class CartController extends Controller
{
  // public function addToCart(Request $request)
  // {
  //   $data = new Cart();
  //   $data->id_user = $request->id_user;
  //   $data->product_id = $request->product_id;
  //   $data->amount_of_item = $request->amount_of_item;
  //   $data->save();

  //   return response()->json($data);
  // }

  // public function removeFromCart(Request $request)
  // {
  //   $userId = $request->id_user;
  //   $productId = $request->product_id;

    
  //   // $cart = DB::table('carts')
  //   //                 ->when($userId, function ($query, $userId) {
  //   //                     return $query->where('id_user', $userId);
  //   //                 }, function($query, $productId) {
  //   //                     return $query->where('product_id', $productId);
  //   //                 })
  //   //                 ->get();
    

  //   $whereArray = array(
  //                   'id_user' => $userId,
  //                   'product_id' => $productId
  //                 );

  //   $query = DB::table('carts');
  //   foreach ($whereArray as $field => $value) {
  //     $query->where($field, $value);
  //   }

  //   return $query->delete();
  // }
}
