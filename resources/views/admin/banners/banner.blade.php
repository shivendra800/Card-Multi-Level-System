@extends('admin.index')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Banner</h4>
                        <a style="max-width: 150px; float:right; display:inline-block;" href="{{ url('admin/add-banner-image') }}" class="btn btn-block btn-primary">Add Banner</a>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Title
                                        </th>

                                        <th>
                                            Image
                                        </th>
                                    
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner )


                                    <tr>
                                        <td>
                                            {{ $banner['id'] }}
                                        </td>
                                        <td>
                                            {{ $banner['title'] }}
                                        </td>
                                        <td>
                                            <img src=" {{ asset('front_assets/banner_images/'.$banner['image']) }}" style="width:70px; height:70px;" >

                                            <td>

                                                <a href="{{ url('admin/add-banner-image/'.$banner['id'] ) }}" <i style="font-size:25px;" class="fas fa-edit"></i></a>
                                                <a href="{{ url('/') }}/admin/Delete-banner/{{$banner['id']}}"  title="Click to edit this row"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
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
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    {{-- @include('admin.layout.footer')

<!-- partial -->
</div> --}}
    @endsection
