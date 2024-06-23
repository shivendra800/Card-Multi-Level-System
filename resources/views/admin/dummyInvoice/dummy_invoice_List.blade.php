@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dummy Invoice List</h1>
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
        
                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Dummy Invoice List</h4>
                                <a style="max-width: 150px; float:right; display:inline-block;" href="{{ url('admin/AddEdit-dummy-invoice') }}" class="btn btn-block btn-primary">Add Dummy Invoice Amount</a>
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
                                <div class="table-responsive pt-3">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> User Name </th>
                                                <th> User Type </th>
                                                <th> Total Amount </th>
                                                <th> Received Amount </th>
                                                <th> Pending Amount </th>
                                                <th>Inovice Created Date</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dummyInvoiceData as $dummyinvoicedata )


                                            <tr>
                                                <td> {{ $dummyinvoicedata->id }} </td>
                                                <td> {{ $dummyinvoicedata->user_name }} </td>
                                                <td> {{ $dummyinvoicedata->user_name }} </td>
                                                <td> {{ $dummyinvoicedata->total_amount }} </td>
                                                <td> {{ $dummyinvoicedata->received_amount }} </td>
                                                <td> {{ $dummyinvoicedata->pending_amount }} </td>
                                                <td> {{ \Carbon\Carbon::parse($dummyinvoicedata->created_at)->isoFormat('MMM Do YYYY')}} </td>
                                                <td>
                                                    <a target="_blank" href="{{ url('/') }}/admin/view-dummy-invoice/{{$dummyinvoicedata->id}}" title="Click to View Inovice"><i style="height:20px;" class="fas fa-file-invoice"></i></a>
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
    </div>
</section>
    
    
    @endsection
