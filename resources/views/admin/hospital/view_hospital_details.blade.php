@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Hospital List</h1>


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
                            <h3 class="card-title"> View<small> Hospital  Detials</small></h3>
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
                                            <label for="name">Hospital Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($createhospital['name'])) value="{{ $createhospital['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Full Name" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Hospital Address</label>
                                            <input type="text" class="form-control" name="address" id="address" @if(!empty($createhospital['address'])) value="{{ $createhospital['address'] }}" @else value="{{ old('address') }}" @endif placeholder="Enter Address" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="assign_district">Hospital District</label>
                                            <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getassigncity();" readonly>
                                                <option>Select Assign District</option>
                                           </select>
                                           @error('assign_district')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                           @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pincode">Hospital Pincode</label>
                                            <input type="number"
                                            @if(!empty($createhospital['pincode'])) value="{{ $createhospital['pincode'] }}" @else value="{{ old('pincode') }}" @endif
                                            onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('pincode')
                                             is-invalid
                                                @enderror"
                                            value="{{ old('pincode') }}" name="pincode"
                                            placeholder="Enter pincode" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Hospital Mobile No</label>
                                            <input type="number" name="mobile"
                                            @if(!empty($createhospital['mobile'])) value="{{ $createhospital['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter mobile no" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_person_mobile">Contact Person Mobile No</label>
                                            <input type="number" name="contact_person_mobile"
                                            @if(!empty($createhospital['contact_person_mobile'])) value="{{ $createhospital['contact_person_mobile'] }}" @else value="{{ old('contact_person_mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('contact_person_mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter contact_person_mobile mobile no" readonly>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Hospital Email</label>
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($createhospital['email'])) value="{{ $createhospital['email'] }}" @else value="{{ old('email') }}" @endif  @if($createhospital['id']!="") disabled="" @else required="" @endif placeholder="Enter Email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person_name">Contact Person Name</label>
                                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" @if(!empty($createhospital['contact_person_name'])) value="{{ $createhospital['contact_person_name'] }}" @else value="{{ old('contact_person_name') }}" @endif placeholder="Enter contact_person_name" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="assign_state">Hospital State</label>
                                        <select name="assign_state" id="assign_state"
                                        class="form-control  @error('assign_state') is-invalid @enderror"
                                        value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();" readonly>
                                        <option value="">Select State</option>
                                        @foreach ($state as $value)
                                            @if ($createhospital != null)
                                                @if ($value->id == $createhospital['assign_by_state'])
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
                                        <select class="form-control text-dark @error('assign_city') is-invalid @enderror" id="assign_city" name="assign_city"  readonly>
                                            <option>Select Assign City</option>
                                        </select>
                                        @error('assign_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="green_card_discount">green_card_discount</label>
                                        <input type="text" class="form-control" name="green_card_discount" id="green_card_discount" @if(!empty($createhospital['green_card_discount'])) value="{{ $createhospital['green_card_discount'] }}" @else value="{{ old('green_card_discount') }}" @endif placeholder="Enter green_card_discount" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="silver_card_discount">Silver Card Discount</label>
                                        <input type="text" class="form-control" name="silver_card_discount" id="silver_card_discount" @if(!empty($createhospital['silver_card_discount'])) value="{{ $createhospital['silver_card_discount'] }}" @else value="{{ old('silver_card_discount') }}" @endif placeholder="Entersilver_card_discount" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="gold_card_discount">Gold Card Discount</label>
                                        <input type="text" class="form-control" name="gold_card_discount" id="gold_card_discount" @if(!empty($createhospital['gold_card_discount'])) value="{{ $createhospital['gold_card_discount'] }}" @else value="{{ old('gold_card_discount') }}" @endif placeholder="Enter gold_card_discount" readonly>
                                    </div>
                                    @if(Auth::guard('admin')->user()->type != 'Health_card_Customer')
                                    <div class="form-group">
                                        <label for="company_discount">Company Commission</label>
                                        <input type="text" class="form-control" name="company_discount" id="company_discount" @if(!empty($createhospital['company_discount'])) value="{{ $createhospital['company_discount'] }}" @else value="{{ old('company_discount') }}" @endif placeholder="Enter Pan Card Number" readonly>
                                    </div>
                                    @endif
                                </div>
                            </div>
                             <!-- /.card-body -->

                        </div>
                        <div class="card-footer" align="center">
                            <div class="btn btn-success"><a href="{{url('/')}}/admin/hospital-List"  style="color: white">Back</a></div>
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
