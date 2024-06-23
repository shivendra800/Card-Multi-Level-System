@extends('admin.index');

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tree</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Tree</li>
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
                        <h3 class="card-title">Tree</h3>
                       
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    
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