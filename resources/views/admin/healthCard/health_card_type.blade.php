@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Health Card(HCMS)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Health Card </li>
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
                            <h3 class="card-title">List of  Health Card Type </h3>
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
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                {{-- <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                       <div class="btn btn-success"><a href="{{url('/')}}/admin/add-edit-health-card-type"  style="color: white">Add Card Type</a></div>
                                        </div>
                                    </div> --}}
                                   

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Card ID</th>
                                                    <th>Health Card Type</th>
                                                    <th>Card Amount</th>
                                                    <th>GST Percentage</th>
                                                    {{-- <th>Status</th> --}}
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($healthcardtype as $healthcardtype)
                                                <tr>
                                                      <td>{{ $healthcardtype['id'] }}</td>
                                                      <td>{{ $healthcardtype['health_card_type'] }}</td>
                                                      <td>{{ $healthcardtype['health_card_amount'] }}</td>
                                                      <td>{{ $healthcardtype['gst_percentage'] }}%</td>
                                                      {{-- <td>
                                                        <div style="display:inline-flex;">

                                                            @if ($healthcardtype['status'] == '1')
                                                                 <form method="post" id="inactive_form_{{ $healthcardtype['id'] }}"
                                                                     action="{{ url('/') }}/admin/upate-health-card-type-status">
                                                                     {{ csrf_field() }}
                                                                     <input type="hidden" name="status_id"
                                                                         value="{{ $healthcardtype['id'] }}">
                                                                     <input type="hidden" name="status" value="0">
                                                                     <span onclick="InActiveRow('{{ $healthcardtype['id'] }}')" class="badge badge-success" type="button" title="Click to In-Active this row"><i class="fa fa-eye"></i></span>
                                                                 </form>
                                                            @else
                                                                 <form method="post" id="active_form_{{ $healthcardtype['id'] }}"
                                                                     action="{{ url('/') }}/admin/upate-health-card-type-status">
                                                                     {{ csrf_field() }}
                                                                     <input type="hidden" name="status_id"
                                                                         value="{{ $healthcardtype['id'] }}">
                                                                     <input type="hidden" name="status" value="1">
                                                                     <span onclick="ActiveRow('{{ $healthcardtype['id'] }}')" type="button" class="badge badge-warning"><i class="fa fa-eye-slash"></i></span>
                                                                 </form>
                                                            @endif
                                                    </td> --}}

                                                        <td>

                                                            <a title="Edit Healthcardtype Details" href="{{ url('admin/add-edit-health-card-type/'.$healthcardtype['id'] ) }}"<i style="font-size:25px;" class="fa fa-edit"></i></a>
                                                            {{-- <a href="{{ url('/') }}/admin/Delete-health-card-type/{{$healthcardtype['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a> --}}

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
