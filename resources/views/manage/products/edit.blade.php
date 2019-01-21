@extends('layouts.manage')

@section('title', 'Edit Produk')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-8">
        <form action="{{ route('products.update', $product->id) }}" method="post" class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span>Edit Produk</span>
            <div>
              <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Kembali</a>
              <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
            </div>
          </div>
          <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Nama Produk</label>
              <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $product->name }}" required>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>

            <div class="row">
              <div class="form-group col col-md-6">
                <label for="category">Kategori</label>
                <select name="category" id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" required>
                  <option selected disabled>Pilih Kategori</option>
                  @foreach ($productCategories as $productCategory)
                    <option value="{{ $productCategory->id }}" {{ is_null($product->category_id) ? '' : ($productCategory->id == $product->category_id ? 'selected' : '') }}>
                      {{ $productCategory->name }}
                    </option>
                  @endforeach
                </select>
                @if ($errors->has('category'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="condition">Kondisi</label>
                <select name="condition" id="condition" class="form-control{{ $errors->has('condition') ? ' is-invalid' : '' }}" required>
                  <option selected disabled>Pilih Kondisi</option>
                  <option value="Bau" {{ $product->condition == 'Bau' ? 'selected' : '' }}>Bau</option>
                  <option value="Bau Sekali" {{ $product->condition == 'Bau Sekali' ? 'selected' : '' }}>Bau Sekali</option>
                  <option value="Bau Duakali" {{ $product->condition == 'Bau Duakali' ? 'selected' : '' }}>Bau Duakali</option>
                </select>
                @if ($errors->has('condition'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('condition') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="row">
              <div class="form-group col col-md-6">
                <label for="price">Harga</label>
                <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $product->price }}" required>
                @if ($errors->has('price'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('price') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="stock">Stok</label>
                <input type="text" name="stock" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ $product->stock }}" required>
                @if ($errors->has('stock'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('stock') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group mb-0">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3">{{ $product->description }}</textarea>
              @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection