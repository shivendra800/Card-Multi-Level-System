@extends('front.layouts.layout')

@section('title', 'Doctor List')

@section('content')
<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Speciality Doctors</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Speciality Doctors</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->
  <div class="sidebar-filter-box mb-30">
    <div class="title">Register Your Doctor</div>
    <!-- sidebar search -->
     <div class="btn-div"> <a href="{{ url('Register-Doctor') }}" class="btn-style-1 btn-sm">Click Here</a>
        </div>
    <!-- sidebar search end -->
  </div>

  <!-- ================ Doctors page ================ -->
  <div class="doctors-page pt-70 pb-40">
    <div class="container">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
        @foreach ($getdoctordata as $doctor)
          <div class="col mb-30">
            <!-- team box -->
            <div class="team-box">
              <div class="team-info"><a href="#"> <span class="designation">{{ $doctor->clininc_name }}</span>
                <h5 class="name">{{ $doctor->name }}</h5></a>
                <h6> <a href="{{ url('Book-Doctor-Appointent/'.$doctor->slug) }}">Book-Appointent</a></h6>
              </div>
              <a href="{{ url('Doctor-Details/'.$doctor->slug) }}" class="btn-style-1 btn-sm">
              <div class="image"><img src="{{ asset('/admin_assets/uploads/doctor/'.$doctor->image) }}" alt=""></div>
              </a>
               
              
            </div>
            </div>
            <!-- team box end -->
              @endforeach
          </div>
          
          <ul class="pagination pagination-box mb-30">
            {{ $getdoctordata->links() }}
          </ul>
          <!-- pagination end -->
      
       
      </div>
    </div>
  </div>
  <!-- ================ Doctors page end ================ -->
@endsection
