@extends('layouts.manage')

@section('title', 'Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Kategori Produk</span>
	          <a href="{{ route('productCategories.create') }}" class="btn btn-primary btn-sm">Tambah Kategori</a>
	        </div>
          <div class="card-body">
            <table class="table border-bottom mb-0">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Nama</th>
						      <th>Produk</th>
						      <th>Tanggal Dibuat</th>
						      <th>Pilihan</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach ($productCategories as $productCategory)
							    <tr>
							      <td>{{ $loop->iteration }}</td>
							      <td>{{ $productCategory->name }}</td>
							      <td>Jumlah Produk</td>
							      <td>{{ $productCategory->created_at->toFormattedDateString() }}</td>
							      <td>
							      	<div class="d-flex">
							      		<a href="{{ route('productCategories.show', $productCategory->id) }}" class="btn btn-light btn-sm">Lihat</a>
								      	<a href="{{ route('productCategories.edit', $productCategory->id) }}" class="btn btn-light btn-sm mx-1">Ubah</a>
								      	<form action="{{ route('productCategories.destroy', $productCategory->id) }}" method="post">
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