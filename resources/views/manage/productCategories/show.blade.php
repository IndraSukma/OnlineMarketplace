@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Kategori Produk</span>
	          <div class="d-flex">
              <a href="{{ route('productCategories.edit', $productCategory->id) }}" class="btn btn-primary btn-sm mx-1">Ubah</a>
              <form action="{{ route('productCategories.destroy', $productCategory->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </div>
	        </div>
          <div class="card-body">
						<dl>
							<dt>Nama Kategori</dt>
							<dd>{{ $productCategory->name }}</dd>
						</dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection