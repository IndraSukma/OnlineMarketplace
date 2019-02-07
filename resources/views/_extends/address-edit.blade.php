<!-- Modal Edit Address -->
<div class="modal fade" id="modalEditAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header blue-gradient">
        <h5 class="modal-title" id="exampleModalLabel">
          <b class="text-white">
            Edit Address
          </b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form action="" method="post" id="formEditAddress">
            <div class="card-body">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="form-group col col-md-6">
                  <label for="full_name">Nama Lengkap</label>
                  <input type="text" name="full_name" id="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" value="{{-- $address->full_name --}}" required>
                  @if ($errors->has('full_name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('full_name') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-6">
                  <label for="phone">Nomor Telepon</label>
                  <input type="text" name="phone" id="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{-- $address->phone --}}" required>
                  @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-6">
                  <label for="address_name">Nama Alamat</label>
                  <input type="text" name="address_name" id="address_name" class="form-control{{ $errors->has('address_name') ? ' is-invalid' : '' }}" value="{{-- $address->address_name --}}" required>
                  @if ($errors->has('address_name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('address_name') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-6">
                  <label for="zip_code">Kode Pos</label>
                  <input type="text" name="zip_code" id="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{-- $address->zip_code --}}" required>
                  @if ($errors->has('zip_code'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('zip_code') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-12">
                  <label for="provence">Provinsi</label>
                  <select type="text" name="provence" id="provence" class="selectpicker form-control{{ $errors->has('provence') ? ' is-invalid' : '' }}" required>
                    <option selected disabled>Pilih Provinsi</option>
                    @foreach($provinces as $provence)
                    <option value="{{$provence->id}}">{{$provence->name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('provence'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('provence') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-12">
                  <label for="city">Kota/Kabupaten</label>
                  <select type="text" name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" required>
                    <option selected disabled>Pilih Kota/Kabupaten</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('city'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-12">
                  <label for="sub_district">Kecamatan</label>
                  <input type="text" name="sub_district" id="sub_district" class="form-control{{ $errors->has('sub_district') ? ' is-invalid' : '' }}" required>
                  @if ($errors->has('sub_district'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('sub_district') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-12">
                  <label for="complete_address">Alamat Lengkap</label>
                  <textarea name="complete_address" id="complete_address" class="form-control{{ $errors->has('complete_address') ? ' is-invalid' : '' }}">{{-- $address->complete_address --}}</textarea>
                  @if ($errors->has('complete_address'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('complete_address') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-12 mb-0">
                  <label for="additional_info">Info Tambahan</label>
                  <textarea name="additional_info" id="additional_info" class="form-control{{ $errors->has('additional_info') ? ' is-invalid' : '' }}">{{-- $address->additional_info --}}</textarea>
                  @if ($errors->has('additional_info'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('additional_info') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="float-right">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
