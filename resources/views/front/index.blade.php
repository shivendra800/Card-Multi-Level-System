@extends('front.layouts.layout')

@section('content')
  <!-- ================ Slider ================ -->
  <div class="slider">
    <div class="slider-overlay">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 col-md-6 order-lg-1 order-md-1 order-sm-2 order-2">
            <form class="search-form" method="post" action="{{ url('search-with-home') }}">
              @csrf
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Type Keyword..." name="keyword" >
              </div>
              {{-- <div class="mb-3">
                <input type="text" class="form-control" placeholder="Location">
              </div> --}}
              <select class="form-select mb-3" name="service" required>
                <option selected>Find Services</option>
                <option value="Clinic-Doctor">Doctors</option>
                <option value="Hospital">Hospital</option>
                <option value="Pathology">Pathology</option>
              </select>
              {{-- <div class="mb-3">
                <input type="date" class="form-control">
              </div> --}}
              {{-- <select class="form-select mb-3">
                <option selected>Specialities</option>
                <option value="Physiotherapist">Physiotherapist</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                <option value="Dentist">Dentist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Dietician">Dietician</option>
                <option value="Eye Doctor">Eye Doctor</option>
                <option value="Colorectal surgeon">Colorectal surgeon</option>
                <option value="Nephrologist">Nephrologist</option>
                <option value="Nutritionist">Nutritionist</option>
              </select> --}}
              <button type="submit" class="btn-style-1 w-100">Search</button>
            </form>
          </div>
          <div class="col-lg-6 col-md-6 offset-lg-2 order-lg-2 order-md-2 order-sm-1 order-1">
            @foreach ($sliderBanners as $banner )
            <div class="banner-caption">
              <h5>{{ $banner['title'] }}</h5>
              <p>{{ $banner['title'] }}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
          @foreach ($sliderBanners as $banner )
        <div class="carousel-item active slider-one" >
             <img title="{{ $banner['title'] }}" src="{{ asset('front_assets/banner_images/'.$banner['image']) }}">
        </div>
            @endforeach
      </div>
    </div>
  </div>
  <!-- ================ Slider end ================ -->
