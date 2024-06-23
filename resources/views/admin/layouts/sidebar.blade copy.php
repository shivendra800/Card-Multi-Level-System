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
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/account-admin" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Account
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/Assign-Role-Permission" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Assign Role & Permission
                    </p>
                </a>
            </li>
            <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Gift-Offered
                </p>
            </a>
            <li class="nav-header">WithDraw Wallet Amount</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
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



            <li class="nav-header">Commission-Registration Amount <br> Management System</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>
                        C-R-A-M-S
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('admin/state-commsion-req')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>State C-R-A-M-S</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/district-commsion-req')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>District C-R-A-M-S</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/city-commsion-req')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>City C-R-A-M-S</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/healthcard-commsion-req')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>HealthCard C-R-A-M-S</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/hospital-commsion-req')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hospital  C-R-A-M-S</p>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- HCMS(health card management system) start here --}}
            <li class="nav-header">Head Management System</li>
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
                        H-M-S
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
                            <p>State H-M-S</p>
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
                            <p>Dist H-M-S</p>
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
                            <p>City H-M-S</p>
                        </a>
                    </li>



                </ul>
            </li>

            <li class="nav-header">Health Card Management System</li>
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
                        H-C-M-S
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

           <li class="nav-header" style="background-color:white;"><strong style="color: red;">Hospital Management System</strong></li>
           <li class="nav-item ">
               <a href="#" class="nav-link">
                   <i class="fa fa-hospital"></i>
                   <p>
                       H-M-S
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


            {{-- E-com-management-system start here --}}
            <li class="nav-item " style="background-color: #b15f7c;">
                @if (Session::get('page') == 'brands'||Session::get('page') == 'medicine-type'||Session::get('page') == 'medicine-subcategory'||Session::get('page') == 'medicine-category'
                || Session::get('page') == 'medicine')
                <?php $active = 'active'; ?>
                @else
                <?php $active = ''; ?>
                @endif
                <a href="#" class="nav-link {{ $active }}">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        ECMS(E-com-management-system)
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Create Dist-Admin</p>
                        </a>
                    </li>

                    <li class="nav-item" style="background-color: #5f7aa0;">
                        @if (Session::get('page') == 'brands'||Session::get('page') == 'medicine-type'||Session::get('page') == 'medicine-subcategory'||Session::get('page') == 'medicine-category'
                        || Session::get('page') == 'medicine')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="#" class="nav-link {{ $active }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Catalogue Management System
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @if (Session::get('page') == 'brands')
                                <?php $active = 'active'; ?>
                                @else
                                <?php $active = ''; ?>
                                @endif
                                <a href="{{ url('admin/brands') }}" class="nav-link {{ $active }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Medicine Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if (Session::get('page') == 'medicine-type')
                                <?php $active = 'active'; ?>
                                @else
                                <?php $active = ''; ?>
                                @endif
                                <a href="{{ url('admin/medicine-type') }}" class="nav-link {{ $active }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Medicine Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if (Session::get('page') == 'medicine-category')
                                <?php $active = 'active'; ?>
                                @else
                                <?php $active = ''; ?>
                                @endif
                                <a href="{{ url('admin/medicine-category') }}" class="nav-link {{ $active }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Medicine Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if (Session::get('page') == 'medicine-subcategory')
                                <?php $active = 'active'; ?>
                                @else
                                <?php $active = ''; ?>
                                @endif
                                <a href="{{ url('admin/medicine-subcategory') }}" class="nav-link {{ $active }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>subcategory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if (Session::get('page') == 'medicine')
                                <?php $active = 'active'; ?>
                                @else
                                <?php $active = ''; ?>
                                @endif
                                <a href="{{ url('admin/medicine') }}" class="nav-link {{ $active }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Medicine</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>coupon</p>
                                </a>
                            </li>

                        </ul>

                    </li>
                    <li class="nav-item" style="background-color: #1900ff1f;">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Order Management System(OMS)
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/new-request') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/pending-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pending Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href={{ url('admin/shipping-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Shipping</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/dispatch-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dispatch</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/out-for-delivery-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Out for Delivery</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/shipping-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assigned Delivery Boy</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/delivery-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Delivered</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/undelivery-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Undelivered</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cancle-order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cancel</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" style="    background-color: #00000075;">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Uploaded Order Management System(OMS)
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/examples/login-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/register-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pending Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Shipping</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dispatch</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Out for Delivery</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assigned Delivery Boy</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Delivered</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Undelivered</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cancel</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" style="background-color: #26306c9e;">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Website setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/examples/login-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Setting </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/register-v2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Slider</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Reports</p>
                        </a>
                    </li>


                </ul>
            </li>
            {{-- E-com-management-system end here --}}
            {{-- location start here --}}
            @if (Session::get('page') == 'state' || Session::get('page') == 'district' || Session::get('page') == 'city')
            <?php $active = 'active'; ?>
            @else
            <?php $active = ''; ?>
            @endif
            <li class="nav-header">Location Management System</li>
            <li class="nav-item  ">
                <a href="#" class="nav-link {{ $active }}">
                    <i class="fa fa-map-marker"></i>
                    <p>
                        L-M-S
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        @if (Session::get('page') == 'state')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/state" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>State</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'district')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/district" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>District</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Session::get('page') == 'city')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <a href="{{ url('/') }}/admin/city" class="nav-link {{ $active }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>City</p>
                        </a>
                    </li>


                </ul>
            </li>
            {{-- location end here --}}
            @endif
            {{-- admin end here --}}
            {{-- district admin for ecom start here --}}
            @if (Auth::guard('admin')->user()->type == 'district-admin')
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Create Delivery Boy
                    </p>
                </a>

            <li class="nav-item ">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Order Management System(OMS)
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>New Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Pending Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Shipping</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dispatch</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Out for Delivery</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Assigned Delivery Boy</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Delivered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Undelivered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Cancel</p>
                        </a>
                    </li>


                </ul>
            </li>
            <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Report
                </p>
            </a>

            </li>
            @endif
            {{-- district admin  end here --}}
            {{-- delivery boy start here  --}}
            @if (Auth::guard('admin')->user()->type == 'delivery-boy')
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>

            <li class="nav-item ">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Order Management System(OMS)
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>New Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Pending Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Shipping</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Dispatch</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Out for Delivery</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Assigned Delivery Boy</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Delivered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Undelivered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Cancel</p>
                        </a>
                    </li>


                </ul>
            </li>
            <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Report
                </p>
            </a>

            </li>
            @endif
            @if (Auth::guard('admin')->user()->type == 'state-head-hcms' )
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Gift-Offered
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/account-statehead" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Account State
                    </p>
                </a>
                <li class="nav-header">WithDraw Wallet Amount</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
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
                    </ul>
                </li>
                <a href="{{ url('/') }}/admin/create-health-card" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Issue Health Card
                    </p>
                </a>
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
                <a href="{{ url('/') }}/admin/assign-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Assigned card list
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/health-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health-Card-Cust list
                    </p>
                </a>
                <a href="{{url('admin/tree-structure')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health Card Tree
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/district-head-hcms" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        District Head
                    </p>
                </a>
                {{-- <a href="{{ url('/') }}/admin/city-head-hcms" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        City Head
                    </p>
                </a> --}}
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Report
                    </p>
                </a>
                <a href="{{url('admin/state-invoice')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       State Invoice
                    </p>
                </a>

            </li>
            @endif
            @if(Auth::guard('admin')->user()->type == 'district-head-hcms')
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/account-districthead" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Account District
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Gift-Offered
                    </p>
                </a>
                <a href="{{url('admin/settings')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                      Site Setting
                    </p>
                </a>
                <li class="nav-header">WithDraw Wallet Amount</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
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
                <a href="{{ url('/') }}/admin/create-health-card" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Issue Health Card
                    </p>
                </a>
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
                <a href="{{ url('/') }}/admin/assign-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Assigned card list
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/health-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health-Card-Cust list
                    </p>
                </a>
                <a href="{{url('admin/tree-structure')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health Card Tree
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/city-head-hcms" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        City Head
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Report
                    </p>
                </a>
                <a href="{{url('admin/district-invoice')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       District Invoice
                    </p>
                </a>

            </li>
            @endif
            @if(Auth::guard('admin')->user()->type == 'city-head-hcms')
            <li class="nav-item">
                <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/account-cityhead" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Account City
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Gift-Offered
                    </p>
                </a>
                <li class="nav-header">WithDraw Wallet Amount</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
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
                <a href="{{ url('/') }}/admin/create-health-card" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Issue Health Card
                    </p>
                </a>
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
                <a href="{{ url('/') }}/admin/assign-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Assigned card list
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/health-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health-Card-Cust list
                    </p>
                </a>
                <a href="{{url('admin/tree-structure')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health Card Tree
                    </p>
                </a>


                <a href="{{ url('/') }}/admin/dashboard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Report
                    </p>
                </a>
                <a href="{{url('admin/city-invoice')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       City Invoice
                    </p>
                </a>

            </li>
            @endif
            {{-- delivery boy end here  --}}
            @if (Auth::guard('admin')->user()->type == 'Health_card_Customer' )
            <li class="nav-item">

                <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/account-healthcard" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Account Health Card
                    </p>
                </a>

                <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Profile
                    </p>
                </a>
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Gift-Offered
                    </p>
                </a>
            
                <li class="nav-header">WithDraw Wallet Amount</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
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
                <a href="{{ url('/') }}/admin/create-health-card" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Issue Health Card
                    </p>
                </a>
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
                <a href="{{ url('/') }}/admin/assign-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Assigned card list
                    </p>
                </a>
                <a href="{{ url('/') }}/admin/health-card-customer-list" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health-Card-Cust list
                    </p>
                </a>
                <a href="{{url('admin/tree-structure')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Health Card Tree
                    </p>
                </a>
                <a href="{{url('admin/hospital-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       Hospital List
                    </p>
                </a>
                <a href="{{url('admin/hospital-Invoice-Customer-wise')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       Hospital Invoice
                    </p>
                </a>
                <a href="{{url('admin/Health-card-user-invoice')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       HealthCard Invoice
                    </p>
                </a>
                <a href="{{url('admin/Online-Appointent-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Online Appointent List
                    </p>
                </a>
                <a href="{{url('admin/Appointent-Accepted-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                         Appointent Accepted List
                    </p>
                </a>
                <a href="{{url('admin/Appointent-Rejected-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                         Appointent Rejected List
                    </p>
                </a>

            </li>
            @endif

            @if (Auth::guard('admin')->user()->type == 'Hospital')
            <a href="{{ url('/') }}/admin/hospital-dashboard" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            <a href="{{url('admin/HealthCard-customer-Details')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    HealthCard Customer
                </p>
            </a>
            <a href="{{url('admin/paitent-list')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Paitent List
                </p>
            </a>
            <a href="{{url('admin/paitent-disharge-list')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Paitent Disharge List
                </p>
            </a>

            <a href="{{url('admin/payment-recipt')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Payment To Company Recipt
                </p>
            </a>
            <a href="{{url('admin/Hospital-Additional-Details')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Hospital-Additional-Details
                </p>
            </a>
            <a href="{{url('admin/Online-Appointent-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Online Appointent List
                </p>
            </a>
            <a href="{{url('admin/Appointent-Accepted-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                     Appointent Accepted List
                </p>
            </a>
            <a href="{{url('admin/Appointent-Rejected-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                     Appointent Rejected List
                </p>
            </a>

            @endif


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
