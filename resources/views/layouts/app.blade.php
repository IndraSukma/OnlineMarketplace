<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Marketplace</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/main/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/">
          <img src="{{asset('img/logo-1.png')}}" height="30px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
              <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item" href="#">Category 1</a>
                <a class="dropdown-item" href="#">Category 2</a>
                <a class="dropdown-item" href="#">Category 3</a>
              </div>
            </li>
          </ul>

          <form action="{{ route('products.search') }}" method="get" class="search form-inline ml-lg-2 mr-lg-auto pr-0 active-pink-3 active-pink-4">
            <input class="form-control form-control-sm ml-3 w-75" type="text" name="keyword" placeholder="Search" aria-label="Search">
            <button type="submit" class="btn blue-gradient btn-sm pt-0 pb-0 pl-2 pr-2"><i class="mdi mdi-magnify mdi-24px" aria-hidden="true"></i></button>
          </form>

          @if (Route::has('login'))
            @auth
              <div class="profil d-flex justify-content-between py-2 d-lg-none">
                <div class="avatar">
                  <a href="#">
                    <img src="{{ asset('img/user.jpg') }}" alt="Avatar" height="40" class="rounded-circle">
                  </a>
                </div>
                <div class="detail flex-grow-1 d-flex justify-content-between align-items-center pl-3">
                  <a href="#" class="lead text-muted">Username</a>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-light">Logout</button>
                  </form>
                </div>
              </div>
              <ul class="navbar-nav auth">
                <li class="nav-item">
                  @if(is_null($cart))
                    <a href="{{route('cart')}}" id="navCart" class="nav-link" title="Cart"><i class="mdi mdi-24px mdi-cart-outline"></i></a>
                  @else
                    <a href="{{route('cart')}}" id="navCart" class="nav-link red-dot" title="Cart"><i class="mdi mdi-24px mdi-cart-outline"></i></a>
                  @endif
                </li>
                <li class="nav-item">
                  @if(is_null($wishlist))
                    <a href="{{ route('wishlist') }}" id="navWishlist" class="nav-link" title="Wishlist"><i class="mdi mdi-24px mdi-heart-outline"></i></a>
                  @else
                    <a href="{{ route('wishlist') }}" id="navWishlist" class="nav-link red-dot" title="Wishlist"><i class="mdi mdi-24px mdi-heart-outline"></i></a>
                  @endif
                </li>
                <li class="nav-item dropdown notification-dropdown d-none d-lg-block">
                  <a class="nav-link red-dot" id="notificationDropdown" href="#" title="Notifications" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-24px mdi-bell-outline"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                    <div class="dropdown-item">
                      <div class="row">
                        <div class="col-lg-12">
                          WAWWWWWWWWWWWWWWWW
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-item">
                      <div class="row">
                        <div class="col-lg-12">
                          WAWWWWWWWWWW
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-item">
                      <div class="row">
                        <div class="col-lg-12">
                          WAWWWWWWWWWWWWWWWWWWW
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown account-dropdown d-none d-lg-block">
                  <a href="#" class="nav-link dropdown-toggle" id="accountDropdown" title="Account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img/user.jpg') }}" alt="User" height="36" class="rounded-circle">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="mdi mdi-24px mdi-account-outline"></i>Dashboard</a>
                    <a class="dropdown-item" href="{{ route('user.index') }}"><i class="mdi mdi-24px mdi-account-outline"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"><i class="mdi mdi-24px mdi-exit-to-app"></i>Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            @else
              <ul class="navbar-nav guest">
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                  </li>
                @endif
              </ul>
            @endauth
          @endif
        </div>
      </nav>
    </header>

    <main class="pb-5">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark">
      <div class="blue-gradient">
        <div class="container">
