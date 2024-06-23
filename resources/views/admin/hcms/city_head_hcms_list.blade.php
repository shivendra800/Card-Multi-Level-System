@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">City Head(HCMS)</h1>
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
                            <h3 class="card-title">List of City Head Of Health Card </h3>
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
                                    <div class="col-sm-12 col-md-6">
                                       <div class="btn btn-success"><a href="{{url('/')}}/admin/Add-city-head-hcms" style="color: white">Add</a></div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Mobile No</th>
                                                    <th>Assiged City</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cityheadhcms as $cityhead)
                                                <tr>
                                                      <td>{{ $cityhead['id'] }}</td>
                                                      <td>
                                                        <img style="width:90px;" src="{{ asset('/admin_assets/uploads/cityheadhcms/'.$cityhead['image']) }}" alt="Image here"
                                                        class="cate-image">
                                                      </td>
                                                      <td>{{ $cityhead['name'] }}</td>
                                                      <td>{{ $cityhead['mobile'] }}</td>
                                                      <td>{{ $cityhead['city_name'] }}</td>
                                                      <td>
                                                        <div style="display:inline-flex;">
                                                            @if($AdminsRoleModule['edit_access']==1 || $AdminsRoleModule['full_access']==1)
                                                           @if ($cityhead['status'] == '1')
                                                                <form method="post" id="inactive_form_{{ $cityhead['id'] }}"
                                                                    action="{{ url('/') }}/admin/ChangeStatus-city-head-hcms">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="status_id"
                                                                        value="{{ $cityhead['id'] }}">
                                                                    <input type="hidden" name="status" value="0">
                                                                    <span onclick="InActiveRow('{{ $cityhead['id'] }}')" class="badge badge-success" type="button" title="Click to In-Active this row"><i class="fa fa-eye"></i></span>
                                                                </form>
                                                           @else
                                                                <form method="post" id="active_form_{{ $cityhead['id'] }}"
                                                                    action="{{ url('/') }}/admin/ChangeStatus-city-head-hcms">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="status_id"
                                                                        value="{{ $cityhead['id'] }}">
                                                                    <input type="hidden" name="status" value="1">
                                                                    <span onclick="ActiveRow('{{ $cityhead['id'] }}')" type="button" class="badge badge-warning"><i class="fa fa-eye-slash"></i></span>
                                                                </form>
                                                           @endif
                                                           @endif
                                                        </div>
                                                    </td>
                                                           <td>
                                                                <ul>
                                                                    @if($AdminsRoleModule['edit_access']==1 || $AdminsRoleModule['full_access']==1)
                                                               <li><a href="{{ url('/') }}/admin/Edit-city-head-hcms/{{$cityhead['id']}}" title="Click to edit this row"><i class="fas fa-edit"></i></a></li>
                                                               @endif
                                                               @if($AdminsRoleModule['full_access']==1)
                                                               <li><a href="{{ url('/') }}/admin/Delete-city-head-hcms/{{$cityhead['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a></li>
                                                               <li><a href="{{ url('/') }}/admin/account-cityhead-admin/{{$cityhead['id']}}" title="Click to Account this row"><i class='fas fa-landmark' style='font-size:28px;color:red'></i></a></li>
                                                               @endif
                                                               <li><a href="{{ url('/') }}/admin/view-bill-city/{{$cityhead['id']}}" title="Click to View Inovice this row"><i class="fas fa-file-invoice" style='font-size:28px;color:blue'></i></a></li>
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
