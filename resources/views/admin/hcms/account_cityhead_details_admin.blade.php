@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1 class="m-0">City Account</h1>

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
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 80px;" src="{{ url('admin_assets/uploads/adminlogin/'.$accountstate['image']) }}" alt="profile">
                        </div>

                        <h3 class="profile-username text-center">{{ $accountstate['name'] }}</h3>

                        <p class="text-muted text-center">{{ $accountstate['state_name'] }}</p>
                        <p class="text-muted text-center">{{ $accountstate['district_name'] }}</p>
                        <p class="text-muted text-center">{{ $accountstate['city_name'] }}</p>
                        <p class="text-muted text-center">{{ $accountstate['email'] }}</p>
                        <p class="text-muted text-center">{{ $accountstate['mobile'] }}</p>


                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Join Us</b> <a class="float-right">{{ \Carbon\Carbon::parse($accountstate['created_at'])->isoFormat('MMM Do YYYY')}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b> <a class="float-right"> @if ($accountstate['status'] == '1') <span>Active</span> @else <span>InActive</span> @endif </a>
                            </li>
                            <li class="list-group-item">
                                <b>Assigned city</b> <a class="float-right">{{ $accountstate['city_name'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Wallet Healthcard Amount</b> <a class="float-right">{{ $healthCardWalletstate }}</a>
                            </li>
                        </ul>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">HealthCard Transaction History</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active " id="timeline">
                                <div id="timeline">{{ $walletHealthCard->links() }}</div>
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <div class="post">
                                        @foreach ($walletHealthCard as $walletHealth )
                                        <div class="user-block">
                                            <img src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="user image">
                                            <span class="username">
                                                <h5  style="color: brown;">Transfer Amount  =><strong style="color: black;">Rs.{{ $walletHealth->city_hcms_trans_amt }}</strong></h5>
                                                <h6 style="color: brown;">Total Health Card Amount =><strong style="color: black;">Rs.{{ $walletHealth->health_card_amount }}</strong></h6>
                                                <h7 style="color: brown;">City Percentage Of {{ $walletHealth->select_refer_user_type }} =><strong style="color: black;">{{  $walletHealth->city_percentage }}%</strong></h7><small>Making Health Card</small>
                                                 <p >
                                                    <br> {{$walletHealth->remark}}.<strong style="color: orange;">{{ date('Y-m-d h:i:s',strtotime($walletHealth['created_at'])); }}</strong>
                                                    </p>
                                                    <hr>
                                        </div>
                                        <!-- /.user-block -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
