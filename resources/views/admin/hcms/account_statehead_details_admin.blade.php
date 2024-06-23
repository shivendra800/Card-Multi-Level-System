@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1 class="m-0">State Account</h1>

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
                                <b>Assigned State</b> <a class="float-right">{{ $accountstate['state_name'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Wallet Register Amount</b> <a class="float-right">{{ $regstatewalletamt }}</a>
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
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Transaction History</a></li>
                            <li class="nav-item"><a class="nav-link " href="#timeline" data-toggle="tab">HealthCard Transaction History</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile</a></li> --}}
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <div class="tab-pane active" id="activity">{{ $wallet->links() }}</div>
                                <!-- Post -->
                                <div class="post">
                                    @foreach ($wallet as $waa )
                                    <div class="user-block">
                                        <img style="width: 60px;" src="{{ url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="profile">
                                        <span class="username">
                                            <h5  style="color: red;">Transfer Amount  => Rs.<strong>{{ $waa->state_hcms_trans_amt }}</strong></h5>
                                            <h6 style="color: green;">Total Registation Amount => Rs.<strong>{{ $waa->registration_amt }}</strong></h6>
                                            <h7 style="color: orange;">State Percentage of {{ $waa->select_refer_user_type }} =>{{  $waa->state_percentage }}%</h7>
                                        </span>
                                        <p>
                                            <br> {{$waa->remark}}.<strong>{{ date('Y-m-d h:i:s',strtotime($waa['created_at'])); }}</strong>
                                        </p>
                                    </div>
                                    <!-- /.user-block -->
                                    @endforeach
                                    <!-- /.user-block -->
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane " id="timeline">
                                <div id="timeline">{{ $walletHealthCard->links() }}</div>
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <div class="post">
                                        @foreach ($walletHealthCard as $walletHealth )
                                        <div class="user-block">
                                            <img src="{{url('admin_assets/uploads/adminlogin/dummy-user.png') }}" alt="user image">
                                            <span class="username">
                                               <h5  style="color: red;">Transfer Amount  => Rs.<strong>{{ $walletHealth->state_hcms_trans_amt }}</strong></h5>
                                                <h6 style="color: green;">Total Health Card Amount => Rs.<strong>{{ $walletHealth->health_card_amount }}</strong></h6>
                                                <h7 style="color: orange;">State Percentage Of {{ $walletHealth->select_refer_user_type }} =>{{  $walletHealth->state_percentage }}% </h7><small>Making Health Card</small>
                                                 <p >
                                                    <br> {{$walletHealth->remark}}.<strong style="color: orange;">{{ date('Y-m-d h:i:s',strtotime($walletHealth['created_at'])); }}</strong>
                                                    </p>
                                        </div>
                                        <!-- /.user-block -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">

                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>



                            </div>
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
