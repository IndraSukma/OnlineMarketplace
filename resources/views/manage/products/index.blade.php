@extends('layouts.master')

@section('title', 'Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
				<div class="card">
					<div class="row">
						<div class="col">
							<h4 class="card-title">Product Data</h4>
						</div>
						<div class="col">
							<button id="btnAddProduct" class="btn btn-primary float-right" type="button">Add Item</button>
						</div>
					</div>
				  <div class="card-body p-0">
				    <table class="table mb-3 table-bordered" id="products-table">
				      <thead>
				        <tr>
				          <th class="text-center border-top-0">#</th>
				          <th class="text-center border-top-0">Nama</th>
				          <th class="text-center border-top-0">Harga</th>
				          <th class="text-center border-top-0">Kategori</th>
				          <th class="text-center border-top-0">Kondisi</th>
				          <th class="text-center border-top-0">Stock</th>
				          <th class="text-center border-top-0">Tanggal Ditambahkan</th>
				          <th class="text-center border-top-0">Pilihan</th>
				        </tr>
				      </thead>
				      <tbody>
				        @foreach ($products as $product)
				          <tr>
				            <th>{{ $loop->iteration }}</th>
				            <td>
				              <span title="{{ $product->name }}" class="text-dark">
				                {{ substr(strip_tags($product->name), 0, 10) }}
				                {{ strlen(strip_tags($product->name)) > 10 ? '...' : '' }}
				              </span>
				            </td>
				            <td class="text-dark">{{ $product->price }}</td>
				            <td class="text-dark">{{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</td>
				            <td class="text-dark">{{ $product->condition }}</td>
				            <td class="text-dark">{{ $product->stock }}</td>
				            <td class="text-dark">{{ $product->created_at->toFormattedDateString() }}</td>
				            <td>
				              <div class="d-flex justify-content-center">
				                <button id="btnShowProduct{{$product->id}}" class="btn btn-primary ">Show</button>
				                <button id="btnEditProduct{{$product->id}}" class="btn btn-warning mx-1">Edit</button>
				                <form action="{{ route('products.destroy', $product->id) }}" method="post">
				                  @csrf
				                  @method('DELETE')
				                  <button type="submit" class="btn btn-danger">Delete</button>
				                </form>
				              </div>
				            </td>
				          </tr>
				        @endforeach
				      </tbody>
				    </table>
				  </div>

					@include('_extends.product-add')

					@foreach($products as $product)
						@include('_extends.product-show')
					@endforeach

					@foreach($products as $product)
						@include('_extends.product-edit')
					@endforeach
				</div>
      </div>
    </div>
  </div>

@endsection
