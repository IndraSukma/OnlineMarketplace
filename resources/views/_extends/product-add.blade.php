<!-- Modal Add -->

{{-- <div id="modalAdd" class="modal" tabindex="-1" role="dialog">
  <h4 class="h4 font-bold mb-3">Add Product</h4>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{ route('products.store') }}" method="post">
        <div class="card-body">
          @csrf
          <div class="mb-3">
            <label class="mb-1">Gambar Produk</label>
            <div class="row px-2">
              <div class="col-sm-6 col-lg-3 p-2">
                <div class="image-box" id="sample" style="background: #F5F6F7 url('{{ asset('img/product-img/product-1.jpeg') }}') no-repeat center; background-size: contain;">
                  <div class="actions">
                    <a href="#"><i class="mdi mdi-24px mdi-check-circle-outline"></i></a>
                    <a href="#" class="btnSetThumbnail"><i class="mdi mdi-24px mdi-light mdi-radiobox-blank"></i></a>
                    <div>
                      <a href="#" class="btnEditImage"><i class="mdi mdi-24px mdi-light mdi-pencil-outline"></i></a>
                      <a href="#" class="btnRemoveImage"><i class="mdi mdi-24px mdi-light mdi-delete-outline"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 p-2" id="btnUploadImage">
                <div class="image-box">
                  <div class="btn-upload">
                    <div class="text">
                      <i class="mdi mdi-upload mdi-48px"></i>
                      <small>Maksimal 4 gambar</small>
                    </div>
                    <input type="file" name="product-image" id="productImageInput" accept="image/*" multiple required />
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <div class="form-group col-md-6">
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

            <div class="form-group col-md-6">
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
            <div class="form-group col-md-6">
              <label for="price">Harga</label>
              <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
              @if ($errors->has('price'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('price') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group col-md-6">
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
            <button type="button" id="btnClose" class="btn btn-secondary">Discard</button>
            <button type="submit" class="btn btn-primary">Save Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div> --}}

<div id="modalAdd" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{ route('products.store') }}" method="post" class="modal-content" id="formAdd" style="margin-top: 100px;">
      <div class="modal-header border-bottom-0">
        <h3 class="modal-title">Add Product</h3>
      </div>
      <div class="modal-body pt-0">
        @csrf
        <div class="mb-2">
          <label class="mb-1">Gambar Produk</label>
          <div class="row px-2">
            <div class="col-6 col-lg-3 p-2 animated fadeIn faster" id="btnUploadImage">
              <div class="button-box">
                <div class="btn-upload">
                  <div class="text">
                    <i class="mdi mdi-upload mdi-48px"></i>
                    <small>Maksimal 4 gambar</small>
                  </div>
                  <label class="invisible-file-input">
                    <input type="file" id="productImageInput" accept="image/x-png,image/gif,image/jpeg" multiple data-modal-id="#modalAdd" />
                  </label>
                </div>
              </div>
            </div>
            <input type="hidden" name="product_images" id="productImages" />
            <input type="hidden" name="product_thumbnail" id="productThumbnail" />
          </div>
        </div>
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
          <div class="form-group col-12 col-md-6">
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
            <input type="text" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
            @if ($errors->has('price'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('price') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-12 col-md-4">
            <label for="stock">Stok</label>
            <input type="text" name="stock" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock') }}" required>
            @if ($errors->has('stock'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('stock') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-12 col-md-4">
            <label for="weight">Berat</label>
            <input type="text" name="weight" id="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{ old('weight') }}" required>
            @if ($errors->has('weight'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('weight') }}</strong>
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
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" data-form-id="#formAdd">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- /.ModalAdd -->