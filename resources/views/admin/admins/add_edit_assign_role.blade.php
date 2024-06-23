@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Assign Role</h1>


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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $title }}</h3>
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
                        <form class="forms-sample" @if(empty($admindata['id'])) action="{{ url('admin/assign-role') }}" @else action="{{ url('admin/assign-role/'.$admindata['id']) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name" @if(!empty($admindata['name'])) value="{{ $admindata['name'] }}" @else value="{{ old('name') }}" @endif placeholder="Enter Full Name" >
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" @if(!empty($admindata['password'])) value="{{ $admindata['password'] }}" @else value="{{ old('password') }}" @endif placeholder="Enter Password" >
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile No</label>
                                            <input type="number" name="mobile"
                                            @if(!empty($admindata['mobile'])) value="{{ $admindata['mobile'] }}" @else value="{{ old('mobile') }}" @endif
                                            onKeyDown="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;"
                                            class="form-control @error('mobile')
                                            is-invalid
                                            @enderror"
                                            placeholder="Enter mobile no">
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" @if(!empty($admindata['email'])) value="{{ $admindata['email'] }}" @else value="{{ old('email') }}" @endif @if($admindata['id']!="") disabled="" @else required="" @endif placeholder="Enter Email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="health_card_amount">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" @if(!empty($admindata['image'])) value="{{ $admindata['image'] }}" @else value="{{ old('image') }}" @endif  >
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Admin Type</label>
                                        <select class="form-control" id="type" name="type" @if($admindata['id']!="") disabled="" @else required="" @endif>
                                            <option value="">Select Admin Type</option>
                                            <option value="Sub-Admin" @if(isset($admindata['type']) && $admindata['type']=="Sub-Admin" ) selected @endif>Sub-Admin</option>
                                            <option value="Accountant" @if(isset($admindata['type']) && $admindata['type']=="Accountant" ) selected @endif>Accountant</option>
                                        </select>
                                    </div>
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

@endsection
@section('script')

@endsection
