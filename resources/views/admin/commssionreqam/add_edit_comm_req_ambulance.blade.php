@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Ambulance</h1>


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
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"> {{ $title }}<small> </small></h3>
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
                        <form class="forms-sample" @if(empty($ambulancecommis['id'])) action="{{ url('admin/add-edit-ambulance-comm-per') }}" @else action="{{ url('admin/add-edit-ambulance-comm-per/'.$ambulancecommis['id']) }}" @endif method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="state_commission">State Commission Percentage</label>
                                  <input type="text" class="form-control" name="state_commission" id="state_commission"@if(!empty($ambulancecommis['state_commission']))
                                  value="{{ $ambulancecommis['state_commission'] }}"  @else value="{{ old('state_commission') }}" @endif
                                  placeholder="Enter State Commission Percentage" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="district_commission">District Commission Percentage</label>
                                    <input type="text" class="form-control" name="district_commission" id="district_commission"@if(!empty($ambulancecommis['district_commission']))
                                    value="{{ $ambulancecommis['district_commission'] }}"  @else value="{{ old('district_commission') }}" @endif
                                    placeholder="Enter State Commission Percentage" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_commission">City Commission Percentage</label>
                                        <input type="text" class="form-control" name="city_commission" id="city_commission"@if(!empty($ambulancecommis['city_commission']))
                                        value="{{ $ambulancecommis['city_commission'] }}"  @else value="{{ old('city_commission') }}" @endif
                                        placeholder="Enter State Commission Percentage" required>
                                        </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer" align="center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                          </div>
                        </form>
                      </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>
  function myFunction() {


        var city_reqistation_amount = $("#city_reqistation_amount").val();
        var gst_percentage = $("#gst_percentage").val();
        var gst_percentage_amount = $("#gst_percentage_amount").val();
        var total_state_reqistation_amount = $("#total_state_reqistation_amount").val();

        if(city_reqistation_amount == "") {
            city_reqistation_amount = 0;
        }
        if(gst_percentage == "") {
            gst_percentage = 0;
        }
        if(gst_percentage_amount == "") {
            gst_percentage_amount = 0;
        }
        if(total_state_reqistation_amount == "") {
            total_state_reqistation_amount = 0;
        }


        var gst_percentage_amount = (parseInt(city_reqistation_amount) * parseInt(gst_percentage))/100;
        var total_state_reqistation_amount = parseInt(gst_percentage_amount)+parseInt(city_reqistation_amount)
        // console.log(total_tax);
        $("#gst_percentage_amount").val(gst_percentage_amount);
        $("#total_state_reqistation_amount").val(total_state_reqistation_amount);



}

 </script>
@endsection
