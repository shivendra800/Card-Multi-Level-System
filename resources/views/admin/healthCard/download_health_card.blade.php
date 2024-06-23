@if($download->health_card_type=="Green Health Discount card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/Backgournd.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 120px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
@if($download->health_card_type=="Silver Health Discount Card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/PLATINUM.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 120px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
@if($download->health_card_type=="Gold  Health Discount card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/GOLD.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 250px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
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
                                                                <img style="width: 340px;" src="{{ asset('/admin_assets/img/healthcard/right-logo.png') }}" class="img-fluid" alt="">
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
                                        </div>
                                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
            <div class="invoice-btn-section clearfix d-print-none">
                {{-- <a href="javascript:window.print()" class="btn btn-lg btn-print">
                    <i class="fa fa-print"></i> Print Invoice
                </a> --}}
                <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                    <i class="fa fa-download"></i> Download Health Card
                </a>
            </div>
        </div>
    </div>
</div>
</div>
{{-- @endsection --}}
