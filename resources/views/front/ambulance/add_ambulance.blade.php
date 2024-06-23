@extends('front.layouts.layout')

@section('title', 'Register Ambulance')

@section('content')
<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Online Reqistation Ambulance</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reqistation Ambulance</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->



  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> {{ $title }}<small> Ambulance </small></h3>
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
                    <form class="forms-sample"  action="{{ url('Register-Ambulance') }}"  method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row">

                        <div class="col-md-6">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Owner Name</label>
                                        <input type="text" class="form-control" name="owner_name" id="owner_name"  value="{{ old('owner_name') }}"  placeholder="Enter Full Owner Name" required="" >
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address"> Address</label>
                                        <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"  placeholder="Enter Address" required=""  >
                                    </div>

                                    <div class="form-group">
                                        <label for="assign_district"> District</label>
                                        <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getassigncity();" required="" >
                                            <option>Select Assign District</option>
                                       </select>
                                       @error('assign_district')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pincode"> Pincode</label>
                                        <input type="number"
                                         value="{{ old('pincode') }}" 
                                        onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58)return false;"
                                        class="form-control @error('pincode')
                                         is-invalid
                                            @enderror"
                                        value="{{ old('pincode') }}" name="pincode" required=""
                                        placeholder="Enter pincode">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile"> Mobile No</label>
                                        <input type="number" name="mobile" required=""
                                         value="{{ old('mobile') }}" 
                                        onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                        class="form-control @error('mobile')
                                        is-invalid
                                        @enderror"
                                        placeholder="Enter mobile no">
                                    </div>
                                    <div class="form-group">
                                        <label for="vechile_no">Vechile No</label>
                                        <input type="text" class="form-control" name="vechile_no" id="vechile_no"  value="{{ old('vechile_no') }}"   placeholder="Enter vechile_no" required=""  >
                                    </div>
                                   
                                  
                                </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email"> Email</label>
                                    <input type="email" class="form-control" name="email" id="email"  value="{{ old('email') }}" placeholder="Enter Email" >
                                </div>
                             

                                <div class="form-group">
                                    <label for="assign_state"> State</label>
                                    <select name="assign_state" id="assign_state"
                                    class="form-control  @error('assign_state') is-invalid @enderror"
                                    value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();"  required="" >
                                    <option value="">Select State</option>
                                    @foreach ($state as $value)
                                        @if ($createAmbulance != null)
                                            @if ($value->id == $createAmbulance['state'])
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
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control text-dark @error('assign_city') is-invalid @enderror" id="assign_city" name="assign_city"  required="" >
                                        <option>Select Assign City</option>
                                    </select>
                                    @error('assign_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="health_card_amount"> Image</label>
                                    <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}"  required=""   >
                                </div>
                                <div class="form-group">
                                    <label for="vechile_documnet">Vechile Docoument</label>
                                    <input type="file" class="form-control" accept="application/pdf" name="vechile_documnet" id="vechile_documnet"  value="{{ old('vechile_documnet') }}"  required=""   >
                                </div>
                                <div class="form-group">
                                    <label for="vechile_insur_doc">Vechile Insurance Docoument</label>
                                    <input type="file" accept="application/pdf" class="form-control" name="vechile_insur_doc" id="vechile_insur_doc"  value="{{ old('vechile_insur_doc') }}"  required=""   >
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
           @if ($createAmbulance != null)
                var assign_district="{{ $createAmbulance['assign_by_district'] }}";
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
        @if ($createAmbulance != null)
            var assign_city="{{ $createAmbulance['assign_city'] }}";
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
           @if ($createAmbulance != null)
                var health_card_amount="{{ $createAmbulance['health_card_amount'] }}";
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