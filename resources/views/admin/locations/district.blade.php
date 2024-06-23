@extends('admin.index')
@section('content')
<div class="" style="min-height: 1345.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Location <small>State List</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}/">Home</a></li>
                        <li class="breadcrumb-item active">State List</li>
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2"
                                            class="table table-bordered table-hover dataTable dtr-inline"
                                            aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th>District ID</th>
                                                    <th>State Name</th>
                                                    <th>District Name</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($districts as $district)
                                                <tr>
                                                    <td>{{$district['id']}}</td>
                                                    <td>{{$district['state_name']}}</td>
                                                    <td>{{$district['district_name']}}</td>
                                                    <td>
                                                        @if($district['status']==1)
                                                        <a class="updatedistrictStatus" id="district-{{ $district['id'] }}" district_id="{{ $district['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size:25px;" class="fas fa-play" status="Active"></i></a>

                                                        @else
                                                        <a class="updatedistrictStatus" id="district-{{ $district['id'] }}" district_id="{{ $district['id'] }}" href="javascript:void(0)">
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
