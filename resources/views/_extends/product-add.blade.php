<!-- Modal Add -->
<div id="modalAddProduct" class="modal" tabindex="-1" role="dialog">
  <h4 class="h4 font-bold">Add Product</h4>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{ route('products.store') }}" method="post">
        <div class="card-body">
          @csrf
          <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
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
                  <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
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
                <option value="Baru">Baru</option>
                <option value="Bekas">Bekas</option>
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
              <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
              @if ($errors->has('price'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('price') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group col col-md-6">
              <label for="stock">Stok</label>
              <input type="text" name="stock" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock') }}" required>
              @if ($errors->has('stock'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('stock') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group mb-0">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="mt-5">
          <div class="float-right">
            <button type="button" id="btnCloseModalAddProduct" class="btn btn-secondary">Discard</button>
            <button type="submit" class="btn btn-primary">Save Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.ModalAdd -->
