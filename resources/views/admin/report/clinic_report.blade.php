@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clinic Doctor Commission Report</h1>
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
    <hr> 
    {{-- <a href="{{ url('admin/Doctor-List') }}" --}}
    <div class="row mb-2">

        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Paitent</span>
                <span class="info-box-number">Added-Member-:{{ $totalPatientDetails }}</span>
                <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalPatientDetailsadiscountamount }}</span>
                <span class="info-box-number">Clinic Doctor -Profit-Rs-{{ $totalPatientdischargeamount }}</span>
                <span class="info-box-number">company commission-Rs-{{ $totalcompanycommission }}</span>
              </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Today Patient </span>
                <span class="info-box-number">Added-Member-:{{ $todayPatientDetails }}</span>
                <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalDayPatientDetailsadiscountamount }}</span>
                <span class="info-box-number">Clinic Doctor-Profit-Rs-{{ $totalDayPatientdischargeamount }}</span>
                <span class="info-box-number">company commission-Rs-{{ $totalDaycompanycommission }}</span>
              </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Monthly Patient</span>
                <span class="info-box-number">Added-Member-:{{ $thisMonthPatientDetails }}</span>
                <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalMonthsPatientDetailsadiscountamount }}</span>
                <span class="info-box-number">Clinic Doctor-Profit-Rs-{{ $totalMonthsPatientdischargeamount }}</span>
                <span class="info-box-number">company commission-Rs-{{ $totalMonthscompanycommission }}</span>
              </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Yearly Patient</span>
                <span class="info-box-number">Added-Member-:{{ $thisYearPatientDetails }}</span>
                <span class="info-box-number">Discount-Amount-To-Patient-:Rs{{ $totalYearPatientDetailsadiscountamount }}</span>
                <span class="info-box-number">Clinic Doctor-Profit-Rs-{{ $totalYearPatientdischargeamount }}</span>
                <span class="info-box-number">company commission-Rs-{{ $totalYearcompanycommission }}</span>
              </div>
            </div>
        </div>
    </div>
    {{-- </a> --}}
   

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clinic Doctor Commission Report </h3>



                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>Clinic Doctor Name</th>
                                                    <th>Admin Per </th>
                                                    <th>Admin Per Amt</th>
                                                    <th>State Per</th>
                                                    <th>State Per Amt</th>
                                                    <th>District Per</th>
                                                    <th>District Per Amt</th>
                                                    <th>City Per </th>
                                                    <th>City Per Amt</th>
                                                    <th>Date</th>
                                                    <th>Remark</th>


                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($gettbldatawallet_doctor as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->doctor_name }} <br>State:  {{ $value->state_name }} <br> District:{{ $value->district_name }}
                                                        <br> City: {{ $value->city_name }}
                                                    </td>

                                                    <td><strong style="color:red;">{{ $value->admin_per }}%</strong></td>
                                                    <td>{{ $value->admin_per_amount }}</td>
                                                    <td><strong style="color:red;">{{ $value->state_per }}%</strong></td>
                                                    <td>{{ $value->state_per_amount }}</td>
                                                    <td><strong style="color:red;">{{ $value->district_per }}%</strong></td>
                                                    <td>{{ $value->district_per_amount }}</td>
                                                    <td><strong style="color:red;">{{ $value->city_per }}%</strong></td>
                                                    <td>{{ $value->city_per_amount }}</td>
                                                    <td><strong style="color:red;">{{ $value->created_at }}</strong></td>
                                                    <td><strong style="color:red;">{{ $value->remark }}</strong></td>

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
