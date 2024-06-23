@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Health Card User Commission Report</h1>
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
                <span class="info-box-number">Health Card Profit-:Rs{{ $totalHealthCardCollection }}</span>
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
                            <h3 class="card-title">Health Card User Commission Report</h3>
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
                                                <th>HealthCard Percentage </th>
                                                <th>HealthCard Amount</th>
                                                <th>HealthCard City</th>
                                                <th>Created At</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0; ?>
                            
                                              @foreach ($stateWalletHelathCardTrans as $index=>$stateWalletTransHis )
                                              <?php $total += $stateWalletTransHis->healthcard_hcms_trans_amt; ?>
                                              <tr>
                                                <td>{{ $index +1 }}</td>
                                               <td>{{ ucfirst($stateWalletTransHis->select_refer_user_type) }}--<b>{{ ucfirst($stateWalletTransHis->name) }}</b>(<small>{{ ucfirst($stateWalletTransHis->member_id) }}</small>)</td>
                                               <td>{{ $stateWalletTransHis->healthcard_percentage}}%</td>
                                               <td>Rs.{{ $stateWalletTransHis->healthcard_hcms_trans_amt}}</td>
                                               <td><button type="button" class="btn btn-waring"><strong style="color: red;">{{ $stateWalletTransHis->state_name}}-{{ $stateWalletTransHis->district_name}}-{{ $stateWalletTransHis->city_name}}</strong></button></td>
                                               <td><button type="button" class="btn btn-success">{{ \Carbon\Carbon::parse($stateWalletTransHis->created_at)->isoFormat('MMM Do YYYY')}}</button></td>
                                               <td>{{ $stateWalletTransHis->remark}}</td>
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
 
