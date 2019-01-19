<div id="modalEditProduct{{$product->id}}" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <form action="{{ route('products.update', $product->id) }}" method="post">
          <h4 class="h4">Edit Data</h4>
          <div>
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
                  <option value="New" {{ $product->condition == 'New' ? 'selected' : '' }}>New</option>
                  <option value="Refurbish" {{ $product->condition == 'Refurbish' ? 'selected' : '' }}>Refurbish</option>
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
          <div class="mt-3">
            <div class="float-right">              
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
