@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1>Paitent List</h1>


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
            <!-- left column -->
            @if(Auth::guard('admin')->user()->type == 'Clinic-Doctor')
              <a href="{{ url('admin/doc-paitent-disharge-list') }}" aligin="left" class="btn btn-info">Back</a>
              @endif
              @if(Auth::guard('admin')->user()->type == 'Health_card_Customer')
              <a href="{{ url('admin/ClinicDoctor-Invoice-Customer-wise') }}" aligin="left" class="btn btn-info">Back</a>
              @endif
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">View<small> Discharge Paitent Details </small></h3>
                        <br>
                     <center><h4> <strong style="background-color: black;">{{ $preMedicine[0]['paitent_caused_disease'] }}</strong></h4></center> 
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
                    <!-- form start -->

                          <!-- /.card-header -->
                          <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Pre Medicine Name</th>
                                                    <th>Medicine MG</th>
                                                    <th>Number Of Day To Take Medicine </th>
                                                    <th>Medicine Given Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @foreach ($preMedicine as $index=>$paitent)
                                                <tr>
                                                      <td>{{ $index+1 }}</td>
                                                      <td>{{ $paitent['pre_medicine'] }}</td>
                                                      <td>{{ $paitent['medicine_mg'] }}</td>
                                                      <td>{{ $paitent['dose_date'] }}</td>
                                                      <td>{{ \Carbon\Carbon::parse($paitent['created_at'])->isoFormat('MMM Do YYYY')}}</td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="row">

                            <div class="col-md-6">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="paitent_name">Paitent Name</label>
                                        <input type="text" class="form-control" name="paitent_name" id="paitent_name" @if(!empty($dischargepatientdetails['paitent_name'])) value="{{ $dischargepatientdetails['paitent_name'] }}" @else value="{{ old('paitent_name') }}" @endif placeholder="Enter Full paitent_name" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="paitent_father_name">Father Name</label>
                                        <input type="text" class="form-control" name="paitent_father_name" id="paitent_father_name" @if(!empty($dischargepatientdetails['paitent_father_name'])) value="{{ $dischargepatientdetails['paitent_father_name'] }}" @else value="{{ old('paitent_father_name') }}" @endif placeholder="Enter paitent_father_name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_discount">Patient Discount</label>
                                        <input type="text" class="form-control" name="paitent_discount" id="paitent_discount" @if(!empty($dischargepatientdetails['paitent_discount'])) value="{{ $dischargepatientdetails['paitent_discount'] }}" @else value="{{ old('paitent_discount') }}" @endif placeholder="Enter Blood Group" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_admit_date">Patient Admit Date</label>
                                        <input type="text" class="form-control" name="paitent_admit_date" id="paitent_admit_date" @if(!empty($dischargepatientdetails['paitent_admit_date'])) value="{{ $dischargepatientdetails['paitent_admit_date'] }}" @else value="{{ old('paitent_admit_date') }}" @endif placeholder="Enter Blood Group" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_total_bill">Patient Total Bill</label>
                                        <input type="text" class="form-control" name="paitent_total_bill" onkeyup="discountamunt();" id="paitent_total_bill" @if(!empty($dischargepatientdetails['paitent_total_bill'])) value="{{ $dischargepatientdetails['paitent_total_bill'] }}" @else value="{{ old('paitent_total_bill') }}" @endif placeholder="Enter paitent_total_bill" readonly>
                                    </div>
                                    @if(Auth::guard('admin')->user()->type != 'Health_card_Customer')
                                    <div class="form-group">
                                        <label for="finall_bill">Hospital Amount After Company Commission</label>
                                        <input type="text" class="form-control" name="hospital_amt_atr_cmp_comm" id="hospital_amt_atr_cmp_comm" @if(!empty($dischargepatientdetails['hospital_amt_atr_cmp_comm'])) value="{{ $dischargepatientdetails['hospital_amt_atr_cmp_comm'] }}" @else value="{{ old('hospital_amt_atr_cmp_comm') }}" @endif placeholder="Enter hospital_amt_atr_cmp_comm" readonly>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="after_discount_finall_bill">After Paitent Discount Final Bill</label>
                                        <input type="text" class="form-control" name="after_discount_finall_bill" id="after_discount_finall_bill" @if(!empty($dischargepatientdetails['after_discount_finall_bill'])) value="{{ $dischargepatientdetails['after_discount_finall_bill'] }}" @else value="{{ old('after_discount_finall_bill') }}" @endif placeholder="Enter after_discount_finall_bill" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="paitent_email">Email</label>
                                        <input type="paitent_email" class="form-control" name="paitent_email" id="paitent_email" @if(!empty($dischargepatientdetails['paitent_email'])) value="{{ $dischargepatientdetails['paitent_email'] }}" @else value="{{ old('paitent_email') }}" @endif placeholder="Enter paitent_email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_mobile">Mobile No</label>
                                        <input type="number" name="paitent_mobile" @if(!empty($dischargepatientdetails['paitent_mobile'])) value="{{ $dischargepatientdetails['paitent_mobile'] }}" @else value="{{ old('paitent_mobile') }}" @endif onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;" class="form-control @error('paitent_mobile')
                                        is-invalid
                                        @enderror" placeholder="Enter paitent_mobile no" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="healthcard_company_commission">Company Commission</label>
                                        <input type="text" class="form-control" name="healthcard_company_commission" id="healthcard_company_commission" @if(!empty($dischargepatientdetails['healthcard_company_commission'])) value="{{ $dischargepatientdetails['healthcard_company_commission'] }}" @else value="{{ old('healthcard_company_commission') }}" @endif placeholder="Enter Pan Card Number" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_discharge_date">Patient discharge Date</label>
                                        <input type="text" class="form-control" name="paitent_discharge_date" id="paitent_discharge_date" @if(!empty($dischargepatientdetails['paitent_discharge_date'])) value="{{ $dischargepatientdetails['paitent_discharge_date'] }}" @else value="{{ old('paitent_discharge_date') }}" @endif placeholder="Enter Discharge date" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paitent_discount_amount">Patient Discount Amount</label>
                                        <input type="text" class="form-control" name="paitent_discount_amount" id="paitent_discount_amount" @if(!empty($dischargepatientdetails['paitent_discount_amount'])) value="{{ $dischargepatientdetails['paitent_discount_amount'] }}" @else value="{{ old('paitent_discount_amount') }}" @endif placeholder="Enter paitent_discount_amount" readonly>
                                    </div>
                                    @if(Auth::guard('admin')->user()->type != 'Health_card_Customer')
                                    <div class="form-group">
                                        <label for="company_commission_amount">Company Commission Amount</label>
                                        <input type="text" class="form-control" name="company_commission_amount" id="company_commission_amount" @if(!empty($dischargepatientdetails['company_commission_amount'])) value="{{ $dischargepatientdetails['company_commission_amount'] }}" @else value="{{ old('company_commission_amount') }}" @endif placeholder="Enter company_commission_amount" readonly>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </div>


                </div>







            </div>
            <!-- /.card -->


        </div>
        <!--/.col (left) -->


    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
