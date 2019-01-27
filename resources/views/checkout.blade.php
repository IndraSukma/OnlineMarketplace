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
                      <button class="dropdown-item"><i class="mdi mdi-plus"></i> Add New Address</button>
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
                            <th class="text-right">JNE REG: <b>Rp. 18000</b></th>
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
                        <strong>Rp. </strong>
                        <strong id="subTotal">{{ number_format($cart->sum('subtotal'),2,',','.') }}</strong>
                      </span>
                    </div>
                  </div>
                  <hr>
                  <button type="button" class="btn peach-gradient w-100" name="button">Place Order</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('script')
<script>
$(document).ready(function () {
  @foreach($addresses as $a)
  $('#select-address-{{$a->id}}').click(function () {
    var contentStr = '';
    contentStr += '<span class="d-none" id="address-id">{{$a->id}}</span>';
    contentStr += '<span class="font-weight-bold" id="recepient-name">{{$a->full_name}}</span><br>';
    contentStr += '<span id="address-name">{{$a->address_name}}</span><br>';
    contentStr += '<span class="mt-5" id="complete-address">{{$a->complete_address}}. </span><span id="additional-info">{{$a->additional_info}}</span><br>';
    contentStr += '<span id="sub-district">{{$a->sub_district}}, </span>';
    contentStr += '<span id="city">{{$a->city}}</span><br>';
    contentStr += '<span id="provence">{{$a->provence}}, </span>';
    contentStr += '<span id="zip-code">{{$a->zip_code}}</span><br>';
    contentStr += '<span id="phone">{{$a->phone}}</span>';
    $('#address-info').html(contentStr);
    $('#recepient').text('{{$a->full_name}}');
  });
  @endforeach
});
</script>
@endsection
