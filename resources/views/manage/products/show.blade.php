@extends('layouts.master')

@section('title', $product->name.' - Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Produk</span>
	          <div class="d-flex">
              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm mx-1">Ubah</a>
              <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </div>
	        </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-md-4">
                <dl>
                  <dt>Nama Produk</dt>
                  <dd>{{ $product->name }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Stok</dt>
                  <dd>{{ $product->stock }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Jumlah Dilihat</dt>
                  <dd>{{ is_null($product->views) ? 'Belum ada yang melihat.' : $product->views }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Kategori</dt>
                  <dd>{{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Kondisi</dt>
                  <dd>{{ $product->condition }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Harga</dt>
                  <dd>{{ $product->price }}</dd>
                </dl>
              </div>
              <div class="col">
                <dl>
                  <dt>Deskripsi</dt>
                  <dd>{{ $product->description }}</dd>
                </dl>
              </div>
              {{-- <div class="col">
                <dl>
                  <dt>Ulasan</dt>
                  <dd>Belum ada ulasan.</dd>
                </dl>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
