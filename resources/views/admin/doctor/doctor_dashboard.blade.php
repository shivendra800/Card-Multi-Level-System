@extends('admin.index')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
                <h1 class="m-0">Clinic Doctor Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Clinic Doctor   </li>
            </ol>
        </div>
    </div>
    <hr>

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


</div>
@endsection
