{{-- <div id="modalEdit" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <form action="" method="post" id="formEdit">
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
                    <option value="{{ $productCategory->id }}">
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
                <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value=" $product->pric}}" required>
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
</div> --}}

<div id="modalEdit" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post" class="modal-content" id="formEdit" style="margin-top: 100px;">
      <div class="modal-header border-bottom-0">
        <h3 class="modal-title">Edit Data</h3>
      </div>
      <div class="modal-body pt-0">
        @csrf
        @method('PUT')
        <div class="mb-2">
          <label class="mb-1">Gambar Produk</label>
          <div class="row px-2">
            <div class="col-6 col-lg-3 p-2 animated fadeIn faster" id="btnUploadImage" style="display: none;">
              <div class="button-box">
                <div class="btn-upload">
                  <div class="text">
                    <i class="mdi mdi-upload mdi-48px"></i>
                    <small>Maksimal 4 gambar</small>
                  </div>
                  <input type="file" id="productImageInput" accept="image/x-png,image/gif,image/jpeg" multiple data-modal-id="#modalEdit" />
                </div>
              </div>
            </div>
            <input type="hidden" name="product_images" id="productImages" />
            <input type="hidden" name="product_thumbnail" id="productThumbnail" />
          </div>
        </div>
        <div class="form-group">
          <label for="name">Nama Produk</label>
          <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{-- $product->name --}}" required>
          @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>

        <div class="row">
          <div class="form-group col-12 col-md-6">
            <label for="category">Kategori</label>
            <select name="category" id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" required>
              <option selected disabled>Pilih Kategori</option>
              @foreach ($productCategories as $productCategory)
                <option value="{{ $productCategory->id }}">
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

          <div class="form-group col-12 col-md-6">
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
          <div class="form-group col-12 col-md-4">
            <label for="price">Harga</label>
            <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{-- $product->price --}}" required>
            @if ($errors->has('price'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('price') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-12 col-md-4">
            <label for="stock">Stok</label>
            <input type="text" name="stock" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{-- $product->stock --}}" required>
            @if ($errors->has('stock'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('stock') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-12 col-md-4">
            <label for="weight">Berat</label>
            <input type="text" name="weight" id="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{-- $product->weight --}}" required>
            @if ($errors->has('weight'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('weight') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group mb-0">
          <label for="description">Deskripsi</label>
          <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3">{{-- $product->description --}}</textarea>

          @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" data-form-id="#formEdit">Save</button>
      </div>
    </form>
  </div>
</div>