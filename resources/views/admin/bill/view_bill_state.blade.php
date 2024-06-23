{{-- @extends('admin.index')

@section('content') --}}
    <style>
        body {
            margin-top: 20px;
            background-color: #f7f7ff;
        }

        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

    </style>
<link rel="stylesheet" href="{{ url('/') }}/admin_assets/css/fee/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_assets/css/fee/style.css"/>
<script src="{{ url('/') }}/admin_assets/css/fee/jquery.min.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/app.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/html2canvas.js"></script>
<script src="{{ url('/') }}/admin_assets/css/fee/jspdf.min.js"></script>
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
                                            <div style="min-width: 600px">
                                                <section id="card">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="card-logo p-4">
                                                                <div class="left-logo me-4">
                                                                    <img src="{{ asset('/admin_assets/img/healthcard/left-logo.png') }}" class="img-fluid" alt="">
                                                                </div>
                                                                <div class="right-logo ms-4">
                                                                    <img src="{{ asset('/admin_assets/img/healthcard/right-logo.png') }}" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row card_mideal_parth">
                                                            <div class="col-md-4 candidate-img-side">
                                                                <div class="candidate-image ">
                                                                    <div class="img-box">
                                                                        <img src="{{ asset('/admin_assets/uploads/healthcardcustomer/'.$download->image) }}"  alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 candidate-details-side ps-4">
                                                                <div class="candidate-detail">
                                                                    <p><b>Name :</b><span>{{ $download->name }}</span></p>
                                                                    <p><b>Card Type :</b><span></span>{{ $download->health_card_type }}</p>
                                                                    <p><b>DOD :</b><span>{{ $download->dob }}</span></p>
                                                                    <p><b>Card No :</b><span>{{ $download->member_id }}</span></p>
                                                                    <p><b>Contact NO :</b><span>{{ $download->mobile }}</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-issue row">
                                                             <span class="col-md-6">
                                                                <p style="text-align: end;"><b> Date of Issued :</b>{{ date('d-m-Y ',strtotime($download->card_reg_start)); }} </p>
                                                            </span>
                                                            <span class="col-md-6">
                                                                <p style="text-align: start;"><b> Date of Expiry :</b>{{ date('d-m-Y ',strtotime($download->card_reg_end)); }} </p>
                                                            </span>
                                                           
                                                        </div>
                                                        <div class="card-footer pb-3">
                                                            <h1>Health id no: {{ $download->health_card_issue_id_no }}</h1>
                                                        </div>
                                                    </div>
                                                </section>
                                                <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                                            </div>
                                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                            <div></div>
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
