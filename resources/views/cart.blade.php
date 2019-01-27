@extends('layouts.app')

@section('title', 'Cart')

@section('content')
  <div class="container-fluid px-4 mt-4">
    <nav class="navbar navbar-expand-md aqua-gradient mdb-color my-3 mx-5">
      <div class="mr-auto">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb d-inline-flex pl-0 pt-0">
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Cart</li>
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
          @if($cart->count() == 0)
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
                    @foreach($cart as $cartItem)
                      <div id="product{{ $cartItem->id }}" class="d-flex border-bottom pb-3 mb-3">
                        <div class="flex-fill">
                          <div class="row">
                            <div class="col-2">
                              <img src="{{ asset('img/user.jpg') }}" alt="{{ $cartItem->product->name }}" class="w-100">
                            </div>
                            <div class="col px-0 mr-5">
                              <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('products.detail', $cartItem->product->slug) }}">
                                  <h5 class="font-weight-bold m-0">{{ $cartItem->product->name }}</h5>
                                </a>
                                <p class="text-right m-0">Rp. {{ $cartItem->product->price }}</p>
                              </div>
                              <div class="row">
                                <div class="col input-group pr-0">
                                  <input type="text" class="form-control" placeholder="Amount of Item">
                                </div>
                                <div class="col input-group">
                                  <input type="text" class="form-control" placeholder="Notes, Ex: Size, Color etc">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button class="btn-cart bg-transparent border-0 p-0" value="{{ $cartItem->product_id }}" title="Remove from Cart" data-toggle="tooltip" data-action="remove" data-price="{{ $cartItem->product->price }}" style="height: fit-content; line-height: initial;">
                          <i class="mdi mdi-24px mdi-close"></i>
                        </button>
                      </div>
                    @endforeach
                    <div class="cart-info">
                      <div class="row">
                        <div class="col-sm-12">
                          <b>Total Item : </b>
                          <b id="totalItem">{{ $cart->count() }}</b>
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
                          <strong>Rp. </strong>
                          <strong id="subTotal">{{ $subTotal }}</strong>
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
@endsection
