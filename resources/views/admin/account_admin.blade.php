@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                        <h1 class="m-0">Admin Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Account  </li>
                    </ol>
                </div><!-- /.col -->
                {{-- Box OF User Number --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <a href="{{ url('admin/state-head-hcms') }}">
                      <div class="info-box-content">
                        <span class="info-box-text">Total State Head </span>
                        <span class="info-box-number">Member-{{ $totalStateHead }}</span>
                      </div>
                    </a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <a href="{{ url('admin/district-head-hcms') }}">
                      <div class="info-box-content">
                        <span class="info-box-text">Total District Head </span>
                        <span class="info-box-number">Member-{{ $totalDistrictHead }}</span>
                      </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <a href="{{ url('admin/city-head-hcms') }}">
                      <div class="info-box-content">
                        <span class="info-box-text">Total City Head </span>
                        <span class="info-box-number">Member-{{ $totalCityHead }}</span>
                      </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <a href="{{ url('admin/create-health-card') }}">
                      <div class="info-box-content">
                        <span class="info-box-text">Total Health Card </span>
                        <span class="info-box-number">Member-{{ $totalhealthCard }}</span>
                      </div>
                      </a>
                    </div>
                  </div>
                  {{-- box of user number end --}}

                  {{-- Admin profit and revenue --}}
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">TOTAL REVENUE </span>
                        <span class="info-box-number">Account Opening - Rs.{{ $totalRegisterAmount }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-rupee-sign"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Register Admin  </span>
                        <span class="info-box-number">Profit- Rs.{{ $regstatewalletamt }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total REVENUE </span>
                        <span class="info-box-number">Health Card-Rs.{{ $toatalHealthCardAmount }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-rupee-sign"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Card Admin</span>
                        <span class="info-box-number">Profit- Rs.{{ $healthCardWalletstate }}</span>
                      </div>
                    </div>
                  </div>
                  {{-- Admin profit and renv end --}}
                  {{-- Profit of meneber Start --}}
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1">
                         <i class='fas fa-wallet' style='color: blue'></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total State Profit </span>
                        <span class="info-box-number">Account Opening Profit => Rs.{{ $totalStateHeadProfit }}</span>
                        <a href="{{ url('/') }}/admin/health-wallet-Transection-History">
                       
                        <span class="info-box-number">HealthCard Profit=> Rs.{{ $totalStateHeadProfitHealth }}</span>
                      </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1">
                    <i class='fas fa-wallet' style='color: blue'></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total District Profit </span>
                                            <span class="info-box-number">Account Opening Profit => Rs.{{ $totalDistrictHeadProfit }}</span>
                                            <a href="{{ url('/') }}/admin/health-wallet-Transection-History">
                                            <span class="info-box-number">Health Card => Rs.{{ $totalDistrictHeadProfitHealth }}</span>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                        <span class="info-box-icon bg-warning elevation-1">
                    <i class='fas fa-wallet' style='color: blue'></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total City Profit </span>
                                            <a href="{{ url('/') }}/admin/health-wallet-Transection-History">
                                            <span class="info-box-number">Health Card => Rs.{{ $totalCityHeadProfit }}</span>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                        <span class="info-box-icon bg-warning elevation-1">
                    <i class='fas fa-wallet' style='color: blue'></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Health Card </span>
                        <a href="{{ url('/') }}/admin/health-wallet-Transection-History">
                        <span class="info-box-number">Health Card Profit=> Rs.{{ $totalhealthCardProfit }}</span>
                        </a>
                      </div>
                    </div>
                  </div>

                  {{-- Profit Of menber End --}}
            </div><!-- /.row -->
            <hr>
            <a href="{{ url('admin/state-head-hcms') }}">  
            <h4>State Head  GST</h4>
           
            <div class="row mb-2">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                     
                      <div class="info-box-content">
                        <span class="info-box-text">Total State GST </span>
                        <span class="info-box-number">Rs-{{ $totalstateheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Today State GST </span>
                        <span class="info-box-number">Rs-{{ $todaystateheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Monthly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisMonthstateheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Yearly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisYearstateheadgst }}</span>
                      </div>
                    </div>
                </div>
            </div>
          </a>
            <hr>
            <a href="{{ url('admin/district-head-hcms') }}">  
            <h4>District Head  GST</h4>
            <div class="row mb-2">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total State GST </span>
                        <span class="info-box-number">Rs-{{ $totaldistrictheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Today State GST </span>
                        <span class="info-box-number">Rs-{{ $todaydistrictheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Monthly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisMonthdistrictheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Yearly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisYeardistrictheadgst }}</span>
                      </div>
                    </div>
                </div>
            </div>
          </a>
            <hr>
            <a href="{{ url('admin/city-head-hcms') }}">  
            <h4>City Head GST</h4>
            <div class="row mb-2">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total State GST </span>
                        <span class="info-box-number">Rs-{{ $totalcityheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Today State GST </span>
                        <span class="info-box-number">Rs-{{ $todaycityheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Monthly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisMonthcityheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Yearly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisYearcityheadgst }}</span>
                      </div>
                    </div>
                </div>
            </div>
          </a>
            <hr>
            <a href="{{ url('admin/create-health-card') }}">  
            <h4>Health Card GST</h4>
            <div class="row mb-2">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total State GST </span>
                        <span class="info-box-number">Rs-{{ $totalhealthcardheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Today State GST </span>
                        <span class="info-box-number">Rs-{{ $todayhealthcardheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Monthly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisMonthhealthcardheadgst }}</span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Yearly State GST </span>
                        <span class="info-box-number">Rs-{{ $thisYearhealthcardheadgst }}</span>
                      </div>
                    </div>
                </div>
            </div>
          </a>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                 @if(!empty(Auth::guard('admin')->user()->image))
            <img style="width: 80px;" src="{{ url('admin_assets/uploads/adminlogin/'.Auth::guard('admin')->user()->image) }}" alt="profile">
            @else
            <img style="width: 80px;" src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="profile">
            @endif
              </div>

              <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>

              <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>
              <p class="text-muted text-center">{{ Auth::guard('admin')->user()->email }}</p>
              <p class="text-muted text-center">{{ Auth::guard('admin')->user()->mobile }}</p>


              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Join Us</b> <a class="float-right">{{ \Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)->isoFormat('MMM Do YYYY')}}</a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="float-right"> @if  (Auth::guard('admin')->user()->status == '1') <span>Active</span> @else <span>InActive</span> @endif  </a>
                </li>
                <li class="list-group-item">
                    <b>Total Register Amount</b> <strong style="color: black;"><a class="float-right">Rs.{{ $totalRegisterAmount }}</a></strong>
                  </li>

                <li class="list-group-item">
                  <b>Wallet Register Profit Amount</b> <h5><a class="float-right" style="color: red;">Rs.{{ $regstatewalletamt }}</a></h5>
                </li>
                <li class="list-group-item">
                    <b>Total Healthcard  Amount</b> <h5><a class="float-right" style="color: black;">Rs.{{ $toatalHealthCardAmount }}</a></h5>
                  </li>
                <li class="list-group-item">
                  <b>Wallet Healthcard Profit Amount</b> <h5><a class="float-right" style="color: red;">Rs.{{ $healthCardWalletstate }}</a></h5>
                </li>
                <li class="list-group-item">
                    <b>Total Level Income Amount</b> <h5><a class="float-right" style="color: red;">Rs.{{ $totalLevelAmount }}</a></h5>
                  </li>
                  <li class="list-group-item">
                    <b>Total Hospital Commission Of Admin</b> <h5><a class="float-right" style="color: red;">Rs.{{ $totalwallet_hospital }}</a></h5>
                  </li>
                  <li class="list-group-item">
                    <b>Total Clinic Doctor Commission Of Admin</b> <h5><a class="float-right" style="color: red;">Rs.{{ $totalwallet_doctor }}</a></h5>
                  </li>
                  <li class="list-group-item">
                    <b>Total Pathology Commission Of Admin</b> <h5><a class="float-right" style="color: red;">Rs.{{ $totalwallet_pathologys }}</a></h5>
                  </li>
              </ul>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Transaction History</a></li>
                  <li class="nav-item"><a class="nav-link " href="#timeline" data-toggle="tab">HealthCard Transaction History</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile</a></li> --}}
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content" >
                  <div class="tab-pane active" id="activity" >
                    <div class="tab-pane active" id="activity">{{ $wallet->links() }}</div>
                    <!-- Post -->
                    <div class="post text-center">

                      @foreach ($wallet as $waa )
                      <?php
                      $admin_transfer_percentage =  100 - ($waa['state_percentage'] + $waa['district_percentage']+ $waa['city_percentage'])
                  ?>
                              <div class="user-block">
                                <img style="width: 60px;" src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="profile">
                                <span class="username">
                                    <strong>{{ date('d-m-Y',strtotime($waa['created_at'])); }}</strong>
                                 <h5 style="color:brown;"> Transfer Amount => Rs.<strong style="color:black;">{{ $waa->admin_transfered_amt }}</strong></h5>
                                 <strong style="color:brown;"> Admin Transfer Perencentage =><samll style="color:black;">{{ $admin_transfer_percentage }} %</samll></strong>
                                 <h6 style="color:brown;"> Total Register Amount => Rs.<strong style="color:black;"> {{ $waa->registration_amt }}</strong></h6>
                                </span>
                                    <p>
                                       <br> {{$waa->remark}}.<strong>{{ date('Y-m-d h:i:s',strtotime($waa['created_at'])); }}</strong>
                                      </p>
                                      <hr>
                              </div>
                              <!-- /.user-block -->
                          @endforeach
                      <!-- /.user-block -->
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane " id="timeline" >
                    <div id="timeline">{{ $walletHealthCard->links() }}</div>
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <div class="post text-center">
                        @foreach ($walletHealthCard as $walletHealth )
                        <?php
                        $admin_transfer_percentage =  100 - ($walletHealth['state_percentage'] + $walletHealth['district_percentage']+ $walletHealth['city_percentage']+ $walletHealth['healthcard_percentage'])
                    ?>
                      <div class="user-block">
                        <img style="width: 60px;" src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="profile">
                        <span class="username">
                            <strong>{{ date('d-m-Y',strtotime($walletHealth['created_at'])); }}</strong>
                            <h5 style="color: brown;"> Transfer Amount => Rs.<strong style="color: black;">{{ $walletHealth->admin_transfered_amt }}</strong></h5>
                            <strong style="color:brown;"> Admin  Transfer Amount Perencentage =><samll style="color:black;">{{ $admin_transfer_percentage }} %</samll></strong>
                            <h6 style="color:brown;"> Total HealthCard Amount => Rs.<strong style="color:black;"> {{ $walletHealth->health_card_amount }}</strong></h6>
                        </span>
                            <p>
                               <br> {{$walletHealth->remark}}<br><strong>{{ date('Y-m-d h:i:s',strtotime($walletHealth['created_at'])); }}</strong>
                              </p>
                              <hr>
                      </div>

                      <!-- /.user-block -->
                      @endforeach
                      {{-- <div>
                        {{ $wallet->links() }}
                    </div> --}}
                    </div>
                    </div>
                  </div>

                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>



                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <center><h2 >Level Income </h2></center>
        <div class="row mb-2">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Today Health Card Created </span>
                <span class="info-box-number">Health Card-{{ $todayHealthCard }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Month Health Card Created </span>
                <span class="info-box-number">Health Card-{{ $thisMonthHealthCard }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Year Health Card Created </span>
                <span class="info-box-number">Health Card-{{ $thisYearHealthCard }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Today Level Income  </span>
                <span class="info-box-number">Rs.{{ $totalDayLevelIncome }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Months Level Income  </span>
                <span class="info-box-number">Rs.{{ $totalMonthsLevelIncome }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Year Level Income  </span>
                <span class="info-box-number">Rs.{{ $totalYearLevelIncome }}</span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
       <a href="{{ url('/') }}/admin/Level-Income-Histroy-Report"><center><h2 >Level Income Histroy </h2></center></a> 
       
        <hr>
        <!-- commission distribute in three level amount from hospital -->
      <a href="{{ url('admin/Hospital-Comm-Report') }}"> <center><h2 >Hospital Waise Commission Histroy </h2></center></a>
       <hr>
       <a href="{{ url('admin/hospital-List') }}"
       <div class="row mb-2">
          <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Paitent</span>
                  <span class="info-box-number">Added-Member-:{{ $totalPatientDetails }}</span>
                  <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalPatientDetailsadiscountamount }}</span>
                  <span class="info-box-number">Hospital-Profit-Rs-{{ $totalPatientdischargeamount }}</span>
                  <span class="info-box-number">company commission-Rs-{{ $totalcompanycommission }}</span>
                </div>
              </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Today Patient </span>
                  <span class="info-box-number">Added-Member-:{{ $todayPatientDetails }}</span>
                  <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalDayPatientDetailsadiscountamount }}</span>
                  <span class="info-box-number">Hospital-Profit-Rs-{{ $totalDayPatientdischargeamount }}</span>
                  <span class="info-box-number">company commission-Rs-{{ $totalDaycompanycommission }}</span>
                </div>
              </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Monthly Patient</span>
                  <span class="info-box-number">Added-Member-:{{ $thisMonthPatientDetails }}</span>
                  <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalMonthsPatientDetailsadiscountamount }}</span>
                  <span class="info-box-number">Hospital-Profit-Rs-{{ $totalMonthsPatientdischargeamount }}</span>
                  <span class="info-box-number">company commission-Rs-{{ $totalMonthscompanycommission }}</span>
                </div>
              </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Yearly Patient</span>
                  <span class="info-box-number">Added-Member-:{{ $thisYearPatientDetails }}</span>
                  <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalYearPatientDetailsadiscountamount }}</span>
                  <span class="info-box-number">Hospital-Profit-Rs-{{ $totalYearPatientdischargeamount }}</span>
                  <span class="info-box-number">company commission-Rs-{{ $totalYearcompanycommission }}</span>
                </div>
              </div>
          </div>
    </div>
  </a>
      
           <!-- commission distribute in three level amount from Clinic Doctor -->
      <a href="{{ url('admin/ClinicDoctor-Comm-Report') }}"><center><h2 >Clinic Doctor Waise Commission Histroy </h2></center></a> 
       <hr>
       
           <!-- commission distribute in three level amount from Clinic Doctor -->
    <a href="{{ url('admin/Pathology-Comm-Report') }}"> <center><h2 >Pathology Waise Commission Histroy </h2></center></a>  
       <hr>
        



      </div><!-- /.container-fluid -->
    </section>

@endsection
@section('script')
 <script>
     function ActiveRow(id) {
            swal({
                    title: "Are you sure?",
                    text: "You want to change status",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#active_form_" + id).submit();
                    } else {
                        //swal("Your data is safe!");
                    }
                });

        }

        function InActiveRow(id) {
            swal({
                    title: "Are you sure?",
                    text: "You want to change status",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#inactive_form_" + id).submit();
                    } else {
                        //swal("Your data is safe!");
                    }
                });

        }
 </script>
@endsection