@section('script')

<script>
    function discountamunt() {


        var paitent_total_bill = $("#paitent_total_bill").val();
        var paitent_discount_amount = $("#paitent_discount_amount").val();
        var company_commission_amount = $("#company_commission_amount").val();
        var paitent_discount = $("#paitent_discount").val();
        var healthcard_company_commission = $("#healthcard_company_commission").val();



        if (paitent_discount_amount == "") {
            paitent_discount_amount = 0;
        }
        if (company_commission_amount == "") {
            company_commission_amount = 0;
        }


        var paitentdiscountamount = (parseFloat(paitent_total_bill) * parseFloat(paitent_discount)) / 100;
        var companyCommission = (parseFloat(paitent_total_bill) * parseFloat(healthcard_company_commission) ) / 100;
        // console.log(total_tax);
        // console.log(total_admin_charges);
        $("#paitent_discount_amount").val(paitentdiscountamount);
        $("#company_commission_amount").val(companyCommission);
        var total_deduction = paitentdiscountamount + companyCommission;

        var after_discount_bill = parseFloat(paitent_total_bill) - parseFloat(paitentdiscountamount);
        $("#after_discount_finall_bill").val(after_discount_bill);
        //  console.log("tft", after_discount_bill);

        var total_bill = parseFloat(paitent_total_bill) - parseFloat(total_deduction);
        $("#hospital_amt_atr_cmp_comm").val(total_bill);
        // console.log("bill", total_bill);


        // if (paitent_total_bill >= total_bill) {

        // }


        // var total_tax = (parseInt(witdrarw_amount) * 5) / 100;
        // var total_admin_charges = (parseInt(witdrarw_amount) * 5) / 100;
        // $("#total_tax_toadmin").val(total_tax);
        // $("#total_admin_charges").val(total_admin_charges);
        // var total_deduction = total_tax + total_admin_charges;
        // console.log("tt", total_deduction);
        // var total_deduction_withdraw = parseInt(total_deduction) + parseInt(witdrarw_amount);
        // console.log("dd", total_deduction_withdraw);
        // $("#total_deduction_withdraw").val(total_deduction_withdraw);
    }

</script>
@endsection
