@extends('layouts.manage')

@section('title', 'Profil')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-8">
      	<div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
	          <span>Profil</span>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">Sunting</a>
	        </div>
          <div class="card-body">
            <h4 class="my-0">{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>
            <div class="row">
            	<div class="col-12">
            		<small>Detail</small>
            	</div>
							<div class="col">
								<dl>
									<dt>Tanggal Kelahiran</dt>
									<dd>{{ $user->place_of_birth.', '.$user->day_of_birth.'-'.$user->month_of_birth.'-'.$user->year_of_birth }}</dd>
								</dl>
							</div>
							<div class="col">
								<dl>
									<dt>Jenis Kelamin</dt>
									<dd>{{ $user->gender }}</dd>
								</dl>
							</div>
							<div class="col">
								<dl>
									<dt>Nomor Telepon</dt>
									<dd>{{ $user->phone }}</dd>
								</dl>
							</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection