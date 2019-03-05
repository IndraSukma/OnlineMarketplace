@extends('layouts.master')

@section('title', 'Transaction List')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="d-flex align-items-center">
	          <h4 class="h4"><b>Daftar Tranasaksi</b></h4>
	        </div>
          <div class="mt-3">
            <table id="categories-table" class="table table-bordered mb-3">
						  <thead>
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Kode Transaksi</th>
									<th class="text-center">Status</th>
						      <th class="text-center">Tanggal Transaksi</th>
						      <th class="text-center">Pilihan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach ($orders as $order)
							    <tr>
							      <td class="text-center text-dark">{{ $loop->iteration }}</td>
							      <td class="text-center text-dark">{{ $order->id }}</td>
										<td class="text-center text-dark">
                      @if($order->status == 'Menunggu Konfimasi Transfer')
                      <span class="text-danger">{{$order->status}}</span>
                      @else
                      <span class="text-primary">{{$order->status}}</span>
                      @endif
                    </td>
							      <td class="text-center text-dark">{{ $order->created_at->toFormattedDateString() }}</td>
							      <td>
							      	<div class="d-flex justify-content-center">
								      	<a class="btn btn-warning mr-3" href="{{route('orders.show', $order->id)}}">Detail</a>
					              <button class="btnDelete btn btn-danger" data-id="{{ $order->id }}">Update</button>
							      	</div>
							      </td>
							    </tr>
						  	@endforeach
						  </tbody>
						</table>
          </div>

					@include('_extends.category-add')
					@include('_extends.category-edit')
					@include('_extends.delete')
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
	<script>
    $(document).ready(function () {
      // Modal
      var modal = new tingle.modal();

      // Add Category
      $('#btnAdd').click(function() {
        var content = $('#modalAdd').html();
        modal.setContent(content);
        modal.open();
      });

      // Edit Category
      $('.btnEdit').click(function() {
        var content = $('#modalEdit').html();
        modal.setContent(content);

        $('#formEdit').attr('action', '/manage/productCategories/' + $(this).data('id'));
        $('#base_category').val($(this).data('base-category'));
        $('#name').val($(this).data('name'));

        modal.open();
      });

      // Delete Category
      $('.btnDelete').click(function() {
        var content = $('#modalDelete').html();
        modal.setContent(content);

        $('#formDelete').attr('action', '/manage/productCategories/' + $(this).data('id'));

        modal.open();
      });

      // Close Modal
      // $('#btnClose').click(function() {
      //   modal.close();
      // });

      // Datatables
      $('#categories-table').DataTable();
    });
  </script>
@endsection
