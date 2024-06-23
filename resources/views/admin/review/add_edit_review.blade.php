@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Review</li>
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
                          <h3 class="card-title"> {{ $title }}<small> Review </small></h3>
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
                        <form class="forms-sample"  action="{{ url('admin/Add-Edit-Review/'.$PaitentDetails['id']) }}"   method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="comment">Comment</label>
                                  <input type="text" class="form-control" name="comment" id="comment"@if(!empty($reviewss['comment']))
                                  value="{{ $reviewss['comment'] }}"  @else value="{{ old('comment') }}" @endif
                                  placeholder="Enter comment" required>
                                  </div>

                          </div>
                          <div class="card-body">
                            <div class="form-group">
                                <label for="rate">Rate</label>
                                <select class="form-control" id="rate" name="rate" >
                                    <option>Select Rate in btw 1 to 5</option>
                                    <option value="1" @if(isset($reviewss['rate']) && $reviewss['rate']=="1" ) selected @endif>1</option>
                                    <option value="2" @if(isset($reviewss['rate']) && $reviewss['rate']=="2" ) selected @endif>2</option>
                                    <option value="3" @if(isset($reviewss['rate']) && $reviewss['rate']=="3" ) selected @endif>3</option>
                                    <option value="4" @if(isset($reviewss['rate']) && $reviewss['rate']=="4" ) selected @endif>4</option>
                                    <option value="5" @if(isset($reviewss['rate']) && $reviewss['rate']=="5" ) selected @endif>5</option>
                                </select>
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


 </script>
@endsection
