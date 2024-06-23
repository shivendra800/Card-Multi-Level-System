@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gift Offered User </h1>
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


 



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gift Offered User  </h3>



                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">


                            @if(Auth::guard('admin')->user()->type != 'admin')
                            <h1>Total Number Of Health Card Created By {{ $tabledata->name }}:-<strong style="color:darkred;">{{ $getall_sponserdata }}</strong></h1>
                                <div class="row">

                                    @if($getall_sponserdata < 10)
                                    <strong>No Offered Achieved!!</strong>

                                   @endif

                                     @if($getall_sponserdata >=10)
                                     <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                       <strong>Gift Offered-:<span>Health Kit</span></strong>
                                       -:  <p>You Have Acheived! 10 Member You Have Created And Got 1000 Health Kit</p>
                                     @endif

                                     @if($getall_sponserdata >=100)
                                     <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                       <strong>Gift Offered-:<span>Health Insurance</span></strong>
                                       -:   <p>You Have Acheived! 100 Member You Have Created And Got 8,000 Health Insurance</p>
                                     @endif

                                     @if($getall_sponserdata >=1000)
                                     <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                     <strong>Gift Offered-:<span>Ambulance</span></strong>
                                     -:     <p>You Have Acheived! 1000 Member You Have Created And You Get 50,000 Ambulance</p>

                                   @endif

                                   @if($getall_sponserdata >=10000)
                                   <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                   <strong>Gift Offered-:<span>Pathology</span></strong>
                                   -:    <p>You Have Acheived! 10000 Member You Have Created And You Get 4Lac Pathology</p>

                                 @endif

                                 @if($getall_sponserdata >=1000000)
                                 <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                 <strong>Gift Offered-:<span>Medical Store</span></strong>
                                 -:    <p>You Have Acheived! 1Lac Member You Have Created And You Get 30Lac Medical Store</p>

                                    @endif

                                    @if($getall_sponserdata >=10000000)
                                    <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                    <strong>Gift Offered-:<span>Hospital</span></strong>
                                    -:    <p>You Have Acheived! 10Lac Member You Have Created And You Get 2Cr Hospital</p

                                    @endif

                                    @if($getall_sponserdata >=20000000)
                                    <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                    <strong>Gift Offered-:<span>2% Company Profit Share</span></strong>
                                    -:   <p>You Have Acheived! 20Lac Member You Have Created</p

                                    @endif

                                    @if($getall_sponserdata >=40000000)
                                    <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                    <strong>Gift Offered-:<span>3% Company Profit Share</span></strong>
                                    -:     <p>You Have Acheived! 40Lac Member You Have Created</

                                    @endif

                                    @if($getall_sponserdata >=800000000)
                                    <img src="{{ url('admin_assets/img/pexels-porapak-apichodilok-360624.jpg') }}" style="width: 100px;" alt="">
                                    <strong>Gift Offered-:<span>4% Company Profit Share</span></strong>
                                    -:     <p>You Have Acheived! 80Lac Member You Have Created</

                                    @endif




                                </div>
                            @endif
                            @if(Auth::guard('admin')->user()->type == 'admin')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                            aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>Mobile No</th>
                                                    <th>Action</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($AdminView as $value)
                                                <tr>
                                                    <td>{{ $value['id'] }}</td>
                                                    <td>{{ $value['type'] }}</td>
                                                    <td>{{ $value['email'] }}</td>
                                                    <td>{{ $value['name'] }}</td>
                                                    <td>{{ $value['mobile'] }}</td>
                                                    <td>
                                                        <a title="Gift Offered" href="{{ url('admin/gift-offered-userwise/'.$value['id'] ) }}"<i style="font-size:25px;" class="fa fa-gift"></i></a>
                                                    </td>




                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @endif
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
@section('script')
<script>
    function ActiveRow(id) {
           swal({
                   title: "Are you sure?",
                   text: "You want to change status",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
               .then((willDelete) => {
                   if (willDelete) {
                       $("#active_form_" + id).submit();
                   } else {
                       //swal("Your data is safe!");
                   }
               });

       }

       function InActiveRow(id) {
           swal({
                   title: "Are you sure?",
                   text: "You want to change status",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
               .then((willDelete) => {
                   if (willDelete) {
                       $("#inactive_form_" + id).submit();
                   } else {
                       //swal("Your data is safe!");
                   }
               });

       }
</script>
@endsection
