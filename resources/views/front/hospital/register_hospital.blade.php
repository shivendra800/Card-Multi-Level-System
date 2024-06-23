@extends('front.layouts.layout')

@section('title', 'Register Your Hospital')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Register Your Hospital Here</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Fill All Information</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->
  <div class="medical-facilities-area bg-light pt-70 pb-70">
    <div class="container">
        <div class="section-title mb-40 text-center"></div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> {{ $title }}<small> Hospital </small></h3>
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
                            <form class="forms-sample"  action="{{ url('Register-Hospital') }}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-6">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Hospital Name</label>
                                                <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Full Name" >
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password" >
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Hospital Address</label>
                                                <input type="text" class="form-control" name="address" id="address"   placeholder="Enter Address" >
                                            </div>

                                            <div class="form-group">
                                                <label for="assign_district">Hospital District</label>
                                                <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getassigncity();" >
                                                    <option>Select Assign District</option>
                                               </select>
                                               @error('assign_district')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pincode">Hospital Pincode</label>
                                                <input type="number"
                                                onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('pincode')
                                                 is-invalid
                                                    @enderror"
                                                value="{{ old('pincode') }}" name="pincode"
                                                placeholder="Enter pincode">
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">Hospital Mobile No</label>
                                                <input type="number" name="mobile"
                                                 value="{{ old('mobile') }}"
                                                onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('mobile')
                                                is-invalid
                                                @enderror"
                                                placeholder="Enter mobile no">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Hospital Email</label>
                                            <input type="email" class="form-control" name="email" id="email"  value="{{ old('email') }}"  placeholder="Enter Email" >
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_person_name">Contact Person Name</label>
                                            <input type="text" class="form-control" name="contact_person_name" id="contact_person_name"  value="{{ old('contact_person_name') }}"  placeholder="Enter contact_person_name" >
                                        </div>

                                        <div class="form-group">
                                            <label for="assign_state">Hospital State</label>
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
                                            <label for="contact_person_mobile">Contact Person Mobile No</label>
                                            <input type="number" name="contact_person_mobile"
                                             value="{{ old('contact_person_mobile') }}"
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('contact_person_mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter contact_person_mobile mobile no">
                                        </div>
                                        <div class="form-group">
                                            <label for="health_card_amount">Hospital Image</label>
                                            <input type="file" class="form-control" name="image" id="image"  value="{{ old('image') }}"  >
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
           // alert(state_id);s
           @if ($createhospital != null)
                var assign_district="{{ $createhospital['assign_by_district'] }}";
            @else
                var assign_district="{{ old('assign_by_district') }}";
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
                   getassigncity();

               }
           });
       }
       function  getassigncity() {

        var dist_id = $("#assign_district").val();
        @if ($createhospital != null)
            var assign_city="{{ $createhospital['assign_city'] }}";
        @else
            var assign_city="{{ old('assign_city') }}";
        @endif

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
           /// Health card type API
        function getamount() {
           var health_card_type = $("#health_card_type").val();
           // alert(state_id);s
           @if ($createhospital != null)
                var health_card_amount="{{ $createhospital['health_card_amount'] }}";
            @else
                var health_card_amount="{{ old('health_card_amount') }}";
            @endif
           $.ajax({
               url: "{{ url('/') }}/admin/getamountcardwise/" + health_card_type,
               dataType: "json",
               success: function(data) {
                   // console.log("data", data);
                   var option = "";
                   $("#health_card_amount").val(data.data[0].health_card_amount);
               }
           });
       }
 </script>
@endsection
