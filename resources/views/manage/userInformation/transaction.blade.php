@extends('layouts.manage')

@section('title', 'Transaction')

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
                    @if($orders->count() == 0)
                    <div class="row  mt-5 mb-5">
                      <div class="col-sm text-center">
                        <h5 class="text-center">You don't have any Transactions</h5>
                        <a href="{{route('home')}}" class="btn btn-sm aqua-gradient">Start Shopping</a>
                      </div>
                    </div>
                    @else
                    <table class="table mb-3" id="address-table">
                      <thead>
                        <tr>
                          <th class="text-center pt-0 border-top-0">Transaction Code</th>
                          <th class="text-center pt-0 border-top-0">Total bill</th>
                          <th class="text-center pt-0 border-top-0">Status</th>
                          <th class="text-center pt-0 border-top-0">Delivery Reciept</th>
                          <th class="text-center pt-0 border-top-0 pr-4 pb-2">

                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                        <tr>
                          <td class="text-center align-middle">{{$order->id}}</td>
                          <td class="text-center align-middle font-weight-bold">Rp. {{number_format($order->total_price, 2, ',', '.')}}</td>
                          <td class="text-center align-middle">{{$order->status}}</td>
                          <td class="text-center align-middle">
                            @if(is_null($order->delivery_reciept))
                            Menunggu Konfirmasi
                            @else
                            {{$order->delivery_reciept}}
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            <a class="btn btn-primary btn-sm blue-gradient border-0" href="{{ route('manage.transactionDetail', $order->id) }}">Order Details</a>
														@if($order->status != 'Menunggu Pengiriman Barang')
														<button class="btn peach-gradient btn-sm" data-toggle="modal" data-target="#modalConfirmPayment{{$order->id}}">Confirm Payment</button>
														@else
														<button class="btn peach-gradient btn-sm">Confirm Item</button>
														@endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
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

	@foreach($orders as $orders)
	@include('_extends.confirm-transcation')
	@endforeach

@endsection

@section('scripts')
	<script>
  </script>
@endsection
