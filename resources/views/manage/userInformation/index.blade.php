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
																{{ $address->full_name }}<br>
															</b>
															<span>{{ $address->phone }}</span>
														</td>
														<td class="text-dark">
															<b>
																{{ $address->address_name }}<br>
															</b>
															<span>
																{{ $address->complete_address }}
															</span>
														</td>
														<td class="text-dark">{{ $address->province->name.', '.$address->city->name.', '.$address->zip_code }}</td>
														<td>
															<div class="d-flex justify-content-center">
																<button class="btnEditAddress btn btn-sm btn-warning"
																				data-toggle="modal"
																				data-target="#modalEditAddress"
																				data-id="{{ $address->id }}"
																				data-full-name="{{ $address->full_name }}"
																				data-phone="{{ $address->phone }}"
																				data-address-name="{{ $address->address_name }}"
																				data-zip-code="{{ $address->zip_code }}"
																				data-province="{{ $address->province_id }}"
																				data-city="{{ $address->city_id }}"
																				data-sub-district="{{ $address->sub_district }}"
																				data-complete-address="{{ $address->complete_address }}"
																				data-additional-info="{{ $address->additional_info }}">Edit</button>
																<button class="btnDeleteAddress btn btn-danger btn-sm"
																				data-toggle="modal"
																				data-target="#modalDeleteAddress"
																				data-id="{{ $address->id }}">Delete</button>
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

		@include('_extends.user-edit')
	</div>
@endsection

@section('scripts')
	<script>
    $(document).ready(function () {
			$('#province').on('change', function(e) {
				console.log(e);
				var province_id = e.target.value;

				$.get('/city?province_id=' + province_id, function (data) {
					$('#city').empty();
					$.each(data, function (index, cityObj) {
						$('#city').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
					});
				});
			});

      // Edit Address
      $('.btnEditAddress').click(function() {
        $('#modalEditAddress #formEditAddress').attr('action', '/manage/address/' + $(this).data('id'));
        $('#modalEditAddress #full_name').val($(this).data('full-name'));
        $('#modalEditAddress #phone').val($(this).data('phone'));
        $('#modalEditAddress #address_name').val($(this).data('address-name'));
        $('#modalEditAddress #zip_code').val($(this).data('zip-code'));
        $('#modalEditAddress #province').val($(this).data('province'));
        $('#modalEditAddress #city').val($(this).data('city'));
        $('#modalEditAddress #sub_district').val($(this).data('sub-district'));
        $('#modalEditAddress #complete_address').val($(this).data('complete-address'));
        $('#modalEditAddress #additional_info').val($(this).data('additional-info'));

				// Modal City Option
				$('#modalEditAddress #province').on('change', function(e) {
					console.log(e);
					var province_id = e.target.value;
					$.get('/city?province_id=' + province_id, function (data) {
						$('#modalEditAddress #city').empty();
						$.each(data, function (index, cityObj) {
							$('#modalEditAddress #city').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
						});
					});
				});

      });

      // Delete Address
      $('.btnDeleteAddress').click(function() {
        $('#modalDeleteAddress #formDeleteAddress').attr('action', '/manage/address/' + $(this).data('id'));
      });
    });
  </script>
@endsection
