@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Specialization </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
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
                        <h3 class="card-title"><small> Specialization </small></h3>
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
                    <form class="forms-sample" @if(empty($AppoimentList['id'])) action="{{ url('admin/Edit-online-appointent') }}" @else action="{{ url('admin/Edit-online-appointent/'.$AppoimentList['id']) }}" @endif method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Paitent Name</label>
                                <input type="text" class="form-control" name="name" id="name" @if(!empty($AppoimentList['name'])) value="{{ $AppoimentList['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Specialization Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Paitent Email</label>
                                <input type="text" class="form-control" name="email" id="email" @if(!empty($AppoimentList['email'])) value="{{ $AppoimentList['email'] }}" @else value="{{ old('email') }}" @endif placeholder="Enter Specialization Name" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile No</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" @if(!empty($AppoimentList['mobile'])) value="{{ $AppoimentList['mobile'] }}" @else value="{{ old('mobile') }}" @endif placeholder="Enter Specialization Name" required>
                            </div>
                            <div class="form-group">
                                <label for="specialization">Specialization Name</label>
                                <input type="text" class="form-control" name="specialization" id="specialization" @if(!empty($AppoimentList['specialization'])) value="{{ $AppoimentList['specialization'] }}" @else value="{{ old('specialization') }}" @endif placeholder="Enter Specialization Name" required>
                            </div>
                            <div class="form-group">
                                <label for="book_appointent_date">Appointent cancel</label>
                                <select name="appointment_cancel" id="appointment_cancel" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Accept">Accept</option>
                                    <option value="Reject">Reject</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="book_appointent_date">Appointent Date</label>
                                <input type="text" class="form-control" name="book_appointent_date" id="book_appointent_date" @if(!empty($AppoimentList['book_appointent_date'])) value="{{ $AppoimentList['book_appointent_date'] }}" @else value="{{ old('book_appointent_date') }}" @endif placeholder="Enter Specialization Name" required>
                            </div>
                            <div class="form-group">
                                <label for="book_appointent_date">cancel_region</label>
                                <input type="text" class="form-control" name="cancel_region" id="cancel_region" @if(!empty($AppoimentList['cancel_region'])) value="{{ $AppoimentList['cancel_region'] }}" @else value="{{ old('cancel_region') }}" @endif placeholder="Enter cancel_regione" >
                            </div>

                            <div class="form-group">
                                <label for="appintent_time">Appointent Time</label>
                                <input type="time" class="form-control" name="appintent_time" id="appintent_time" @if(!empty($AppoimentList['appintent_time'])) value="{{ $AppoimentList['appintent_time'] }}" @else value="{{ old('appintent_time') }}" @endif placeholder="Enter Specialization Name" >
                            </div>
                            <div class="form-group">
                                <label for="docter_name">Docter Name</label>
                                <input type="text" class="form-control" name="docter_name" id="docter_name" @if(!empty($AppoimentList['docter_name'])) value="{{ $AppoimentList['docter_name'] }}" @else value="{{ old('docter_name') }}" @endif placeholder="Enter Specialization Name" >
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
   $('#appointment_cancel').on('change', function () {
    if ( this.value == 'Accept')
      {
        $("#appintent_time").show();
        $("#docter_name").show();
        $("#cancel_region").hide();
      }
      else
      {
        $("#appintent_time").hide();
        $("#cancel_region").show();
        $("#docter_name").hide();
      }
        });

</script>
@endsection
