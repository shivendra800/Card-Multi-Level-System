@extends('admin.index')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1>Health Card Customer</h1>


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
<div class="container-fluid">
    <div class="row">
        <!-- left column -->

        <div class="col-md-12">
            <div class="card card-primary">

                <!-- /.card-header -->
                <!-- form start -->

                <div class="row">

                    <div class="col-md-6">

                        <div class="card-body">
                            <form class="forms-sample" action="{{ url('admin/HCcustomer-Details-Search') }}"  method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="search here ......" class="form-control" name="keyword" required="" >
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>

                                </div>
                            </form>


                        </div>

                    </div>


                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th>Card ID</th>
                                    <th>Health Card Number</th>
                                    <th>Name</th>


                                    <th>Card State Date</th>
                                    <th>Card End Date</th>
                                    <th>Registered Date</th>
                                    <th>Card Activated Date</th>
                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabledata as $createcard)
                                <tr>
                                      <td>{{ $createcard->id }}</td>
                                      <td>{{ $createcard->health_card_issue_id_no }}</td>
                                      <td>{{ $createcard->name }}</td>


                                      <td>{{ $createcard->card_reg_start }}</td>
                                      <td>{{ $createcard->card_reg_end }}</td>
                                      <td>{{ date('Y-m-d ',strtotime($createcard->created_at)); }}</td>
                                      <td>{{  date('Y-m-d ',strtotime($createcard->card_activited_date));}}</td>
                                      <td>

                                        <div style="display:inline-flex;">
                                               @if($createcard->card_reg_end <  now()->format('Y-m-d'))
                                                    <span  class="badge badge-warning"><i class="fa fa-eye-slash"></i></span>

                                                 @else
                                                    <span class="badge badge-success" type="button" title="Click to In-Active this row"><i class="fa fa-eye"></i></span>
                                                  @endif

                                             </td>
                                             <td>
                                               <a title="View Details Details" href="{{ url('admin/HCcustomer-view/'.$createcard->id ) }}"<i style="font-size:25px;" class="fa fa-info-circle"></i></a>
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

@endsection
