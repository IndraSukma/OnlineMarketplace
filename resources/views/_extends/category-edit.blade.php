<div id="modalEdit" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <h4 class="h4">
      <b>Edit Category</b>
    </h4>
  	<form action="" method="post" id="formEdit">
      <div>
				@csrf
        @method('PUT')
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
        <div class="form-group">
          <label for="name">Nama Kategori</label>
          <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $productCategory->name }}" required>
          @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="float-right mb-5 mt-2">
        <div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
