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
    <!-- /.content-header -->

    <!-- Main content -->
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
                                                    <th>referred_by</th>
                                                    <th>sponsor_id</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tabledata as $cityhead)
                                                <tr>
                                                      <td>{{ $cityhead['id'] }}</td>
                                                      <td>{{ $cityhead['type'] }}</td>
                                                      <td>{{ $cityhead['email'] }}</td>
                                                      <td>{{ $cityhead['name'] }}</td>
                                                      <td>{{ $cityhead['mobile'] }}</td>
                                                      <td>{{ $cityhead['referred_by'] }}</td>
                                                      <td>{{ $cityhead['sponsor_id'] }}</td>




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
