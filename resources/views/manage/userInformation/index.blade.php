@extends('layouts.manage')

@section('title', 'Profil')

@section('content')

<div class="container mt-5">
	<h5><i class="mdi mdi-account-outline mr-2"></i>{{$user->name}}</h5>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
					      aria-controls="pills-home" aria-selected="true">Profile</a>
					  </li>
					  <li class="nav-item ml-2">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
					      aria-controls="pills-profile" aria-selected="false">Address List</a>
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
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="row">
								<div class="col-sm-12">
									<table class="table mb-3" id="address-table">
										<thead>
											<tr>
												<th class="text-center border-top-0">Recipient</th>
												<th class="text-center border-top-0">Shipping Address</th>
												<th class="text-center border-top-0">Shipping Area</th>
												<th class="text-center border-top-0 pr-4 pb-2">
													<button type="button" class="btn btn-sm peach-gradient" data-toggle="modal" data-target="#modalAddAddress">
													  Add new Address
													</button>
												</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($addresses as $address)
											<tr>
												<td>
													<b>
														{{$address->full_name}}<br>
													</b>
													<span>{{$address->phone}}</span>
												</td>
												<td class="text-dark">
													<b>
														{{$address->address_name}}<br>
													</b>
													<span>
														{{ $address->complete_address }}
													</span>
												</td>
												<td class="text-dark">{{ $address->city.','.$address->sub_district.','.$address->zip_code }}</td>
												<td>
													<div class="d-flex justify-content-center">
														<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditAddress{{$address->id}}">Edit</button>
														<form action="{{ route('address.destroy', $address->id) }}" method="post">
															@csrf
															@method('DELETE')
															<button type="submit" class="btn btn-danger btn-sm ">Delete</button>
														</form>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Edit Profile -->
	<div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header aqua-gradient">
	        <h5 class="modal-title" id="exampleModalLabel">
						<b class="text-white">
							Edit Profile Data
						</b>
					</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        @include('_extends.user-edit')
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Add Address -->
	<div class="modal fade" id="modalAddAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header aqua-gradient">
	        <h5 class="modal-title" id="exampleModalLabel">
						<b class="text-white">
							Add new Address
						</b>
					</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        @include('_extends.address-add')
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Edit Address -->
	@foreach($addresses as $address)
	<div class="modal fade" id="modalEditAddress{{$address->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        @include('_extends.address-edit')
	      </div>
	    </div>
	  </div>
	</div>
	@endforeach
</div>

@endsection
