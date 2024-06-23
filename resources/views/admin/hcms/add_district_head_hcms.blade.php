@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($update_data != null)
                        <h1 class="m-0">Edit District Head(HCMS)</h1>
                    @else
                        <h1 class="m-0">Add District Head(HCMS)</h1>
                    @endif

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->name }}" @else value="{{ old('name') }}" @endif
                                                name="name" placeholder="Enter name" required="" >
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mobile No</label>
                                            <input type="number" name="mobile"
                                                @if ($update_data != null) value="{{ $update_data->mobile }}" @else value="{{ old('mobile') }}" @endif
                                                onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('mobile')
                                                is-invalid
                                                @enderror"
                                                placeholder="Enter mobile no" required="" >
                                            @error('mobile')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->email }}" @else value="{{ old('email') }}" @endif
                                                name="email" placeholder="Enter email" required="" >
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Image</label>
                                            <input type="file" value="{{ old('image') }}"
                                                class="form-control  @error('image') is-invalid @enderror" name="image" required="" >
                                            @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-1">DOB</label>
                                            <input type="date"
                                                @if ($update_data != null) value="{{ $update_data->dob }}" @else value="{{ old('dob') }}" @endif
                                                class="form-control  @error('dob') is-invalid @enderror" name="dob" required="" >
                                            @error('dob')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" id="" class="form-control" required="" >
                                                <option value="">Select</option>
                                                <option @if ($update_data != null) @if ($update_data->gender == 'Male') value="{{ $update_data->gender == 'Male' }}" selected @endif @else @if (old('gender') == 'Male') selected @endif @endif  value="Male">Male</option>
                                                <option @if ($update_data != null) @if ($update_data->gender == 'Female') value="{{ $update_data->gender == 'Female' }}" selected @endif @else @if (old('gender') == 'Female') selected @endif @endif  value="Female">Female</option>
                                                <option @if ($update_data != null) @if ($update_data->gender == 'Others') value="{{ $update_data->gender == 'Others' }}" selected @endif @else @if (old('gender') == 'Others') selected @endif @endif  value="Others">Others</option>
                                            </select>
                                            @error('gender')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Aadhar No</label>
                                            <input type="number"
                                                @if ($update_data != null) value="{{ $update_data->aadhar_no }}" @else value="{{ old('aadhar_no') }}" @endif
                                                onKeyDown="if(this.value.length==12 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('aadhar_no')
                                                 is-invalid
                                                    @enderror"
                                                value="{{ old('aadhar_no') }}" name="aadhar_no" required=""
                                                placeholder="Enter aadhar_no">
                                            @error('aadhar_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PAN No</label>
                                            <input type="text"
                                                class="form-control @error('pan_no') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->pan_no }}" @else value="{{ old('pan_no') }}" @endif
                                                name="pan_no" placeholder="Enter pan_no" required="" >
                                            @error('pan_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input type="text"
                                                class="form-control @error('father_name') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->father_name }}" @else value="{{ old('father_name') }}" @endif
                                                name="father_name" placeholder="Enter father_name" required="" >
                                            @error('father_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Assign State</label>
                                            <select name="assign_by_state" id="assign_state"
                                                class="form-control  @error('assign_state') is-invalid @enderror"
                                                value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();" required="" >
                                                <option value="">Select State</option>
                                                @foreach ($state as $value)
                                                    @if ($update_data != null)
                                                        @if ($value->id == $update_data->assign_by_state)
                                                            <option selected value="{{ $value->id }}">
                                                                {{ $value->state_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $value->id }}">{{ $value->state_name }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        @if ($value->id == old('assign_state'))
                                                            <option selected value="{{ $value->id }}">
                                                                {{ $value->state_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $value->id }}">{{ $value->state_name }}
                                                        @endif
                                                    @endif
                                                @endforeach

                                            </select>
                                            @error('assign_state')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Assign District</label>
                                            <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getcity();" >
                                                    <option>Select assign_district</option>
                                            </select>
                                            @error('assign_district')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <h3>Address</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> State</label>

                                            <select name="state" id="state"
                                                class="form-control selectpicker @error('state') is-invalid @enderror"
                                                data-live-search="true" value="{{ old('state') }}" id="state" onchange="getdiststatewise();" required="" >
                                                <option value="">Select State</option>
                                                @foreach ($state as $value)
                                                    @if ($update_data != null)
                                                        @if ($value->id == $update_data->state)
                                                            <option selected value="{{ $value->id }}">
                                                                {{ $value->state_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $value->id }}">{{ $value->state_name }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        @if ($value->id == old('state'))
                                                            <option selected value="{{ $value->id }}">
                                                                {{ $value->state_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $value->id }}">{{ $value->state_name }}
                                                        @endif
                                                    @endif
                                                @endforeach

                                            </select>
                                            @error('state')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> District</label>
                                            <select class="form-control text-dark @error('district') is-invalid @enderror" id="district" name="district" required onchange="getcity();">
                                                    <option>Select district</option>
                                            </select>
                                            @error('district')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> City</label>
                                            <select class="form-control text-dark @error('city') is-invalid @enderror" id="city" name="city" required>
                                                    <option>Select district</option>
                                            </select>
                                            @error('city')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Street</label>
                                            <input type="text"
                                                class="form-control @error('street') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->street }}" @else value="{{ old('street') }}" @endif
                                                name="street" placeholder="Enter street" required="" >
                                            @error('street')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Pinecode</label>
                                            <input type="text"
                                                class="form-control @error('pincode') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->pincode }}" @else value="{{ old('pincode') }}" @endif
                                                name="pincode" placeholder="Enter pincode" required="" >
                                            @error('pincode')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Country</label>
                                            <input type="text"
                                                class="form-control @error('country') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->country }}" @else value="{{ old('country') }}" @endif
                                                name="country" placeholder="Enter country"required=""  >
                                            @error('country')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" name="password"
                                                placeholder="Enter password" required="" >
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                name="confirm_password" placeholder="Enter confirm_password" required="" >
                                            @error('confirm_password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h3>Account Details</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text"
                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->bank_name }}" @else value="{{ old('bank_name') }}" @endif
                                                name="bank_name" placeholder="Enter bank_name" required="" >
                                            @error('bank_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text"
                                                class="form-control @error('account_no') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->account_no }}" @else value="{{ old('account_no') }}" @endif
                                                name="account_no" placeholder="Enter account_no" required=""  >
                                            @error('account_no')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>IFSC Code</label>
                                            <input type="text"
                                                class="form-control @error('ifsc_code') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->ifsc_code }}" @else value="{{ old('ifsc_code') }}" @endif
                                                name="ifsc_code" placeholder="Enter ifsc_code" required=""  >
                                            @error('ifsc_code')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Account Holder Name</label>
                                            <input type="text"
                                                class="form-control @error('account_holder_name') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->account_holder_name }}" @else value="{{ old('account_holder_name') }}" @endif
                                                name="account_holder_name" placeholder="Enter account_holder_name" required="" >
                                            @error('account_holder_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h3>Payment Details</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>State Commission Rate</label>
                                            <input type="text"
                                                class="form-control @error('commission') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->commission }}" @else value="{{ $commission_reqistation_amount->state_commission }}" @endif
                                                name="commission" placeholder="Enter commission" readonly>
                                            @error('commission')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>District Commission Rate for City Creation</label>
                                            <input type="text"
                                                class="form-control @error('commission') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->commission }}" @else value="{{ $commission_reqistation_amount->district_commission }}" @endif
                                                name="commission" placeholder="Enter commission" readonly>
                                            @error('commission')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Registration Amount</label>
                                            <input type="number"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->amount }}" @else value="{{ $commission_reqistation_amount->distrcit_reqistation_amount }}" @endif
                                                name="amount" placeholder="Enter amount " readonly>
                                            @error('amount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>GST Percentage</label>
                                            <input type="number"
                                                class="form-control @error('gst_percentage') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->gst_percentage }}" @else value="{{ $commission_reqistation_amount->gst_percentage }}" @endif
                                                name="gst_percentage" placeholder="Enter gst_percentage " readonly>
                                            @error('gst_percentage')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>GST Percentage Amount</label>
                                            <input type="number"
                                                class="form-control @error('gst_percentage_amount') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->gst_percentage_amount }}" @else value="{{ $commission_reqistation_amount->gst_percentage_amount }}" @endif
                                                name="gst_percentage_amount" placeholder="Enter gst_percentage_amount " readonly>
                                            @error('gst_percentage_amount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Total Reqistation Amount</label>
                                            <input type="number"
                                                class="form-control @error('total_state_reqistation_amount') is-invalid @enderror"
                                                @if ($update_data != null) value="{{ $update_data->total_state_reqistation_amount }}" @else value="{{ $commission_reqistation_amount->total_state_reqistation_amount }}" @endif
                                                name="total_state_reqistation_amount" placeholder="Enter total_state_reqistation_amount " readonly>
                                            @error('total_state_reqistation_amount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <select name="payment_mode" id="" class="form-control" required="" >
                                                <option value="">Select</option>
                                                <option
                                                    @if ($update_data != null) @if ($update_data->payment_mode == 'Cash') value="{{ $update_data->payment_mode == 'Cash' }}" selected @endif
                                                @else @if (old('payment_mode') == 'Cash') selected @endif @endif value="Cash">Cash</option>
                                                <option
                                                    @if ($update_data != null) @if ($update_data->payment_mode == 'Account') value="{{ $update_data->payment_mode == 'Account' }}" selected @endif
                                                @else @if (old('payment_mode') == 'Account') selected @endif @endif value="Account">Account</option>
                                                <option
                                                    @if ($update_data != null) @if ($update_data->payment_mode == 'Upi') value="{{ $update_data->payment_mode == 'Upi' }}" selected @endif
                                                @else @if (old('payment_mode') == 'Upi') selected @endif @endif value="Upi">Upi</option>
                                                <option
                                                    @if ($update_data != null) @if ($update_data->payment_mode == 'Check') value="{{ $update_data->payment_mode == 'Check' }}" selected @endif
                                                @else @if (old('payment_mode') == 'Check') selected @endif @endif value="Check">Check</option>
                                            </select>
                                            @error('amount')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@section('script')
<script>
     $(document).ready(function() {
        getdiststatewise();
        getassigndiststatewise();
     });
    function getdiststatewise() {
           var state_id = $("#state").val();
           // alert(state_id);s
           @if ($update_data != null)
                var district="{{ $update_data->district }}";
            @else
                var district="{{ old('district') }}";
            @endif

           $.ajax({
               url: "{{ url('/') }}/admin/Getdist-state-wise/" + state_id,
               dataType: "json",
               success: function(data) {
                   // console.log("data", data);
                   var option = "";
                   for (var i = 0; i < data.data.length; i++) {
                       if (district == data.data[i].id) {
                           option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                   i]
                               .district_name + "</option>";
                       } else {
                           option += "<option value=" + data.data[i].id + ">" + data.data[i]
                               .district_name + "</option>";
                       }
                   }
                   $("#district").html(option);
                   getcity();
               }
           });
       }
       function getcity() {

            var dist_id = $("#district").val();
            @if ($update_data != null)
                var city="{{ $update_data->city }}";
            @else
                var city="{{ old('city') }}";
            @endif

            $.ajax({
                url: "{{ url('/') }}/admin/getcitydistwise/" + dist_id,
                dataType: "json",
                success: function(data) {
                    console.log("city", data);
                    var option = "";
                    for (var i = 0; i < data.data.length; i++) {
                        if (city == data.data[i].id) {
                            option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                    i]
                                .city_name + "</option>";
                        } else {
                            option += "<option value=" + data.data[i].id + ">" + data.data[i]
                                .city_name + "</option>";
                        }
                    }
                    $("#city").html(option);
                }
            });

        }

        function getassigndiststatewise() {
           var state_id = $("#assign_state").val();
           // alert(state_id);s
           @if ($update_data != null)
                var assign_district="{{ $update_data->assign_district }}";
            @else
                var assign_district="{{ old('assign_district') }}";
            @endif

           $.ajax({
               url: "{{ url('/') }}/admin/Getdist-state-wise/" + state_id,
               dataType: "json",
               success: function(data) {
                   // console.log("data", data);
                   var option = "";
                   for (var i = 0; i < data.data.length; i++) {
                       if (assign_district == data.data[i].id) {
                           option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                   i]
                               .district_name + "</option>";
                       } else {
                           option += "<option value=" + data.data[i].id + ">" + data.data[i]
                               .district_name + "</option>";
                       }
                   }
                   $("#assign_district").html(option);

               }
           });
       }

 </script>
@endsection
