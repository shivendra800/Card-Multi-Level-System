@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hospital Management System</h1>
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
                            <h3 class="card-title">List of Hospital </h3>
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
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    @if(Auth::guard('admin')->user()->type == 'admin')
                                    <div class="col-sm-12 col-md-6">
                                       <div class="btn btn-success"><a href="{{url('/')}}/admin/Add-Edit-Hospital"  style="color: white">Add</a></div>
                                        </div>
                                        @endif
                                    </div>



                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Hospital ID</th>
                                                    <th>Name</th>
                                                    <th>Green Card Discount</th>
                                                    <th>Sliver Card Discount</th>
                                                    <th>Gold Card Discount</th>
                                                    @if(Auth::guard('admin')->user()->type == 'admin')
                                                    <th>Company Commission</th>
                                                    <th>Total Commission</th>
                                                    @endif
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($hospitalList as $hospital)
                                                <tr>
                                                      <td>{{ $hospital['id'] }}</td>
                                                      <td>{{ $hospital['name'] }}</td>
                                                      <td>{{ $hospital['green_card_discount'] }}%</td>
                                                      <td>{{ $hospital['silver_card_discount'] }}%</td>
                                                      <td>{{ $hospital['gold_card_discount'] }}%</td>
                                                      @if(Auth::guard('admin')->user()->type == 'admin')
                                                      <td>{{ $hospital['company_discount'] }}%</td>
                                                      <td>Rs.{{ $hospital['total_commission_hicl'] }}</td>
                                                      @endif

                                                      <td>

                                                        <div style="display:inline-flex;">
                                                            @if(Auth::guard('admin')->user()->type == 'admin')
                                                            @if ($hospital['status'] == '1')
                                                                 <form method="post" id="inactive_form_{{ $hospital['id'] }}"
                                                                     action="{{ url('/') }}/admin/upate-hospital-list-status">
                                                                     {{ csrf_field() }}
                                                                     <input type="hidden" name="status_id"
                                                                         value="{{ $hospital['id'] }}">
                                                                     <input type="hidden" name="status" value="0">
                                                                     <span onclick="InActiveRow('{{ $hospital['id'] }}')" class="badge badge-success" type="button" title="Click to In-Active this row"><i class="fa fa-eye"></i></span>
                                                                 </form>
                                                            @else
                                                                 <form method="post" id="active_form_{{ $hospital['id'] }}"
                                                                     action="{{ url('/') }}/admin/upate-hospital-list-status">
                                                                     {{ csrf_field() }}
                                                                     <input type="hidden" name="status_id"
                                                                         value="{{ $hospital['id'] }}">
                                                                     <input type="hidden" name="status" value="1">
                                                                     <span onclick="ActiveRow('{{ $hospital['id'] }}')" type="button" class="badge badge-warning"><i class="fa fa-eye-slash"></i></span>
                                                                 </form>
                                                            @endif
                                                            @endif

                                                         </div>

                                                      </td>

                                                      <td>
                                                        <ul class="table_Action">
                                                            @if(Auth::guard('admin')->user()->type == 'admin')
                                                            <li><a href="{{ url('/') }}/admin/Add-Edit-Hospital/{{$hospital['id']}}" title="Click to edit this row"><i class="fas fa-edit"></i></a></li>
                                                            <li><a href="{{ url('/') }}/admin/Delete-hospital/{{$hospital['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a></li>
                                                            <li><a href="{{ url('/') }}/admin/hospital-wise_paitent-list/{{$hospital['id']}}" title="Click to edit this row"><i class="fas fa-info"></i></a></li>
                                                            <li><a href="{{ url('/') }}/admin/hospital-commisison-reciver/{{$hospital['id']}}" title="Click to edit this row"><span class="badge badge-success"><i class="fas fa-wallet"></i></span></a></li>
                                                            <li> <a href="{{ url('/') }}/admin/Hospital-More-Details/{{$hospital['id']}}" class="btn-style-1 btn-sm"><i style="font-size:24px" class="fa">&#xf0c0;</i></a></li>
                                                            {{-- <li><a href="{{ url('/') }}/admin/add-multi-hospitalimage/{{$hospital['id']}}" title="Click to edit this row"><i class="fa fa-images"></i></a></li> --}}
                                                            @endif
                                                            @if(Auth::guard('admin')->user()->type == 'Health_card_Customer')
                                                            <li><a href="{{ url('/') }}/admin/view-hospital-details/{{$hospital['id']}}" title="Click to edit this row"><i class="fas fa-eye"></i></a></li>
                                                            @endif
                                                        </ul>
                                                    </td>

                                                    </tr>



                                                @endforeach



                                            </tbody>

                                        </table>
                                    </div>
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
