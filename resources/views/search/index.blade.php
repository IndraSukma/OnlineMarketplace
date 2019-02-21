@extends('layouts.app')

@section('title', $keyword)

@section('content')
  <div class="container-fluid px-4 mt-4">
    <nav class="navbar navbar-expand-md aqua-gradient mdb-color my-3 mx-5">
      <div class="mr-auto">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb d-inline-flex pl-0 pt-0">
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Result for "{{ $keyword }}"</li>
          </ol>
        </nav>
      </div>
    </nav>
  </div>

  <div class="container-fluid px-4">
    <div class="mx-5 px-2 py-0">
      <div class="row">
        <div class="col-sm-6">
          <p class="pt-2">Showing 1 - 20 of 100 Items</p>
        </div>
        <div class="col-sm-6 float-right">
          <div class="row justify-content-end">
            <div class="col-sm-3">
              <select class="browser-default custom-select">
                <option selected>Show : 20</option>
                <option value="1">Show : 50</option>
                <option value="2">Show : 100</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select class="browser-default custom-select">
                <option selected>Sort By</option>
                <option value="1">Price: Lowest First</option>
                <option value="2">Price: Highest First</option>
                <option value="3">Product Name: A to Z</option>
                <option value="4">Product Name: Z to A</option>
                <option value="4">In Stock</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <hr class="mt-0">

      <div class="row mt-4">
        @if (count($products) != 0)
          @foreach ($products as $product)
            <div class="col-md-6 col-lg-3">
              <div class="card card-cascade mb-4">

                <!--Card image-->
                <div class="view view-cascade">
                  @if (!empty($product->thumbnail))
                    <img src="{{ asset('img/product-thumbnail/' . $product->thumbnail) }}" class="card-img-top" alt="{{ $product->name }}">
                  @else
                    <img src="{{ asset('img/product-thumbnail/image-not-found.png') }}" class="card-img-top" alt="{{ $product->name }}">
                  @endif
                  <a href="{{ route('products.detail', $product->slug) }}">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <!--/.Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade">
                  <a href="{{ route('products.detail', $product->slug) }}" class="text-dark">
                    <h5 class="card-title mb-0"><strong>{{ $product->name }}</strong></h5>
                  </a>
                  <p class="lead text-primary">Rp. {{ $product->price }}</p>
                  <hr>

                  <div class="text-center">
                    <div class="row">
                      <div class="col-sm">
                        <div class="float-left">
                          <button class="btn-cart bg-transparent border-0" value="{{ $product->id }}" title="Add to Cart" data-toggle="tooltip" data-action="add">
                            <i class="mdi mdi-24px mdi-cart-plus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="float-right">
                          @if (Auth::check() && in_array($product->id, $wishlist_array))
                            <button class="btn-wishlist bg-transparent border-0" value="{{ $product->id }}" title="Remove Wishlist" data-toggle="tooltip" data-action="remove">
                              <i class="mdi mdi-24px mdi-heart text-danger"></i>
                            </button>
                          @else
                            <button class="btn-wishlist bg-transparent border-0" value="{{ $product->id }}" title="Add to Wishlist" data-toggle="tooltip" data-action="add">
                              <i class="mdi mdi-24px mdi-heart-outline text-danger"></i>
                            </button>
                          @endif
                          <button data-toggle="tooltip" title="Copy Link to Clipboard" id="link{{$product->id}}" value="{{$product->id}}" class="bg-transparent border-0 pr-0">
                            <i class="mdi mdi-24px mdi-share-variant text-link"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!--/.Card content-->
              </div>
            </div>
          @endforeach
        @else
          <h4 class="w-100 text-center">Tidak ada hasil untuk "{{ $keyword }}"</h4>
        @endif
      </div>

      <nav aria-label="Page Navigation" class="d-flex justify-content-between align-items-center mt-5">
        {{ $products->links() }}
      </nav>
    </div>
  </div>
@endsection