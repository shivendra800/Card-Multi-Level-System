@extends('admin.index')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tax and Charges On Withdraw Wallet Amount </h1>
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
@if (Auth::guard('admin')->user()->type == 'admin')
<div class="row mb-2">

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Withdraw Tax</span>
            <span class="info-box-number">Rs-{{ $totalwithdrwatax }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Today Withdraw Tax</span>
            <span class="info-box-number">Rs-{{ $todaywithdrwatax }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Monthly Withdraw Tax</span>
            <span class="info-box-number">Rs-{{ $thisMonthwithdrwatax }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Yearly Withdraw Tax</span>
            <span class="info-box-number">Rs-{{ $thisYearwithdrwatax }}</span>
          </div>
        </div>
    </div>
</div>
<div class="row mb-2">

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Withdraw Admin Charges</span>
            <span class="info-box-number">Rs-{{ $totalwithdrawadmincharges }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Today Withdraw Admin Charges</span>
            <span class="info-box-number">Rs-{{ $todaywithdrawadmincharges }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Monthly Withdraw Admin Charges</span>
            <span class="info-box-number">Rs-{{ $thisMonthwithdrawadmincharges }}</span>
          </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Yearly Withdraw Admin Charges</span>
            <span class="info-box-number">Rs-{{ $thisYearwithdrawadmincharges }}</span>
          </div>
        </div>
    </div>
</div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th>Request User Name</th>
                            <th>Tax Percentage</th>
                            <th>Tax Amount</th>
                            <th>Admin Withdarw Charges Percentage</th>
                            <th>Admin withdraw Charges Amount</th>
                            <th>Created </th>



                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($withdrawChargeshistroy as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->user_name }}</td>
                            <td><strong style="color:black;">{{ $value->tax_percentage }}%</strong></td>
                            <td><strong style="color:red;">Rs.{{ $value->tax_amount }}</strong></td>
                            <td><strong style="color:orange;">{{ $value->admin_charge_perc }}%</strong></td>
                            <td><strong style="color:black;">{{ $value->admin_charge_amount }}</strong></td>
                            <td><strong style="color:black;">{{ $value->created_at }}</strong></td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
