<!-- ================ Footer area ================ -->
<footer class="footer-main">
    <!-- footer upper -->
    <div class="footer-upper pt-40 pb-10">
      <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
          <div class="col mb-30">
            <!-- footer title -->
            <div class="footer-title">Address</div>
            <!-- footer title end -->
            <p>{{ $get_setting_data->addresss }}</p>
            <!-- footer title -->
            <div class="footer-title">Contact Us</div>
            <!-- footer title end -->
            <!-- footer address -->
            <ul class="footer-address">
              <li><a href="mailto:info@example.com"><i class="bi bi-envelope"></i> {{ $get_setting_data->email1 }}</a></li>
              <li><a href="tel:123457890"><i class="bi bi-telephone"></i> {{ $get_setting_data->phone1 }}</a></li>
            </ul>
            <!-- footer address end -->
          </div>
          <div class="col mb-30">
            <!-- footer title -->
            <div class="footer-title">Useful Links</div>
            <!-- footer title end -->
            <!-- footer link -->
            <ul class="footer-link">
              <li><a href="{{ url('about') }}"><i class="bi bi-caret-right"></i> About us</a></li>
              <li><a href="{{ url('doctors') }}"><i class="bi bi-caret-right"></i> Find a Doctors</a></li>
              <li><a href="{{ url('hospital') }}"><i class="bi bi-caret-right"></i> Find a Hospital</a></li>
              <li><a href="{{ url('Health-Card') }}"><i class="bi bi-caret-right"></i> Find a Health Card</a></li>
              <li><a href="{{ url('Pathology') }}"><i class="bi bi-caret-right"></i> Find a Pathology</a></li>
              <li><a href="#"><i class="bi bi-caret-right"></i> Find a Pharmacy</a></li>
              <li><a href="{{ url('contact') }}"><i class="bi bi-caret-right"></i> Contact Us</a></li>
            </ul>
            <!-- footer link end -->
          </div>
          <div class="col mb-30">
            <!-- footer title -->
            <div class="footer-title">Company</div>
            <!-- footer title end -->
            <!-- footer recent post -->
            <ul class="footer-recent-post">
              <li>
                <div class="footer-recent-post-des">
                  <h5 class="post-title"><a href="#">{{ $get_setting_data->meta_keywords }}</a></h5>
                  <div class="post-date"> {{ \Carbon\Carbon::parse($get_setting_data->updated_at)->isoFormat('MMM Do YYYY')}}  </div>
                </div>
              </li>
            </ul>
            <!-- footer recent post end -->
          </div>
          <div class="col mb-30">
            <!-- footer title -->
            <div class="footer-title">Business Hours</div>
            <!-- footer title end -->
            <!-- footer hours -->
            <ul class="footer-hours mb-20">
              <li><span>Monday-Friday:</span> 9am to 6pm</li>
              <li><span>Saturday:</span> 10am to 5pm</li>
              <li><span>Sunday:</span> Closed</li>
            </ul>
            <!-- footer hours end -->
            <!-- footer social -->
            <div class="footer-social"> <a href="{{ $get_setting_data->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a> 
              <a href="{{ $get_setting_data->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a> 
              <a href="{{ $get_setting_data->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
               <a href="{{ $get_setting_data->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a>
               </div>
            <!-- footer social end -->
          </div>
        </div>
      </div>
    </div>
    <!-- footer upper end -->
    <!-- footer copyright -->
    <div class="footer-copyright text-center">
      <div class="container">
        <p class="mb-0"><strong>Copyright &copy; 2023 <a href="https://uifstechnologies.com/">UIFS Technology</a>.</strong><span class="current-year"></span> All Rights Reserved.</p>
      </div>
    </div>
    <!-- footer copyright end -->
  </footer>
  <!-- ================ Footer area end ================ -->
