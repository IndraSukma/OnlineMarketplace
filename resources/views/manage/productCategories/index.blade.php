@extends('layouts.master')

@section('title', 'Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="d-flex justify-content-between align-items-center">
	          <h4 class="h4"><b>Product Categories</b></h4>
	          <button type="button" id="btnAddCategory" class="btn btn-primary">Add Category</button>
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
								      	<button id="btnEditCategory{{$productCategory->id}}" class="btn btn-warning mr-3">Ubah</button>
								      	<form action="{{ route('productCategories.destroy', $productCategory->id) }}" method="post">
					                @csrf
					                @method('DELETE')
					                <button type="submit" class="btn btn-danger">Hapus</button>
					              </form>
							      	</div>
							      </td>
							    </tr>
						  	@endforeach
						  </tbody>
						</table>
          </div>

					@include('_extends.category-add')

					@foreach($productCategories as $productCategory)
					@include('_extends.category-edit')
					@endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
