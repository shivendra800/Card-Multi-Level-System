@extends('front.layouts.layout')

@section('title', 'Ambulance List')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Ambulance List</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ambulance List</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->
  <div class="sidebar-filter-box mb-30">
    <div class="title">Register Your Ambulance </div>
    <!-- sidebar search -->
     <div class="btn-div"> <a href="{{ url('Register-Ambulance') }}" class="btn-style-1 btn-sm">Click Here</a>
        </div>
        <div class="btn-div"> <a href="{{ url('Book-Ambulance') }}" class="btn-style-1 btn-sm">Book Ambulance</a>
        </div>
        
    <!-- sidebar search end -->
  </div>
 

  <!-- ================ Doctors page ================ -->
  <div class="doctors-page pt-70 pb-40">
    <div class="container">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
        @foreach ($ambulanceList as $ambList)
          <div class="col mb-30">
            <!-- team box -->
            <div class="team-box">
              <div class="team-info"><a href="#"> <span class="designation">{{ $ambList['owner_name'] }}</span>
                <h5 class="name">{{ $ambList['owner_name'] }}</h5></a>
              </div>
              <a href="#" class="btn-style-1 btn-sm">
              <div class="image"><img src="{{ asset('/admin_assets/uploads/ambulance/'.$ambList['image']) }}" alt="" style="hight: 100px;"></div>
              </a>
               
              
            </div>
            </div>
            <!-- team box end -->
              @endforeach
          </div>
          
      
          <!-- pagination -->
          <ul class="pagination pagination-box mb-30">
            {{ $ambulanceList->links() }}
          </ul>
          <!-- pagination end -->
      
       
      </div>
    </div>
  </div>
  <!-- ================ Doctors page end ================ -->

@endsection