<<<<<<< HEAD

          <!-- Grid row-->
          <div class="row py-4 d-flex align-items-center">

            <!-- Grid column -->
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
              <h6 class="mb-0">Get connected with us on social networks!</h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-6 col-lg-7 text-center text-md-right">

              <!-- Facebook -->
              <a class="mr-3">
                <i class="mdi mdi-facebook white-text"> </i>
              </a>
              <!--Instagram-->
              <a class="mr-3">
                <i class="mdi mdi-instagram white-text"> </i>
              </a>
              <!--Whatsaap-->
              <a class="">
                <i class="mdi mdi-whatsapp white-text"> </i>
              </a>

            </div>
            <!-- Grid column -->

          </div>
          <!-- Grid row-->

        </div>
      </div>

      <!-- Footer Links -->
      <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

            <!-- Content -->
            <h6 class="text-uppercase font-weight-bold">Company name</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur
              adipisicing elit.</p>

            </div>
            <!-- Grid column -->

=======
          <!-- Grid row-->
          <div class="row py-4 d-flex align-items-center">
>>>>>>> 3ea2d4e1cec5fc5701627e08b5a1430a22811f6e
            <!-- Grid column -->
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
              <h6 class="mb-0">Get connected with us on social networks!</h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-6 col-lg-7 text-center text-md-right">

              <!-- Facebook -->
              <a class="mr-3">
                <i class="mdi mdi-facebook white-text"> </i>
              </a>
              <!--Instagram-->
              <a class="mr-3">
                <i class="mdi mdi-instagram white-text"> </i>
              </a>
              <!--Whatsaap-->
              <a class="">
                <i class="mdi mdi-whatsapp white-text"> </i>
              </a>

            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row-->
        </div>
      </div>

      <!-- Footer Links -->
      <div class="container text-center text-md-left mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase font-weight-bold">Company name</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur
              adipisicing elit.</p>
          </div>
          <!-- Grid column -->

<<<<<<< HEAD
              <!-- Links -->
              <h6 class="text-uppercase font-weight-bold">Contact</h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>
                <i class="fas fa-home mr-3"></i> Cimahi, 40115, ID<
                /p>
              <p>
                <i class="fas fa-envelope mr-3"></i> app@markeplace.com
              </p>
              <p>
                <i class="fas fa-phone mr-3"></i> + 01 234 567 88
              </p>
              <p>
                <i class="fas fa-print mr-3"></i> + 01 234 567 89
              </p>
=======
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Products</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><a href="#!">MDBootstrap</a></p>
            <p><a href="#!">MDWordPress</a></p>
            <p><a href="#!">BrandFlow</a></p>
            <p><a href="#!">Bootstrap Angular</a></p>
          </div>
          <!-- Grid column -->
>>>>>>> 3ea2d4e1cec5fc5701627e08b5a1430a22811f6e

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Useful links</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><a href="#!">Your Account</a></p>
            <p><a href="#!">Become an Affiliate</a></p>
            <p><a href="#!">Shipping Rates</a></p>
            <p><a href="#!">Help</a></p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase font-weight-bold">Contact</h6>
            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><i class="fas fa-home mr-3"></i> Cimahi, 40115, ID</p>
            <p><i class="fas fa-envelope mr-3"></i> app@markeplace.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column -->

        </div>
<<<<<<< HEAD
                <!-- Footer Links -->

      <!-- Copyright -->[]
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="#"> Marketplace.io</a>
      </div>
        <!-- Copyright -->
    </footer>
      <!-- Footer -->
=======
        <!-- Grid row -->

      </div>
      <!-- Footer Links -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="#"> Marketplace.io</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <div id="modal-alert" data-izimodal-subtitle="Item has added to Cart"></div>
>>>>>>> 3ea2d4e1cec5fc5701627e08b5a1430a22811f6e
    <script src="{{ asset('js/main/jquery-3.3.1.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/main/popper.min.js') }}"></script>
    <script src="{{ asset('js/main/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
      });
    </script>

    





    @yield('script')
    @include('_includes.mainJs')
  </body>
</html>
