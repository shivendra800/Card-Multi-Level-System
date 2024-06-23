@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Driver {{ $title }}</h1>


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
                        <form class="forms-sample" @if(empty($createDriver['id'])) action="{{ url('admin/Add-Edit-Driver') }}" @else action="{{ url('admin/Add-Edit-Driver/'.$createDriver['id']) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Driver Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($createDriver['name'])) value="{{ $createDriver['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Full Owner Name" required="" >
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password" @if($createDriver['id']!="") disabled="" @else required="" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="address"> Address</label>
                                            <input type="text" class="form-control" name="address" id="address" @if(!empty($createDriver['address'])) value="{{ $createDriver['address'] }}" @else value="{{ old('address') }}" @endif placeholder="Enter Address" required=""  >
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
                                            @if(!empty($createDriver['pincode'])) value="{{ $createDriver['pincode'] }}" @else value="{{ old('pincode') }}" @endif
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
                                            @if(!empty($createDriver['mobile'])) value="{{ $createDriver['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter mobile no">
                                        </div>
                                        <div class="form-group">
                                            <label for="pan_card">Pan Card No</label>
                                            <input type="text" class="form-control" name="pan_card" id="pan_card" @if(!empty($createDriver['pan_card'])) value="{{ $createDriver['pan_card'] }}" @else value="{{ old('pan_card') }}" @endif @if($createDriver['id']!="") disabled="" @else required="" @endif placeholder="Enter pan_card" required=""  >
                                        </div>
                                 
                                      
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($createDriver['email'])) value="{{ $createDriver['email'] }}" @else value="{{ old('email') }}" @endif  @if($createDriver['id']!="") disabled="" @else required="" @endif placeholder="Enter Email" >
                                    </div>
                                 

                                    <div class="form-group">
                                        <label for="assign_state"> State</label>
                                        <select name="assign_state" id="assign_state"
                                        class="form-control  @error('assign_state') is-invalid @enderror"
                                        value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();"  required="" >
                                        <option value="">Select State</option>
                                        @foreach ($state as $value)
                                            @if ($createDriver != null)
                                                @if ($value->id == $createDriver['state'])
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
                                        <label for="aadhar">Aadhar No</label>
                                        <input type="text" class="form-control" name="aadhar" id="aadhar" @if(!empty($createDriver['aadhar'])) value="{{ $createDriver['aadhar'] }}" @else value="{{ old('aadhar') }}" @endif placeholder="Enter aadhar" required="" >
                                    </div>

                                    <div class="form-group">
                                        <label for="health_card_amount"> Image</label>
                                        <input type="file" class="form-control" name="image" id="image" @if(!empty($createDriver['image'])) value="{{ $createDriver['image'] }}" @else value="{{ old('image') }}" @endif @if($createDriver['id']!="") disabled="" @else required="" @endif required=""   >
                                        <a target="_blank" href="{{ url('admin_assets/uploads/ambulance/'.$createDriver['image']) }}">View Image</a>&nbsp;&nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label for="driving_lan_image">Driving Lic Docoument</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="driving_lan_image" id="driving_lan_image" @if(!empty($createDriver['driving_lan_image'])) value="{{ $createDriver['driving_lan_image'] }}" @else value="{{ old('driving_lan_image') }}" @endif @if($createDriver['id']!="") disabled="" @else required="" @endif required=""   >
                                        <a target="_blank" href="{{ url('admin_assets/uploads/driving_lan_image/'.$createDriver['driving_lan_image']) }}">View Driving Lic No</a>&nbsp;&nbsp;
                                        <a target="_blank" download="" href="{{ url('admin_assets/uploads/driving_lan_image/'.$createDriver['driving_lan_image']) }}">Download Driving Lic No</a>&nbsp;&nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label for="aadhar_image">Aaddhar Card Docoument</label>
                                        <input type="file" accept="application/pdf" class="form-control" name="aadhar_image" id="aadhar_image" @if(!empty($createDriver['aadhar_image'])) value="{{ $createDriver['aadhar_image'] }}" @else value="{{ old('aadhar_image') }}" @endif  @if($createDriver['id']!="") disabled="" @else required="" @endif required=""   >
                                        <a target="_blank" href="{{ url('admin_assets/uploads/driver_aadhar_image/'.$createDriver['aadhar_image']) }}">View Aaddhar Docoument</a>&nbsp;&nbsp;
                                        <a target="_blank" download="" href="{{ url('admin_assets/uploads/driver_aadhar_image/'.$createDriver['aadhar_image']) }}">Download Aaddhar Docoument</a>&nbsp;&nbsp;
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
           @if ($createDriver != null)
                var assign_district="{{ $createDriver['assign_by_district'] }}";
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
        @if ($createDriver != null)
            var assign_city="{{ $createDriver['assign_city'] }}";
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
           @if ($createDriver != null)
                var health_card_amount="{{ $createDriver['health_card_amount'] }}";
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
