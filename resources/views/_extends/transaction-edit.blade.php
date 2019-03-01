<div id="modalEdit" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <form action="" method="post" id="formEdit">
          <h4 class="h4">Update Transaction</h4>
          <div>
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Kode Transaksi</label>
              <input type="text" name="id" id="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" required readonly>
              @if ($errors->has('id'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('id') }}</strong>
                </span>
              @endif
            </div>

            <div class="row">
              <div class="form-group col col-md-6">
                <label for="price">Status Transaksi</label>
                <select type="text" name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" value="{{-- $product->price --}}" required>
                  <option disabled selected>Pilih Status</option>
                  <option value="Barang Dikirm">Barang Dikirim</option>
                  <option value="Transaksi Dibatalkan">Transaksi Dibatalkan</option>
                </select>
                @if ($errors->has('status'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('status') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="stock">Resi Pengiriman</label>
                <input type="text" name="reciept" id="reciept" class="form-control{{ $errors->has('reciept') ? ' is-invalid' : '' }}" placeholder="Ex: 12345678" required>
                @if ($errors->has('reciept'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('reciept') }}</strong>
                  </span>
                @endif
              </div>
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
