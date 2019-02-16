@extends('layouts.manage')

@section('title', 'Profil')

@section('content')
	<div class="container mt-5">
		<h5><i class="mdi mdi-account-outline mr-2"></i>{{ $user->name }}</h5>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" href="{{ route('user.index') }}">Profile</a>
						  </li>
						  <li class="nav-item ml-2">
						    <a class="nav-link" href="{{ route('manage.address') }}">Address List</a>
						  </li>
							<li class="nav-item ml-2">
						    <a class="nav-link" href="{{ route('manage.transaction') }}">Transaction List</a>
						  </li>
						</ul>
						<hr>
						<div class="tab-content py-3" id="pills-tabContent">
						  <div class="tab-pane fade show active px-5" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="row">
									<div class="col-sm-4">
										<img src="{{ asset('img/user.jpg') }}" class="img-thumbnail w-100" alt="">
									</div>
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-6">
												<p class="mt-3"><b>Profile Data</b></p>
											</div>
											<div class="col-sm-6">
												<button type="button" class="btn btn-sm blue-gradient float-right" data-toggle="modal" data-target="#modalEditProfile"><i class=""></i>Edit Profile</button>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												Name
											</div>
											<div class="col-sm-8">
												<p class="my-0">{{ $user->name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												Date of Birth
											</div>
											<div class="col-sm-8">
												<p class="my-0">{{ $user->place_of_birth.', '.$user->day_of_birth.'-'.$user->month_of_birth.'-'.$user->year_of_birth }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												Gender
											</div>
											<div class="col-sm-8">
												<p class="my-0">{{ $user->gender }}</p>
											</div>
										</div>
										<p class="mt-4"><b>Contact Data</b></p>
										<div class="row">
											<div class="col-sm-4">
												Email
											</div>
											<div class="col-sm-8">
												<p class="my-0">{{ $user->email }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												Phone Number
											</div>
											<div class="col-sm-8">
												<p class="my-0">{{ $user->phone }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('_extends.user-edit')
	</div>
@endsection
