@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Pathology Creation </h1>


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
                            <h3 class="card-title"> {{ $title }}<small> Pathology </small></h3>
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
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($createPathology['name'])) value="{{ $createPathology['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Full Name" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="clininc_name">Pathology Name</label>
                                            <input type="text" class="form-control" name="clininc_name" id="clininc_name" @if(!empty($createPathology['clininc_name'])) value="{{ $createPathology['clininc_name'] }}" @else value="{{ old('clininc_name') }}" @endif  @if($createPathology['id']!="") disabled="" @else required="" @endif placeholder="Enter Full Pathology Name" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="address"> Address</label>
                                            <input type="text" class="form-control" name="address" id="address" @if(!empty($createPathology['address'])) value="{{ $createPathology['address'] }}" @else value="{{ old('address') }}" @endif placeholder="Enter Address" required=""  >
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
                                            <label for="pincode">Pincode</label>
                                            <input type="number"
                                            @if(!empty($createPathology['pincode'])) value="{{ $createPathology['pincode'] }}" @else value="{{ old('pincode') }}" @endif
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
                                            @if(!empty($createPathology['mobile'])) value="{{ $createPathology['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter mobile no">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_person_mobile">Contact Person Mobile No</label>
                                            <input type="number" name="contact_person_mobile"
                                            @if(!empty($createPathology['contact_person_mobile'])) value="{{ $createPathology['contact_person_mobile'] }}" @else value="{{ old('contact_person_mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('contact_person_mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter contact_person_mobile mobile no" required="" >
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($createPathology['email'])) value="{{ $createPathology['email'] }}" @else value="{{ old('email') }}" @endif  @if($createPathology['id']!="") disabled="" @else required="" @endif placeholder="Enter Email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person_name">Contact Person Name</label>
                                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" @if(!empty($createPathology['contact_person_name'])) value="{{ $createPathology['contact_person_name'] }}" @else value="{{ old('contact_person_name') }}" @endif placeholder="Enter contact_person_name" >
                                    </div>

                                    <div class="form-group">
                                        <label for="assign_state"> State</label>
                                        <select name="assign_state" id="assign_state"
                                        class="form-control  @error('assign_state') is-invalid @enderror"
                                        value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();"  required="" >
                                        <option value="">Select State</option>
                                        @foreach ($state as $value)
                                            @if ($createPathology != null)
                                                @if ($value->id == $createPathology['state'])
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
                                        <label for="green_card_discount">green_card_discount</label>
                                        <input type="text" class="form-control" name="green_card_discount" id="green_card_discount" @if(!empty($createPathology['green_card_discount'])) value="{{ $createPathology['green_card_discount'] }}" @else value="{{ old('green_card_discount') }}" @endif placeholder="Enter green_card_discount" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="silver_card_discount">Silver Card Discount</label>
                                        <input type="text" class="form-control" name="silver_card_discount" id="silver_card_discount" @if(!empty($createPathology['silver_card_discount'])) value="{{ $createPathology['silver_card_discount'] }}" @else value="{{ old('silver_card_discount') }}" @endif placeholder="Entersilver_card_discount" required=""  >
                                    </div>
                                    <div class="form-group">
                                        <label for="gold_card_discount">Gold Card Discount</label>
                                        <input type="text" class="form-control" name="gold_card_discount" id="gold_card_discount" @if(!empty($createPathology['gold_card_discount'])) value="{{ $createPathology['gold_card_discount'] }}" @else value="{{ old('gold_card_discount') }}" @endif placeholder="Enter gold_card_discount" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="company_discount">Company Commission</label>
                                        <input type="text" class="form-control" name="company_discount" id="company_discount" @if(!empty($createPathology['company_discount'])) value="{{ $createPathology['company_discount'] }}" @else value="{{ old('company_discount') }}" @endif placeholder="Enter Pan Card Number" required="" >
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->

                        </div>
                      

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
           @if ($createPathology != null)
                var assign_district="{{ $createPathology['assign_by_district'] }}";
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
        @if ($createPathology != null)
            var assign_city="{{ $createPathology['assign_city'] }}";
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
           @if ($createPathology != null)
                var health_card_amount="{{ $createPathology['health_card_amount'] }}";
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
