@extends('layouts.manage')

@section('title', 'Sunting Alamat')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-8">
      	<form action="{{ route('address.update', $address->id) }}" method="post" class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span>Sunting Alamat</span>
            <div>
              <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Batal</a>
              <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
          </div>
          <div class="card-body">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="form-group col col-md-6">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" value="{{ $address->full_name }}" required>
                @if ($errors->has('full_name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('full_name') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="phone">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ $address->phone }}" required>
                @if ($errors->has('phone'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="address_name">Nama Alamat</label>
                <input type="text" name="address_name" id="address_name" class="form-control{{ $errors->has('address_name') ? ' is-invalid' : '' }}" value="{{ $address->address_name }}" required>
                @if ($errors->has('address_name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address_name') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-6">
                <label for="zip_code">Kode Pos</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ $address->zip_code }}" required>
                @if ($errors->has('zip_code'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-4">
                <label for="provence">Provinsi</label>
                <select name="provence" id="provence" class="form-control{{ $errors->has('provence') ? ' is-invalid' : '' }}" required>
                  <option selected disabled>Pilih Provinsi</option>
                  <option value="Provinsi 1" {{ $address->provence == 'Provinsi 1' ? 'selected' : '' }}>Provinsi 1</option>
                  <option value="Provinsi 2" {{ $address->provence == 'Provinsi 2' ? 'selected' : '' }}>Provinsi 2</option>
                  <option value="Provinsi 3" {{ $address->provence == 'Provinsi 3' ? 'selected' : '' }}>Provinsi 3</option>
                </select>
                @if ($errors->has('provence'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('provence') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-4">
                <label for="city">Kota/Kabupaten</label>
                <select name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" required>
                  <option selected disabled>Pilih Kota/Kabupaten</option>
                  <option value="Kota/Kabupaten 1" {{ $address->city == 'Kota/Kabupaten 1' ? 'selected' : '' }}>Kota/Kabupaten 1</option>
                  <option value="Kota/Kabupaten 2" {{ $address->city == 'Kota/Kabupaten 2' ? 'selected' : '' }}>Kota/Kabupaten 2</option>
                  <option value="Kota/Kabupaten 3" {{ $address->city == 'Kota/Kabupaten 3' ? 'selected' : '' }}>Kota/Kabupaten 3</option>
                </select>
                @if ($errors->has('city'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('city') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-md-4">
                <label for="sub_district">Kecamatan</label>
                <select name="sub_district" id="sub_district" class="form-control{{ $errors->has('sub_district') ? ' is-invalid' : '' }}" required>
                  <option selected disabled>Pilih Kecamatan</option>
                  <option value="Kecamatan 1" {{ $address->sub_district == 'Kecamatan 1' ? 'selected' : '' }}>Kecamatan 1</option>
                  <option value="Kecamatan 2" {{ $address->sub_district == 'Kecamatan 2' ? 'selected' : '' }}>Kecamatan 2</option>
                  <option value="Kecamatan 3" {{ $address->sub_district == 'Kecamatan 3' ? 'selected' : '' }}>Kecamatan 3</option>
                </select>
                @if ($errors->has('sub_district'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sub_district') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-12">
                <label for="complete_address">Alamat Lengkap</label>
                <textarea name="complete_address" id="complete_address" class="form-control{{ $errors->has('complete_address') ? ' is-invalid' : '' }}">{{ $address->complete_address }}</textarea>
                @if ($errors->has('complete_address'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('complete_address') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group col col-12 mb-0">
                <label for="additional_info">Info Tambahan</label>
                <textarea name="additional_info" id="additional_info" class="form-control{{ $errors->has('additional_info') ? ' is-invalid' : '' }}">{{ $address->additional_info }}</textarea>
                @if ($errors->has('additional_info'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('additional_info') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection