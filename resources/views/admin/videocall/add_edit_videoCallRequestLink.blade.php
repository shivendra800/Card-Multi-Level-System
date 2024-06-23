@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> ADD Video Link Section</h1>
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
                          <h3 class="card-title"> {{ $title }}<small> Link  </small></h3>
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
                        <h4><a target="_blank" href="https://meet.google.com/" title="Click to edit this row"><i class="fas fa-edit"></i>Click Here To Create Link</a>
                        </h4>
                        <form class="forms-sample"  action="{{ url('admin/Add-Edit-VideoCallLink/'.$addVideoReqLink['id']) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            
                              <div class="form-group">
                                  <label for="video_link">Video Call Link</label>
                                  <input type="text" class="form-control" name="video_link" id="video_link"@if(!empty($addVideoReqLink['video_link']))
                                  value="{{ $addVideoReqLink['video_link'] }}"  @else value="{{ old('video_link') }}" @endif
                                  placeholder="Enter video_link " required>
                                  </div>
                                  <div class="form-group">
                                    <label for="time">Video Call Time</label>
                                    <input type="text" class="form-control" name="time" id="time"@if(!empty($addVideoReqLink['time']))
                                    value="{{ $addVideoReqLink['time'] }}"  @else value="{{ old('time') }}" @endif
                                    placeholder="Enter time " required>
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
