@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Health Card Customer List(HCMS)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Health Card  </li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Customer</span>
                            <span class="info-box-number">
                                {{ $total_healthCardCustomer }}
                                {{-- <small>%</small> --}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

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
                            <h3 class="card-title">List of  Health Card Customer  </h3>
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
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Image</th>
                                                    {{-- <th>Reference By</th> --}}
                                                    <th>Reference Name</th>
                                                    <th>Reference Type</th>
                                                    <th>Customer Name</th>
                                                    <th>Card Issue Date</th>
                                                    <th>Expire Issue Date</th>
                                                    <th>Health Card Type</th>
                                                    <th>Health Card Amount</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($HealthCardCustomerList as $healthcustomer)
                                                <tr>
                                                      <td>{{ $healthcustomer['id'] }}</td>
                                                      <td>
                                                        <img style="width:80px;" src="{{ asset('/admin_assets/uploads/healthcardcustomer/'.$healthcustomer['image']) }}" alt="Image here"
                                                        class="cate-image">
                                                      </td>
                                                      {{-- <td>{{ $healthcustomer['referred_by'] }}</td> --}}
                                                      <td>{{ $healthcustomer['refered_by'] }}</td>
                                                      <td>{{ $healthcustomer['type'] }}</td>
                                                      <td>{{ $healthcustomer['name'] }}</td>
                                                      <td>{{ $healthcustomer['card_reg_start'] }}</td>
                                                      <td>{{ $healthcustomer['card_reg_end'] }}</td>
                                                      <td>{{ $healthcustomer['health_card_type'] }}</td>
                                                      <td>{{ $healthcustomer['health_card_amount'] }}</td>
                                                      <td>
                                                        <a title="Update health Card" href="{{ url('admin/Update-health-card/'.$healthcustomer['id'] ) }}"<i style="font-size:25px;" class="fa fa-edit"></i></a>
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
