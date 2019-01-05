<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();

    if($user->hasRole('superadministrator|administrator')) {
      return redirect()->route('address.indexAdmin');
    }

    $addresses = Address::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('manage.address.index', compact('addresses'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('manage.address.create');
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
      'full_name'        => 'required',
      'address_name'     => 'required',
      'complete_address' => 'required',
      'provence'         => 'required',
      'city'             => 'required',
      'sub_district'     => 'required',
      'additional_info'  => 'required',
      'phone'            => 'required'
    ]);

    $address = new Address;
    $address->user_id          = Auth::user()->id;
    $address->full_name        = $request->full_name;
    $address->address_name     = $request->address_name;
    $address->complete_address = $request->complete_address;
    $address->provence         = $request->provence;
    $address->city             = $request->city;
    $address->sub_district     = $request->sub_district;
    $address->zip_code         = $request->zip_code;
    $address->additional_info  = $request->additional_info;
    $address->phone            = $request->phone;
    $address->save();

    Session::flash('success', 'Alamat berhasil ditambahkan.');

    return redirect()->route('address.show', $address->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Address $address)
  {
    return view('manage.address.show', compact('address'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Address $address)
  {
    if ($address->user_id == Auth::user()->id) {
      return view('manage.address.edit', compact('address'));
    }
    return abort(403);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Address $address)
  {
    $this->validate($request, [
      'full_name'        => 'required',
      'address_name'     => 'required',
      'complete_address' => 'required',
      'provence'         => 'required',
      'city'             => 'required',
      'sub_district'     => 'required',
      'additional_info'  => 'required',
      'phone'            => 'required'
    ]);

    $address->full_name        = $request->full_name;
    $address->address_name     = $request->address_name;
    $address->complete_address = $request->complete_address;
    $address->provence         = $request->provence;
    $address->city             = $request->city;
    $address->sub_district     = $request->sub_district;
    $address->zip_code         = $request->zip_code;
    $address->additional_info  = $request->additional_info;
    $address->phone            = $request->phone;
    $address->save();

    Session::flash('success', 'Alamat berhasil diubah.');

    return redirect()->route('address.show', $address->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Address $address)
  {
    $address->delete();

    Session::flash('success', 'Alamat Berhasil dihapus.');

    return redirect()->route('address.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function indexAdmin()
  {
    $addresses = Address::orderBy('created_at', 'desc')->get();

    return view('manage.address.index', compact('addresses'));
  }
}
