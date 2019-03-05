@extends('layouts.master')

@section('title', 'Transaksi - '. $order->id)

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="d-flex justify-content-between align-items-center mb-4">
	          <h5 class="h5"><b>Detail Transaksi</b></h5>
	          <div class="d-flex">
              <button class="btn btn-danger btn-sm btnEdit"
              data-id="{{$order->id}}"
              data-status="{{$order->status}}"
              data-reciept="{{$order->delivery_reciept}}">Update Transaksi</button>
            </div>
	        </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Kode Transaksi</th>
                      <th class="text-center">Atas Nama</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Resi Pengiriman</th>
                      <th class="text-center">Total Tagihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-dark text-center">{{$order->id}}</td>
                      <td class="text-dark text-center">
                        <a href="#" class="text-primary">
                          <b>{{$order->user->name}}</b>
                        </a>
                      </td>
                      <td class="text-center text-dark">
                        @if($order->status == 'Menunggu Konfimasi Transfer')
                        <span class="text-danger">{{$order->status}}</span>
                        @else
                        <span class="text-warning">{{$order->status}}</span>
                        @endif
                      </td>
                      <td class="text-dark text-center">
                        @if(is_null($order->delivery_reciept))
                        Resi Belum Diisi
                        @else
                        {{$order->delivery_reciept}}
                        @endif
                      </td>
                      <td class="text-dark text-center">Rp. {{number_format($order->total_price, 2, ',', '.')}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-sm-12 table-responsive">
                <h5 class="h5"><b>Detail Pembayaran</b></h5>
                <hr>
                @if(empty($payment->id))
                <div class="card">
                  <div class="card-body">
                    <p class="lead text-danger">Belum Melakukan Pembayaran</p>
                  </div>
                </div>
                @else
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center text-dark">Transfer Ke Bank</th>
                      <th class="text-center text-dark">Dibayar Oleh</th>
                      <th class="text-center text-dark">Tanggal Pembayaran</th>
                      <th class="text-center text-dark">Total Pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center text-dark">{{$payment->bank}}</td>
                      <td class="text-center text-dark">{{$payment->paid_by}}</td>
                      <td class="text-center text-dark">{{$payment->day_of_pay . '-' . $payment->month_of_pay . '-' . $payment->year_of_pay }}</td>
                      <td class="text-center text-dark">Rp. {{number_format($payment->total_payment, 2, ',', '.')}}</td>
                    </tr>
                  </tbody>
                </table>
                @endif
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-sm-12 table-responsive">
                <h5 class="h5"><b>Detail Product</b></h5>
                <hr>
                <table class="table table-bordered mt-3">
                  <thead>
                    <tr>
                      <th class="text-center text-dark">Nama Produck</th>
                      <th class="text-center text-dark">Jumlah Barang</th>
                      <th class="text-center text-dark">Catatan Product</th>
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
                      <td class="text-center text-dark align-middle">{{$item->quantity}}</td>
                      <td class="text-center text-dark align-middle">{{$item->note}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-title">
                    <h5 class="h5"><b>Alamat Pengiriman</b></h5>
                  </div>
                  <div class="card-body">
                    <span class="text-dark" >{{$order->address->full_name}}</span><br>
                    <span class="text-dark" >{{$order->address->address_name}}</span><br>
                    <span class="text-dark">{{$order->address->complete_address}}. <br></span><span class="text-dark">{{$order->address->additional_info}}</span><br>
                    <span class="text-dark" >{{$order->address->sub_district}}, </span>
                    <span class="text-dark" >{{$order->address->city->name}}</span><br>
                    <span class="text-dark" >{{$order->address->province->name}}, </span>
                    <span class="text-dark" >{{$order->address->zip_code}}</span><br>
                    <span class="text-dark" >{{$order->address->phone}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('_extends.transaction-edit')

@endsection

@section('scripts')
	<script>
    $(document).ready(function () {
      // Modal
      var modal = new tingle.modal();

      // Edit Category
      $('.btnEdit').click(function() {
        var content = $('#modalEdit').html();
        modal.setContent(content);

        $('#formEdit').attr('action', '/manage/orders/' + $(this).data('id'));
        $('#id').val($(this).data('id'));
        //$('#name').val($(this).data('name'));

        modal.open();
      });

      // Close Modal
       $('#btnClose').click(function() {
         modal.close();
       });
    });
  </script>
@endsection
