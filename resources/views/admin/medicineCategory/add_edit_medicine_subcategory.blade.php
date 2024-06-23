@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalogue Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"<a href="{{ url('admin/medicine-category') }}">Medicine Category</a></li>
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
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"> {{ $title }}<small> Medicine Category </small></h3>
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
                        <form class="forms-sample" @if(empty($subcategory['id'])) action="{{ url('admin/add-edit-medicine-subcategory') }}" @else action="{{ url('admin/add-edit-medicine-subcategory/'.$subcategory['id']) }}" @endif method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                                <label for="medicine_category_id">Select Medicine Category</label>
                                <select class="form-control text-dark" id="medicine_category_id" name="medicine_category_id">
                                    <option>Select Category</option>
                                    @foreach ($medicineCategoryies as $category )
                                    <option @if(!empty($subcategory['medicine_category_id']==$category['id'])) selected="" @endif value="{{ $category['id']}}" @if(!empty($category['medicine_category_id'])&& $category['medicine_category_id']==$category['id']) selected="" @endif>
                                        {{ $category['medicine_category_name'] }}</option>

                                    @endforeach

                                </select>
                            </div>
                              <div class="form-group">
                                  <label for="subcategory_name">Medicine Subcategory Name</label>
                                  <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"@if(!empty($subcategory['subcategory_name']))
                                  value="{{ $subcategory['subcategory_name'] }}"  @else value="{{ old('subcategory_name') }}" @endif
                                  placeholder="Enter medicine Subcategory Name" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="slug">  Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"@if(!empty($subcategory['slug']))
                                    value="{{ $subcategory['slug'] }}"  @else value="{{ old('slug') }}" @endif
                                    placeholder="Enter medicine Subcategory Name" required>
                                    </div>

                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer" align="center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                          </div>
                        </form>
                      </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>


 </script>
@endsection
