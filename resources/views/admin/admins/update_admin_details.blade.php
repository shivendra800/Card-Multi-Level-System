@extends('admin.index')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update {{ Auth::guard('admin')->user()->name }} Details </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ Auth::guard('admin')->user()->type }}</li>
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
                <h3 class="card-title">Update {{ Auth::guard('admin')->user()->name }} <small> Details  of {{ Auth::guard('admin')->user()->type }}</small></h3>
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
              <form action="{{ url('admin/update-details') }}" class="forms-sample" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{Auth::guard('admin')->user()->email }}"  placeholder="Email" readonly>
                      </div>
                      <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" class="form-control" id="type" value="{{Auth::guard('admin')->user()->type }}" readonly placeholder="type" readonly>
                      </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{Auth::guard('admin')->user()->name }}" placeholder="name">

                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile No</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" value="{{Auth::guard('admin')->user()->mobile }}" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image"  placeholder="Password">
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{ url('admin_assets/uploads/adminlogin/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                    <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image  }}">
                    @endif
                  </div>
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
