@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role , Permission and  Reset Section</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Role And Permission Section </li>
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
                            <h3 class="card-title">List of  Role And Permission Section </h3>
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
                                    <div class="col-sm-12 col-md-6">
                                       <div class="btn btn-success"><a href="{{url('/')}}/admin/assign-role"  style="color: white">Add Role</a></div>
                                        </div>
                                    </div>



                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="date-table-download-button">



                                      </div>
                                      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                      aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Admin ID</th>
                                                    <th>Admin Type</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Dummy Wallet</th>

                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($AdminView as $AdminView)
                                                <tr>
                                                      <td>{{ $AdminView['id'] }}</td>
                                                      <td>{{ $AdminView['type'] }}</td>
                                                      <td>{{ $AdminView['name'] }}</td>
                                                      <td>{{ $AdminView['email'] }}</td>
                                                      <td class="text-danger">Rs.{{ $AdminView['dummy_wallet'] }}</td>

                                                        <td class="table_Action">
                                                            <a title="Assign Role" href="{{ url('admin/update-role/'.$AdminView['id']) }}"><spam class="btn btn-info"><i class="fas fa-unlock"></i></spam></a><br>
                                                            @if($AdminView['type'] == "Sub-Admin" ||$AdminView['type'] == "Accountant" )
                                                            @else
                                                            <a title="Add Dummy Wallet" href="{{ url('admin/Add-dummy-wallet/'.$AdminView['id']) }}"><spam class="btn btn-primary"><i class="fas fa-wallet"></i></spam></a><br>

                                                            @endif
                                                            <a title="Reset Email & Password" href="{{ url('admin/assign-role/'.$AdminView['id'] ) }}"><spam class="btn btn-warning"><i  class="fa fa-lock-open"></i></spam></a><br>
                                                            <a title="Reset Password" href="{{ url('admin/reset-password/'.$AdminView['id']) }}"><spam class="btn btn-danger"><i class="fas fa-key"></i></spam></a><br>

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
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('script')
 <script>
     function ActiveRow(id) {
            swal({
                    title: "Are you sure?",
                    text: "You want to change status",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#active_form_" + id).submit();
                    } else {
                        //swal("Your data is safe!");
                    }
                });

        }

        function InActiveRow(id) {
            swal({
                    title: "Are you sure?",
                    text: "You want to change status",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#inactive_form_" + id).submit();
                    } else {
                        //swal("Your data is safe!");
                    }
                });

        }
 </script>
@endsection
