<!-- ================ Header ================ -->
<header>
    <!-- header upper -->
    <div class="header-upper">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 col-md-9">
            <ul class="header-upper-link list-inline">
              <li class="list-inline-item"><span>Mail Us:</span> {{ $get_setting_data->email1 }}</li>
              <li class="list-inline-item"><span>Follow Us:</span>
                <a href="{{ $get_setting_data->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a> 
                <a href="{{ $get_setting_data->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a> 
                <a href="{{ $get_setting_data->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                 <a href="{{ $get_setting_data->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a>
                </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 text-lg-end text-md-end text-sm-center text-center">
            <div class="header-right-btn"> <a href="{{ url('admin/login') }}">Admin Login</a></div>
          </div>
        </div>
      </div>
    </div>
    <!-- header upper end -->
    <!-- header lover -->
    <div class="header-lover">
      <div class="container">
        <nav class="navbar navbar-expand-lg">
          <!-- logo -->
          <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/') }}/front_assets/img/logo.png" alt=""></a>
          <!-- logo end -->
          <div class="header-call"> <a href="#"><i class="bi bi-telephone"></i> Call: {{ $get_setting_data->phone1 }}</a> </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars01" aria-controls="navbars01" aria-expanded="false" aria-label="Toggle navigation"> <span></span> <span></span> <span></span> </button>
          <div class="collapse navbar-collapse" id="navbars01">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item active"> <a class="nav-link" href="{{ url('/') }}">Home</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/Health-Card') }}">Health Card</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/doctors') }}">Doctors</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/hospital') }}">Hospital</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/Pathology') }}">Pathology</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/ambulance') }}">Ambulance</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/E-Commerce') }}">Medicine</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a> </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!-- header lover end -->
  </header>
  <!-- ================ Header end ================ -->

