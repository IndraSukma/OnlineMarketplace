@extends('layouts.master')

@section('title', 'Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="d-flex justify-content-between align-items-center">
	          <h4 class="h4"><b>Product Categories</b></h4>
	          <button type="button" id="btnAdd" class="btn btn-primary">Add Category</button>
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
								      	<button class="btnEdit btn btn-warning mr-3"
								      					data-id="{{ $productCategory->id }}"
				                				data-name="{{ $productCategory->name }}"
				                				data-base-category="{{ $productCategory->base_category }}">Ubah</button>
					              <button class="btnDelete btn btn-danger" data-id="{{ $productCategory->id }}">Hapus</button>
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
