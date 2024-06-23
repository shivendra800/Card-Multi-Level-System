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
                                <b>Wallet Hospital Commission Amount</b> <a class="float-right">{{ $totalWalletHospitalComiAmount }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Wallet Clinic Doctor Commission Amount</b> <a class="float-right">{{ $totalClinicDoctorAmount }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Wallet Pathology Commission Amount</b> <a class="float-right">{{ $totalClinicPathologyAmount }}</a>
                            </li>
                            @if($totalHealthCardAmountgetalldata != null)
                            @if($totalHealthCardAmountgetalldata->type == 'withdrawRequest')
                            <li class="list-group-item">
                                <b>Total Amount</b> <a class="float-right">{{ $totalHealthCardAmount }}</a>
                                <button type="submit" class="btn btn-primary">Withdraw Requested Sent - Rs : {{ $totalHealthCardAmountgetalldata->total_deduction_withdraw }} </button>
                            </li>
                            @else
                            <li class="list-group-item">
                                <b>Total Amount</b> <a class="float-right">{{ $totalHealthCardAmount }}</a>
                                <input type="hidden" id="totalHealthCardAmount" value="{{ $totalHealthCardAmount }}">
                                <form  action="{{ url('/') }}/admin/withdrwawalletamount" method="post" >@csrf
                                    <input type="text" id="witdrarw_amount" name="witdrarw_amount" class="form-control" onkeyup="myFunction();" >
                                    <span id="witdrarw_amount_error" class="text-danger"></span>
                                  Tax   <input type="text" id="total_tax_toadmin"  readonly>
                                   Admin Charge  <input type="text" id="total_admin_charges"  readonly>
                                   Total WithDraw Amount  <input type="text" id="total_deduction_withdraw" name="total_deduction_withdraw" readonly>

                                    <button type="submit" class="btn btn-primary" id="submit">Withdraw</button>
                                </form>
                                <p id="projectIDSelectError"></p>

                            </li>
                            @endif
                            @else
                            <li class="list-group-item">
                                <b>Total Amount</b> <a class="float-right">0</a>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <b>Total Amount</b> <a class="float-right">{{ $totalHealthCardAmount }}</a>
                                <input type="hidden" id="totalHealthCardAmount" value="{{ $totalHealthCardAmount }}">
                                <form  action="{{ url('/') }}/admin/transfer-to-dummyWallet" method="post" >@csrf
                                    <input type="text" id="witdrarw_amount_dummywallet" name="witdrarw_amount_dummywallet"  class="form-control" required onkeyup="TransfertoDummyWallet();" >
                                    <span id="witdrarw_amount_dummywallet_error" class="text-danger"></span>
                                    <button type="submit" class="btn btn-primary" id="submit2">TransferToDummyWallet</button>
                                </form>
                             <strong> <p id="witdrarwamountdummywalletError"></p></strong>

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

 <!-- commission distribute in three level amount from hospital -->
 <center><h2 >Hospital Waise Commission Histroy </h2></center>
 <hr>
  <div class="row">
      <div class="col-sm-12">
          <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
              aria-describedby="example1_info">
              <thead>
                  <tr>

                      <th>Hospital Name</th>
                      <th>City Per</th>
                      <th>City Per Amt</th>
                      <th>Date</th>
                      <th>Remark</th>


                  </tr>
              </thead>
              <tbody>


                  @foreach ($gettbldatawallet_hospital as $value)
                  <tr>
                        <td>{{ $value->hospital_name }}
                      </td>
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
  <center><h2 >Clinic Doctor Waise Commission Histroy </h2></center>
  <hr>
   <div class="row">
       <div class="col-sm-12">
           <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead>
                   <tr>

                       <th>Clinic Doctor Name</th>
                       <th>City Per</th>
                       <th>City Per Amt</th>
                       <th>Date</th>
                       <th>Remark</th>


                   </tr>
               </thead>
               <tbody>


                   @foreach ($gettbldatawallet_doctor as $value)
                   <tr>
                         <td>{{ $value->doctor_name }}
                       </td>
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
   <center><h2 >Pathology Waise Commission Histroy </h2></center>
   <hr>
    <div class="row">
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                aria-describedby="example1_info">
                <thead>
                    <tr>
 
                        <th>Pathology Center Name</th>
                        <th>City Per</th>
                        <th>City Per Amt</th>
                        <th>Date</th>
                        <th>Remark</th>
 
 
                    </tr>
                </thead>
                <tbody>
 
 
                    @foreach ($gettbldatawallet_pathology as $value)
                    <tr>
                          <td>{{ $value->clininc_name }}
                        </td>
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

@endsection
@section('script')
<script>

    function myFunction() {

        $("#submit").prop('disabled', true);
        var witdrarw_amount = $("#witdrarw_amount").val();
        var totalHealthCardAmount = $("#totalHealthCardAmount").val();

        if(witdrarw_amount == "") {
            witdrarw_amount = 0;
        }


        var total_tax = (parseInt(witdrarw_amount) * 5)/100;
        var total_admin_charges = (parseInt(witdrarw_amount) * 5)/100;
        // console.log(total_tax);
        // console.log(total_admin_charges);
        $("#total_tax_toadmin").val(total_tax);
        $("#total_admin_charges").val(total_admin_charges);
        var total_deduction = total_tax + total_admin_charges ;
        console.log("tt",total_deduction);
        var total_deduction_withdraw = parseInt(total_deduction) + parseInt(witdrarw_amount) ;
        console.log("dd",total_deduction_withdraw);
        $("#total_deduction_withdraw").val(total_deduction_withdraw);
        if(totalHealthCardAmount < total_deduction_withdraw)
        {
            $("#projectIDSelectError").html(" Not sufficient balance!").addClass("error-msg");

        }
        else
        {
            $("#submit").prop('disabled', false);
        }

        // console.log(after_discount_total);
        // $("#pending_amount").val(total2);
        // withdrawamount();


   }

   function withdrawamount() {


        var totalHealthCardAmount = $("#totalHealthCardAmount").val();
        var witdrarw_amount = $("#witdrarw_amount").val();



        if(witdrarw_amount == "") {
            witdrarw_amount = 0;
        }


        var total_tax = (parseInt(witdrarw_amount) * 5)/100;
        var total_admin_charges = (parseInt(witdrarw_amount) * 5)/100;
        // console.log(total_tax);
        // console.log(total_admin_charges);
        $("#total_tax_toadmin").val(total_tax);
        $("#total_admin_charges").val(total_admin_charges);
        var total_deduction = total_tax + total_admin_charges ;
        console.log("tt",total_deduction);
        var total_deduction_withdraw = parseInt(total_deduction) + parseInt(witdrarw_amount) ;



        if(totalHealthCardAmount >= total_deduction_withdraw) {

        }


        var total_tax = (parseInt(witdrarw_amount) * 5)/100;
        var total_admin_charges = (parseInt(witdrarw_amount) * 5)/100;
        // console.log(total_tax);
        // console.log(total_admin_charges);
        $("#total_tax_toadmin").val(total_tax);
        $("#total_admin_charges").val(total_admin_charges);
        var total_deduction = total_tax + total_admin_charges ;
        console.log("tt",total_deduction);
        var total_deduction_withdraw = parseInt(total_deduction) + parseInt(witdrarw_amount) ;
        console.log("dd",total_deduction_withdraw);
        $("#total_deduction_withdraw").val(total_deduction_withdraw);

        // console.log(after_discount_total);
        // $("#pending_amount").val(total2);


}

    // Transfer to Dummy WalletSetion
    function TransfertoDummyWallet() {

$("#submit2").prop('disabled', true);
var witdrarw_amount_dummywallet = $("#witdrarw_amount_dummywallet").val();
var totalHealthCardAmount = $("#totalHealthCardAmount").val();

if(witdrarw_amount_dummywallet == "") {
    witdrarw_amount_dummywallet = 0;
}
var withdrawA = parseInt(witdrarw_amount_dummywallet);
$("#witdrarw_amount_dummywallet").val(withdrawA);
if(totalHealthCardAmount < withdrawA)
{
    $("#witdrarwamountdummywalletError").html(" Not sufficient balance!").addClass("error-msg");

}
else
{
    $("#submit2").prop('disabled', false);
}
}
// End Transfer dummy  wallet Section
</script>
@endsection
