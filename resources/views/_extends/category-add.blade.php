{{-- <div id="modalAdd" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <h4 class="h4">
      <b>Add Category</b>
    </h4>
  	<form action="{{ route('productCategories.store') }}" method="post" class="py-4">
      <div class="card-body">
				@csrf
        <div class="form-group">
          <label for="base_category">Base Category</label>
          <select name="base_category" id="base_category" class="form-control{{ $errors->has('base_category') ? ' is-invalid' : '' }}" required>
            <option selected disabled>Choose Base Category</option>
            <option value="Fashion Anak">Fashion Anak</option>
            <option value="Fashion Wanita">Fashion Wanita</option>
            <option value="Fashion Pria">Fashion Pria</option>
            <option value="Olahraga">Olahraga</option>
          </select>
          @if ($errors->has('category'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('category') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group mb-3">
          <label for="name">Nama Kategori</label>
          <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
          @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="mt-3">
        <div class="float-right">
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </div>
    </form>
  </div>
</div> --}}

<div id="modalAdd" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{ route('productCategories.store') }}" method="post" class="modal-content" id="formAdd">
      <div class="modal-header border-bottom-0">
        <h3 class="modal-title">Add Category</h3>
      </div>
      <div class="modal-body pt-0">
        @csrf

        <div class="form-group">
          <label for="base_category">Base Category</label>
          <select name="base_category" id="base_category" class="form-control{{ $errors->has('base_category') ? ' is-invalid' : '' }}" required>
            <option selected disabled>Choose Base Category</option>
            <option value="Fashion Anak">Fashion Anak</option>
            <option value="Fashion Wanita">Fashion Wanita</option>
            <option value="Fashion Pria">Fashion Pria</option>
            <option value="Olahraga">Olahraga</option>
          </select>
          @if ($errors->has('category'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('category') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group mb-3">
          <label for="name">Nama Kategori</label>
          <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
          @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
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