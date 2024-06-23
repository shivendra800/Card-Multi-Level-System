@extends('admin.index')
@section('content')
<div class="" style="min-height: 1345.6px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Location <small>City/Town/Village/Block List</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}/">Home</a></li>
                        <li class="breadcrumb-item active">City/Town/Village/Block List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <a style="max-width: 150px; float:; display:inline-block;" href="{{ url('admin/add-edit-city') }}" class="btn btn-block btn-primary">Add City</a>
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2"
                                            class="table table-bordered table-hover"
                                            aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th>City ID</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>City/Town/Village/Block</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($citys as $city)
                                                <tr>
                                                    <td>{{$city['id']}}</td>
                                                    <th>{{$city['state_name']}}</th>
                                                    <th>{{$city['district_name']}}</th>
                                                    <td>{{$city['city_name']}}</td>
                                                    <td>
                                                        @if($city['status']==1)
                                                        <a class="updatecityStatus" id="city-{{ $city['id'] }}" city_id="{{ $city['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size:25px;" class="fas fa-play" status="Active"></i></a>

                                                        @else
                                                        <a class="updatecityStatus" id="city-{{ $city['id'] }}" city_id="{{ $city['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size:25px;" class="fas fa-pause" status="Inactive"></i></a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

