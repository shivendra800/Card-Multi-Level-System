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
                        <form class="forms-sample" @if(empty($healthcardtype['id'])) action="{{ url('admin/add-edit-health-card-type') }}" @else action="{{ url('admin/add-edit-health-card-type/'.$healthcardtype['id']) }}" @endif method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="health_card_type">Health Card Type</label>
                                  <input type="text" class="form-control" name="health_card_type" id="health_card_type"@if(!empty($healthcardtype['health_card_type']))
                                  value="{{ $healthcardtype['health_card_type'] }}"  @else value="{{ old('health_card_type') }}" @endif
                                  placeholder="Enter Health Card Type" readonly required>
                                  </div>
                                <div class="form-group">
                                  <label for="health_card_amount">Health Card Amount</label>
                                  <input type="text" class="form-control" name="health_card_amount" id="health_card_amount"@if(!empty($healthcardtype['health_card_amount']))
                                  value="{{ $healthcardtype['health_card_amount'] }}"  @else value="{{ old('health_card_amount') }}" @endif
                                  placeholder="Enter Health Card Amount" required="" >
                                  </div>
                                  <div class="form-group">
                                    <label for="gst_percentage">Gst Percentage</label>
                                    <input type="text" class="form-control" name="gst_percentage" id="gst_percentage"@if(!empty($healthcardtype['gst_percentage']))
                                    value="{{ $healthcardtype['gst_percentage'] }}"  @else value="{{ old('gst_percentage') }}" @endif
                                    placeholder="Enter State Registration Amount" onkeyup="myFunction();" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="gst_percentage_amount">Gst Percentage Amount</label>
                                        <input type="text" class="form-control" name="gst_percentage_amount" id="gst_percentage_amount"@if(!empty($healthcardtype['gst_percentage_amount']))
                                        value="{{ $healthcardtype['gst_percentage_amount'] }}"  @else value="{{ old('gst_percentage_amount') }}" @endif
                                        placeholder="Enter State Registration Amount" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_state_reqistation_amount">Total Registration Amount</label>
                                            <input type="text" class="form-control" name="total_state_reqistation_amount" id="total_state_reqistation_amount"@if(!empty($healthcardtype['total_healthcard_reqistation_amount']))
                                            value="{{ $healthcardtype['total_healthcard_reqistation_amount'] }}"  @else value="{{ old('total_healthcard_reqistation_amount') }}" @endif
                                            placeholder="Enter State Registration Amount" readonly>
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


var health_card_amount = $("#health_card_amount").val();
var gst_percentage = $("#gst_percentage").val();
var gst_percentage_amount = $("#gst_percentage_amount").val();
var total_state_reqistation_amount = $("#total_state_reqistation_amount").val();

if(health_card_amount == "") {
    health_card_amount = 0;
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


var gst_percentage_amount = (parseInt(health_card_amount) * parseInt(gst_percentage))/100;
var total_state_reqistation_amount = parseInt(gst_percentage_amount)+parseInt(health_card_amount)
// console.log(total_tax);
$("#gst_percentage_amount").val(gst_percentage_amount);
$("#total_state_reqistation_amount").val(total_state_reqistation_amount);



}
 </script>
@endsection
