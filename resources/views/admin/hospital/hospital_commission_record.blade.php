@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Add Dummmy Wallet</h1>


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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Commision History Record </h3>
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
                        <form class="forms-sample" @if(empty($createhospital['id'])) action="{{ url('admin/hospital-commisison-reciver') }}" @else action="{{ url('admin/hospital-commisison-reciver/'.$createhospital['id']) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row mt-4">

                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="amount_recive">Amount Recive</label>
                                    <input type="number" class="form-control" name="amount_recive" id="amount_recive"  placeholder="Enter Dummmy Wallet Amount" required>
                                </div>
                                <div class="form-group ">
                                    <label for="reciver_name">Recive Name</label>
                                    <input type="text" class="form-control" name="reciver_name" id="reciver_name"  placeholder="Enter Dummmy Wallet Amount" required>
                                </div>
                                <div class="form-group ">
                                    <label for="receive_slip">Recive Slip Image</label>
                                    <input type="file" class="form-control" name="receive_slip" id="receive_slip"  placeholder="Enter Dummmy Wallet Amount" required>
                                </div>
                            </div>
                            <div class="col-md-4"></div>







                            </div>

                             <!-- /.card-body -->

                        </div>
                        <div class="card-footer" align="center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>

                    </div>
                    <div class="row" >
                        <div class="col-md-12">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Money Recive By</th>
                                        <th>Received Commissions Amount</th>
                                        <th>Total Commission Amount</th>
                                        <th>Remaning Commission Amount</th>
                                        <th>Money Received Date</th>
                                        <th>Transection Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hospitalCommisisonHistory as $HosptHistroy)
                                    <tr>
                                          <td>{{ $HosptHistroy['id'] }}</td>
                                          <td>{{ $HosptHistroy['reciver_name'] }}</td>
                                          <td>{{ $HosptHistroy['amount_recive'] }}</td>
                                          <td>{{ $HosptHistroy['total_amount'] }}</td>
                                          <td>{{ $HosptHistroy['remaing_amount'] }}</td>

                                          <td>{{ date('d-m-Y ',strtotime($HosptHistroy['created_at'])); }}</td>
                                          <td>
                                            <a class="label label-info" href="{{ url('/') }}/admin_assets/uploads/receive_slip/{{ $HosptHistroy['receive_slip']}}" target="_blank" download="">Transection Receipt
                                            </a>
                                          </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>






                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@section('script')

@endsection
