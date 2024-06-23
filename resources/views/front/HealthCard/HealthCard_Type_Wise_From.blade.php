@extends('front.layouts.layout')

@section('title','HealthCard-Type-Wise-From')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Health-Card-Type-Wise-From</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Health-Card-Type-Wise-From</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->

  <div class="doctors-page pt-70 pb-40">
    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Health Card Registration<small style="color: red;">({{ $healthcardtype->health_card_type }})</small></h3>
                                @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong> {{Session::get('error_message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{Session::get('success_message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                {{-- error meg with close button---- --}}
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                {{-- error meg --}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="forms-sample"  action="{{ url('HealthCard-Type-Wise-From/'.$healthcardtype->slug) }}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-6">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Full Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"   placeholder="Enter Full Name" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="dob">DOB</label>
                                                <input type="date" class="form-control" name="dob" id="dob"  value="{{ old('dob') }}"  placeholder="Enter Date Of Birth" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"   placeholder="Enter Address" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="assign_district">District</label>
                                                <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getassigncity();" >
                                                    <option>Select Assign District</option>
                                               </select>
                                               @error('assign_district')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pincode">Pincode</label>
                                                <input type="number"
                                                onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('pincode')
                                                 is-invalid
                                                    @enderror"
                                                value="{{ old('pincode') }}" name="pincode"
                                                placeholder="Enter pincode">
                                            </div>

                                            <div class="form-group">
                                                <label for="card_reg_end">Card End Date</label>(Click on this to get the Date)
                                                <input type="date" class="form-control" onblur="nextYearDate(this.value);" name="card_reg_end" id="card_reg_end"  value="{{ old('card_reg_end') }}"  readonly placeholder="Enter Health Card End Date" >
                                            </div>

                                            <div class="form-group">
                                                <label for="aadhar_no">Aadhar Number</label>
                                                <input type="number"

                                                onKeyDown="if(this.value.length==12 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('aadhar_no')
                                                 is-invalid
                                                    @enderror"
                                                value="{{ old('aadhar_no') }}" name="aadhar_no"
                                                placeholder="Enter aadhar_no" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="mobile">Mobile No</label>
                                                <input type="number" name="mobile"
                                                 value="{{ old('mobile') }}"
                                                onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('mobile')
                                                is-invalid
                                                @enderror"
                                                placeholder="Enter mobile no" required="" >
                                            </div>

                                            <div class="form-group">
                                                <label for="health_card_type">Health Card Type</label>
                                                <input name="health_card_type" id="health_card_type" value="{{ $healthcardtype->health_card_type }}"
                                            class="form-control" readonly  >
                                            </div>

                                            <div class="form-group">
                                                <label for="gst_percentage_amount">GST Percentage Amount</label>
                                                <input type="text" class="form-control" name="gst_percentage_amount" id="gst_percentage_amount"   value="{{ $healthcardtype->gst_percentage_amount }}"  placeholder="gst_percentage_amount"  readonly>
                                            </div>
                                        </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"  value="{{ old('email') }}"  placeholder="Enter Email" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="swd">Father Name</label>
                                            <input type="text" class="form-control" name="swd" id="swd"  value="{{ old('swd') }}"  placeholder="Enter Father Name" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="blood_group">Blood Group</label>
                                            <input type="text" class="form-control" name="blood_group" id="blood_group"   value="{{ old('blood_group') }}"  placeholder="Enter Blood Group" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="assign_state">State</label>
                                            <select name="assign_state" id="assign_state"
                                            class="form-control  @error('assign_state') is-invalid @enderror"
                                            value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();" >
                                            <option value="">Select State</option>
                                            @foreach ($state as $value)

                                                    @if ($value->id == old('assign_state'))
                                                        <option selected value="{{ $value->id }}">
                                                            {{ $value->state_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->state_name }}
                                                    @endif

                                            @endforeach

                                        </select>
                                        @error('assign_state')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select class="form-control text-dark @error('assign_city') is-invalid @enderror" id="assign_city" name="assign_city"  >
                                                <option>Select Assign City</option>
                                            </select>
                                            @error('assign_city')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="card_reg_start">Card Issue Date</label>
                                            <input type="date"  class="form-control" onblur="nextYearDate(this.value);"  name="card_reg_start" id="card_reg_start"   value="{{ old('card_reg_start') }}"  placeholder="Enter Health Card Start Date" >
                                        </div>

                                        <div class="form-group">
                                            <label for="pan_number">Pan Card Number</label>
                                            <input type="text" class="form-control" name="pan_number" id="pan_number"  value="{{ old('pan_number') }}" placeholder="Enter Pan Card Number" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="health_card_amount">Image</label>
                                            <input type="file" class="form-control" name="image" id="image"  value="{{ old('image') }}"   >
                                        </div>
                                        <div class="form-group">
                                            <label for="health_card_amount">Health Card Amount</label>
                                            <input type="text" class="form-control" name="health_card_amount" id="health_card_amount"   value={{ $healthcardtype->health_card_amount }}  placeholder="Enter Health Card Amount"  readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="gst_percentage">GST Percentage</label>
                                            <input type="text" class="form-control" name="gst_percentage" id="gst_percentage" value="{{ $healthcardtype->gst_percentage}}"  placeholder="gst_percentage"  readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="total_healthcard_reqistation_amount">Total Amount</label>
                                            <input type="text" class="form-control" name="total_healthcard_reqistation_amount" id="total_healthcard_reqistation_amount"  value="{{ $healthcardtype->total_healthcard_reqistation_amount }}" placeholder="Enter Health Card Amount"  readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="sponsor_id">Sponsor ID</label>
                                            <input type="text" class="form-control" name="sponsor_id" id="sponsor_id"  placeholder="Enter Sponsor ID" value="{{ old('sponsor_id') }}"required="" >
                                        </div>
                                    </div>
                                </div>
                                 <!-- /.card-body -->

                            </div>
                            <div class="card-footer" align="center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </div>
                        </form>

                        </div>







                        </div>
                        <!-- /.card -->


                    </div>
                    <!--/.col (left) -->


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
  </div>

@endsection

@section('script')

<script>
     $(document).ready(function() {
       getassigndiststatewise();
       getamount();
     });

    function getassigndiststatewise() {
           var state_id = $("#assign_state").val();

                var assign_district="{{ old('assign_by_district') }}";


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
                   getassigncity();

               }
           });
       }
       function  getassigncity() {

        var dist_id = $("#assign_district").val();

            var assign_city="{{ old('assign_city') }}";


        $.ajax({
            url: "{{ url('/') }}/admin/getcitydistwise/" + dist_id,
            dataType: "json",
            success: function(data) {
                console.log("city", data);
                var option = "";
                for (var i = 0; i < data.data.length; i++) {
                    if (assign_city == data.data[i].id) {
                        option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                i]
                            .city_name + "</option>";
                    } else {
                        option += "<option value=" + data.data[i].id + ">" + data.data[i]
                            .city_name + "</option>";
                    }
                }
                $("#assign_city").html(option);
            }
        });

        }

 </script>
@endsection
