@extends('layouts.app')

@section('title', 'Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Produk</span>
	          <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Tambah Produk</a>
	        </div>
          <div class="card-body p-0">
            <table class="table mb-0">
						  <thead>
						    <tr>
						      <th class="border-top-0">#</th>
						      <th class="border-top-0">Nama</th>
						      <th class="border-top-0">Harga</th>
						      <th class="border-top-0">Deskripsi</th>
						      <th class="border-top-0">Kategori</th>
						      <th class="border-top-0">Kondisi</th>
						      <th class="border-top-0">Dilihat</th>
						      <th class="border-top-0">Stock</th>
						      <th class="border-top-0">Tanggal Dibuat</th>
						      <th class="border-top-0">Pilihan</th>
						    </tr>
						  </thead>
						  <tbody>
						    @foreach ($products as $product)
						    	<tr>
							      <th>{{ $loop->iteration }}</th>
							      <td>
							      	<span title="{{ $product->name }}">
							      		{{ substr(strip_tags($product->name), 0, 10) }}
							      		{{ strlen(strip_tags($product->name)) > 10 ? '...' : '' }}
							      	</span>
							      </td>
							      <td>{{ $product->price }}</td>
							      <td>
							      	<span title="{{ $product->description }}">
												{{ substr(strip_tags($product->description), 0, 15) }}
								      	{{ strlen(strip_tags($product->description)) > 15 ? '...' : '' }}
							      	</span>
							      </td>
							      <td>{{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</td>
							      <td>{{ $product->condition }}</td>
							      <td>{{ $product->views }}</td>
							      <td>{{ $product->stock }}</td>
							      <td>{{ $product->created_at->toFormattedDateString() }}</td>
							      <td>
							      	<div class="d-flex">
							      		<a href="{{ route('products.show', $product->id) }}" class="btn btn-light btn-sm">Lihat</a>
								      	<a href="{{ route('products.edit', $product->id) }}" class="btn btn-light btn-sm mx-1">Ubah</a>
								      	<form action="{{ route('products.destroy', $product->id) }}" method="post">
					                @csrf
					                @method('DELETE')
					                <button type="submit" class="btn btn-light btn-sm">Hapus</button>
					              </form>
							      	</div>
							      </td>
							    </tr>
						    @endforeach
						  </tbody>
						</table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection