@extends('layouts.app')

@section('title', $product->name)

@section('content')
  <div class="container-fluid px-4">
    <nav class="navbar navbar-expand-md aqua-gradient mdb-color my-3 mx-5">
      <div class="mr-auto">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb d-inline-flex pl-0 pt-0">
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="white-text" href="#!">Shoes</a></li>
            <li class="breadcrumb-item active">Sneaker</li>
          </ol>
        </nav>
      </div>
    </nav>
  </div>

  <div class="container-fluid px-4">
    <div class="mx-5 px-2 py-0">
      <div class="row">
        <div class="col-sm-5 pl-2">
          <div class="product-gallery">
            <div id="productGallery" class="owl-carousel owl-theme">
              <div class="item">
                <img src="{{ asset('img/product-img/product-2.jpeg') }}" class="img-thumbnail w-100" alt="">
              </div>
              <div class="item">
                <img src="{{ asset('img/user.jpg') }}" class="img-thumbnail w-100" alt="">
              </div>
              <div class="item">
                <img src="{{ asset('img/user.jpg') }}" class="img-thumbnail w-100" alt="">
              </div>
              <div class="item">
                <img src="{{ asset('img/user.jpg') }}" class="img-thumbnail w-100" alt="">
              </div>
              <div class="item">
                <img src="{{ asset('img/user.jpg') }}" class="img-thumbnail w-100" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-7">
          <!-- Product information -->
          <div class="container">
            <h6 class="h6 mb-3">Category : <a href="#">
              {{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</a>
            </h6>
            <h2 class="font-weight-bold deep-orange-lighter-hover mb-0">{{ $product->name }}</h2>
            <h5 class="h5 font-weight-bold deep-orange-lighter-hover">Rp. {{ $product->price }}</h5>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm">
                <div class="float-left">
                  Stock : <b>{{ $product->stock }}</b>
                </div>
              </div>
              <div class="col-sm">
                <div class="float-right">
                  <div class="share-link">
                    @if (Auth::check() && in_array($product->id, $wishlist_array))
                      <button value="{{ $product->id }}" title="Remove Wishlist" data-toggle="tooltip" data-action="remove" class="btn-wishlist bg-transparent border-0">
                        <i class="mdi mdi-24px mdi-heart text-danger"></i>
                      </button>
                    @else
                      <button value="{{ $product->id }}" title="Add to Wishlist" data-toggle="tooltip" data-action="add" class="btn-wishlist bg-transparent border-0">
                        <i class="mdi mdi-24px mdi-heart-outline text-danger"></i>
                      </button>
                    @endif
                    <a href="" class="text-dark" data-toggle="tooltip" title="Copy Link to Clipboard">
                      <i class="mdi mdi-24px mdi-share-variant"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Product information -->
          <hr>
          <div class="container">
            <div class="row">
              <div class="col-sm-6 float-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend ">
                    <span class="input-group-text">Amount of Item</span>
                  </div>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 float-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend ">
                    <span class="input-group-text">Notes</span>
                  </div>
                  <input type="text" class="form-control" placeholder="ex, size: xl">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <a href="#" class="btn purple-gradient waves-effect w-100 mx-0 py-2">
                  <span>Add to Cart</span>
                </a>
              </div>
              <div class="col-sm-6">
                <a href="#" class="btn peach-gradient waves-effect w-100 mx-0 py-2">
                  <span>Buy Now</span>
                </a>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <i class="mdi mdi-36px mdi-check-circle-outline text-success"></i>
                      </div>
                      <div class="col-sm-11">
                        <h5 class="h5 font-weight-bold">100% Safe Guarantee</h5>
                        <p>
                          Goods not according to order? Follow the steps in return of goods <a href="#">here</a><br>
                          Money is sure to come back. Fraud free payment system. <a href="#">Learn more.</a>
                        </p>
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

    <div class="card mx-5 mt-4">
      <div class="card-body px-4 py-4">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item mr-2">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
            aria-controls="pills-home" aria-selected="true">Detail</a>
          </li>
          <li class="nav-item mr-2">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
            aria-controls="pills-profile" aria-selected="false">Item Review</a>
          </li>
        </ul>
        <hr>
        <div class="tab-content pt-2 pb-4 px-4" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <!-- Information -->
            <h5 class="h5 font-weight-bold">Information</h5>
            <div class="row">
              <div class="col-sm-2">
                <p>Condition</p>
              </div>
              <div class="col-sm-2">
                <p>: <span class="peach-gradient rounded-right rounded-left py-1 px-2 text-white ml-4">{{ $product->condition }}</span> </p>
              </div>
              <div class="col-sm-3"></div>
              <div class="col-sm-2">
                <p>Wishlisted</p>
              </div>
              <div class="col-sm-3">
                <p>: <strong class="ml-4">-</strong> </p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <p>Sold</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">-</strong> </p>
              </div>
              <div class="col-sm-3"></div>
              <div class="col-sm-2">
                <p>Updated</p>
              </div>
              <div class="col-sm-3">
                <p>: <strong class="ml-4">{{ $product->updated_at->toFormattedDateString() }}</strong> </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">
                <p>Viewed</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">{{ $product->views }}</strong> </p>
              </div>
              <div class="col-sm-3"></div>
              <div class="col-sm-2">
              </div>
              <div class="col-sm-3">
              </div>
            </div>
            <hr>
            <!-- ./Information -->

            <!-- Specification -->
            <h5 class="h5 font-weight-bold">Specification</h5>
            <div class="row">
              <div class="col-sm-2">
                <p>Category</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">{{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</strong> </p>
              </div>
              <div class="col-sm-8"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">
                <p>Weight</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">1000 gram</strong></p>
              </div>
              <div class="col-sm-8"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">
                <p>Brand</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">Others</strong></p>
              </div>
              <div class="col-sm-8"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">
                <p>Size</p>
              </div>
              <div class="col-sm-2">
                <p>: <strong class="ml-4">36, 37, 38, 40</strong></p>
              </div>
              <div class="col-sm-8"></div>
            </div>
            <hr>
            <!-- ./Specification -->

            <!-- Description -->
            <h5 class="h5 font-weight-bold">Description</h5>
            <div class="row">
              <div class="col-sm-12">{{ $product->description }}</div>
            </div>
            <!-- ./ Description -->
          </div>
          <div class="tab-pane fade pt-2 px-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="feedback">
              <div class="row">
                <div class="col-sm-1 text-center">
                  <div class="avatar">
                    <a href="#">
                      <img src="{{ asset('img/user.jpg') }}" alt="Avatar" height="50" class="rounded-circle">
                    </a>
                  </div>
                </div>
                <div class="col-sm-11">
                  <span><i class="mdi mdi-thumb-up text-success"></i></span><br>
                  <small><span>By <a href="">Indra Sukmajaya</a></span></small>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-11">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>
            <hr class="mb-3">

            <div class="feedback">
              <div class="row">
                <div class="col-sm-1 text-center">
                  <div class="avatar">
                    <a href="#">
                      <img src="{{ asset('img/user.jpg') }}" alt="Avatar" height="50" class="rounded-circle">
                    </a>
                  </div>
                </div>
                <div class="col-sm-11">
                  <span><i class="mdi mdi-thumb-up text-success"></i></span><br>
                  <small><span>By <a href="">Muhamad Iqbal Nurzaman</a></span></small>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-11">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>
            <hr class="mb-3">

            <div class="feedback">
              <div class="row">
                <div class="col-sm-1 text-center">
                  <div class="avatar">
                    <a href="#">
                      <img src="{{ asset('img/user.jpg') }}" alt="Avatar" height="50" class="rounded-circle">
                    </a>
                  </div>
                </div>
                <div class="col-sm-11">
                  <span><i class="mdi mdi-thumb-up text-success"></i></span><br>
                  <small><span>By <a href="">Rido Amaludin Toyib</a></span></small>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-11">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-5 mt-4">
      <hr class="my-3">
      <div class="row">
        <div class="col-sm">
          <div class="float-left">
            <p class="lead primary-text font-weight-bold">Related Products</p>
          </div>
        </div>
        <div class="col-sm">
          <div class="float-right">
            <a href="#">
              <p class="lead primary-text font-weight-bold">See All Related Products</p>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($relatedProducts as $relatedProduct)
          <div class="col-md-6 col-lg-3">
            <div class="card card-cascade">

              <!--Card image-->
              <div class="view view-cascade">
                <img src="{{ asset('img/user.jpg') }}" class="card-img-top" alt="">
                <a href="{{ route('products.detail', $relatedProduct->slug) }}">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--/.Card image-->

              <!--Card content-->
              <div class="card-body card-body-cascade">
                <a href="{{ route('products.detail', $relatedProduct->slug) }}" class="text-dark">
                  <h5 class="card-title mb-0"><strong>{{ $relatedProduct->name }}</strong></h5>
                </a>
                <p class="lead text-primary">Rp. {{ $relatedProduct->price }}</p>
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
                        @if (Auth::check() && in_array($relatedProduct->id, $wishlist_array))
                          <button class="btn-wishlist bg-transparent border-0" value="{{ $relatedProduct->id }}" title="Remove Wishlist" data-toggle="tooltip" data-action="remove">
                            <i class="mdi mdi-24px mdi-heart text-danger"></i>
                          </button>
                        @else
                          <button class="btn-wishlist bg-transparent border-0" value="{{ $relatedProduct->id }}" title="Add to Wishlist" data-toggle="tooltip" data-action="add">
                            <i class="mdi mdi-24px mdi-heart-outline text-danger"></i>
                          </button>
                        @endif
                        <button data-toggle="tooltip" title="Copy Link to Clipboard" id="link{{$relatedProduct->id}}" value="{{$relatedProduct->id}}" class="bg-transparent border-0 pr-0">
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
      </div>
    </div>
  </div>
@endsection

@section('script')
  @include('_includes.imageSlider')
@endsection
