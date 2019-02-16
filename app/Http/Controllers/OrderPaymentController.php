<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\PaymentOrder;
use App\Orders;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
  public function store(Request $request)
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
    $order->day_of_pay    = $day;
    $order->month_of_pay  = $month;
    $order->year_of_pay   = $year;
    $order->save();

    Orders::where('id', $request->order_id)->update(['status' => 'Menunggu Pengiriman Barang']);

    Session::flash('success', 'Payment Confirmed');

    return redirect()->back();
  }
}
