<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace</title>
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('css/main/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="#">Navbar</a>
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
          <form class="search form-inline ml-lg-2 mr-lg-auto">
            <button class="btn" type="submit"><i class="mdi mdi-magnify mdi-24px"></i></button>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
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
                  <button class="btn btn-sm btn-light">Logout</button>
                </div>
              </div>
              <ul class="navbar-nav auth">
                <li class="nav-item">
                  <a href="#" class="nav-link" title="Cart"><i class="mdi mdi-24px mdi-cart-outline"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" title="Wishlist"><i class="mdi mdi-24px mdi-heart-outline"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link red-dot" href="#" title="Notifications"><i class="mdi mdi-24px mdi-bell-outline"></i></a>
                </li>
                <li class="nav-item dropdown account-dropdown d-none d-lg-block">
                  <a href="#" class="nav-link dropdown-toggle" id="accountDropdown" title="Account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img/user.jpg') }}" alt="User" height="36" class="rounded-circle">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="#"><i class="mdi mdi-24px mdi-account-outline"></i>Profile</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-24px mdi-exit-to-app"></i>Logout</a>
                  </div>
                </li>
              </ul>
            @else
              <ul class="navbar-nav guest">
                <li class="nav-item">
                  <a href="#" class="nav-link">Login</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a href="#" class="nav-link">Register</a>
                  </li>
                @endif
              </ul>
            @endauth
          @endif
        </div>
      </nav>
    </header>

    <main></main>

    <footer></footer>

    <script src="{{ asset('js/main/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/main/popper.min.js') }}"></script>
    <script src="{{ asset('js/main/bootstrap.min.js') }}"></script>
  </body>
</html>
