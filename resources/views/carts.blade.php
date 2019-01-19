@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 mt-4">
  <nav class="navbar navbar-expand-md aqua-gradient mdb-color my-3 mx-5">
    <div class="mr-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb d-inline-flex pl-0 pt-0">
          <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Carts</li>
        </ol>
      </nav>
    </div>
  </nav>
</div>

<div class="container-fluid px-4">
  <div class="mx-5 py-0">
    <h3>Cart</h3>
    <div class="row justify-content-center">
      <div class="col-sm-12">
          @if($carts->count() < 1)
          <div class="card">
            <div class="card-body">
              <div class="row  mt-5 mb-5">
                <div class="col-sm text-center">
                  <div class="text-center display-1">
                    <i class="mdi mdi-cart-off"></i>
                  </div>
                  <h5 class="text-center font-weight-bold">There are no items in your cart</h5>
                  <a href="#" class="btn aqua-gradient">Start Shopping</a>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-sm-7">
              <div class="card">
                <div class="card-body">
                  @foreach($inCart as $item)
                  <div id="product-detail{{$item->id}}">
                    <div class="product-thumbnail">
                      <div class="row ">
                        <div class="col-sm-2">
                          <img src="{{ asset('img/user.jpg') }}" alt="{{$item->name}}" class="w-100">
                        </div>
                        <div class="col-sm-7">
                          <a href="#" class="d-block mt-1">
                            <h5 class="font-weight-bold">{{$item->name}}</h5>
                          </a>
                          <div class="row mt-3">
                            <div class="col-sm-6 float-left">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Amount of Item">
                              </div>
                            </div>
                            <div class="col-sm-6 float-left">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Notes, Ex: Size, Color etc">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <p class="mt-2 text-right">Rp. {{$item->price}}</p>
                        </div>
                        <div class="col-sm-1">
                          <button type="button" id="cart_item{{$item->id}}" data-toggle="tooltip" title="Remove from Cart" name="button" class="border-0" style="background: transparent; cursor: pointer" value="{{$item->product_id}}">
                            <i class="mdi mdi-24px mdi-close text-dark"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  @endforeach
                  <div class="cart-info">
                    <div class="row">
                      <div class="col-sm-12">
                        <b>Total Item : {{$inCart->count()}}</b>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <span class="lead">
                        <strong>Total Price :</strong>
                      </span>
                    </div>
                    <div class="col-sm">
                      <span class="text-success float-right">
                        <strong>Rp. {{collect($inCart)->sum('price')}}</strong>
                      </span>
                    </div>
                  </div>
                  <hr>
                  <button type="button" class="btn blue-gradient w-100" name="button">Checkout</button>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
