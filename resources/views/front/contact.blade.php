@extends('front.layouts.layout')

@section('title', 'Contact Us')

@section('content')
<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Contact Us</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->
<!-- ================ Contact us page ================ -->
<div class="contact-us-page pt-70 pb-40">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 mb-10">
          <!-- contact box -->
          <div class="contact-box mb-20">
            <div class="icon"><i class="bi bi-geo-alt"></i></div>
            <h4 class="mb-8">Visit our office at</h4>
            <p>{{ $get_setting_data->addresss }}</p>
          </div>
          <!-- contact box end -->
          <div class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1">
            <div class="col">
              <!-- contact box -->
              <div class="contact-inner-box mb-20">
                <div class="icon"><i class="bi bi-envelope"></i></div>
                <h4 class="mb-8">Email</h4>
                <p> {{ $get_setting_data->email1 }}</p>
                <p> {{ $get_setting_data->email2 }}</p>
              </div>
              <!-- contact box end -->
            </div>
            <div class="col">
              <!-- contact box -->
              <div class="contact-inner-box mb-20">
                <div class="icon"><i class="bi bi-telephone"></i></div>
                <h4 class="mb-8">Call Us</h4>
                <p> {{ $get_setting_data->phone1 }}</p>
                <p> {{ $get_setting_data->phone2 }}</p>
              </div>
              <!-- contact box end -->
            </div>
            <div class="col">
              <!-- contact box -->
              <div class="contact-inner-box mb-20">
                <div class="icon"><img style="width: 50px;" src="{{ asset('front_assets/social-media.png') }}"></div>
                <h4 class="mb-8">Socila Media</h4>
                <p><a href="{{ $get_setting_data->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="{{ $get_setting_data->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a>
                <a href="{{ $get_setting_data->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                 <a href="{{ $get_setting_data->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a></p>
              </div>
              <!-- contact box end -->
            </div>
          </div>
          <div class="contact-img mb-20"><img src="{{ url('/') }}/front_assets/img/contact-img.jpg" alt=""></div>
        </div>
        <div class="col-lg-6 col-md-12 mb-30">
          <!-- map area -->
          <div class="map-box mb-30">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56935.632395862434!2d80.95985441403852!3d26.888351983208388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd549ce377af%3A0xb88f53ecb02c52d8!2sIndira%20Nagar%2C%20Lucknow%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1680162237902!5m2!1sen!2sin"></iframe>
          </div>
          <!-- map area end -->
        </div>
      </div>
      <!-- contact form -->
      {{-- <form class="contact-form mb-30" id="contact-form" method="post" action="contact.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3">
              <input type="text" class="form-control" name="Your-Name" placeholder="Your Name" required data-error="Your Name is required.">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <input type="email" class="form-control" name="Your-Email" placeholder="Your Email" required data-error="Email is required.">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <input type="text" placeholder="Your Phone" name="Your-Phone" class="form-control" required data-error="Phone is required.">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <input type="text" placeholder="Subject" name="Subject" class="form-control" required data-error="Subject is required.">
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <textarea class="form-control" rows="3" name="Message" placeholder="Your Message" required data-error="Message is required."></textarea>
          <div class="help-block with-errors"></div>
        </div>
        <button type="submit" class="btn-style-1">Submit Message</button>
        <div class="messages"></div>
      </form> --}}
      <!-- contact form end -->
    </div>
  </div>
  <!-- ================ Contact us page end ================ -->
@endsection
