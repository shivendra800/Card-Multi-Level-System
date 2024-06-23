@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gift</h1>
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
                            <h3 class="card-title">Gift Offered List </h3>
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
                                        <table id="example1" class="table table-bordered table-striped  dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th> ID</th>
                                                    <th>Number of Helath Card </th>
                                                    <th>Offered Gift By Company</th>
                                                    <th>Created Health Card</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                      <td>10</td>
                                                      <td>
                                                          <i class='fas fa-medkit' style='font-size:28px;color:red'></i>
                                                          <button class="btn btn-success">Health Kit</button></td>
                                                      <td><button class="btn btn-info">You Have Acheived! 10 Member You Have Created And Got 1000 Health Kit</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                          <td>100</td>
                                                          <td>
                                                              <i class='fas fa-h-square' style='font-size:28px;color:red'></i>
                                                              <button class="btn btn-success">Health Insurance</button></td>
                                                            <td><button class="btn btn-info">You Have Acheived! 100 Member You Have Created And Got 8,000 Health Insurance</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                              <td>1000</td>
                                                              <td>
                                                                  <i class='fas fa-ambulance' style='font-size:28px;color:red'></i>
                                                                  <button class="btn btn-success">Ambulance</button></td>
                                                              <td><button class="btn btn-info">You Have Acheived! 1000 Member You Have Created And You Get 50,000 Ambulance</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                  <td>10000</td>
                                                                  <td>
                                                                      <i class="fa fa-plus-square" style='font-size:28px;color:red'></i>
                                                                    <button class="btn btn-success">Pathology</button></td>
                                                                  <td><button class="btn btn-info">You Have Acheived! 10000 Member You Have Created And You Get 4Lac Pathology</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                      <td>1Lac</td>
                                                                      <td>
                                                                          <i class='fas fa-store' style='font-size:28px;color:red'></i>
                                                                          <button class="btn btn-success">Medical Store</button></td>
                                                                      <td><button class="btn btn-info">You Have Acheived! 1Lac Member You Have Created And You Get 30Lac Medical Store</button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>6</td>
                                                                          <td>10Lac</td>
                                                                          <td>
                                                                              <i class='fas fa-hospital' style='font-size:28px;color:red'></i>
                                                                              <button class="btn btn-success">Hospital</button></td>
                                                                          <td><button class="btn btn-info">You Have Acheived! 10Lac Member You Have Created And You Get 2Cr Hospital</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>7</td>
                                                                              <td>20Lac</td>
                                                                              <td>
                                                                                  <i class="fas fa-users" style='font-size:28px;color:red'></i>
                                                                                      <button class="btn btn-success">2% Company Profit Share</button></td>
                                                                              <td><button class="btn btn-info">You Have Acheived! 20Lac Member You Have Created</button></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>8</td>
                                                                                  <td>40Lac</td>
                                                                                  <td>
                                                                                      <i class="fas fa-users" style='font-size:28px;color:red'>
                                                                                     <button class="btn btn-success">3% Company Profit Share</button></td>
                                                                                  <td><button class="btn btn-info">You Have Acheived! 40Lac Member You Have Created</button></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>9</td>
                                                                                      <td>80Lac</td>
                                                                                      <td>
                                                                                          <i class="fas fa-users" style='font-size:28px;color:red'>
                                                                                              <button class="btn btn-success">4% Company Profit Share</button></td>
                                                                                      <td><button class="btn btn-info">You Have Acheived! 80Lac Member You Have Created</button></td>
                                                                                    </tr>
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

