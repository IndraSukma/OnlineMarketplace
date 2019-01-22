@extends('layouts.master')

@section('title', 'Tambah Kategori Produk')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-6">
      	<form action="{{ route('productCategories.update', $productCategory->id) }}" method="post" class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Tambah Kategori Produk</span>
	          <div>
              <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Kembali</a>
              <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
            </div>
	        </div>
          <div class="card-body">
						@csrf
            @method('PUT')
            <div class="form-group mb-0">
              <label for="name">Nama Kategori</label>
              <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $productCategory->name }}" required>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
