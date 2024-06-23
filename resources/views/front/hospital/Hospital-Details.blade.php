@extends('front.layouts.layout')

@section('title', 'Hospital Details')

@section('content')
<!-- ================ Details page bammer ================ -->
<div class="details-page-bammer">
    
    <div class="details-page-bammer-carousel owl-carousel owl-theme">
        @foreach ($gethospitaldata as $hospital)
      <div class="item"><img src="{{ asset('/admin_assets/uploads/hospital/'.$hospital->image) }}" alt=""></div>
     @endforeach
         @foreach ($getmultiimages as $hospitals)
      <div class="item"><img src="{{ asset('/admin_assets/uploads/hospital/small/'.$hospitals->image) }}" alt=""></div>
     @endforeach
    </div>
         @foreach ($gethospitaldata as $hospital)
    <div class="details-page-bammer-caption">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-8 offset-lg-4 offset-md-2">
            <div class="details-page-bammer-caption-c">
              <h1>{{ $hospital->name }}</h1>
              <div class="location"><i class="bi bi-geo-alt"></i>{{ $hospital->address }}, {{ $hospital->city_name }},{{ $hospital->district_name }},{{ $hospital->state_name }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="details-page-bammer-caption-btn">
        <a href="{{ asset('admin_assets/uploads/hospital_video/'.$hospital->video) }}">
        <source src="{{ asset('admin_assets/uploads/hospital_video/'.$hospital->video) }}"  type="video/mp4" class="venobox" data-autoplay="true" data-vbtype="video"><i class="bi bi-play-circle"></i>Video</a>
        <a href="{{ asset('/admin_assets/uploads/hospital/'.$hospital->image) }}" class="venobox" data-gall="gallery1"><i class="bi bi-camera"></i> Photos</a> <a href="{{ asset('/admin_assets/uploads/hospital/'.$hospital->image) }}" class="venobox d-none" data-gall="gallery1"></a>
             @foreach ($getmultiimages as $hospitals)
         <a href="{{ asset('/admin_assets/uploads/hospital/medium/'.$hospitals->image) }}" class="venobox d-none" data-gall="gallery1"></a>
           @endforeach
        </div>
    @endforeach

</div>
  <!-- ================ Details page bammer end ================ -->

  <!-- ================ Details page ================ -->
  <div class="details-page pt-70 pb-40">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <!-- details page btn -->
          <ul class="details-page-btn mb-20">
            <li><a href="#overview" class="smooth-menu">Overview</a></li>
            <li><a href="#facilities" class="smooth-menu">Facilities</a></li>
            {{-- <li><a href="#doctors" class="smooth-menu">Doctors</a></li>
            <li><a href="#testimonials" class="smooth-menu">Testimonials</a></li>
            <li><a href="#faqs" class="smooth-menu">FAQs</a></li>
            <li><a href="#review" class="smooth-menu">Review</a></li> --}}
          </ul>
          <!-- details page btn end -->
          <div id="overview" class="details-page-content-box mb-20">
            <h2 class="details-page-title">Overview</h2>
            @if(!empty($hospital->description))
            <p>{{ $hospital->description }}.</p>
            @endif
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
              <div class="col mb-20">
                @if(!empty($hospital->sort_description))
                <p>{{ $hospital->sort_description }}.</p>
                @endif
                <ul class="d-inline-block w-100 list">
                    @if(!empty($hospital->higlight_point_1))
                  <li><i class="bi bi-arrow-right-circle"></i> {{ $hospital->higlight_point_1 }}.</li>
                  @endif
                  @if(!empty($hospital->higlight_point_2))
                  <li><i class="bi bi-arrow-right-circle"></i>{{ $hospital->higlight_point_2 }}.</li>
                  @endif
                </ul>
              </div>
              <div class="col mb-20">
                @if(!empty($hospital->image))
                <div class="details-page-img"><img src="{{ asset('/admin_assets/uploads/hospital/'.$hospital->image) }}" alt=""></div>
                @endif
              </div>
            </div>
          </div>
          <div id="facilities" class="details-page-content-box mb-40">
            <h2 class="details-page-title">Facilities</h2>
            <div class="medical-facilitie-block">
              <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 text-center g-0">
                @if(!empty($getfaciclity->emergency_care == 'Yes'))
                <div class="col">
                  <div class="medical-facilitie-box">
                    <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/1.png" alt=""></div>
                    <h5 class="title">Emergency Care</h5>
                  </div>
                </div>
                @endif
                
                @if(!empty($getfaciclity->qualified_doctor == 'Yes'))
                <div class="col">
                  <div class="medical-facilitie-box">
                    <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/4.png" alt=""></div>
                    <h5 class="title">Qualified Doctor</h5>
                  </div>
                </div>
                @endif
                @if(!empty($getfaciclity->operation_theatre	 == 'Yes'))
                <div class="col">
                  <div class="medical-facilitie-box">
                    <div class="icon"><img src="{{ url('/') }}/front_assets/img/medical-facilitie-icon/5.png" alt=""></div>
                    <h5 class="title">Operation Theatre</h5>
                  </div>
                </div>
                @endif
                @if(!empty($getfaciclity->ambulance == 'Yes'))
                <div class="col">
                  <div class="medical-facilitie-box">
                    <div class="icon"><img src="{{ url('/') }}/front_assets/img/feature/4.jpg" alt=""></div>
                    <h5 class="title">Ambulance</h5>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
          {{-- <div id="doctors" class="details-page-content-box mb-10">
            <h2 class="details-page-title">Doctors</h2>
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1">
              <div class="col mb-30">
                <!-- team box -->
                <div class="team-box">
                  <div class="team-info"> <span class="designation">Doctor of Surgery</span>
                    <h5 class="name">Dr. Kevin Smith</h5>
                  </div>
                  <div class="image"><img src="{{ url('/') }}/front_assets/img/team/1.jpg" alt=""></div>
                  <div class="team-social"> <a href="#"><i class="bi bi-facebook"></i></a> <a href="#"><i class="bi bi-twitter"></i></a> <a href="#"><i class="bi bi-linkedin"></i></a> <a href="#"><i class="bi bi-pinterest"></i></a> </div>
                </div>
                <!-- team box end -->
              </div>
              <div class="col mb-30">
                <!-- team box -->
                <div class="team-box">
                  <div class="team-info"> <span class="designation">Physician</span>
                    <h5 class="name">Dr. Smith Adarson</h5>
                  </div>
                  <div class="image"><img src="{{ url('/') }}/front_assets/img/team/2.jpg" alt=""></div>
                  <div class="team-social"> <a href="#"><i class="bi bi-facebook"></i></a> <a href="#"><i class="bi bi-twitter"></i></a> <a href="#"><i class="bi bi-linkedin"></i></a> <a href="#"><i class="bi bi-pinterest"></i></a> </div>
                </div>
                <!-- team box end -->
              </div>
              <div class="col mb-30">
                <!-- team box -->
                <div class="team-box">
                  <div class="team-info"> <span class="designation">Master of Surgery</span>
                    <h5 class="name">Dr. John Doe</h5>
                  </div>
                  <div class="image"><img src="{{ url('/') }}/front_assets/img/team/3.jpg" alt=""></div>
                  <div class="team-social"> <a href="#"><i class="bi bi-facebook"></i></a> <a href="#"><i class="bi bi-twitter"></i></a> <a href="#"><i class="bi bi-linkedin"></i></a> <a href="#"><i class="bi bi-pinterest"></i></a> </div>
                </div>
                <!-- team box end -->
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
          <div class="hours-box mb-30">
            <h4 class="mb-8"> Hospital Specialities List</h4>
            <ul>
                @foreach ($gethpositalwsiespec as  $gethospitalwsieSpe)
              <li>
                @if(!empty($gethospitalwsieSpe->specialization_name))
                <p>{{ $gethospitalwsieSpe->specialization_name }}</p>
                @endif
              </li>
              @endforeach
            </ul>
          </div>
          <div class="hours-box mb-30">
            <h4 class="mb-8">Opening Hours</h4>
            <div class="place"><i class="bi bi-geo-alt"></i> {{ $hospital->address }}, {{ $hospital->city_name }},{{ $hospital->district_name }},{{ $hospital->state_name }}</div>
            <ul>
              <li>
                <h5>Monday-Thursday:</h5>
                @if(!empty($hospital->mon_thur))
                <p>{{ $hospital->mon_thur }}</p>
                @endif
              </li>
              <li>
                <h5>Friday-Saturday:</h5>
                @if(!empty($hospital->time_firday))
                <p>{{ $hospital->time_firday }}</p>
                @endif
              </li>
              <li>
                <h5>Sunday:</h5>
                @if(!empty($hospital->time_sunday))
                <p>{{ $hospital->time_sunday }}</p>
                @endif
              </li>
            </ul>
          </div>
          <!-- hours box end -->
        
          <!-- call us widget -->
          <div class="call-us-widget mb-30">
            <h5 class="call-us-widget-title mb-10">24-Hour Emergency Servise</h5>
            <div class="call">{{ $gethospitaldatasingledata->mobile }}</div>
          </div>
          <!-- call us widget end -->
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Details page end ================ -->
@endsection
