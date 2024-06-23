@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (Auth::guard('admin')->user()->type == 'state-head-hcms')
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/admin_assets/uploads/stateheadhcms/' . $stateuser->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $stateuser->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Basic Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->name }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Reference Code</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->reference_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->mobile }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->email }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->dob }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->gender }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Aadhar No</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->aadhar_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PAN No</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->pan_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->father_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referred By</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->referred_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Assign State</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->state_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">
                                {{ $stateuser->street }}-{{ $stateuser->city_name }}-{{ $stateuser->district_name }}-{{ $stateuser->state_nameaddress }}-pincode-{{ $stateuser->pincode }}-{{ $stateuser->country }}
                            </p>


                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Bank Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->bank_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account No</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->account_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->ifsc_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" class="form-control"
                                            @if ($stateuser != null) value="{{ $stateuser->account_holder_name }}" @endif
                                            readonly>
                                    </div>
                                </div>

                            </div>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @endif
                @if (Auth::guard('admin')->user()->type == 'district-head-hcms')
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/admin_assets/uploads/districtheadhcms/' . $distuser->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $distuser->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Basic Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->name }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Reference Code</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->reference_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->mobile }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->email }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->dob }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->gender }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Aadhar No</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->aadhar_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PAN No</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->pan_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->father_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referred By</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->referred_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Assign District</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->district_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">
                                {{ $distuser->street }}-{{ $distuser->city_name }}-{{ $distuser->district_nameaddress }}-{{ $distuser->state_name }}-pincode-{{ $distuser->pincode }}-{{ $distuser->country }}
                            </p>


                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Bank Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->bank_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account No</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->account_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->ifsc_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" class="form-control"
                                            @if ($distuser != null) value="{{ $distuser->account_holder_name }}" @endif
                                            readonly>
                                    </div>
                                </div>

                            </div>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @endif

                @if (Auth::guard('admin')->user()->type == 'city-head-hcms')
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/admin_assets/uploads/cityheadhcms/' . $cityuser->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $cityuser->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Basic Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->name }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Reference Code</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->reference_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->mobile }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->email }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->dob }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->gender }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Aadhar No</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->aadhar_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PAN No</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->pan_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->father_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referred By</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->referred_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Assign City</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->assign_city }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                
                                
                                
                               
                                
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">
                                {{ $cityuser->street }}-{{ $cityuser->city_name }}-{{ $cityuser->district_name }}-{{ $cityuser->state_name }}-pincode-{{ $cityuser->pincode }}-{{ $cityuser->country }}
                            </p>



                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Bank Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->bank_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account No</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->account_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->ifsc_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" class="form-control"
                                            @if ($cityuser != null) value="{{ $cityuser->account_holder_name }}" @endif
                                            readonly>
                                    </div>
                                </div>


                            </div>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @endif

                @if (Auth::guard('admin')->user()->type == 'Health_card_Customer')
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/admin_assets/uploads/healthcardcustomer/' . $healthcarduser->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $healthcarduser->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Basic Details</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->name }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Reference Code</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->reference_code }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->mobile }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->email }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->dob }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Health Card Issue ID No</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->health_card_issue_id_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Aadhar No</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->aadhar_no }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PAN No</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->pan_number }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->swd }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referred By</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->referred_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Blood Group</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->blood_group }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Health Card Type</label>
                                        <input type="text" class="form-control"
                                            @if ($healthcarduser != null) value="{{ $healthcarduser->health_card_type_name }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                
                                
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">
                                {{ $healthcarduser->address }}-{{ $healthcarduser->city_name }}-{{ $healthcarduser->district_name }}-{{ $healthcarduser->state_name }}-pincode-{{ $healthcarduser->pincode }}-{{ $healthcarduser->country }}
                            </p>



                            <hr>

                            
                             
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @endif


            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('script')
@endsection
