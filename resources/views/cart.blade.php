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
            <div class="row mt-5 mb-5" id="cartEmpty" style="display: none;">
              <div class="col-sm text-center">
                <div class="text-center display-1">
                  <i class="mdi mdi-cart-off"></i>
                </div>
                <h5 class="text-center">There are no items in your cart</h5>
                <a href="#" class="btn aqua-gradient">Start Shopping</a>
              </div>
            </div>
            <div class="row" id="cartFilled">
              <div class="col-sm-7">
                <div class="card">
                  <div class="card-body">
                    @foreach($cart as $cartItem)
                      <div class="cartItem d-flex border-bottom mb-3" data-id="{{ $cartItem->product->id }}" data-stock="{{ $cartItem->product->stock }}" data-price="{{ $cartItem->product->price }}">
                        <div class="detail flex-fill">
                          <div class="row">
                            <div class="col-2">
                              <img src="{{ asset('img/user.jpg') }}" alt="{{ $cartItem->product->name }}" class="w-100">
                            </div>
                            <div class="col px-0 mr-5">
                              <div class="d-flex justify-content-between">
                                <a href="{{ route('products.detail', $cartItem->product->slug) }}">
                                  <h5 class="font-weight-bold m-0">{{ $cartItem->product->name }}</h5>
                                </a>
<<<<<<< HEAD
                                <p>Rp. <span class="text-right m-0" id="item-price{{$cartItem->id}}">{{number_format($cartItem->amount_of_item * $cartItem->product->price,2,',','.')}}</span></p>
=======
                                <p>Rp. <span class="multiplePrice">{{ number_format($cartItem->amount_of_item * $cartItem->product->price, 2, ',', '.') }}</span></p>
>>>>>>> 3ea2d4e1cec5fc5701627e08b5a1430a22811f6e
                              </div>
                              <div class="row">
                                <div class="col-lg-4">
                                  <label>Amount of Item</label>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <button class="btnMinus btn btn-primary z-depth-0 px-2 py-0 m-0"><i class="mdi mdi-24px mdi-minus"></i></button>
                                    </div>
                                    <input type="number" class="quantity form-control text-center bg-white" value="{{ $cartItem->amount_of_item }}" readonly>
                                    <div class="input-group-append">
                                      <button class="btnPlus btn btn-primary z-depth-0 px-2 py-0 m-0"><i class="mdi mdi-24px mdi-plus"></i></button>
                                    </div>
                                  </div>
                                </div>
                                <div class="col pl-0">
                                  <div class="input-group mb-3">
                                    <label>Notes</label>
                                    <input type="text" class="notes form-control w-100 rounded" placeholder="Ex: Size: XL, etc">
                                  </div>
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
                          <strong id="subTotal">{{ number_format($cart->sum('subtotal'), 2, ',', '.') }}</strong>
                        </span>
                      </div>
                    </div>
                    <hr>
                    <button id="btnCheckout" class="btn blue-gradient w-100">Checkout</button>
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
  <script src="{{ asset('js/jquery.number.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      var delay = (function () {
        var timer = 0;

        return function(callback, ms) {
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
      })();

      $('.cartItem').each(function () {
        var cartItem = $(this);
        var quantityInput = cartItem.find('.quantity');
        var btnMinus = cartItem.find('.btnMinus');
        var btnPlus = cartItem.find('.btnPlus');

        var minValue = 1;
        var maxValue = cartItem.data('stock');

        var singlePrice = cartItem.data('price');
        var multiplePrice = cartItem.find('.multiplePrice');

        btnMinus.click(function () {
          var oldValue = parseInt(quantityInput.val());

          if (oldValue <= minValue) {
            var newValue = oldValue;
          } else {
            var newValue = oldValue - 1;
          }

          quantityInput.val(newValue);
          quantityInput.change();
          multiplePrice.number((singlePrice * newValue), 2, ',', '.' );
          multiplePrice.change();
        });

        btnPlus.click(function () {
          var oldValue = parseInt(quantityInput.val());

          if (oldValue >= maxValue) {
            var newValue = oldValue;
          } else {
            var newValue = oldValue + 1;
          }

          quantityInput.val(newValue);
          quantityInput.change();
          multiplePrice.number((singlePrice * newValue), 2, ',', '.');
          multiplePrice.change();
        });

        quantityInput.change(function () {
          var csrf_token = '{{ csrf_token() }}';
          var product_id = cartItem.data('id');
          var quantity = quantityInput.val();

          delay(function () {
            $.ajax({
              type: 'POST',
              url: '{{ route('products.updateQuantity') }}',
              data: {
                '_token': csrf_token,
                'product_id': product_id,
                'quantity': quantity
              },
              success: function(response) {
                iziToast.show({
                  message: response,
                  // onOpening: function() {
                  //   location.reload();
                  // }
                });
              }
            });
          }, 1000);
        });
      });

      $('.multiplePrice').change(function() {
        var sum = 0;
        var totalPrice = $('#subTotal');

        $('.multiplePrice').each(function () {
          var multiplePriceText = $(this).text();
          var multiplePriceTextFormatted = multiplePriceText.substr(0, multiplePriceText.length - 2).replace(/[^a-z0-9\s]/gi, '');

          sum += parseInt(multiplePriceTextFormatted);
        });

        totalPrice.number(sum, 2, ',', '.');
      });

      $('#btnCheckout').click(function() {
        window.location.replace('{{ route('checkout') }}');
      });
    });
  </script>
@endsection
