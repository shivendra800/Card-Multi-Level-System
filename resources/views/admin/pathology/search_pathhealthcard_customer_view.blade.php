@extends('admin.index')

@section('content')

<div class="col-md-12">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            {{-- <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{ asset('/admin_assets/uploads/hospital/' . $tabledata['image']) }}"
                    alt="User profile picture">
            </div> --}}
            <h3 class="profile-username text-center">{{ $tabledata->name }}</h3>
            <p class="text-muted text-center">{{ $tabledata['type'] }}</p>
        </div>
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
            <form action="{{ url('admin/add-pathpaitent-details') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="paitent_name"
                            @if ($tabledata != null) value="{{ $tabledata->name }}" @endif readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="paitent_mobile"
                            @if ($tabledata != null) value="{{ $tabledata->mobile }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="paitent_email"
                            @if ($tabledata != null) value="{{ $tabledata->email }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>DOB</label>
                        <input type="text" class="form-control" name="paitent_dob"
                            @if ($tabledata != null) value="{{ $tabledata->dob }}" @endif readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Health Card Issue ID No</label>
                        <input type="text" class="form-control" name="health_card_issue_id_no"
                            @if ($tabledata != null) value="{{ $tabledata->health_card_issue_id_no }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Member ID</label>
                        <input type="text" class="form-control" name="member_id"
                            @if ($tabledata != null) value="{{ $tabledata->member_id }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Aadhar No</label>
                        <input type="text" class="form-control" name="paitent_aadhar_no"
                            @if ($tabledata != null) value="{{ $tabledata->aadhar_no }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>PAN No</label>
                        <input type="text" class="form-control" name="paitent_pan_number"
                            @if ($tabledata != null) value="{{ $tabledata->pan_number }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Father Name</label>
                        <input type="text" class="form-control" name="paitent_father_name"
                            @if ($tabledata != null) value="{{ $tabledata->swd }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" name="paitent_blood_group"
                            @if ($tabledata != null) value="{{ $tabledata->blood_group }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Health Card Type</label>
                        <input type="text" class="form-control" name="paitent_health_card_type"
                            @if ($tabledata != null) value="{{ $tabledata['health_card_type_name'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address"
                            @if ($tabledata != null) value="{{ $tabledata['address'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" class="form-control" name="paitent_pincode"
                            @if ($tabledata != null) value="{{ $tabledata['pincode'] }}" @endif
                            readonly>
                    </div>
                </div>


            </div>
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">
                {{ $tabledata->address }}-{{ $tabledata->city_name }}-{{ $tabledata->district_name }}-{{ $tabledata->state_name }}-pincode-{{ $tabledata->pincode }}-{{ $tabledata->country }}
            </p>



            <hr>



            </p>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control"
                            @if ($tabledata != null) value="{{ $tabledata['state_name'] }}" @endif
                            readonly>
                            <input type="hidden" class="form-control" name="paitent_state"
                            @if ($tabledata != null) value="{{ $tabledata['assign_state'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>District</label>
                        <input type="text" class="form-control"
                            @if ($tabledata != null) value="{{ $tabledata['district_name'] }}" @endif
                            readonly>
                            <input type="hidden" class="form-control" name="paitent_district"
                            @if ($tabledata != null) value="{{ $tabledata['assign_district'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control"
                            @if ($tabledata != null) value="{{ $tabledata['city_name'] }}" @endif
                            readonly>
                            <input type="hidden" class="form-control" name="paitent_city"
                            @if ($tabledata != null) value="{{ $tabledata['assign_city'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Card Registor Date</label>
                        <input type="text" class="form-control" name="paitent_card_reg_start"
                            @if ($tabledata != null) value="{{ $tabledata['card_reg_start'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Card Activited Date</label>
                        <input type="text" class="form-control" name=""
                            @if ($tabledata != null) value="{{ $tabledata['card_activited_date'] }}" @endif
                            readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Card End Date</label>
                        <input type="text" class="form-control" name="paitent_card_reg_end"
                            @if ($tabledata != null) value="{{ $tabledata['card_reg_end'] }}" @endif
                            readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer" align="center">
                <button type="submit" class="btn btn-primary">Add Pateint</button>
            </div>
        </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
