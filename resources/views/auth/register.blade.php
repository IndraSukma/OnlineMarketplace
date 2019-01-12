@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-5">
                    <form>
                      <h3 class="font-weight-bold">Sign Up</h3>
                      <p>Register with following methods: </p>
                      <div class="row">
                        <div class="col-sm-4">
                          <a href="#" class="btn primary-color-dark w-100 px-1 py-2 mx-0">
                            <i class="mdi mdi-facebook float-left ml-3"></i>
                            <span class="ml-0">facebook</span>
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#" class="btn primary-color-dark w-100 px-1 py-2 mx-0">
                            <i class="mdi mdi-facebook float-left ml-3"></i>
                            <span class="ml-0">Twitter</span>
                          </a>
                        </div>
                        <div class="col-sm-4">
                          <a href="#" class="btn red darken-3 w-100 px-1 py-2 mx-0">
                            <i class="mdi mdi-facebook float-left ml-3"></i>
                            <span class="ml-0">google</span>
                          </a>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary w-100 mx-0 mt-2 purple-gradient">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer aqua-gradient border-top-0 text-center pt-4">
                    <p class="text-white">Already have an account? <a href="#">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
