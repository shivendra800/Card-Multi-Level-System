@extends('admin.index')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      @if (Auth::guard('admin')->user()->type == 'admin')
      <div class="row">
          <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Statehead Amount</span>
                    <span class="info-box-number">
                        {{ $total_statehead_amount }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
          </div>   
          <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Districthead Amount</span>
                    <span class="info-box-number">
                        {{ $total_disthead_amount }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
          </div>
          <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total CityHead Amount</span>
                    <span class="info-box-number">
                        {{ $total_cityhead_amount }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
          </div>
           
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text"> Total Assign Card</span>
                  <span class="info-box-number">
                      {{ $total_assigncard }}
                      {{-- <small>%</small> --}}
                  </span>
              </div>
              <!-- /.info-box-content -->
          </div>
        </div>   
        <div class="col-lg-4">
          <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text"> Total Assign Card Amount</span>
                  <span class="info-box-number">
                      {{ $total_assigncardamount }}
                      {{-- <small>%</small> --}}
                  </span>
              </div>
              <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-lg-4">
           
        </div>
         
      </div>
      @endif
      @if (Auth::guard('admin')->user()->type == 'state-head-hcms')
        <div class="row">
            
            <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Districthead Amount</span>
                    <span class="info-box-number">
                        {{ $total_disthead_amount_withuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            </div>
            <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total CityHead Amount</span>
                    <span class="info-box-number">
                        {{ $total_cityhead_amountwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            </div>
            
        </div>
        <div class="row">
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card</span>
                    <span class="info-box-number">
                        {{ $total_assigncardwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>   
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card Amount</span>
                    <span class="info-box-number">
                        {{ $total_assigncardamountwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-lg-4">
            
        </div>
        
        </div>
     @endif

     @if (Auth::guard('admin')->user()->type == 'district-head-hcms')
        <div class="row">
            
            
            <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total CityHead Amount</span>
                    <span class="info-box-number">
                        {{ $total_cityhead_amountwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            </div>
            
        </div>
        <div class="row">
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card</span>
                    <span class="info-box-number">
                        {{ $total_assigncardwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>   
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card Amount</span>
                    <span class="info-box-number">
                        {{ $total_assigncardamountwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-lg-4">
            
        </div>
        
        </div>
     @endif
     @if (Auth::guard('admin')->user()->type == 'city-head-hcms')
        
        <div class="row">
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card</span>
                    <span class="info-box-number">
                        {{ $total_assigncardwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>   
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Total Assign Card Amount</span>
                    <span class="info-box-number">
                        {{ $total_assigncardamountwithuser }}
                        {{-- <small>%</small> --}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-lg-4">
            
        </div>
        
        </div>
     @endif
     @if (Auth::guard('admin')->user()->type == 'Health_card_Customer')
        
     <div class="row">
     <div class="col-lg-4">
         <div class="info-box">
             <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text"> Total Assign Card</span>
                 <span class="info-box-number">
                     {{ $total_assigncardwithuser }}
                     {{-- <small>%</small> --}}
                 </span>
             </div>
             <!-- /.info-box-content -->
         </div>
     </div>   
     <div class="col-lg-4">
         <div class="info-box">
             <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text"> Total Assign Card Amount</span>
                 <span class="info-box-number">
                     {{ $total_assigncardamountwithuser }}
                     {{-- <small>%</small> --}}
                 </span>
             </div>
             <!-- /.info-box-content -->
         </div>
     </div>
     <div class="col-lg-4">
         
     </div>
     
     </div>
  @endif
       
      
     
       
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
    
@endsection
@section('script')
    
@endsection