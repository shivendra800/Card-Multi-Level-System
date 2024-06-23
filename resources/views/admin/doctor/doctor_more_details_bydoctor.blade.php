@extends('admin.index')

@section('content')



        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Doctor Multiple Details :</h1>
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Add Images</h4>
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
                                <form class="forms-sample" action="{{ url('admin/Doctor-Additional-Details/') }}" method="post" enctype="multipart/form-data">
                                    @csrf




                                    <div class="form-group">
                                        <label for="product_name">Hospital Name</label>
                                        &nbsp;{{ $gethospitalWiseDetails['name'] }}
                                    </div>
                                    <div class="form-group">
                                        <img style="width: 120px;" src="{{ asset('/admin_assets/uploads/doctor/'.$gethospitalWiseDetails['image']) }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="field_wrapper">

                                            <input type="file" name="images[]" multiple="" id="images">

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                                <br>
                                <h4 class="card-title">Add Images</h4>

                                <table id="sections" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gethospitalWiseDetails['images'] as $image)
                                        <tr>
                                            <td>{{ $image['id'] }}</td>
                                            <td>
                                                <img style="width: 60px; height:60px;" src=" {{ asset('admin_assets/uploads/doctor/small/'.$image['image']) }}" >
                                            </td>
                                            <td>
                                                <a href="{{ url('/') }}/admin/delete-image/{{$image['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
                                            </td>

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </section>

          <!--- Hospital Wise Specialization List -->
          <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Add Doctor Specialization</h4>
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
                             
                                <form class="forms-sample" action="{{ url('admin/Doctor-Details-Specialization/') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="field_wrapper">

                                           <select class="form-control" id="specialization_name" name="specialization_name">
                                            <option value="">Select Specialization Of Your Hospital</option>
                                            @foreach ($specialization as $value )

                                                 <option value="{{ $value->specialization_name }}">{{ $value->specialization_name }}</option>
                                            @endforeach

                                           </select>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                                <br>
                                <h2 class="card-title">Add Doctor Wise Specialization List</h2>
                                 <br>
                                <table id="sections" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Specialization</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gethospitalWiseDetails['specializationHospitalList'] as $sepciallist)
                                        <tr>
                                            <td>{{ $sepciallist['id'] }}</td>
                                            <td>
                                                {{ $sepciallist['specialization_name'] }}
                                            </td>
                                            <td>
                                                <a href="{{ url('/') }}/admin/delete-specializationHospitalList/{{$sepciallist['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
                                            </td>

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- end Hospital wise Spe List -->

        {{-- more other detials --}}

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Add More Details :</h4>
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
                                <hr>
                                <form class="forms-sample" action="{{ url('admin/Doctor-Details-Additional') }}" method="post" enctype="multipart/form-data">
                                    @csrf



                                  <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Upload Video</label>
                                                        <input type="file" name="video" id="video" class="form-control">
                                                        @if(!empty($gethospitalWiseDetails1->video))
                                                        <a target="_blank" href="{{ url('admin_assets/uploads/doctor_video/'.$gethospitalWiseDetails1->video) }}">View video</a>&nbsp;&nbsp;
                                                        <input type="hidden" name="video" @if(!empty($gethospitalWiseDetails1->video )) value="{{ $gethospitalWiseDetails1->video }}" @else value="{{ old('video') }}" @endif required="" >
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Time Mon-Thur</label>
                                                        <input type="time" name="mon_thur"  class="form-control"  @if(!empty($gethospitalWiseDetails1->mon_thur )) value="{{ $gethospitalWiseDetails1->mon_thur }}" @else value="{{ old('mon_thur') }}" @endif required="" >

                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Time Firday</label>
                                                        <input type="time" name="time_firday"  class="form-control" @if(!empty($gethospitalWiseDetails1->time_firday )) value="{{ $gethospitalWiseDetails1->time_firday  }}" @else value="{{ old('time_firday') }}" @endif required=""  >

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Time Sunday</label>
                                                        <input type="text" name="time_sunday"  class="form-control" @if(!empty($gethospitalWiseDetails1->time_sunday )) value="{{ $gethospitalWiseDetails1->time_sunday }}" @else value="{{ old('time_sunday') }}" @endif  required="" >

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Hospital Description</label>
                                                        <textarea class="form-control" id="description" name="description" required=""  rows="10">@if(!empty($gethospitalWiseDetails1->description )) {{ $gethospitalWiseDetails1->description  }} @else {{ old('description') }} @endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Hospital Sort Description</label>
                                                        <textarea class="form-control" id="sort_description" required=""  name="sort_description" rows="3">@if(!empty($gethospitalWiseDetails1->sort_description )) {{ $gethospitalWiseDetails1->sort_description }} @else {{ old('sort_description') }} @endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Hospital Highlight Point 1</label>
                                                         <input type="text" name="higlight_point_1"  class="form-control" @if(!empty($gethospitalWiseDetails1->higlight_point_1 )) value="{{ $gethospitalWiseDetails1->higlight_point_1  }}" @else value="{{ old('higlight_point_1') }}" @endif required="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class="field_wrapper">
                                                        <label for="">Hospital Highlight Point 2</label>
                                                         <input type="text" name="higlight_point_2"  class="form-control" @if(!empty($gethospitalWiseDetails1->higlight_point_2 )) value="{{ $gethospitalWiseDetails1->higlight_point_2 }}" @else value="{{ old('higlight_point_2') }}" @endif required="" >
                                                    </div>
                                                </div>
                                            </div>

                                             </div>
                                    </div>
                                  </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                                <br>



                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>



@endsection