<!-- ================ Feature area ================ -->
<div class="feature-area pt-70 pb-40">
    <div class="container">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
        <div class="col mb-30">
          <!-- feature box -->
          <div class="feature-box">
            <div class="image"><img src="{{ url('/') }}/front_assets/img/feature/1.jpg" alt=""></div>
            <h3><a href="{{ url('/doctors') }}">Doctors</a></h3>
          </div>
          <!-- feature box end -->
        </div>
        <div class="col mb-30">
          <!-- feature box -->
          <div class="feature-box">
            <div class="image"><img src="{{ url('/') }}/front_assets/img/feature/2.jpg" alt=""></div>
            <h3><a href="{{ url('/hospital') }}">Hospital</a></h3>
          </div>
          <!-- feature box end -->
        </div>
        
        <div class="col mb-30">
          <!-- feature box -->
          <div class="feature-box">
            <div class="image"><img src="{{ url('/') }}/front_assets/img/feature/3.jpg" alt=""></div>
            <h3><a href="#">Pharmacy</a></h3>
          </div>
          <!-- feature box end -->
        </div>
        <div class="col mb-30">
          <!-- feature box -->
          <div class="feature-box">
            <div class="image"><img src="{{ url('/') }}/front_assets/img/feature/4.jpg" alt=""></div>
            <h3><a href="{{ url('/ambulance') }}">Ambulance</a></h3>
          </div>
          <!-- feature box end -->
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Feature area ================ -->

  <!-- ================ Popular hospital area ================ -->
  <div class="popular-hospital-area position-relative pt-70 pb-40">
    <div class="head-bg"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 mb-30">
          <!-- section title -->
          <div class="section-title mb-20">
            <div class="small-title">Hospital</div>
            <h2>Popular Hospital</h2>
            <span class="dashed-border"></span> </div>
          <!-- section title end -->
          {{-- <p>Lorem ipsum dolor sit amet consectetur adipiscing elit felis etiam tincidunt orci lacus id varius dolor fermum sit amet.</p> --}}
          <a class="btn-style-1" href="{{ url('/hospital') }}">View all Hospital</a> </div>
        <div class="col-lg-9">
          <div class="hospital-carousel owl-carousel owl-theme">
            @foreach ($popularHos as  $hospital)
            <div class="item">
              <!-- popular hospital box -->
              <div class="popular-hospital-box">
                <div class="popular-hospital-box-img"><img  src="{{ asset('/admin_assets/uploads/hospital/small/'.$hospital->multi_images) }}" alt="">
                </div>
                <div class="popular-hospital-des">
                  <h3><a href="{{ url('Hospital-Details/'.$hospital->name) }}">{{ $hospital->name }}</a></h3>
                  <div class="location mb-10"><i class="bi bi-geo-alt"></i>{{ $hospital->address }} {{ $hospital->city_name }},{{ $hospital->district_name }},{{ $hospital->state_name }}</div>
                  <a href="{{ url('Hospital-Details/'.$hospital->name) }}" class="btn-style-1 btn-sm">View Detail</a> </div>
                <a class="favorites-icon"><i class="bi bi-heart-fill"></i></a> 
              </div>
              <!-- popular hospital box end -->
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Popular hospital area end ================ -->

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

  <!-- ================ Team area ================ -->
  <div class="team-area pt-70 pb-40">
    <div class="container">
      <!-- section title -->
      <div class="section-title mb-40 text-center">
        <div class="small-title">Our Team</div>
        <h2>Speciality Clinic Doctors</h2>
        <span class="dashed-border"></span> </div>
      <!-- section title end -->
      <div class="doctors-carousel owl-carousel owl-theme">
        @foreach ($getClinicdoctordata as $doctor )
        <div class="item">
          <!-- team box -->
          <div class="team-box">
            <div class="team-info"><a href="{{ url('Doctor-Details/'.$doctor->slug) }}"> 
              {{-- <span class="designation">Doctor of Surgery</span> --}}
              <h5 class="name">{{ $doctor->name }}</h5>
              <h6 class="name" style="background-color: red;">{{ $doctor->clininc_name }}</h6>
              </a>
            </div>
            <div class="image"><img src="{{ asset('/admin_assets/uploads/doctor/small/'.$doctor->multi_images) }}" alt=""></div>

          </div>
          <!-- team box end -->
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- ================ Team area ================ -->

  <!-- ================ card area ================ -->
  <div class="card-area position-relative pt-70 pb-40 card-section">
    <div class="head-bg card-area-bg"></div>
    <div class="container">
      <!-- section title -->
      <div class="section-title mb-40 text-center">
        <div class="small-title">Health Card</div>
        <h2>Earn money by helping others.</h2>
        <span class="dashed-border">Become a mentor after 12 weeks and earn up to £5,000 per month.</span> </div>
      <!-- section title end -->
      <div class="card-carousel owl-carousel owl-theme">
        <div class="item">
          <!-- blog item -->
         <img src="{{ url('/') }}/front_assets/img/team/1.jpg">
          <!-- blog item end -->
      </div>
      <div class="item">
        <!-- blog item -->
       <img src="{{ url('/') }}/front_assets/img/team/2.jpg">
        <!-- blog item end -->
    </div>
    <div class="item">
      <!-- blog item -->
     <img src="{{ url('/') }}/front_assets/img/team/3.jpg">
      <!-- blog item end -->
  </div>
  <div class="item">
    <!-- blog item -->
   <img src="{{ url('/') }}/front_assets/img/team/4.jpg">
    <!-- blog item end -->
  </div>
  <div class="item">
    <!-- blog item -->
   <img src="{{ url('/') }}/front_assets/img/team/5.jpg">
    <!-- blog item end -->
  </div>
  <div class="item">
    <!-- blog item -->
   <img src="{{ url('/') }}/front_assets/img/team/6.jpg">
    <!-- blog item end -->
  </div>
  <div class="item">
    <!-- blog item -->
   <img src="{{ url('/') }}/front_assets/img/team/7.jpg">
    <!-- blog item end -->
  </div>
  <div class="item">
    <!-- blog item -->
   <img src="{{ url('/') }}/front_assets/img/team/8.jpg">
    <!-- blog item end -->
  </div>
    </div>
  </div>
  </div>
  <!-- ================ card area end ================ -->



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


  <!-- ================ Testimonial area ================ -->
  <div class="testimonial-area position-relative pt-70 pb-70">
    <div class="head-bg"></div>
    <div class="container">
      <!-- section title -->
      <div class="section-title mb-40 text-center">
        <div class="small-title">Testimonial</div>
        <h2>Our Patients Say</h2>
        <span class="dashed-border"></span> </div>
      <!-- section title end -->
      <div class="testimonial-carousel owl-carousel owl-theme">
        @foreach ($review as $review)
        <div class="item">
          <!-- testimonial box -->
          <div class="testimonial-box">
            <p>{{ $review->comment }}</p>
            <div class="profile-info">
              <div class="author-img"><img src="{{ url('/') }}/front_assets/dummy.jpg" alt=""></div>
              <div class="info-des">
                <h3>{{ $review->customer_name }}</h3>
                <span class="post">{{ $review->type }}</span> </div>
               
                <div class="star"> 
                  @for($i = 0; $i < 5; $i++)
                  <i class="bi bi-star{{ $review->rate <= $i ? '' : '-fill' }}"> </i> 
                  @endfor
                  

                </div>
             
                 
              {{-- <div class="star"> 
                <i class="bi bi-star-fill"> </i> 
                <i class="bi bi-star-fill"> </i> 
                <i class="bi bi-star-fill"> </i> 
                <i class="bi bi-star"></i> 
                <i class="bi bi-star"></i> 
              </div> --}}
            </div>
          </div>
          <!-- testimonial box end -->
        </div>
          
        @endforeach
        
       
      </div>
    </div>
  </div>
  <!-- ================ Testimonial area end ================ -->


  <!-- ================ Blog area ================ -->
  <div class="blog-area position-relative pt-70 pb-40">
    <div class="container">
      <!-- section title -->
      <div class="section-title mb-40 text-center">
        <div class="small-title">Our Blogs</div>
        <h2>Latest News</h2>
        <span class="dashed-border"></span> </div>
      <!-- section title end -->
      <div class="bolg-carousel owl-carousel owl-theme">
        @foreach ($blog as $blogDetails )
        <div class="item">
          <!-- blog item -->
          <div class="blog-item">
            <div class="blog-item-img"><img src="{{ asset('front_assets/blog_images/'.$blogDetails['image']) }}" alt="">
            </div>
            <div class="blog-item-content">
              <h6><a href="#">{{ $blogDetails['blog_title'] }}</a></h6>
              <ul class="list-inline d-flex align-items-center justify-content-between">
                <li class="list-inline-item"><a href="#"><i class="bi bi-calendar-check"></i>{{ \Carbon\Carbon::parse($blogDetails['created_at'])->isoFormat('MMM Do YYYY')}}</a></li>
              </ul>
              <p>{{ $blogDetails['description'] }}</p>
            </div>
          </div>
          <!-- blog item end -->
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- ================ Blog area end ================ -->

@endsection
