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

            <div class="row mb-2">

                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total Paitent</span>
                        <span class="info-box-number">Added-Member-:{{ $totalPatientDetails }}</span>
                        <span class="info-box-number">company commission-Rs-<strong style="color:red;">{{ $totalcompanycommission }}</strong></span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Today Patient </span>
                        <span class="info-box-number">Added-Member-:{{ $todayPatientDetails }}</span>
                        <span class="info-box-number">company commission-Rs-<strong style="color:red;">{{ $totalDaycompanycommission }}</strong></span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Monthly Patient</span>
                        <span class="info-box-number">Added-Member-:{{ $thisMonthPatientDetails }}</span>
                        <span class="info-box-number">company commission-Rs-<strong style="color:red;">{{ $totalMonthscompanycommission }}</strong></span>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Yearly Patient</span>
                        <span class="info-box-number">Added-Member-:{{ $thisYearPatientDetails }}</span>
                        <span class="info-box-number">company commission-Rs-<strong style="color:red;">{{ $totalYearcompanycommission }}</strong></span>
                      </div>
                    </div>
                </div>
            </div>
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
                            <h3 class="card-title">Patient List in Doctor </h3>
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
                                                    <th>Paitent ID</th>
                                                    <th>HealthCard Issue No</th>
                                                    <th>Discharge Date</th>
                                                    <th>Total Bill</th>
                                                    <th>Company Commission</th>
                                                    <th>Company Commission Amount</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paitentlist as $paitent)
                                                <tr>
                                                      <td>{{ $paitent['id'] }}</td>
                                                      <td>{{ $paitent['health_card_issue_id_no'] }}</td>
                                                      <td>{{ $paitent['paitent_discharge_date'] }}</td>
                                                      <td style="color:black;"> <strong>Rs.{{ $paitent['paitent_total_bill'] }}</strong></td>
                                                      <td>{{ $paitent['healthcard_company_commission'] }}%</td>
                                                      <td style="color:red;">Rs.{{ $paitent['company_commission_amount'] }}</td>
                                                      <td>
                                                        <ul>

                                                            <li>  <a href="{{ url('/') }}/admin/doc-paitent-disharge-list_details/{{$paitent['id']}}" title="Click to edit this row"><i class="fas fa-list"></i></a></li>
                                                            <li>  <a target="_blank" href="{{ url('/') }}/admin/view-doc-paitent-bill/{{$paitent['id']}}" title="Click to View Inovice this row"><i class="fas fa-file-invoice" style='font-size:20px;color:blue'></i></a></li>
                                                            <li>     <a target="_blank" href="{{ url('/') }}/admin/view-paitent-medicine-slip/{{$paitent['id']}}" title="Click to View Medicine slip this row"><i class="fas fa-file-invoice" style='font-size:20px;color:rgb(39, 211, 48)'></i></a></li>  
                                                            <li> <a class="label label-info" href="{{ url('/') }}/admin_assets/uploads/doctor_slip/{{ $paitent['hospital_discharge_slip']}}" target="_blank" download="">Discharge Slip
                                                            </a></li>
                                                            <li><a target="_blank" href="https://api.whatsapp.com/send?phone={{$paitent['paitent_mobile']}}&text={{ url('/') }}/admin_assets/uploads/doctor_slip/{{ $paitent['hospital_discharge_slip']}}" download="">
                                                                <i class="fab fa-whatsapp-square" style='font-size:20px;color:green;'></i> </a></li>
                                                        </ul>
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
