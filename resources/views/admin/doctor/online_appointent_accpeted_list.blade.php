@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctor Management System</h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Online Book Appointent List </h3>
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
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Hospital ID</th>
                                                    <th>Name</th>
                                                    <th>Mobile </th>
                                                    <th>Specialization</th>
                                                    <th>Book_appointent_date</th>
                                                    <th>Aappintent Time</th>
                                                    <th>Docter Name</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($AppoimentaccepetedList as $appList)
                                                <tr>
                                                      <td>{{ $appList['id'] }}</td>
                                                      <td>{{ $appList['name'] }}</td>
                                                      <td>{{ $appList['mobile'] }}</td>
                                                      <td>{{ $appList['specialization'] }}</td>
                                                      <td>{{ $appList['book_appointent_date'] }}</td>
                                                      <td>{{ $appList['appintent_time'] }}</td>
                                                      <td>{{ $appList['docter_name'] }}</td>


                                                    </tr>



                                                @endforeach



                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')

@endsection
