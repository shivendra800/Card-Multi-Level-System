<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if(!empty(Auth::guard('admin')->user()->image))
            <img src="{{ url('admin_assets/uploads/adminlogin/'.Auth::guard('admin')->user()->image) }}" alt="profile">
            @else
            <img src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="profile">
            @endif
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }} <br>
                - {{ Auth::guard('admin')->user()->type }}</a>
        </div>
    </div>


    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tree"></i>
                  <p>
                    Setting
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/update-password') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Update Password</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/update-details') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Update Details</p>
                    </a>
                  </li>
                </ul>
              </li>




            {{-- admin start here --}}
            @if (Auth::guard('admin')->user()->type == 'admin')
            {{-- <li class="nav-item">
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>
                    General  Setting
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Commission-Reg-Sett
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{url('admin/state-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>State Comm-Reg-Sett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/district-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>District Comm-Reg-Sett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/city-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>City Comm-Reg-Sett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/healthcard-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>HealthCard C-RegSett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/ClinicDoctor-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>ClinicDoctor C-RegSett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/Pathology-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pathology C-RegSett</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/hospital-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Hospital Comm-Reg-Sett</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <i class="fa fa-map-marker"></i>
                      <p>
                        Location
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/') }}/admin/state" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>State</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/') }}/admin/district" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>District </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/') }}/admin/city" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>City</p>
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <i class="fa fa-gift"></i>
                      <p> Gift-Offered</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('admin/gift-Offered-List')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <i class="fa fa-gift"></i>
                      <p> Gift-Offered List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/') }}/admin/Assign-Role-Permission" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <i class="fa fa-users"></i>
                      <p>Assign Roles </p>
                    </a>
                  </li>
                  <li class="nav-item">
                  <a href="{{url('admin/settings')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Website Setting
                    </p>
                </a>
                <a href="{{url('admin/banners')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Website Banner
                    </p>
                </a>
                <a href="{{url('admin/Blog')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Website Blogs
                    </p>
                </a>
                <a href="{{url('admin/dummy-invoice')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Dummy Invoice 
                    </p>
                </a>
            </li>


                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/admin/account-admin" class="nav-link ">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Account

                  </p>
                </a>
              </li>




            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                       WithDraw Section
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('admin/withdraw-request')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/approve_withdraw_amount')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw Approvel</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/withdraw-Histroy')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw History</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/Withdraw-charges')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw Charges</p>
                        </a>
                    </li>

                </ul>
            </li>




            {{-- HCMS(health card management system) start here --}}

            @if ( Session::get('page') == 'state-head-hcms' ||
            Session::get('page') == 'district-head-hcms' ||
            Session::get('page') == 'city-head-hcms' )
            <?php $active = 'active'; ?>
            @else
            <?php $active = ''; ?>
            @endif

            <li class="nav-item  {{ $active }}">
                <a href="#" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p>
                      Manage Head User
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview ">
                    <li class="nav-item">
                        <a href="{{url('/')}}/admin/hcms-dashboard" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        @if (Session::get('page') == 'state-head-hcms')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/state-head-hcms" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>State Head</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'district-head-hcms')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/district-head-hcms" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dist Head</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'city-head-hcms')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/city-head-hcms" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>City Head</p>
                        </a>
                    </li>



                </ul>
            </li>

            @if (Session::get('page') == 'create-health-card' ||
            Session::get('page') == 'health-card-type' ||
            Session::get('page') == 'assign-card-customer-list' ||
            Session::get('page') == 'health-card-customer-list')
            <?php $active = 'active'; ?>
            @else
            <?php $active = ''; ?>
            @endif

            <li class="nav-item  {{ $active }}">
                <a href="#" class="nav-link">
                    <i class="fas fa-id-card"></i>
                    <p>
                        Health Card
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview ">
                    <li class="nav-item">
                        <a href="{{url('/')}}/admin/hcms-dashboard" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'health-card-type')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/health-card-type" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Health Card Type</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'create-health-card')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/create-health-card" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Issue Health Card</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'assign-card-customer-list')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('admin/assign-card-customer-list') }}" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Assigned card list</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'health-card-customer-list')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('admin/health-card-customer-list') }}" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Health-Card-Cust list</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/inactive-healthcard')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>InActive Health Card</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/health-wallet-Transection-History')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Health-Wallet-Trans-History</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/tree-structure')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Health Card Tree</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/healthcarduser') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Health Card Report</p>
                        </a>
                      </li>
                </ul>
            </li>
            {{-- HCMS(health card management system) end here --}}

           {{-- Hospital Management System Start Here --}}


           <li class="nav-item ">
               <a href="#" class="nav-link">
                   <i class=" nav-icon far fa-plus-square"></i>
                   <p>
                      Hospital
                       <i class="fas fa-angle-left right"></i>
                   </p>
               </a>

               <ul class="nav nav-treeview ">
                   <li class="nav-item">
                       <a href="{{url('/')}}/admin/hospital-dashboard" class="nav-link">
                           <i class="nav-icon far fa-circle text-info"></i>
                           <p>Hospital Dashboard</p>
                       </a>
                   </li>

                   <li class="nav-item">
                       <a href="{{ url('/') }}/admin/hospital-List" class="nav-link">
                           <i class="nav-icon far fa-circle text-info"></i>
                           <p>Hospital H-M-S</p>
                       </a>
                   </li>
                   <li class="nav-item">
                    <a href="{{ url('/') }}/admin/Hospital-Specialization" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Specialization Hospital</p>
                    </a>
                </li>
               </ul>
           </li>

           {{-- Hospital Managment System End Here --}}
           <li class="nav-item ">
            <a href="#" class="nav-link">
                <i class="fas fa-user-md"></i>
                <p>
                   Doctor
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview ">
                <li class="nav-item">
                    <a href="{{url('/')}}/admin/Doctor-dashboard" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Doctor Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/') }}/admin/Doctor-List" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Doctor</p>
                    </a>
                </li>
                 
            </ul>
        </li>
        <li class="nav-item ">
            <a href="#" class="nav-link">
                <i class="fas fa-user-md"></i>
                <p>
                   Pathology
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview ">
                <li class="nav-item">
                    <a href="{{url('/')}}/admin/Pathology-Dashboard" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Pathology Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/') }}/admin/Pathology-List" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Pathology</p>
                    </a>
                </li>
                 
            </ul>
        </li>
         {{-- Pathology Managment System End Here --}}
            {{-- Ambulance Managment System End Here --}}
            <li class="nav-item ">
                <a href="#" class="nav-link">
                    <i class="fas fa-ambulance"></i>
                    <p>
                       Ambulance
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
    
                <ul class="nav nav-treeview ">
                  {{-- <li class="nav-item">
                    <a href="{{url('admin/Driver-list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Driver List</p>
                    </a>
                  </li> --}}
                    <li class="nav-item">
                        <a href="{{url('admin/ambulance-commsion-req')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Ambulance Comm-Sett</p>
                        </a>
                      </li>
                    <li class="nav-item">
                        <a href="{{url('/')}}/admin/Ambulance-dashboard" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Ambulance Dashboard</p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ url('/') }}/admin/Ambulance-List" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Ambulance List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('/') }}/admin/Ambulance-Km-Charges" class="nav-link">
                          <i class="nav-icon far fa-circle text-info"></i>
                          <p>Ambulance Charges/KM </p>
                      </a>
                  </li>
                    {{-- <li class="nav-item">
                      <a href="{{ url('/') }}/admin/AssignAmbulance-list" class="nav-link">
                          <i class="nav-icon far fa-circle text-info"></i>
                          <p>Assign Ambulance List</p>
                      </a>
                  </li> --}}
                     
                </ul>
            </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                   Report Section
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('admin/StateHead-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>StateHead Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/DistrictHead-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>DistrictHead Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/CityHead-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>CityHead Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/HealthCard-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>HealthCard User Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/Hospital-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hospital Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/ClinicDoctor-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ClinicDoctor Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/Pathology-Comm-Report')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pathology Report</p>
                    </a>
                </li>

            </ul>
        </li>


            
            {{-- location start here --}}
            @if (Session::get('page') == 'state' || Session::get('page') == 'district' || Session::get('page') == 'city')
            <?php $active = 'active'; ?>
            @else
            <?php $active = ''; ?>
            @endif

            @endif
            {{-- admin end here --}}
             {{-- state-head-hcms start here --}}
            @if (Auth::guard('admin')->user()->type == 'state-head-hcms' )
                    @include('admin.layouts.sidebar_stateheadhcms')
            @endif
              {{-- state-head-hcms end here --}}
                {{-- district-head-hcms start here --}}
            @if(Auth::guard('admin')->user()->type == 'district-head-hcms')
                       @include('admin.layouts.sidebar_districtheadhcms')
            @endif
                {{-- district-head-hcms end here --}}
                {{-- city-head-hcms Start here --}}
            @if(Auth::guard('admin')->user()->type == 'city-head-hcms')
                    @include('admin.layouts.sidebar_cityheadhcms')
            @endif
                {{-- city-head-hcms Start here --}}
                   {{-- Health_card_Customer Start here --}}
            @if (Auth::guard('admin')->user()->type == 'Health_card_Customer' )
                     @include('admin.layouts.sidebar_healthcard')
            @endif
                 {{-- Health_card_Customer end here --}}
               {{-- Hospital start here --}}
            @if (Auth::guard('admin')->user()->type == 'Hospital')
            @include('admin.layouts.sidebar_hospital')
            @endif
              {{-- Clinic-Doctor start here --}}
            @if (Auth::guard('admin')->user()->type == 'Clinic-Doctor')
            @include('admin.layouts.sidebar_Clinic_Doctor')
            @endif
                 {{-- Clinic-Doctor end here --}}
                                   {{-- Pathology start here --}}
            @if (Auth::guard('admin')->user()->type == 'Pathology')
            @include('admin.layouts.sidebar_pathology')
            @endif
                 {{-- Pathology end here --}}
                    {{-- Ambulance && Driver start here --}}
            @if (Auth::guard('admin')->user()->type == 'Ambulance')
            @include('admin.layouts.sidebar_ambulance_and_driver')
         
            @endif
            @if (Auth::guard('admin')->user()->type == 'Driver')
            {{-- @include('admin.layouts.sidebar_ambulance_and_driver') --}}

            @endif
          
            
                 {{-- Ambulance && Driver end here --}}

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
