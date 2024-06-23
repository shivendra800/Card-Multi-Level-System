@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Ambulance {{ $title }}</h1>


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
                        <form class="forms-sample" @if(empty($assignAmbulance['id'])) action="{{ url('admin/Add-Edit-AssignAmbulance') }}" @else action="{{ url('admin/Add-Edit-AssignAmbulance/'.$assignAmbulance['id']) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="ambulance_id">Select Ambulance</label>
                                            <select class="form-control" id="ambulance_id" name="ambulance_id" style="color:#000;">
                                                <option>Select Ambulance</option>
                                                @foreach ($getAmbulance as $ambulace )
                                                <option value="{{ $ambulace['id']}}"  @if(!empty($assignAmbulance['ambulance_id'])&& $assignAmbulance['ambulance_id']==$ambulace['id']) selected="" @endif>
                                                    {{ $ambulace['vechile_no'] }}</option>
            
                                                @endforeach
            
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="assign_state"> State</label>
                                            <select name="assign_state" id="assign_state"
                                            class="form-control  @error('assign_state') is-invalid @enderror"
                                            value="{{ old('assign_state') }}" id="assign_state" onchange="getassigndiststatewise();"  required="" >
                                            <option value="">Select State</option>
                                            @foreach ($state as $value)
                                                @if ($assignAmbulance != null)
                                                    @if ($value->id == $assignAmbulance['assign_state'])
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
                                     
                                      
                                      
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="driver_id">Select Driver</label>
                                        <select class="form-control" id="driver_id" name="driver_id" style="color:#000;">
                                            <option>Select Driver</option>
                                            @foreach ($getDriver as $driver )
                                            <option value="{{ $driver['id']}}"  @if(!empty($assignAmbulance['driver_id'])&& $assignAmbulance['driver_id']==$driver['id']) selected="" @endif>
                                                {{ $driver['name'] }}</option>
        
                                            @endforeach
        
                                        </select>
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
                                        <label for="city">City</label>
                                        <select class="form-control text-dark @error('assign_city') is-invalid @enderror" id="assign_city" name="assign_city"  required="" >
                                            <option>Select Assign City</option>
                                        </select>
                                        @error('assign_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
           @if ($assignAmbulance != null)
                var assign_district="{{ $assignAmbulance['assign_by_district'] }}";
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
        @if ($assignAmbulance != null)
            var assign_city="{{ $assignAmbulance['assign_city'] }}";
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
           @if ($assignAmbulance != null)
                var health_card_amount="{{ $assignAmbulance['health_card_amount'] }}";
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
