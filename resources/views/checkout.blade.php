@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
  <div class="container-fluid px-4 mt-4">
    <nav class="navbar navbar-expand-md aqua-gradient mdb-color my-3 mx-5">
      <div class="mr-auto">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb d-inline-flex pl-0 pt-0">
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('cart') }}">Cart</a></li>
            <li class="breadcrumb-item active">Checkout</li>
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
              <div class="card mb-3">
                <div class="card-header aqua-gradient d-flex justify-content-between">
                  <h6 class="text-white mb-0 mt-2">Address Data</h6>
                  <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Address
                    </button>
                    <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton">
                      <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalAddAddress">
                        <i class="mdi mdi-plus"></i> Add New Address
                      </button>
                      <div class="dropdown-divider"></div>
                      @foreach($addresses as $address)
                      <button class="dropdown-item" id="select-address-{{$address->id}}">
                        <p class="font-weight-light m-0">
                          {{$address->full_name}}<br>
                          <b>
                            {{$address->address_name}}
                          </b>
                        </p>
                      </button>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="card-body" id="address-info">
                  <h5 class="text-center">Please Select Your Address</h5>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th class="text-right lead">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($cart as $item)
                          <tr>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->amount_of_item}}</td>
                            <td class="text-right font-weight-bold">Rp. {{ number_format($item->product->price * $item->amount_of_item,2,',','.') }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Shipping</th>
                            <th class="text-right">POS KILAT : <b> <span class="shipping-cost">Select your address</span></b></th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="row px-2">
                    <div class="col-sm">
                      <span class="lead">
                        <b>Sub Total :</b>
                      </span>
                    </div>
                    <div class="col-sm">
                      <span class="text-success float-right">
                        <strong id="subTotal">Rp. {{ number_format($cart->sum('subtotal'),2,',','.') }}</strong>
                      </span>
                    </div>
                  </div>
                  <hr>
                  <button type="button" class="btn peach-gradient w-100" name="button">Place Order</button>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

@include('_extends.address-add')
@endsection

@section('script')
  <script>
    $(document).ready(function () {
      function convertToRupiah(angka)
      {
      	var rupiah = '';
      	var angkarev = angka.toString().split('').reverse().join('');
      	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
      }

      function setCheckoutPrice(a) {
        var checkoutPrice = a;
      }

      var totalprice = {{$cart->sum('subtotal')}};
      var checkoutPrice;

      $('#province').on('change', function(e) {
        console.log(e);
        var province_id = e.target.value;

        $.get('/city?province_id=' + province_id, function (data) {
          $('#city').empty();
          $.each(data, function (index, cityObj) {
            $('#city').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
          });
        });
      });

      @foreach($addresses as $a)
        $('#select-address-{{$a->id}}').click(function () {
          var contentStr = '';
          contentStr += '<span class="d-none" id="address-id">{{$a->id}}</span>';
          contentStr += '<span class="font-weight-bold" id="recepient-name">{{$a->full_name}}</span><br>';
          contentStr += '<span id="address-name">{{$a->address_name}}</span><br>';
          contentStr += '<span class="mt-5" id="complete-address">{{$a->complete_address}}. </span><span id="additional-info">{{$a->additional_info}}</span><br>';
          contentStr += '<span id="sub-district">{{$a->sub_district}}, </span>';
          contentStr += '<span class="city" id="{{$a->city->id}}">{{$a->city->name}}</span><br>';
          contentStr += '<span class="province" id="{{$a->province->id}}">{{$a->province->name}}, </span>';
          contentStr += '<span id="zip-code">{{$a->zip_code}}</span><br>';
          contentStr += '<span id="phone">{{$a->phone}}</span>';
          $('#address-info').html(contentStr);
          $('#recepient').text('{{$a->full_name}}');

          var csrf_token = '{{ csrf_token() }}';
          var origin = '107';
          var destination = $('.city').attr('id');
          var weight = '1700';
          var courier = 'pos';

          $.ajax({
            type: 'post',
            url: '{{ route('processShipping') }}',
            data: {
              '_token': csrf_token,
              'origin': origin,
              'destination': destination,
              'weight': weight,
              'courier': courier,
            },
            success: function(response) {
              var subtotal = parseInt(response) + parseInt(totalprice);
              $('.shipping-cost').html('<strong>'+ convertToRupiah(response) +',00</strong>');
              $('#subTotal').html('<span>'+convertToRupiah(subtotal)+',00</span>');
              checkoutPrice = subtotal;

              console.log(checkoutPrice);
            }
          });
        });
      @endforeach
    });
  </script>
@endsection
