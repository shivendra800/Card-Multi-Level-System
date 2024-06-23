@extends('front.layouts.layout')

@section('title', 'Hospital List')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Search Results</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Search Results List View</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->

  <!-- ================ Search results page ================ -->
  <div class="search-results-page pt-70 pb-40">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <aside>
            <div class="sidebar-filter-box mb-30">
                <div class="title">Register Your Hospital</div>
                <!-- sidebar search -->
                 <div class="btn-div"> <a href="{{ url('Register-Hospital') }}" class="btn-style-1 btn-sm">Click Here</a>
                    </div>
                <!-- sidebar search end -->
              </div>
            <div class="sidebar-filter-box mb-30">
              <div class="title">Search Here</div>
              <!-- sidebar search -->
              <form class="sidebar-search"  method="post">
                @csrf
                <input placeholder="Search Here" type="search" name="keyword">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
              <!-- sidebar search end -->
            </div>
          
            <!-- sidebar filter box -->
            <div class="sidebar-filter-box mb-30">
              <div class="title">Specialities</div>
              <!-- sidebar categories -->
              <ul class="sidebar-categories">
                @foreach ($getspecialization as $speciList )
                <li><a href="#"><i class="bi bi-arrow-right"></i> {{ $speciList['specialization_name'] }}</a></li>
                @endforeach
              </ul>
              <!-- sidebar categories -->
            </div>
            <!-- sidebar filter box end -->
          </aside>
        </div>
        <div class="col-lg-9">
          <!-- listing box -->
          @foreach ($gethospitaldata as $hospital)
          <div class="listing-box mb-30">
            <div class="row align-items-center">
              <div class="col-lg-4 col-md-4 mb-10">
                <div class="listbox-img"> <img src="{{ asset('/admin_assets/uploads/hospital/'.$hospital->image) }}" alt=""> <a href="#" class="add-favorites-btn"><i class="bi bi-heart-fill"></i></a>
                  <div class="star-div"> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i> <span class="ml-8">3/5 stars</span> </div>
                </div>
              </div>

              <div class="col-lg-8 col-md-8 mb-10">
                <div class="listing-box-des">
                  <div class="location mb-10"><i class="bi bi-geo-alt"></i> {{ $hospital->city_name }},{{ $hospital->district_name }},{{ $hospital->state_name }}</div>
                  <h4><a href="#">{{ $hospital->name }}</a></h4>
                  {{-- <div class="speciality mb-10">{{ $hospital->specialization_name }}</div> --}}
                  <p>{{ $hospital->sort_description}}.</p>
                  <div class="btn-div"> <a href="{{ url('Hospital-Details/'.$hospital->name) }}" class="btn-style-1 btn-sm">View Details</a>
                    <a href="{{ url('Book-Appointent/'.$hospital->name) }}" class="btn-style-2 btn-sm">Book Appointment</a> </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach


          <!-- pagination -->
          <ul class="pagination pagination-box mb-30">
            {{ $gethospitaldata->links() }}
          </ul>
          <!-- pagination end -->
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Search results page end ================ -->
@endsection
