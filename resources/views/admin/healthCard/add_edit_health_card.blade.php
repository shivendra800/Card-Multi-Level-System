@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>HCMS</h1>


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
                            <h3 class="card-title"> {{ $title }}<small> Health Card Customer</small></h3>
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
                        <form class="forms-sample" @if(empty($issuehealthCard['id'])) action="{{ url('admin/add-edit-health-card') }}" @else action="{{ url('admin/add-edit-health-card/'.$issuehealthCard['id']) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($issuehealthCard['name'])) value="{{ $issuehealthCard['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Full Name" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" @if(!empty($issuehealthCard['password'])) value="{{ $issuehealthCard['password'] }}" @else value="{{ old('password') }}" @endif placeholder="Enter Password" @if($issuehealthCard['id']!="") disabled="" @else required="" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob">DOB</label>
                                            <input type="date" class="form-control" name="dob" id="dob" @if(!empty($issuehealthCard['dob'])) value="{{ $issuehealthCard['dob'] }}" @else value="{{ old('dob') }}" @endif placeholder="Enter Date Of Birth" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" @if(!empty($issuehealthCard['address'])) value="{{ $issuehealthCard['address'] }}" @else value="{{ old('address') }}" @endif placeholder="Enter Address" required=""  >
                                        </div>

                                        <div class="form-group">
                                            <label for="assign_district">District</label>
                                            {{-- <input type="text" class="form-control" name="assign_district" id="assign_district" @if(!empty($issuehealthCard['assign_district'])) value="{{ $issuehealthCard['assign_district'] }}" @else value="{{ old('assign_district') }}" @endif placeholder="Enter District" > --}}
                                            <select class="form-control text-dark @error('assign_district') is-invalid @enderror" id="assign_district" name="assign_district" required onchange="getassigncity();" @if($issuehealthCard['id']!="") disabled="" @else required="" @endif>
                                                <option>Select Assign District</option>
                                           </select>
                                           @error('assign_district')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                           @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="number"
                                            @if(!empty($issuehealthCard['pincode'])) value="{{ $issuehealthCard['pincode'] }}" @else value="{{ old('pincode') }}" @endif
                                            onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('pincode')
                                             is-invalid
                                                @enderror"
                                            value="{{ old('pincode') }}" name="pincode"
                                            placeholder="Enter pincode" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="card_reg_end">Card End Date</label>(Click on this to get the Date)
                                            <input type="date" class="form-control" onblur="nextYearDate(this.value);" name="card_reg_end" id="card_reg_end" @if(!empty($issuehealthCard['card_reg_end'])) value="{{ $issuehealthCard['card_reg_end'] }}" @else value="{{ old('card_reg_end') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif readonly placeholder="Enter Health Card End Date" >
                                            {{-- <input type="date" name="next_date" id="next_date" value="" onblur="nextYearDate(this.value);" disabled/> --}}

                                        </div>

                                        <div class="form-group">
                                            <label for="aadhar_no">Aadhar Number</label>
                                            <input type="number"
                                            @if(!empty($issuehealthCard['aadhar_no'])) value="{{ $issuehealthCard['aadhar_no'] }}" @else value="{{ old('aadhar_no') }}" @endif
                                            onKeyDown="if(this.value.length==12 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('aadhar_no')
                                             is-invalid
                                                @enderror"
                                            value="{{ old('aadhar_no') }}" name="aadhar_no"
                                            placeholder="Enter aadhar_no" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile">Mobile No</label>
                                            {{-- <input type="number" class="form-control" name="mobile" id="mobile" @if(!empty($issuehealthCard['mobile'])) value="{{ $issuehealthCard['mobile'] }}" @else value="{{ old('mobile') }}" @endif min="10" max="10" placeholder="Enter Mobile Number" > --}}
                                            <input type="number" name="mobile"
                                            @if(!empty($issuehealthCard['mobile'])) value="{{ $issuehealthCard['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter mobile no" required="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="health_card_type">Health Card Type</label>
                                            <select name="health_card_type" id="health_card_type" @if($issuehealthCard['id']!="") disabled="" @else required="" @endif
                                        class="form-control  @error('health_card_type') is-invalid @enderror"
                                        value="{{ old('health_card_type') }}" id="health_card_type" onchange="getamount();" >
                                        <option value="">Select Health Card Type</option>
                                        @foreach ($healthcardtype as $value)
                                            @if ($healthcardtype != null)
                                                @if ($value->id == $issuehealthCard['health_card_type'])
                                                    <option selected value="{{ $value->id }}">
                                                        {{ $value->health_card_type }}
                                                    </option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->health_card_type }}
                                                    </option>
                                                @endif
                                            @else
                                                @if ($value->id == old('health_card_type'))
                                                    <option selected value="{{ $value->id }}">
                                                        {{ $value->state_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->health_card_type }}
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                        </div>

                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($issuehealthCard['email'])) value="{{ $issuehealthCard['email'] }}" @else value="{{ old('email') }}" @endif  @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="swd">Father Name</label>
                                        <input type="text" required=""  class="form-control" name="swd" id="swd" @if(!empty($issuehealthCard['swd'])) value="{{ $issuehealthCard['swd'] }}" @else value="{{ old('swd') }}" @endif placeholder="Enter SWD" >
                                    </div>
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <input type="text" class="form-control" name="blood_group" id="blood_group" @if(!empty($issuehealthCard['blood_group'])) value="{{ $issuehealthCard['blood_group'] }}" @else value="{{ old('blood_group') }}" @endif placeholder="Enter Blood Group" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="assign_state">State</label>
                                        <select name="assign_state" id="assign_state"
                                        class="form-control  @error('assign_state') is-invalid @enderror"
                                        value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();" @if($issuehealthCard['id']!="") disabled="" @else required="" @endif>
                                        <option value="">Select State</option>
                                        @foreach ($state as $value)
                                            @if ($issuehealthCard != null)
                                                @if ($value->id == $issuehealthCard['assign_state'])
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
                                    @error('assign_city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        {{-- <input type="text" class="form-control" name="city" id="city" @if(!empty($issuehealthCard['city'])) value="{{ $issuehealthCard['city'] }}" @else value="{{ old('city') }}" @endif placeholder="Enter city" > --}}
                                        <select class="form-control text-dark @error('assign_city') is-invalid @enderror" id="assign_city" name="assign_city" @if($issuehealthCard['id']!="") disabled="" @else required="" @endif >
                                            <option>Select Assign City</option>
                                        </select>
                                        @error('assign_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="card_reg_start">Card Issue Date</label>
                                        <input type="date"  class="form-control" onblur="nextYearDate(this.value);"  name="card_reg_start" id="card_reg_start" @if(!empty($issuehealthCard['card_reg_start'])) value="{{ $issuehealthCard['card_reg_start'] }}" @else value="{{ old('card_reg_start') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Health Card Start Date" >
                                        {{-- <input type="date" name="current_date" id="current_date" value="" onblur="nextYearDate(this.value);" /> --}}

                                    </div>

                                    <div class="form-group">
                                        <label for="pan_number">Pan Card Number</label>
                                        <input type="text" class="form-control" name="pan_number" id="pan_number" @if(!empty($issuehealthCard['pan_number'])) value="{{ $issuehealthCard['pan_number'] }}" @else value="{{ old('pan_number') }}" @endif placeholder="Enter Pan Card Number" required=""  >
                                    </div>

                                    <div class="form-group">
                                        <label for="health_card_amount">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" @if(!empty($issuehealthCard['image'])) value="{{ $issuehealthCard['image'] }}" @else value="{{ old('image') }}" @endif  required=""  >
                                    </div>
                                    <div class="form-group">
                                        <label for="health_card_amount">Health Card Amount</label>
                                        <input type="text" class="form-control" name="health_card_amount" id="health_card_amount" @if(!empty($issuehealthCard['health_card_amount'])) value="{{ $issuehealthCard['health_card_amount'] }}" @else value="{{ old('health_card_amount') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Health Card Amount"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="gst_percentage">GST Percentage</label>
                                        <input type="text" class="form-control" name="gst_percentage" id="gst_percentage" @if(!empty($issuehealthCard['gst_percentage'])) value="{{ $issuehealthCard['gst_percentage'] }}" @else value="{{ old('gst_percentage') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Health Card Amount"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="gst_percentage_amount">GST Percentage Amount</label>
                                        <input type="text" class="form-control" name="gst_percentage_amount" id="gst_percentage_amount" @if(!empty($issuehealthCard['gst_percentage_amount'])) value="{{ $issuehealthCard['gst_percentage_amount'] }}" @else value="{{ old('gst_percentage_amount') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Health Card Amount"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_healthcard_reqistation_amount">Total Amount</label>
                                        <input type="text" class="form-control" name="total_healthcard_reqistation_amount" id="total_healthcard_reqistation_amount" @if(!empty($issuehealthCard['total_healthcard_reqistation_amount'])) value="{{ $issuehealthCard['total_healthcard_reqistation_amount'] }}" @else value="{{ old('total_healthcard_reqistation_amount') }}" @endif @if($issuehealthCard['id']!="") disabled="" @else required="" @endif placeholder="Enter Health Card Amount"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_id">Sponsor ID</label>
                                        <input type="text" class="form-control" name="sponsor_id" id="sponsor_id" @if(!empty($issuehealthCard['sponsor_id'])) value="{{ $issuehealthCard['sponsor_id'] }}" @else value="{{ old('sponsor_id') }}" @endif placeholder="Enter Pan Card Number" required="" >
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
           @if ($issuehealthCard != null)
                var assign_district="{{ $issuehealthCard['assign_by_district'] }}";
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
        @if ($issuehealthCard != null)
            var assign_city="{{ $issuehealthCard['assign_city'] }}";
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
           @if ($issuehealthCard != null)
                var health_card_amount="{{ $issuehealthCard['health_card_amount'] }}";
                var gst_percentage="{{ $issuehealthCard['gst_percentage'] }}";
                var gst_percentage_amount="{{ $issuehealthCard['gst_percentage_amount'] }}";
                var total_healthcard_reqistation_amount="{{ $issuehealthCard['total_healthcard_reqistation_amount'] }}";
            @else
                var health_card_amount="{{ old('health_card_amount') }}";
                var gst_percentage="{{ old('gst_percentage') }}";
                var gst_percentage_amount="{{ old('gst_percentage_amount') }}";
                var total_healthcard_reqistation_amount	="{{ old('total_healthcard_reqistation_amount') }}";
            @endif
           $.ajax({
               url: "{{ url('/') }}/admin/getamountcardwise/" + health_card_type,
               dataType: "json",
               success: function(data) {
                   // console.log("data", data);
                   var option = "";
                   $("#health_card_amount").val(data.data[0].health_card_amount);
                   $("#gst_percentage").val(data.data[0].gst_percentage);
                   $("#gst_percentage_amount").val(data.data[0].gst_percentage_amount);
                   $("#total_healthcard_reqistation_amount").val(data.data[0].total_healthcard_reqistation_amount);
               }
           });
       }
 </script>
@endsection
