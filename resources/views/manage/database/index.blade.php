@extends('layouts.master')

@section('title', 'Database')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
				<div class="card">
					<div class="row">
						<div class="col">
							<h4 class="h4"><b>Database Backups</b></h4>
						</div>
						<div class="col">
							<a href="{{ route('database.backup') }}" class="btn btn-primary float-right">Create new backup</a>
							{{-- <button id="btnAdd" class="btn btn-primary float-right" type="button">Add Item</button> --}}
						</div>
					</div>
				  <div class="card-body p-0">
				  	@if (count($backups) > 0)
					    <table class="table table-bordered" id="database-table">
					    	<thead>
					    		<tr>
					    			<th class="text-center">#</th>
					    			<th class="text-center">File Name</th>
					    			<th class="text-center">Size</th>
					    			<th class="text-center">Date</th>
					    			<th class="text-center">Age</th>
					    			<th class="text-center">Actions</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach ($backups as $backup)
						    		<tr>
						    			<td class="text-dark">{{ $loop->iteration }}</td>
						    			<td class="text-dark">{{ $backup['name'] }}</td>
						    			<td class="text-dark">{{ $backup['size'] }}</td>
						    			<td class="text-dark">{{ $backup['last_modified'] }}</td>
						    			<td class="text-dark">{{ $backup['age'] }}</td>
						    			<td class="text-center">
						    				<a class="btnRestore btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modalRestore" data-filename="{{ $backup['name'] }}">Restore</a>
						    				<a href="{{ route('database.download', $backup['name']) }}" class="btn btn-sm btn-warning">Download</a>
						    				<a class="btnDelete btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#modalDelete" data-filename="{{ $backup['name'] }}">Delete</a>
						    			</td>
						    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
					  @else
					  	<div class="my-5 py-5">
					  		<h3 class="text-center my-3">No backup files found.</h3>
					  	</div>
				  	@endif
				  </div>
				</div>

				<!-- Modal restore database -->
				<div id="modalRestore" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
				  <div class="modal-dialog" role="document">
				    <form action="{{ route('database.restore') }}" method="post" class="modal-content" id="formRestore">
				      <div class="modal-header border-bottom-0">
				        <h3 class="modal-title">Restore this backup file ?</h3>
				      </div>
				      <div class="modal-body py-0">
				        @csrf
				        <p id="itemName"></p>
				        <input type="hidden" name="filename" id="filename" />
				        <div class="form-group">
				          <label for="password">Password</label>
				          <input type="password" name="password" id="password" class="form-control{{ Session::has('wrongPassword') ? ' is-invalid' : '' }}" placeholder="Enter your password" required />
				          @if (Session::has('wrongPassword'))
				            <span class="invalid-feedback" role="alert">
				              <strong>{{ Session::get('wrongPassword') }}</strong>
				            </span>
				          @endif
				        </div>
				      </div>
				      <div class="modal-footer border-top-0 pt-0">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Restore</button>
				      </div>
				    </form>
				  </div>
				</div>
				@include('_extends.delete')
      </div>
    </div>
  </div>
@endsection

@section('scripts')
	<script>
    $(document).ready(function () {
      // Message
      @if (Session::has('success'))
      	iziToast.success({
          message: '{{ Session::get('success') }}'
        });
      @elseif (Session::has('error'))
      	iziToast.error({
          message: '{{ Session::get('error') }}'
        });
      @elseif (Session::has('wrongPassword'))
      	iziToast.error({
          message: '{{ Session::get('wrongPassword') }}'
        });
      @endif

      // Restore database
      $('#database-table').on('click', '.btnRestore', function () {
        $('#itemName').text($(this).data('filename'));
        $('#filename').val($(this).data('filename'));

        $('#modalDelete').on('hide.bs.modal', function () {
          $('#itemName').text('');
        	$('#filename').val('');
        });
      });

      // Delete Backup
      $('#database-table').on('click', '.btnDelete', function () {
        $('#formDelete').attr('action', '/manage/database/' + $(this).data('filename'));
        $('#itemName').text($(this).data('filename'));

        $('#modalDelete').on('hide.bs.modal', function () {
          $('#formDelete').attr('action', '');
          $('#itemName').text('');
        });
      });

			// Datatables
      $('#database-table').DataTable();
    });
  </script>
@endsection