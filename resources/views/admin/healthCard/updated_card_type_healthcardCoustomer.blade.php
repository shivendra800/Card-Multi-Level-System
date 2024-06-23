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
                            <h3 class="card-title"> <small> Health Card Customer</small></h3>
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
                        <form class="forms-sample"  action="{{ url('admin/Update-health-card/'.$UpdateCardDetails['id']) }}"  method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($UpdateCardDetails['name'])) value="{{ $UpdateCardDetails['name'] }}" @else value="{{ old('name') }}" @endif  readonly placeholder="Enter Full Name" >
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" @if(!empty($UpdateCardDetails['address'])) value="{{ $UpdateCardDetails['address'] }}" @else value="{{ old('address') }}" @endif readonly placeholder="Enter Address" >
                                        </div>
                                        <div class="form-group">
                                            <label for="card_reg_end">Card End Date</label>(Only Click You Get Date Of Next Year)
                                            <input type="date"  class="form-control" onblur="nextYearDate(this.value);" name="card_reg_end" id="card_reg_end" @if(!empty($UpdateCardDetails['card_reg_end'])) value="{{ $UpdateCardDetails['card_reg_end'] }}" @else value="{{ old('card_reg_end') }}" @endif  placeholder="Enter Health Card End Date" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="health_card_type">Health Card Type</label>
                                            <select name="health_card_type" id="health_card_type"
                                        class="form-control  @error('health_card_type') is-invalid @enderror"
                                        value="{{ old('health_card_type') }}" id="health_card_type" onchange="getamount();" required="" >
                                        <option value="">Select Health Card Type</option>
                                        @foreach ($healthcardtype as $value)
                                            @if ($healthcardtype != null)
                                                @if ($value->id == $UpdateCardDetails['health_card_type'])
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
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($UpdateCardDetails['email'])) value="{{ $UpdateCardDetails['email'] }}" @else value="{{ old('email') }}" @endif  readonly placeholder="Enter Email" >
                                    </div>

                                    <div class="form-group">
                                        <label for="card_reg_start">Card Issue Date</label>
                                        <input type="date" class="form-control" onblur="nextYearDate(this.value);" name="card_reg_start" id="card_reg_start" @if(!empty($UpdateCardDetails['card_reg_start'])) value="{{ $UpdateCardDetails['card_reg_start'] }}" @else value="{{ old('card_reg_start') }}" @endif  placeholder="Enter Health Card Start Date" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile No</label>
                                        <input type="number" name="mobile"
                                        @if(!empty($UpdateCardDetails['mobile'])) value="{{ $UpdateCardDetails['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                        onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                        class="form-control @error('mobile')
                                        is-invalid
                                        @enderror"
                                        placeholder="Enter mobile no" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="health_card_amount">Health Card Amount</label>
                                        <input type="text" class="form-control" name="health_card_amount" id="health_card_amount" @if(!empty($UpdateCardDetails['health_card_amount'])) value="{{ $UpdateCardDetails['health_card_amount'] }}" @else value="{{ old('health_card_amount') }}" @endif  placeholder="Enter Health Card Amount"  readonly>
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
           @if ($UpdateCardDetails != null)
                var assign_district="{{ $UpdateCardDetails['assign_by_district'] }}";
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
        @if ($UpdateCardDetails != null)
            var assign_city="{{ $UpdateCardDetails['assign_city'] }}";
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
           @if ($UpdateCardDetails != null)
                var health_card_amount="{{ $UpdateCardDetails['health_card_amount'] }}";
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
