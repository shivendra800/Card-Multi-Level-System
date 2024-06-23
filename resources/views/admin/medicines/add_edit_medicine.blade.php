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
                        <li class="breadcrumb-item active"<a href="{{ url('admin/medicine') }}">Medicine </a></li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"> {{ $title }}<small> Medicine</small></h3>
                          @if(Session::has('success_message'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success:</strong> {{Session::get('success_message')}}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          @endif
                          
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="forms-sample" @if(empty($medicine['id'])) action="{{ url('admin/add-edit-medicine') }}" @else action="{{ url('admin/add-edit-medicine/'.$medicine['id']) }}" @endif method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="medicine_name">Medicine Name</label>
                                    <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" name="medicine_name" id="medicine_name"@if(!empty($medicine['medicine_name']))
                                    value="{{ $medicine['medicine_name'] }}"  @else value="{{ old('medicine_name') }}" @endif
                                    placeholder="Enter medicine type Name" >
                                    @error('medicine_name')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                               </div>
                               <div class="form-group col-md-3">
                                  <label for="m_category_id">Category Name</label>
                                  <select name="m_category_id" id="m_category_id"
                                  class="form-control  @error('m_category_id') is-invalid @enderror"
                                  value="{{ old('m_category_id') }}" id="m_category_id" onchange="getsubcategory();">
                                  <option value="">Select Category</option>
                                  @foreach ($category as $value)
                                      @if ($medicine != null)
                                          @if ($value->id == $medicine['m_category_id'])
                                              <option selected value="{{ $value->id }}">
                                                  {{ $value->medicine_category_name }}
                                              </option>
                                          @else
                                              <option value="{{ $value->id }}">{{ $value->medicine_category_name }}
                                              </option>
                                          @endif
                                      @else
                                          @if ($value->id == old('m_category_id'))
                                              <option selected value="{{ $value->id }}">
                                                  {{ $value->medicine_category_name }}
                                              </option>
                                          @else
                                              <option value="{{ $value->id }}">{{ $value->medicine_category_name }}
                                          @endif
                                      @endif
                                  @endforeach

                              </select>
                                @error('m_category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                             </div>
                             <div class="form-group col-md-3">
                                <label for="medicine_name">Sub Category Name</label>
                                <select class="form-control text-dark @error('m_subcategory_id') is-invalid @enderror" id="m_subcategory_id" name="m_subcategory_id" required>
                                    <option>Select </option>
                                </select>
                                
                                @error('m_subcategory_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Brand  Name</label>
                            <select name="brand_id" id="brand_id" class="form-control  @error('brand_id') is-invalid @enderror"
                               value="{{ old('brand_id') }}" id="brand_id" >
                            <option value="">Select Brand Name</option>
                            @foreach ($brands as $value)
                                @if ($medicine != null)
                                    @if ($value->id == $medicine['brand_id'])
                                        <option selected value="{{ $value->id }}">
                                            {{ $value->brand_name }}
                                        </option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->brand_name }}
                                        </option>
                                    @endif
                                @else
                                    @if ($value->id == old('brand_id'))
                                        <option selected value="{{ $value->id }}">
                                            {{ $value->brand_name }}
                                        </option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->brand_name }}
                                    @endif
                                @endif
                                @endforeach
                            </select>
                                 
                            @error('brand_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Medicine Type  Name</label>
                            <select name="medicine_type_id" id="medicine_type_id" class="form-control  @error('medicine_type_id') is-invalid @enderror"
                            value="{{ old('medicine_type_id') }}" id="medicine_type_id" >
                            <option value="">Select</option>
                            @foreach ($medicinetype as $value)
                                @if ($medicine != null)
                                    @if ($value->id == $medicine['medicine_type_id'])
                                        <option selected value="{{ $value->id }}">
                                            {{ $value->medicine_type_name }}
                                        </option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->medicine_type_name }}
                                        </option>
                                    @endif
                                @else
                                    @if ($value->id == old('medicine_type_id'))
                                        <option selected value="{{ $value->id }}">
                                            {{ $value->medicine_type_name }}
                                        </option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->medicine_type_name }}
                                    @endif
                                @endif
                                @endforeach
                            </select>
                                
                            @error('medicine_type_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Slug Name</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug"@if(!empty($medicine['slug']))
                                value="{{ $medicine['slug'] }}"  @else value="{{ old('slug') }}" @endif
                                placeholder="Enter slug " >
                            @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
  
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Small Description</label>
                                <textarea type="text" class="form-control @error('small_description') is-invalid @enderror" name="small_description" id="small_description"
                                placeholder="Enter small_description " >@if(!empty($medicine['small_description']))
                                {{ $medicine['small_description'] }}  @else {{ old('small_description') }} @endif</textarea>
                            @error('small_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name"> Description</label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                placeholder="Enter description " >@if(!empty($medicine['description']))
                                {{ $medicine['description'] }}  @else {{ old('description') }} @endif</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Cost Price</label>
                                <input type="number" class="form-control @error('cost_price') is-invalid @enderror" name="cost_price" id="cost_price"@if(!empty($medicine['cost_price']))
                                value="{{ $medicine['cost_price'] }}"  @else value="{{ old('cost_price') }}" @endif
                                placeholder="Enter cost_price " >
                            @error('cost_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Original Price</label>
                                <input type="number" class="form-control @error('original_price') is-invalid @enderror" name="original_price" id="original_price"@if(!empty($medicine['original_price']))
                                value="{{ $medicine['original_price'] }}"  @else value="{{ old('original_price') }}" @endif
                                placeholder="Enter original_price " >
                            @error('original_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Selling Price</label>
                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" id="selling_price"@if(!empty($medicine['selling_price']))
                                value="{{ $medicine['selling_price'] }}"  @else value="{{ old('selling_price') }}" @endif
                                placeholder="Enter selling_price " >
                            @error('selling_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image"@if(!empty($medicine['image']))
                                value="{{ $medicine['image'] }}"  @else value="{{ old('image') }}" @endif
                                placeholder="Enter image " >
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">QTY</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty"@if(!empty($medicine['qty']))
                                value="{{ $medicine['qty'] }}"  @else value="{{ old('qty') }}" @endif
                                placeholder="Enter qty " >
                            @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Original QTY</label>
                                <input type="number" class="form-control @error('original_qty') is-invalid @enderror" name="original_qty" id="original_qty"@if(!empty($medicine['original_qty']))
                                value="{{ $medicine['original_qty'] }}"  @else value="{{ old('original_qty') }}" @endif
                                placeholder="Enter original_qty " >
                            @error('original_qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Tax</label>
                                <input type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" id="tax"@if(!empty($medicine['tax']))
                                value="{{ $medicine['tax'] }}"  @else value="{{ old('tax') }}" @endif
                                placeholder="Enter tax " >
                            @error('tax')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Deals</label>
                                <input type="number" class="form-control @error('deals') is-invalid @enderror" name="deals" id="deals"@if(!empty($medicine['deals']))
                                value="{{ $medicine['deals'] }}"  @else value="{{ old('deals') }}" @endif
                                placeholder="Enter deals " >
                            @error('deals')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Meta Title</label>
                                <input type="number" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title"@if(!empty($medicine['meta_title']))
                                value="{{ $medicine['meta_title'] }}"  @else value="{{ old('meta_title') }}" @endif
                                placeholder="Enter meta_title " >
                            @error('meta_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Meta Description</label>
                                <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description"@if(!empty($medicine['meta_description']))
                                value="{{ $medicine['meta_description'] }}"  @else value="{{ old('meta_description') }}" @endif
                                placeholder="Enter meta_description " >
                            @error('meta_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Meta Keywords</label>
                                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords"@if(!empty($medicine['meta_keywords']))
                                value="{{ $medicine['meta_keywords'] }}"  @else value="{{ old('meta_keywords') }}" @endif
                                placeholder="Enter meta_keywords " >
                            @error('meta_keywords')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           <div class="form-group col-md-3">
                            <label for="medicine_name">Unit</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" id="unit"@if(!empty($medicine['unit']))
                                value="{{ $medicine['unit'] }}"  @else value="{{ old('unit') }}" @endif
                                placeholder="Enter unit as 100ml " >
                            @error('unit')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           
  
  

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
               
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>
     $(document).ready(function() {
        getsubcategory();
       
     });
  function getsubcategory() {
           var m_category_id = $("#m_category_id").val();
           // alert(state_id);s
           @if ($medicine != null)
                var m_subcategory_id="{{ $medicine['m_subcategory_id'] }}";
            @else
                var m_subcategory_id="{{ old('m_subcategory_id') }}";
            @endif

           $.ajax({
               url: "{{ url('/') }}/admin/getsubcategory/" + m_category_id,
               dataType: "json",
               success: function(data) {
                   // console.log("data", data);
                   var option = "";
                   for (var i = 0; i < data.data.length; i++) {
                       if (m_subcategory_id == data.data[i].id) {
                           option += "<option selected value=" + data.data[i].id + ">" + data.data[
                                   i]
                               .subcategory_name + "</option>";
                       } else {
                           option += "<option value=" + data.data[i].id + ">" + data.data[i]
                               .subcategory_name + "</option>";
                       }
                   }
                   $("#m_subcategory_id").html(option);
                   

               }
           });
       }

 </script>
@endsection
