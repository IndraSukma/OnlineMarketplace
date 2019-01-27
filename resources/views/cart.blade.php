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
      <div class="row justify-content-center">
        <div class="col-sm-12">
          @if($cart->count() == 0)
          <div class="row  mt-5 mb-5">
            <div class="col-sm text-center">
              <div class="text-center display-1">
                <i class="mdi mdi-cart-off"></i>
              </div>
              <h5 class="text-center">There are no items in your cart</h5>
              <a href="#" class="btn aqua-gradient">Start Shopping</a>
            </div>
          </div>
          @else
            <div class="row">
              <div class="col-sm-7">
                <div class="card">
                  <div class="card-body">
                    @foreach($cart as $cartItem)
                      <div id="product{{ $cartItem->id }}" class="d-flex border-bottom mb-3">
                        <div class="flex-fill">
                          <div class="row">
                            <div class="col-2">
                              <img src="{{ asset('img/user.jpg') }}" alt="{{ $cartItem->product->name }}" class="w-100">
                            </div>
                            <div class="col px-0 mr-5">
                              <div class="d-flex justify-content-between">
                                <a href="{{ route('products.detail', $cartItem->product->slug) }}">
                                  <h5 class="font-weight-bold m-0">{{ $cartItem->product->name }}</h5>
                                </a>
                                <p>Rp. <span class="text-right m-0" id="item-price{{$cartItem->id}}">{{number_format($cartItem->amount_of_item * $cartItem->product->price,2,',','.')}}</span></p>                                
                              </div>
                              <div class="row">
                                <div class="col form-group pr-0">
                                    <label for="exampleInputEmail1">Amount of Item</label>
                                    <input type="number" class="form-control w-100" id="quantity-{{$cartItem->id}}" min="1" max="100" value="{{$cartItem->amount_of_item}}">
                                </div>
                                <div class="col form-group input-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <input type="email" class="form-control w-100" id="notes" placeholder="Ex: Size: XL, etc">
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
                          <strong id="subTotal">{{ number_format($cart->sum('subtotal'),2,',','.') }}</strong>
                        </span>
                      </div>
                    </div>
                    <hr>
                    <button id="processProducts" type="button" class="btn blue-gradient w-100" name="button">Checkout</button>
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
@section('script')
<script>
$(document).ready(function () {
  var csrf_token = '{{ csrf_token() }}';
  @foreach($cart as $c)
  $('#quantity-{{$c->id}}').on('input',function(e){
    var quantity = $('#quantity-{{$c->id}}').val();
    var subtotal = {{$c->product->price}} * quantity;
    var product_id = {{$c->product->id}};
    $.ajax({
      type: 'POST',
      url: '{{ route('products.updateQuantity') }}',
      data: {
        '_token': csrf_token,
        'product_id': product_id,
        'quantity': quantity,
        'subtotal': subtotal
      },
      success: function(response) {
        iziToast.show({
            message: response,
            onOpening: function() {
              location.reload();
            }
        });
      }
    });
  });
  @endforeach
});
</script>
@endsection
