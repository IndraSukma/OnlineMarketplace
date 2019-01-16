@extends('layouts.app')

@section('content')
<div class="card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">
  <div class="text-white text-center rgba-stylish-strong py-5 px-4">
    <div class="py-5">

      <!-- Content -->
      <h2 class="card-title font-weight-bold h2 my-4 py-2">New Collections</h2>
      <p class="mb-4 pb-2 px-md-5 mx-md-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p>
      <a class="btn purple-gradient"><i class="fas fa-clone left"></i>View Collections</a>

    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-sm">
      <div class="view overlay zoom young-passion-gradient color-block z-depth-1-half">
          <div class="img-gradient">
            <img src="{{asset('img/bg-img/bg-2.jpg')}}" class="img-fluid" alt="smaple image">
            <div class="mask flex-center rgba-indigo-light">
              <a href="#">
                <h3 class="white-text font-weight-bold">CLOTHING</h3>
              </a>
            </div>
          </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="view overlay zoom young-passion-gradient color-block z-depth-1-half">
          <div class="img-gradient">
            <img src="{{asset('img/bg-img/bg-3.jpg')}}" class="img-fluid" alt="smaple image">
            <div class="mask flex-center rgba-indigo-light">
              <a href="#">
                <h3 class="white-text font-weight-bold">SHOES</h3>
              </a>
            </div>
          </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="view overlay zoom young-passion-gradient color-block z-depth-1-half">
          <div class="img-gradient">
            <img src="{{asset('img/bg-img/bg-4.jpg')}}" class="img-fluid" alt="smaple image">
            <div class="mask flex-center rgba-indigo-light">
              <a href="#">
                <h3 class="white-text font-weight-bold">ACCESSORIES</h3>
              </a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- GLOBAL SALE 60% -->
<div class="container mt-5">
  <div class="jumbotron hoverable p-4" style="background-image: url({{ asset('img/bg-img/bg-5.jpg') }}); background-size: cover;">
    <div class="row py-5 px-4">
      <div class="col-md-6">
      </div>

      <div class="col-md-6">
        <a href="#!" class="red-text">
          <h2 class="pb-1 font-weight-bold">-60%</h2>
        </a>

        <p class="font-weight-normal">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
           magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <p class="font-weight-normal">
        <a class="btn peach-gradient text-white">BUY NOW</a>
      </div>
    </div>
  </div>
</div>

<!-- carousel -->
<div class="container mt-5">
  <hr class="my-3">
  <div class="row">
    <div class="col-sm">
      <div class="float-left">
        <p class="lead primary-text font-weight-bold">Popular Products</p>
      </div>
    </div>
    <div class="col-sm">
      <div class="float-right">
        <a href="{{ route('products') }}">
          <p class="lead primary-text font-weight-bold">See All Products</p>
        </a>
      </div>
    </div>
  </div>

  <!-- ################################################################### -->
  <div class="row">
    @foreach ($products as $product)
      <div class="col-md-6 col-lg-3">
        <div class="card card-cascade mb-4">

          <!--Card image-->
          <div class="view view-cascade">
            <img src="{{ asset('img/user.jpg') }}" class="card-img-top" alt="">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <!--/.Card image-->

          <!--Card content-->
          <div class="card-body card-body-cascade">
            <a href="{{ route('productDetail', $product->slug) }}" class="text-dark">
              <h5 class="card-title mb-0"><strong>{{ $product->name }}</strong></h5>
            </a>
            <p class="lead text-primary">Rp. {{ $product->price }}</p>
            <hr>

            <div class="text-center">
              <div class="row">
                <div class="col-sm">
                  <div class="float-left">
                    <a href class=""><i class="mdi mdi-24px mdi-cart-plus text-dark"></i></a>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="float-right">
                    <a href class=""><i class="mdi mdi-24px mdi-heart-outline text-danger"></i></a>
                    <a href class=""><i class="mdi mdi-24px mdi-share-variant text-link"></i></a>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!--/.Card content-->
        </div>
      </div>
    @endforeach
</div>

@endsection
