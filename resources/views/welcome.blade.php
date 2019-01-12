@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <div class="container">
    <h1 class="display-4">New Collection</h1>
    <a href="#" class="btn btn-primary">View Collections</a>
  </div>
</div>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-4">
      <div class="view overlay">
        <img src="https://mdbootstrap.com/img/Photos/Others/forest-sm.jpg" class="img-fluid " alt="smaple image">
        <div class="mask flex-center rgba-green-slight">
          <p class="white-text">Strong overlay</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="view overlay">
        <img src="https://mdbootstrap.com/img/Photos/Others/forest-sm.jpg" class="img-fluid " alt="smaple image">
        <div class="mask flex-center rgba-red-strong">
          <p class="white-text">Strong overlay</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="view overlay">
        <img src="https://mdbootstrap.com/img/Photos/Others/forest-sm.jpg" class="img-fluid " alt="smaple image">
        <div class="mask flex-center rgba-red-strong">
          <p class="white-text">Strong overlay</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection