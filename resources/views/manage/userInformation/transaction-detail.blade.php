@extends('layouts.manage')

@section('title', 'Transaction Detail')

@section('content')
	<div class="container mt-5">
		<h5><i class="mdi mdi-account-outline mr-2"></i>{{ $user->name }}</h5>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link" id="pills-home-tab" href="{{route('user.index')}}">Profile</a>
						  </li>
						  <li class="nav-item ml-2">
						    <a class="nav-link" href="{{route('manage.address')}}">Address List</a>
						  </li>
              <li class="nav-item ml-2">
						    <a class="nav-link active" href="{{route('manage.transaction')}}">Transaction List</a>
						  </li>
						</ul>
						<hr>
						<div class="tab-content pt-3" id="pills-tabContent">
						  <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<div class="row">
									<div class="col-sm-12">
                    <table class="table mb-3" id="address-table">
                      <thead>
                        <tr>
                          <th class="text-center pt-0 border-top-0">Transaction Code</th>
                          <th class="text-center pt-0 border-top-0">Status</th>
                          <th class="text-center pt-0 border-top-0">Delivery Reciept</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center align-middle font-weight-bold">{{$orders->id}}</td>
                          <td class="text-center align-middle">{{$orders->status}}</td>
                          <td class="text-center align-middle">
                            @if(is_null($orders->delivery_reciept))
                            Menunggu Konfirmasi
                            @else
                            {{$orders->delivery_reciept}}
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                    <table class="table table-bordered mb-3" id="address-table">
                      <thead>
                        <tr>
                          <th class="text-center align-middle ">Product Name</th>
                          <th class="text-center align-middle ">Quantity</th>
                          <th class="text-center align-middle ">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $item)
                        <tr>
                          <td class="text-center align-middle font-weight-bold">
                            <a href="{{ route('products.detail', $item->product->slug) }}" class="text-primary">
                              {{$item->product->name}}
                            </a>
                          </td>
                          <td class="text-center align-middle">{{$item->quantity}}</td>
                          <td class="text-center align-middle">Rp. {{number_format($item->single_price * $item->quantity, 2, ',', '.')}}</td>
                        </tr>
                        @endforeach

                        <tr>
                          <td colspan="2" class="text-center align-middle font-weight-bold">Total</td>
                          <td class="text-center align-middle font-weight-bold">Rp. {{number_format($orders->total_price, 2, ',', '.')}}</td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                    <div class="float-right">
											@if($orders->status != 'Menunggu Pengiriman Barang')
											<button class="btn peach-gradient btn-md" data-toggle="modal" data-target="#modalConfirmPayment{{$orders->id}}">Confirm Payment</button>
											@else
											<button class="btn peach-gradient btn-md">Confirm Item</button>
											@endif
                    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('_extends.confirm-transcation')

@endsection

@section('scripts')
	<script>
  </script>
@endsection
