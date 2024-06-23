@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Level Income History Commission Report</h1>
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
    <hr> 
    

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Level Income History Commission Report </h3>



                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th>Card ID</th>
                                                <th>introname</th>
                                                <th>Level</th>
                                                <th>Level Wise Percentage</th>
                                                <th>Level Income</th>
                                                <th>Card Amount</th>
                                                <th>Remainng Amount</th>
                    
                    
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                    
                                            @foreach ($tabledata as $value)
                                            <tr>
                                                  <td>{{ $value->id }}</td>
                                                  <td>{{ $value->introname }}</td>
                                                <td><strong style="color:red;">{{ $value->position }}</strong></td>
                                                <td><strong style="color:red;">{{ $value->percentage }}%</strong></td>
                                                <td><strong style="color:red;">{{ $value->rs }}</strong></td>
                                                  <td>{{ $value->package }}</td>
                                                  <td><strong style="color:red;">{{ $value->remainng_amount }}</strong></td>
                    
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
