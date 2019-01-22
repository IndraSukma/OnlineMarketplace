<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <!-- <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> -->

  <title>{{config('app.name', 'Online Marketplace')}}</title>

  <link href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tingle/0.14.0/tingle.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">  -->
  <!-- Custom CSS -->

  <link href="{{ asset('css/lib/calendar2/semantic.ui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/helper.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- Icons -->
  <link href="{{ URL::asset('icons/flag-icon-css/flag-icon.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/linea-icons/linea.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/material-design-iconic-font/css/materialdesignicons.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/themify-icons/themify-icons.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('icons/weather-icons/css/weather-icons.min.css') }}" rel="stylesheet">


  @yield('stylesheets')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
  <!--[if lt IE 9]>
  <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
  <!-- Preloader - style you can find in spinners.css -->
  <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
  </div>
  <!-- Main wrapper  -->
  <div id="main-wrapper">
    <!-- Start of Header -->
    <div class="header">
      <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">
            <!-- Logo icon -->
            <b><img src="{{ asset('img/logo.png') }}" alt="homepage" class="dark-logo" /></b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span><img src="{{ asset('img/logo-text.png') }}" alt="homepage" class="dark-logo" /></span>
          </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
          <!-- toggle and nav items -->
          <ul class="navbar-nav mr-auto mt-md-0">
            <!-- This is  -->
            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
            <!-- Messages -->
            <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-th-large"></i></a>
              <div class="dropdown-menu animated zoomIn">
                <ul class="mega-dropdown-menu row">


                  <li class="col-lg-3  m-b-30">
                    <h4 class="m-b-20">CONTACT US</h4>
                    <!-- Contact -->
                    <form>
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter email"> </div>
                      <div class="form-group">
                        <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                      </div>
                      <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                  </li>
                  <li class="col-lg-3 col-xlg-3 m-b-30">
                    <h4 class="m-b-20">List style</h4>
                    <!-- List style -->
                    <ul class="list-style-none">
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                    </ul>
                  </li>
                  <li class="col-lg-3 col-xlg-3 m-b-30">
                    <h4 class="m-b-20">List style</h4>
                    <!-- List style -->
                    <ul class="list-style-none">
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                    </ul>
                  </li>
                  <li class="col-lg-3 col-xlg-3 m-b-30">
                    <h4 class="m-b-20">List style</h4>
                    <!-- List style -->
                    <ul class="list-style-none">
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> This Is Another Link</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </li>
            <!-- End Messages -->
          </ul>
          <!-- User profile and search -->
          <ul class="navbar-nav my-lg-0">
            <!-- Comment -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell"></i>
              <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                <ul>
                  <li>
                    <div class="drop-title">Notifications</div>
                  </li>
                  <li>
                    <div class="message-center">
                      <!-- Message -->
                      <a href="#">
                        <div class="btn btn-danger btn-circle m-r-10"><i class="fa fa-link"></i></div>
                        <div class="mail-contnet">
                          <h5>This is title</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="btn btn-success btn-circle m-r-10"><i class="ti-calendar"></i></div>
                        <div class="mail-contnet">
                          <h5>This is another title</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="btn btn-info btn-circle m-r-10"><i class="ti-settings"></i></div>
                        <div class="mail-contnet">
                          <h5>This is title</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="btn btn-primary btn-circle m-r-10"><i class="ti-user"></i></div>
                        <div class="mail-contnet">
                          <h5>This is another title</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                        </div>
                      </a>
                    </div>
                  </li>
                  <li>
                    <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- End Comment -->
            <!-- Messages -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted  " href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-envelope"></i>
        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
      </a>
              <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn" aria-labelledby="2">
                <ul>
                  <li>
                    <div class="drop-title">You have 4 new messages</div>
                  </li>
                  <li>
                    <div class="message-center">
                      <!-- Message -->
                      <a href="#">
                        <div class="user-img"> <img src="{{ asset('img/users/5.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                        <div class="mail-contnet">
                          <h5>Michael Qin</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="user-img"> <img src="{{ asset('img/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                        <div class="mail-contnet">
                          <h5>John Doe</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="user-img"> <img src="{{ asset('img/users/3.jpg') }}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                        <div class="mail-contnet">
                          <h5>Mr. John</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span>
                        </div>
                      </a>
                      <!-- Message -->
                      <a href="#">
                        <div class="user-img"> <img src="{{ asset('img/users/4.jpg') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                        <div class="mail-contnet">
                          <h5>Michael Qin</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                        </div>
                      </a>
                    </div>
                  </li>
                  <li>
                    <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- End Messages -->
            <!-- Profile -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/users/5.jpg') }}" alt="user" class="profile-pic" /></a>
              <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                <ul class="dropdown-user">
                  <li><a href="{{ route('user.index') }}"><i class="ti-user"></i> Profile</a></li>
                  <li><a href="{{ route('address.indexAdmin') }}"><i class="ti-location-pin"></i> Address</a></li>
                  {{-- <li><a href="#"><i class="ti-wallet"></i> Balance</a></li> --}}
                  {{-- <li><a href="#"><i class="ti-email"></i> Inbox</a></li> --}}
                  {{-- <li><a href="#"><i class="ti-settings"></i> Setting</a></li> --}}
                  <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <i class="fa fa-power-off"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- End header header -->

    <!-- Left Sidebar  -->
    <div class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="nav-devider"></li>
            <li class="nav-label">Home</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Insight </a></li>
                <li><a href="#">Analytics </a></li>
              </ul>
            </li>
            <li class="nav-label">Product Listing</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bullhorn"></i><span class="hide-menu">Announce</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Featured Items</a></li>
                <li><a href="#">Discounted Items</a></li>
                <li><a href="#">Hot Products</a></li>
              </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-calendar"></i><span class="hide-menu">Events</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Flash Sale</a></li>
                <li><a href="#">Promo</a></li>
              </ul>
            </li>
            <li class="nav-label">Products and Orders</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">Products</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Products Data</a></li>
                <li><a href="#">Category Data</a></li>
              </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-handshake-o"></i><span class="hide-menu">Transactions</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Transaction list</a></li>
                <li><a href="#">Track Orders</a></li>
              </ul>
            </li>
            <li class="nav-label">Settings</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-database"></i><span class="hide-menu">Database</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Backup Database</a></li>
                <li><a href="#">Restore Database</a></li>
              </ul>
            </li>

            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-question-circle-o"></i><span class="hide-menu">Website</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="#">Other</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </div>
    <!-- End Left Sidebar  -->
    <!-- Page wrapper  -->
    <div class="page-wrapper">
      <!-- Bread crumb -->
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
          <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
      <!-- End Bread crumb -->
      <!-- Container fluid  -->
      <div class="container-fluid">
        <!-- Start Page Content -->
        @yield('content')
        <!-- End PAge Content -->
      </div>
      <!-- End Container fluid  -->
      <!-- footer -->
      <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
      <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->    

  </div>
  <!-- End Wrapper -->

  <!-- All Jquery -->
  <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap/js/popper.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tingle/0.14.0/tingle.min.js"></script>

  <!-- Amchart -->

    <script src="{{ asset('js/lib/calendar-2/moment.latest.min.js') }}"></script>
  <script src="{{ asset('js/lib/calendar-2/semantic.ui.min.js') }}"></script>
  <script src="{{ asset('js/lib/calendar-2/prism.min.js') }}"></script>
  <script src="{{ asset('js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
  <script src="{{ asset('js/lib/calendar-2/pignose.init.js') }}"></script>

  <script src="{{ asset('js/scripts.js') }}"></script>

  <script src="{{ asset('js/custom.min.js') }}"></script>
  @include('_includes/adminJs')
  @yield('scripts')

</body>

</html>
