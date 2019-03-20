@extends('layouts.master')

@section('title', 'Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="d-flex justify-content-between align-items-center">
	          <h4 class="h4"><b>Product Categories</b></h4>
	          <button id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add Category</button>
	        </div>
          <div class="mt-3">
            <table id="categories-table" class="table table-bordered mb-3">
						  <thead>
						    <tr>
						      <th class="text-center">#</th>
						      <th class="text-center">Base Category</th>
									<th class="text-center">Nama Kategori</th>
						      <th class="text-center">Tanggal Dibuat</th>
						      <th class="text-center">Pilihan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach ($productCategories as $productCategory)
							    <tr>
							      <td class="text-center text-dark">{{ $loop->iteration }}</td>
							      <td class="text-center text-dark">{{ $productCategory->base_category }}</td>
										<td class="text-center text-dark">{{ $productCategory->name }}</td>
							      <td class="text-center text-dark">{{ $productCategory->created_at->toFormattedDateString() }}</td>
							      <td>
							      	<div class="d-flex justify-content-center">
								      	<button class="btnEdit btn btn-warning mr-3" data-toggle="modal" data-target="#modalEdit" 
								      					data-id="{{ $productCategory->id }}"
				                				data-name="{{ $productCategory->name }}"
				                				data-base-category="{{ $productCategory->base_category }}">Ubah</button>
					              <button class="btnDelete btn btn-danger" data-toggle="modal" data-target="#modalDelete" 
                                data-id="{{ $productCategory->id }}"
                                data-name="{{ $productCategory->name }}">Hapus</button>
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
      var baseUrl = window.location.origin;
      
      // Datatables
      $('#categories-table').DataTable();

      // Edit Category
      $('#categories-table').on('click', '.btnEdit', function() {
        $('#formEdit').attr('action', baseUrl + '/manage/productCategories/' + $(this).data('id'));
        $('#modalEdit #base_category').val($(this).data('base-category'));
        $('#modalEdit #name').val($(this).data('name'));

        $('#modalEdit').on('hide.bs.modal', function () {
          $('#formEdit').attr('action', '');
          $('#modalEdit #base_category').val('');
          $('#modalEdit #name').val('');
        });
      });

      // Delete Category
      $('#categories-table').on('click', '.btnDelete' ,function() {
        $('#formDelete').attr('action', baseUrl + '/manage/productCategories/' + $(this).data('id'));
        $('#itemName').text($(this).data('name'));

        $('#modalDelete').on('hide.bs.modal', function () {
          $('#formDelete').attr('action', '');
          $('#itemName').text('');
        });
      });
    });
  </script>
@endsection
