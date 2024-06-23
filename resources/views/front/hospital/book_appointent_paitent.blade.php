@extends('front.layouts.layout')

@section('title', 'Book Appointent With Hospital')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Register Your Hospital Here</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Fill All Information</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->
  <div class="medical-facilities-area bg-light pt-70 pb-70">
    <div class="container">
        <div class="section-title mb-40 text-center"></div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Book Appoitment<small> Hospital </small></h3>
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
                            <!-- form start -->
                            <form class="forms-sample"  action="{{ url('Book-Appointent/'.$gethospitaldatasingledata->name) }}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">

                                <div class="col-md-6">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name"> Name</label>
                                                <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Full Name" >
                                            </div>

                                            <div class="form-group">
                                                <label for="mobile"> Mobile No</label>
                                                <input type="number" name="mobile"
                                                 value="{{ old('mobile') }}"
                                                onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                                class="form-control @error('mobile')
                                                is-invalid
                                                @enderror"
                                                placeholder="Enter mobile no">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_appointent_date">Book Appointent Date</label>
                                                <input type="date" class="form-control" name="book_appointent_date" id="book_appointent_date"  value="{{ old('book_appointent_date') }}"  placeholder="Enter Book Appointent Date" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email"> Email</label>
                                            <input type="email" class="form-control" name="email" id="email"  value="{{ old('email') }}"  placeholder="Enter Email" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Select Specialization</label>
                                           <select name="specialization" id="" class="form-control">
                                            <option value="">Select Specialization</option>
                                            @foreach ($gethpositalwsiespec as $value)
                                                     <option value="{{ $value->specialization_id }}">{{ $value->specialization_name }}</option>
                                            @endforeach
                                           </select>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="health_card_no">Health card No</label>
                                            <input type="text" class="form-control" name="health_card_no" id="health_card_no"  value="{{ old('health_card_no') }}"  placeholder="Enter health_card_no" >
                                        </div> --}}


                                    </div>
                                </div>
                                 <!-- /.card-body -->

                            </div>
                            <div class="card-footer" align="center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </div>
                        </form>
                        </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
  </div>

@endsection
