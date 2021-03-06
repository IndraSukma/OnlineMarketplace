<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\User;
use App\Address;
use App\Provinces;
use App\Orders;
use App\ProductOrder;
use App\PaymentOrder;
use App\City;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();
    $today = Carbon::today('Asia/Jakarta')->toDateString();
    $year_now = Carbon::today()->year;
    $year = $year_now - 100;

    return view('manage.userInformation.index', compact('user', 'today', 'year'));
  }

  public function address()
  {
    $user = Auth::user();
    $today = Carbon::today('Asia/Jakarta')->toDateString();
    $year_now = Carbon::today()->year;
    $year = $year_now - 100;
    $addresses = Address::where('user_id', $user->id)->get();
    $provinces = Provinces::get();
    $cities = City::get();

    return view('manage.userInformation.address', compact('addresses', 'user', 'today', 'year', 'provinces', 'cities'));
  }

  public function transaction()
  {
    $user = Auth::user();
    $orders = Orders::where('user_id', $user->id)->get();
    $today = Carbon::today('Asia/Jakarta')->toDateString();
    $year_now = Carbon::today()->year;
    $year = $year_now - 100;

    return view('manage.userInformation.transaction', compact('orders', 'user', 'today' ,'year'));
  }

  public function transactionDetail(Orders $order, $code)
  {
    $user = Auth::user();
    $orders = Orders::where('id', $code)->first();
    $products = ProductOrder::where('order_id', $code)->get();
    $payment = PaymentOrder::where('order_id', $code)->first();
    $today = Carbon::today('Asia/Jakarta')->toDateString();
    $year_now = Carbon::today()->year;
    $year = $year_now - 100;

    return view('manage.userInformation.transaction-detail', compact('orders', 'user', 'products', 'payment', 'today','year'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $today = Carbon::today('Asia/Jakarta')->toDateString();
    $year_now = Carbon::today()->year;
    $year = $year_now - 100;

    return view('manage.userInformation.edit', compact('user', 'today', 'year'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $this->validate($request, [
      'name'           => 'required|string|max:255|unique:users,id',
      'email'          => 'required|string|email|max:255|unique:users,id',
      'phone'          => 'required|numeric|unique:users,id',
      'gender'         => 'required',
      'place_of_birth' => 'required',
      'date_of_birth'  => 'required'
    ]);

    $date = explode('-', $request->date_of_birth);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];

    $user->name           = $request->name;
    $user->email          = $request->email;
    $user->phone          = $request->phone;
    $user->gender         = $request->gender;
    $user->place_of_birth = $request->place_of_birth;
    $user->day_of_birth   = $day;
    $user->month_of_birth = $month;
    $user->year_of_birth  = $year;
    $user->save();

    Session::flash('success', 'Profil berhasil diubah.');

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
