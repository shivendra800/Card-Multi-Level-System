@extends('admin.index')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Report Health Card User</h1>
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
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Health Card User List </h3>



                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">

                        <h1>Total Number Of Health Card Created By {{ $tabledata->name }}:-<strong style="color:darkred;">{{ $datacount }}</strong></h1>


                        <div class="row">
                            @if($datacount < 10)
                            <strong>No Offered Achieved!!</strong>

                           @endif
                             @if($datacount >=10)
                             <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                               <strong>Gift Offered-:<span>Health Kit</span></strong>
                               -:  <p>You Have Acheived! 10 Member You Have Created And Got 1000 Health Kit</p>
                             @endif

                             @if($datacount >=100)
                             <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                               <strong>Gift Offered-:<span>Health Insurance</span></strong>
                               -:   <p>You Have Acheived! 100 Member You Have Created And Got 8,000 Health Insurance</p>
                             @endif

                             @if($datacount >=1000)
                             <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                             <strong>Gift Offered-:<span>Ambulance</span></strong>
                             -:     <p>You Have Acheived! 1000 Member You Have Created And You Get 50,000 Ambulance</p>

                           @endif

                           @if($datacount >=10000)
                           <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                           <strong>Gift Offered-:<span>Pathology</span></strong>
                           -:    <p>You Have Acheived! 10000 Member You Have Created And You Get 4Lac Pathology</p>

                         @endif

                         @if($datacount >=1000000)
                         <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                         <strong>Gift Offered-:<span>Medical Store</span></strong>
                         -:    <p>You Have Acheived! 1Lac Member You Have Created And You Get 30Lac Medical Store</p>

                            @endif

                            @if($datacount >=10000000)
                            <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                            <strong>Gift Offered-:<span>Hospital</span></strong>
                            -:    <p>You Have Acheived! 10Lac Member You Have Created And You Get 2Cr Hospital</p>

                            @endif

                            @if($datacount >=20000000)
                            <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                            <strong>Gift Offered-:<span>2% Company Profit Share</span></strong>
                            -:   <p>You Have Acheived! 20Lac Member You Have Created</p

                            @endif

                            @if($datacount >=40000000)
                            <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                            <strong>Gift Offered-:<span>3% Company Profit Share</span></strong>
                            -:     <p>You Have Acheived! 40Lac Member You Have Created</p>

                            @endif

                            @if($datacount >=800000000)
                            <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                            <strong>Gift Offered-:<span>4% Company Profit Share</span></strong>
                            -:     <p>You Have Acheived! 80Lac Member You Have Created</p>

                            @endif




                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
