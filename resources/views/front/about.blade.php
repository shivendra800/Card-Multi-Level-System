@extends('front.layouts.layout')

@section('title', 'Abouts Us')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>About Us</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->

  <!-- ================ About area ================ -->
  <div class="about-area pt-70 pb-40">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about-text">
            <h4>About Us</h4>
            <h2 class="mb-20">{{ $get_setting_data->about_us_title }}</h2>
            <p>{{ $get_setting_data->about_us_description }}.</p>
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1">
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Happy Patients</h3>
                  <span class="counter">{{ $get_setting_data->happy_paitent }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Specialist Doctors</h3>
                  <span class="counter">{{ $get_setting_data->specialist_doctors }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Specialist Hospital</h3>
                  <span class="counter">{{ $get_setting_data->specialist_hospital }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Specialist Pathology</h3>
                  <span class="counter">{{ $get_setting_data->specialist_pathology }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Specialist Ambulance</h3>
                  <span class="counter">{{ $get_setting_data->ambulance }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
              <div class="col mb-30">
                <!-- counter box -->
                <div class="counter-box">
                  <h3>Years of Experience</h3>
                  <span class="counter">{{ $get_setting_data->company_exp }}</span> <span class="plus">+</span></div>
                <!-- counter box end -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1 mb-30">
          @foreach ($AboutUsBanners as $bannerAboutUs )
          <div class="about-img"> <img src="{{ asset('front_assets/banner_images/'.$bannerAboutUs['image']) }}" alt=""> </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- ================ About area end ================ -->

  <!-- ================ Call to action area ================ -->
  <div class="call-to-action-area pt-70 pb-70">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 offset-lg-2">
          <div class="cta-text">
            @foreach ($fixBanners as $bannerfix )
            <div class="icon"><img src="{{ url('/') }}/front_assets/img/ambulance.png" alt=""></div>
            <h2>{{ $bannerfix['title']  }}</h2>
            <p>{{ $bannerfix['link']  }}</p>
            <a href="tel:123-456-789"><i class="bi bi-telephone"></i>{{ $get_setting_data->phone1 }}</a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Call to action area end ================ -->

  <!-- ================ Medical facilities area ================ -->
  <div class="medical-facilities-area bg-light pt-70 pb-70">
    <div class="container">
      <!-- section title -->
      <div class="section-title mb-40 text-center">
        <div class="small-title">Facilities</div>
        <h2>Medical Facilities</h2>
        <span class="dashed-border"></span> </div>
      <!-- section title end -->
      <div class="medical-facilitie-block">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 text-center g-0">
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/1.png" alt=""></div>
              <h5 class="title">Emergency Care</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/2.png" alt=""></div>
              <h5 class="title">Outdoor Checkup</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/3.png" alt=""></div>
              <h5 class="title">Digital Diagnosis</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/4.png" alt=""></div>
              <h5 class="title">Qualified Doctor</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/5.png" alt=""></div>
              <h5 class="title">Operation Theatre</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/6.png" alt=""></div>
              <h5 class="title">Heart Surgery</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/7.png" alt=""></div>
              <h5 class="title">Dental Care</h5>
            </div>
          </div>
          <div class="col">
            <div class="medical-facilitie-box">
              <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/8.png" alt=""></div>
              <h5 class="title">Cardiologist</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Medical facilities area end ================ -->

@endsection
