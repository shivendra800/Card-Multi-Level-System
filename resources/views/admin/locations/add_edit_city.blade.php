@extends('admin.index')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Location</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Location</li>
              <li class="breadcrumb-item active">City</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> <small> </small></h3>
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
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="forms-sample" @if(empty($city['id'])) action="{{ url('admin/add-edit-city') }}" @else action="{{ url('admin/add-edit-city/'.$city['id']) }}" @endif method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="state_id">State</label>
                        <select class="form-control text-dark @error('state_id') is-invalid @enderror" id="state" name="state_id" onchange="getdiststatewise();" required>
                            <option>Select state</option>
                            @foreach ($states as $state )
                            {{-- <option value="{{ $state['id'] }}">{{ $state['state_name'] }}</option> --}}
                                @if ($state['id'] == old('state_id'))
                                <option selected value="{{ $state['id'] }}">
                                  {{ $state['state_name'] }}
                                </option>
                                @else
                                    <option value="{{ $state['id'] }}">{{ $state['state_name'] }}
                                @endif
                            @endforeach
                            

                        </select>
                        @error('state_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label for="district_id">District</label>
                        <select class="form-control text-dark @error('district_id') is-invalid @enderror" id="district" name="district_id" required>
                            <option>Select district</option>
                        </select>
                        @error('district_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                    </div>


                    <div class="form-group">
                        <label for="city_name">city Name</label>
                        <input type="text" class="form-control @error('city_name') is-invalid @enderror" name="city_name" id="city_name" @if(!empty($city['city_name'])) value="{{ $city['city_name'] }}" @else value="{{ old('city_name') }}" @endif placeholder="Enter city Name" required>
                        @error('city_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                    </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('script')
  <script>
     function getdiststatewise() {
            var state_id = $("#state").val();
            // alert(state_id);s
            var district = "{{ old('district') }}";
            $.ajax({
                url: "{{ url('/') }}/admin/Getdist-state-wise/" + state_id,
                dataType: "json",
                success: function(data) {
                    // console.log("data", data);
                    var option = "";
                    for (var i = 0; i < data.data.length; i++) {
                        if (district == data.data[i].id) {
                            option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                    i]
                                .district_name + "</option>";
                        } else {
                            option += "<option value=" + data.data[i].id + ">" + data.data[i]
                                .district_name + "</option>";
                        }
                    }
                    $("#district").html(option);
                }
            });


        }
  </script>
@endsection

