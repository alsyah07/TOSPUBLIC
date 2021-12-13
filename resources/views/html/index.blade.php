@if(empty(Auth::user()->name) && empty(Auth::user()->id))
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<center><img src="/gambar/page_expired.jpg" class="img img-responsive" width="70%"></center>
<div style="margin-top: -15%;">
<center><a href="/" class="btn btn-primary" style="width: 30%; margin-left: 20%;"><h3>Login Kembali</h3></a></center>
</div>
@else
@include('include.header')
@include('include.menutop')
@include('include.menuleft')  
 @yield('content')
@include('include.footer')
@endif
