@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pathtest</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}/admin/dashboard">Home</a></li>
                        {{-- <li class="breadcrumb-item active"<a href="{{ url('admin/Pathology-Paitent-list') }}">Pathtest</a></li> --}}
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
                          <h3 class="card-title"> <small> Pathology-Paitent-Type </small></h3>
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
                        <form class="forms-sample"   action="{{ url('admin/add-path-paitent-test/'.$paitentlist['id']) }}" method="post" enctype="multipart/form-data">
                          @csrf
                         
                          <div class="card-body">
                            <div class="form-group">
                                <label for="name">Pathology Test</label>
                                <select name="pathology_test_id" id="pathology_test_id" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($pathtestype as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach    
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Pathology Test</label>
                                    <input type="number" class="form-control" name="test_rate" id="test_charge">
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


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                       
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                   <th>Id</th>
                                                    <th>Test Type</th>
                                                    <th>Test Charges</th>
                                                    <th>Action</th>
                                                    
                                                   
                                                  

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($PaitentTypeTest as $type)
                                                <tr>
                                                      <td>{{ $type['id'] }}</td>
                                                    
                                                      <td>{{ $type['test_name'] }}</td>
                                                      <td>{{ $type['test_rate'] }}</td>
                                                      <td>
                                                       <a href="{{ url('/') }}/admin/Delete-Paitent-Test-Type/{{$type['id']}}" title="Click to Delete this row"><i class="fa fa-trash"></i></a>
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
$( document ).ready(function() {
$("#pathology_test_id").on("change",function(){
     var pathology_test_id =   this.options[this.selectedIndex].value;
    //  alert('kj');
      
      $.ajax({
       
       url: "{{ url('/') }}/admin/testtype_wise_amount/" + pathology_test_id,
       dataType: "json",
        cache:false,
        success: function(data){  
            console.log(data);
        console.log(data.data.test_charge);
        var test_charge = document.getElementById("test_charge").value = data.data.test_charge;
         }
      });
    });

});

   


 </script>
@endsection
