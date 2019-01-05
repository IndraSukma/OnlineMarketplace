@extends('layouts.app')

@section('title', 'Alamat')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-8">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Alamat</span>
            <div class="d-flex">
              <a href="{{ route('address.edit', $address->id) }}" class="btn btn-primary btn-sm mx-1">Ubah</a>
              <form action="{{ route('address.destroy', $address->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </div>
	        </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-12">
                <dl>
                  <dt>Nama Lengkap</dt>
                  <dd>{{ $address->full_name }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Nomor Telepon</dt>
                  <dd>{{ $address->phone }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Nama Alamat</dt>
                  <dd>{{ $address->complete_address }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Kode Post</dt>
                  <dd>{{ $address->zip_code }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Provinsi</dt>
                  <dd>{{ $address->provence }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Kota/Kabupaten</dt>
                  <dd>{{ $address->city }}</dd>
                </dl>
              </div>
              <div class="col col-md-4">
                <dl>
                  <dt>Kecamatan</dt>
                  <dd>{{ $address->sub_district }}</dd>
                </dl>
              </div>
              <div class="col col-12">
                <dl>
                  <dt>Alamat Lengkap</dt>
                  <dd>{{ $address->complete_address }}</dd>
                </dl>
              </div>
              <div class="col col-12">
                <dl>
                  <dt>Info Tambahan</dt>
                  <dd>{{ $address->additional_info }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection