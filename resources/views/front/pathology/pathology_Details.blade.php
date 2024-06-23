@extends('front.layouts.layout')

@section('title', 'Pathology Details')

@section('content')
<!-- ================ Details page bammer ================ -->
<div class="details-page-bammer">
    <div class="details-page-bammer-carousel owl-carousel owl-theme">
        @foreach ($getpathlogydata as $pathDetails )
        <div class="item"><img src="{{ asset('/admin_assets/uploads/pathology/'.$pathDetails->image) }}" alt=""></div>
        @endforeach
    </div>
    <div class="details-page-bammer-caption">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-8 offset-lg-4 offset-md-2">
            <div class="details-page-bammer-caption-c">
              <h1>{{ $getpathologydatasingledata->clininc_name }}</h1>
              @foreach ($getpathlogydata as $pathDetails )
              <div class="location"><i class="bi bi-geo-alt"></i> {{ $pathDetails->address }}, {{ $pathDetails->city_name }},{{ $pathDetails->district_name }},{{ $pathDetails->state_name }}</div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Details page bammer end ================ --> 
  
  <!-- ================ Details page ================ -->
  <div class="details-page pt-70 pb-40">
    <div class="container">
      <div class="row">
        <div class="col-lg-9"> 
          <!-- details page btn -->
          <ul class="details-page-btn mb-20">
            <li><a href="#overview" class="smooth-menu">Test Type And Charges</a></li>
            <li><a href="#facilities" class="smooth-menu">Facilities</a></li>
            <li><a href="#testimonials" class="smooth-menu">Testimonials</a></li>
            <li><a href="#faqs" class="smooth-menu">FAQs</a></li>
            <li><a href="#review" class="smooth-menu">Review</a></li>
          </ul>
          <!-- details page btn end -->
          <div id="overview" class="details-page-content-box mb-20">
            <h2 class="details-page-title">Test Type And Charges</h2>
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
              <div class="col mb-20">
                <ul class="d-inline-block w-100 list">
                    @foreach ($getpathologytestwsiespec as $testType )
                    <li><i class="bi bi-arrow-right-circle"></i>{{ $testType->name }}--<strong style="color: red;">Rs.{{ $testType->test_charge }}</strong></li>
                    @endforeach
                </ul>
              </div>
              <div class="col mb-20">
                <div class="details-page-img"><img src="{{ url('/') }}/front_assets/img/details-page/details-page-img-1.jpg" alt=""></div>
              </div>
            </div>
          </div>
          {{-- <div id="facilities" class="details-page-content-box mb-40">
            <h2 class="details-page-title">Facilities</h2>
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
          <div id="testimonials" class="details-page-content-box mb-40">
            <h2 class="details-page-title">Testimonials</h2>
            <div class="testimonial-carousel owl-carousel owl-theme">
              <div class="item"> 
                <!-- testimonial box -->
                <div class="testimonial-box">
                  <p>Lorem ipsum dolor eletum nulla eu placerat felis etiam tincidunt tiam tincidunt orci lacus id varius dolor etiam tincidunt tiam tincidunt orci lacus id varius dolor fermum sit amet orem.</p>
                  <div class="profile-info">
                    <div class="author-img"><img src="{{ url('/') }}/front_assets/img/testimonial/1.jpg" alt=""></div>
                    <div class="info-des">
                      <h3>Henry</h3>
                      <span class="post">Customer</span> </div>
                    <div class="star"> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i> </div>
                  </div>
                </div>
                <!-- testimonial box end --> 
              </div>
              <div class="item"> 
                <!-- testimonial box -->
                <div class="testimonial-box">
                  <p>Lorem ipsum dolor eletum nulla eu placerat felis etiam tincidunt tiam tincidunt orci lacus id varius dolor etiam tincidunt tiam tincidunt orci lacus id varius dolor fermum sit amet orem.</p>
                  <div class="profile-info">
                    <div class="author-img"><img src="{{ url('/') }}/front_assets/img/testimonial/2.jpg" alt=""></div>
                    <div class="info-des">
                      <h3>Barton</h3>
                      <span class="post">Customer</span> </div>
                    <div class="star"> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i> </div>
                  </div>
                </div>
                <!-- testimonial box end --> 
              </div>
              <div class="item"> 
                <!-- testimonial box -->
                <div class="testimonial-box">
                  <p>Lorem ipsum dolor eletum nulla eu placerat felis etiam tincidunt tiam tincidunt orci lacus id varius dolor etiam tincidunt tiam tincidunt orci lacus id varius dolor fermum sit amet orem.</p>
                  <div class="profile-info">
                    <div class="author-img"><img src="{{ url('/') }}/front_assets/img/testimonial/3.jpg" alt=""></div>
                    <div class="info-des">
                      <h3>Mattie</h3>
                      <span class="post">Customer</span> </div>
                    <div class="star"> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i> </div>
                  </div>
                </div>
                <!-- testimonial box end --> 
              </div>
            </div>
          </div>
          <div id="faqs" class="details-page-content-box mb-40">
            <h2 class="details-page-title">FAQs</h2>
            <!-- Accordion -->
            <div class="accordion faq-box" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bi bi-plus-lg"></i> Are you ISO certified?</button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p class="mb-0">Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor sitametcoctr adipisg.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="bi bi-plus-lg"></i> Which material types can you work with?</button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p class="mb-0">Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor sitametcoctr adipisg.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="bi bi-plus-lg"></i> How long does it takes to receive the answer?</button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p class="mb-0">Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor sitametcoctr adipisg.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> <i class="bi bi-plus-lg"></i> How to get start with us?</button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p class="mb-0">Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit adipisg elit amet consectur orem ipsum dolor sitametcoctr adipisg.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Accordion end --> 
          </div>
          <div id="review" class="details-page-content-box mb-30">
            <h2 class="details-page-title">Review</h2>
            <!-- comments area -->
            <div class="comments-block">
              <ul>
                <li>
                  <div class="d-flex">
                    <div class="flex-grow-1">
                      <h5>Smith Adarson <small>Jan 01, <span class="current-year"></span></small></h5>
                      <p>Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit consectur aiscing elit amet adipisg adipisg.</p>
                    </div>
                    <div class="flex-shrink-0"><img src="{{ url('/') }}/front_assets/img/blog/comment-1.jpg" alt="..."><a href="#" class="reply"><i class="bi bi-arrow-up-right-square"></i></a></div>
                  </div>
                  <ul>
                    <li>
                      <div class="d-flex">
                        <div class="flex-grow-1">
                          <h5>Kevin Smith <small>Jan 01, <span class="current-year"></span></small></h5>
                          <p>Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit consectur aiscing elit amet adipisg adipisg.</p>
                        </div>
                        <div class="flex-shrink-0"><img src="{{ url('/') }}/front_assets/img/blog/comment-2.jpg" alt="..."><a href="#" class="reply"><i class="bi bi-arrow-up-right-square"></i></a></div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li>
                  <div class="d-flex">
                    <div class="flex-grow-1">
                      <h5>Daisy John <small>Jan 01, <span class="current-year"></span></small></h5>
                      <p>Lorem ipsum dolor sitametcoctr elit amet consectur aiscing elit amet adipisg elit consectur aiscing elit amet adipisg adipisg.</p>
                    </div>
                    <div class="flex-shrink-0"><img src="{{ url('/') }}/front_assets/img/blog/comment-3.jpg" alt="..."><a href="#" class="reply"><i class="bi bi-arrow-up-right-square"></i></a></div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- comments area end --> 
          </div> --}}
        </div>
        <div class="col-lg-3"> 
          <!-- hours box -->
          {{-- <div class="hours-box mb-30">
            <h4 class="mb-8">Opening Hours</h4>
            <ul>
              <li>
                <h5>Monday-Thursday:</h5>
                <p>9:00 - 5:00</p>
              </li>
              <li>
                <h5>Friday:</h5>
                <p>9:00 - 4:00</p>
              </li>
              <li>
                <h5>Saturday:</h5>
                <p>9:00 - 2:00</p>
              </li>
              <li>
                <h5>Sunday:</h5>
                <p>Closed</p>
              </li>
            </ul>
          </div> --}}
          <!-- hours box end --> 
          <!-- side book appointment -->
          <!-- side book appointment end --> 
          <!-- call us widget -->
          {{-- <div class="call-us-widget mb-30">
            <h5 class="call-us-widget-title mb-10">24-Hour Emergency Servise</h5>
            <div class="call">{{ $getpathologydatasingledata->mobile }}</div>
          </div> --}}
          <!-- call us widget end --> 
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Details page end ================ --> 
@endsection
