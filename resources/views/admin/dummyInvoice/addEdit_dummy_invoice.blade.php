@extends('admin.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Dummy Invoice Amount</h1>
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
                    <div class="col-md-3"></div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">{{ $title }}</h4>
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
                                <form class="forms-sample" @if(empty($banner['id'])) action="{{ url('admin/AddEdit-dummy-invoice') }}" @else action="{{ url('admin/AddEdit-dummy-invoice/'.$banner['id']) }}" @endif method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="title">User Member ID</label>
                                        <input type="text" class="form-control" name="member_id" id="member_id"@if(!empty($banner['member_id']))
                                        value="{{ $banner['member_id'] }}"  @else value="{{ old('member_id') }}" @endif
                                        placeholder="Enter member_id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Total Amount</label>
                                        <input type="number" class="form-control" name="total_amount" id="total_amount"@if(!empty($banner['total_amount']))
                                        value="{{ $banner['total_amount'] }}"  @else value="{{ old('total_amount') }}" @endif
                                        placeholder="Enter total_amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Received Amount</label>
                                        <input type="number" class="form-control" name="received_amount" id="received_amount"@if(!empty($banner['received_amount']))
                                        value="{{ $banner['received_amount'] }}"  @else value="{{ old('received_amount') }}" @endif
                                        placeholder="Enter received_amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="alt">Pending Amount</label>
                                        <input type="number" class="form-control" name="pending_amount" id="pending_amount"@if(!empty($banner['pending_amount']))
                                        value="{{ $banner['pending_amount'] }}"  @else value="{{ old('pending_amount') }}" @endif
                                        placeholder="Enter pending_amount" required>
                                    </div>


                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            
        
    </div>
</section>
    @endsection
