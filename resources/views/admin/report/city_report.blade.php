@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">City Commission Report</h1>
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

    <div class="row mb-2">
  
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Profit::Rs.<strong style="color::red;">{{ $totalCollection }}</strong></span>
                <span class="info-box-number">Health Card Profit-:Rs{{ $totalHealthCardCollection }}</span>
                <span class="info-box-number">Hospital-Profit-Rs-{{ $totalHospitalCollection }}</span>
                <span class="info-box-number">Clinic Doctor Profit-Rs-{{ $totalDoctorCollection }}</span>
                <span class="info-box-number">Pathology Profit-Rs-{{ $totalPathologyCollection }}</span>
              </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">City Commission Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="example1" class="  table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>User Type</th>
                                                <th>City Percentage </th>
                                                <th>City Amount</th>
                                                <th>Assign City</th>
                                                <th>Created At</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0; ?>
                            
                                              @foreach ($stateWalletHelathCardTrans as $index=>$stateWalletTransHis )
                                              <?php $total += $stateWalletTransHis->city_hcms_trans_amt; ?>
                                              <tr>
                                                <td>{{ $index +1 }}</td>
                                               <td>{{ ucfirst($stateWalletTransHis->select_refer_user_type) }}</td>
                                               <td>{{ $stateWalletTransHis->city_percentage}}%</td>
                                               <td>Rs.{{ $stateWalletTransHis->city_hcms_trans_amt}}</td>
                                               <td><button type="button" class="btn btn-waring"><strong style="color: red;">{{ $stateWalletTransHis->state_name}}-{{ $stateWalletTransHis->district_name}}-{{ $stateWalletTransHis->city_name}}</strong></button></td>
                                               <td><button type="button" class="btn btn-success">{{ \Carbon\Carbon::parse($stateWalletTransHis->created_at)->isoFormat('MMM Do YYYY')}}</button></td>
                                               <td>{{ $stateWalletTransHis->remark}}</td>
                                              </tr>
                                             @endforeach
                                             @foreach ($stateWalletHospitalTrans as $index=>$stateWalletHospitalTrans )
                                             <?php $total += $stateWalletHospitalTrans->city_per_amount; ?>
                                             <tr>
                                               <td>{{ $index +1 }}</td>
                                              <td>{{ ucfirst($stateWalletHospitalTrans->user_type) }}<button type="button" class="btn btn-primary">{{ ucfirst($stateWalletHospitalTrans->hospital_name) }}</button></td>
                                              <td>{{ $stateWalletHospitalTrans->city_per}}%</td>
                                              <td>Rs.{{ $stateWalletHospitalTrans->city_per_amount}}</td>
                                              <td><button type="button" class="btn btn-waring"><strong style="color: red;">{{ $stateWalletHospitalTrans->state_name}}-{{ $stateWalletHospitalTrans->district_name}}-{{ $stateWalletHospitalTrans->city_name}}</strong></button></td>
                                              <td><button type="button" class="btn btn-success">{{ \Carbon\Carbon::parse($stateWalletHospitalTrans->created_at)->isoFormat('MMM Do YYYY')}}</button></td>
                                              <td>{{ $stateWalletHospitalTrans->remark}}</td>
                                             </tr>
                                            @endforeach
                                            @foreach ($stateWalletDoctoralTrans as $index=>$stateWalletDoctoralTrans )
                                            <?php $total += $stateWalletDoctoralTrans->city_per_amount; ?>
                                            <tr>
                                              <td>{{ $index +1 }}</td>
                                             <td>{{ ucfirst($stateWalletDoctoralTrans->user_type) }}<button type="button" class="btn btn-info">{{ ucfirst($stateWalletDoctoralTrans->doctor_name) }}</button></td>
                                             <td>{{ $stateWalletDoctoralTrans->city_per}}%</td>
                                             <td>Rs.{{ $stateWalletDoctoralTrans->city_per_amount}}</td>
                                             <td><button type="button" class="btn btn-waring"><strong style="color: red;">{{ $stateWalletDoctoralTrans->state_name}}-{{ $stateWalletDoctoralTrans->district_name}}-{{ $stateWalletDoctoralTrans->city_name}}</strong></button></td>
                                             <td><button type="button" class="btn btn-success">{{ \Carbon\Carbon::parse($stateWalletDoctoralTrans->created_at)->isoFormat('MMM Do YYYY')}}</button></td>
                                             <td>{{ $stateWalletDoctoralTrans->remark}}</td>
                                            </tr>
                                            @endforeach
                                            @foreach ($stateWalletPathologyalTrans as $index=>$stateWalletPathologyalTrans )
                                            <?php $total += $stateWalletPathologyalTrans->city_per_amount; ?>
                                            <tr>
                                              <td>{{ $index +1 }}</td>
                                             <td>{{ ucfirst($stateWalletPathologyalTrans->user_type) }}<button type="button" class="btn btn-info">{{ ucfirst($stateWalletPathologyalTrans->clininc_name) }}</button></td>
                                             <td>{{ $stateWalletPathologyalTrans->city_per}}%</td>
                                             <td>Rs.{{ $stateWalletPathologyalTrans->city_per_amount}}</td>
                                             <td><button type="button" class="btn btn-waring"><strong style="color: red;">{{ $stateWalletPathologyalTrans->state_name}}-{{ $stateWalletPathologyalTrans->district_name}}-{{ $stateWalletPathologyalTrans->city_name}}</strong></button></td>
                                             <td><button type="button" class="btn btn-success">{{ \Carbon\Carbon::parse($stateWalletPathologyalTrans->created_at)->isoFormat('MMM Do YYYY')}}</button></td>
                                             <td>{{ $stateWalletPathologyalTrans->remark}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        {{-- <tfoot>
                                            <th colspan="3">Total</th>
                                            <td>{{$total}}</td>
                                        </tfoot> --}}
                                       
                                    </table>
                                    {{-- <tfoot>
                                      <b><strong style="size:100px; height:100px"><th colspan="3">Total</th></strong></b>  
                                      <button style="color: red;"><td >{{$total}}</td></button>  
                                    </tfoot> --}}
                                   
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
 
