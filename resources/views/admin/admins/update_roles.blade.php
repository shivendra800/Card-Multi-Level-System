@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>HCMS</h1>


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
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"> {{ $title }}<small> </small></h3>
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
                        <form class="forms-sample"  action="{{ url('admin/update-role/'.$Adminid['id']) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            @if(!empty($adminRoles))
                            @foreach ($adminRoles as $role )
                              @if($role['module']=="state-head-hcms")
                                  @if($role['view_access']==1)
                                    @php $viewStateheadhcms = "checked"; @endphp
                                     @else
                                       @php $viewStateheadhcms = ""; @endphp
                                       @endif

                                       @if($role['edit_access']==1)
                                       @php $editStateheadhcms = "checked"; @endphp
                                        @else
                                          @php $editStateheadhcms = ""; @endphp
                                          @endif

                                          @if($role['full_access']==1)
                                          @php $fullStateheadhcms = "checked"; @endphp
                                           @else
                                             @php $fullStateheadhcms = ""; @endphp
                                             @endif
                              @endif
                              @endforeach
                              @endif
                              <div class="form-group">
                                  <label for="state-head-hcms" class="col-md-3">State Head HCMS</label>
                                  <div class="col-md-9">
                                    <input type="checkbox" name="state-head-hcms[view]" value="1" @if(isset($viewStateheadhcms)) {{ $viewStateheadhcms }} @endif> View Access &nbsp;
                                    <input type="checkbox" name="state-head-hcms[edit]" value="1" @if(isset($editStateheadhcms)) {{ $editStateheadhcms }} @endif> Edit Access &nbsp;
                                    <input type="checkbox" name="state-head-hcms[full]" value="1" @if(isset($fullStateheadhcms)) {{ $fullStateheadhcms }} @endif> Full Access &nbsp;
                                  </div>
                                  </div>
                            @if(!empty($adminRoles))
                            @foreach ($adminRoles as $role )
                              @if($role['module']=="district-head-hcms")
                                  @if($role['view_access']==1)
                                    @php $viewdistrictheadhcms = "checked"; @endphp
                                     @else
                                       @php $viewdistrictheadhcms = ""; @endphp
                                       @endif

                                       @if($role['edit_access']==1)
                                       @php $editdistrictheadhcms = "checked"; @endphp
                                        @else
                                          @php $editdistrictheadhcms = ""; @endphp
                                          @endif

                                          @if($role['full_access']==1)
                                          @php $fulldistrictheadhcms = "checked"; @endphp
                                           @else
                                             @php $fulldistrictheadhcms = ""; @endphp
                                             @endif
                              @endif
                              @endforeach
                              @endif
                              <div class="form-group">
                                  <label for="district-head-hcms" class="col-md-3">District Head HCMS</label>
                                  <div class="col-md-9">
                                    <input type="checkbox" name="district-head-hcms[view]" value="1" @if(isset($viewdistrictheadhcms)) {{ $viewdistrictheadhcms }} @endif> View Access &nbsp;
                                    <input type="checkbox" name="district-head-hcms[edit]" value="1" @if(isset($editdistrictheadhcms)) {{ $editdistrictheadhcms }} @endif> Edit Access &nbsp;
                                    <input type="checkbox" name="district-head-hcms[full]" value="1" @if(isset($fulldistrictheadhcms)) {{ $fulldistrictheadhcms }} @endif> Full Access &nbsp;
                                  </div>
                                  </div>
                                  @if(!empty($adminRoles))
                                  @foreach ($adminRoles as $role )
                                    @if($role['module']=="city-head-hcms")
                                        @if($role['view_access']==1)
                                          @php $viewCityheadhcms = "checked"; @endphp
                                           @else
                                             @php $viewCityheadhcms = ""; @endphp
                                             @endif

                                             @if($role['edit_access']==1)
                                             @php $editCityheadhcms = "checked"; @endphp
                                              @else
                                                @php $editCityheadhcms = ""; @endphp
                                                @endif

                                                @if($role['full_access']==1)
                                                @php $fullCityheadhcms = "checked"; @endphp
                                                 @else
                                                   @php $fullCityheadhcms = ""; @endphp
                                                   @endif
                                    @endif
                                    @endforeach
                                    @endif
                                    <div class="form-group">
                                        <label for="city-head-hcms" class="col-md-3">City Head HCMS</label>
                                        <div class="col-md-9">
                                          <input type="checkbox" name="city-head-hcms[view]" value="1" @if(isset($viewCityheadhcms)) {{ $viewCityheadhcms }} @endif> View Access &nbsp;
                                          <input type="checkbox" name="city-head-hcms[edit]" value="1" @if(isset($editCityheadhcms)) {{ $editCityheadhcms }} @endif> Edit Access &nbsp;
                                          <input type="checkbox" name="city-head-hcms[full]" value="1" @if(isset($fullCityheadhcms)) {{ $fullCityheadhcms }} @endif> Full Access &nbsp;
                                        </div>
                                        </div>
                                        @if(!empty($adminRoles))
                                        @foreach ($adminRoles as $role )
                                          @if($role['module']=="create-health-card")
                                              @if($role['view_access']==1)
                                                @php $viewHealthCardUser = "checked"; @endphp
                                                 @else
                                                   @php $viewHealthCardUser = ""; @endphp
                                                   @endif

                                                   @if($role['edit_access']==1)
                                                   @php $editHealthCardUser = "checked"; @endphp
                                                    @else
                                                      @php $editHealthCardUser = ""; @endphp
                                                      @endif

                                                      @if($role['full_access']==1)
                                                      @php $fullHealthCardUser = "checked"; @endphp
                                                       @else
                                                         @php $fullHealthCardUser = ""; @endphp
                                                         @endif
                                          @endif
                                          @endforeach
                                          @endif
                                          <div class="form-group">
                                              <label for="create-health-card" class="col-md-3">Health Card User</label>
                                              <div class="col-md-9">
                                                <input type="checkbox" name="create-health-card[view]" value="1" @if(isset($viewHealthCardUser)) {{ $viewHealthCardUser }} @endif> View Access &nbsp;
                                                <input type="checkbox" name="create-health-card[edit]" value="1" @if(isset($editHealthCardUser)) {{ $editHealthCardUser }} @endif> Edit Access &nbsp;
                                                <input type="checkbox" name="create-health-card[full]" value="1" @if(isset($fullHealthCardUser)) {{ $fullHealthCardUser }} @endif> Full Access &nbsp;
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
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>


 </script>
@endsection
