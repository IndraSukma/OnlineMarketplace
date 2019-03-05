<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\PaymentOrder;
use App\Product;
use App\ProductOrder;
use Auth;
use Session;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Orders::orderBy('created_at', 'asc')->get();

    return view('manage.orders.index', compact('orders'));
  }

  public function show(Orders $orders, $id)
  {
    $order = Orders::where('id', $id)->first();
    $products = ProductOrder::where('order_id', $id)->orderBy('created_at', 'asc')->get();
    $payment = PaymentOrder::where('order_id', $id)->first();

    return view('manage.orders.show', compact('order', 'products', 'payment'));
  }

  public function update(Request $request, Orders $order)
  {
    $this->validate($request, [
      'id'         =>  'required',
      'status'     =>  'required',
      'reciept'    =>  'required',
    ]);

    $updateDetails = array(
        'status'           => $request->status,
        'delivery_reciept' => $request->reciept
    );

    $order->where('id', $request->id)
          ->update($updateDetails);


    Session::flash('Success', 'Data berhasil diubah');

    return redirect()->back();
  }
}
