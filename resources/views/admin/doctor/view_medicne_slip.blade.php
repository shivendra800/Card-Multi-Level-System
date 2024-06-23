{{-- @extends('admin.index')

@section('content') --}}
<style>
    body {
        margin-top: 20px;
        color: #484b51;
    }

    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #86bd68 !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #478fcc !important;
    }

    .pb-25,
    .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: rgba(121, 169, 197, .92) !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }

    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #4087d4 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #68a3d5 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }

</style>
<link rel="stylesheet" href="{{ url('/') }}/admin_assets/css/fee/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_assets/css/fee/style.css" />
<script src="{{ url('/') }}/admin_assets/css/fee/jquery.min.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/app.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/html2canvas.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/jspdf.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!------ Include the above in your HEAD tag ---------->


<div class="invoice-4 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div id="invoice">
                                        <div class="invoice overflow-auto">
                                            <div class="page-content container">
                                                <div class="container px-0">
                                                    <div class="row mt-4">
                                                        <div class="col-12 col-lg-12">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="text-center text-150">
                                                                        <img src="{{ asset('/admin_assets/img/healthcard/left-logo.png') }}" width="80" alt="">
                                                                        <span class="text-default-d3">{{ $companyDetails->website_name }}</span><br><br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- .row -->

                                                            <hr class="row brc-default-l1 mx-n1 mb-4" />

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div>
                                                                        <span class="text-sm text-grey-m2 align-middle">Customer Details:</span>
                                                                        <span class="text-600 text-110 text-blue align-middle">{{ $InvoiceData->paitent_name }}</span>
                                                                    </div>
                                                                    <div class="text-grey-m2">
                                                            
                                                                        <div class="my-1">Diseases:<b class="text-600">{{ $medicineType[0]['paitent_caused_disease'] }}</b></div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->

                                                                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                                                    <hr class="d-sm-none" />
                                                                    <div class="text-grey-m2">
                                                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                                            Doctor Name:<strong style="color:#dd4949;">{{$doctorDetails['name']  }}</strong>
                                                                        </div>

                                                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Doctor Clinic Name:</span> {{ $doctorDetails['clininc_name'] }}</div>

                                                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Contact Number:</span>  {{ $doctorDetails['mobile'] }}</div>

                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>

                                                            <div class="mt-4">
                                                                <div class="row text-600 text-white bgc-default-tp1 py-25">
                                                                    <div class="d-none d-sm-block col-1">#</div>
                                                                    <div class="col-9 col-sm-5">Medicine Name</div>
                                                                    <div class="d-none d-sm-block col-4 col-sm-2">Medicine MG</div>
                                                                    <div class="d-none d-sm-block col-sm-2">Dose Days</div>
                                                                   
                                                                </div>
                                                                 @foreach($medicineType as $index=>$Mtype)
                                                                <div class="text-95 text-secondary-d3">
                                                                    <div class="row mb-2 mb-sm-0 py-25">
                                                                        <div class="d-none d-sm-block col-1">{{ $index+1 }}</div>
                                                                        <div class="col-9 col-sm-5">{{$Mtype['pre_medicine']  }}</div>
                                                                        <div class="d-none d-sm-block col-2">{{$Mtype['medicine_mg']  }}</div>
                                                                        <div class="d-none d-sm-block col-2 text-95">{{$Mtype['dose_date']  }}</div>
                                                                 
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                <div class="row border-b-2 brc-default-l2"></div>
                                                                <hr />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-btn-section clearfix d-print-none">
                                <a href="javascript:window.print()" class="btn btn-lg btn-print">
                                    <i class="fa fa-print"></i> Print Invoice
                                </a>
                                <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                                    <i class="fa fa-download"></i> Download Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endsection --}}
