@extends('front.layouts.layout')

@section('title', 'Pathology List')

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
  <div class="sidebar-filter-box mb-30">
    <div class="title">Registeration OF Pathology</div>
    <!-- sidebar search -->
     <div class="btn-div"> <a href="{{ url('Register-Pathology') }}" class="btn-style-1 btn-sm">Click Here</a>
        </div>
    <!-- sidebar search end -->
  </div>

  <!-- ================ inner page header end ================ -->

  <!-- ================ Search results page ================ -->
  <div class="search-results-page pt-70 pb-40">
    <div class="container">
      <div class="row">
        {{-- <div class="col-lg-3">
          <aside>
            <div class="sidebar-filter-box mb-30">
                <div class="title">Register Your path</div>
                <!-- sidebar search -->
                 <div class="btn-div"> <a href="{{ url('Register-path') }}" class="btn-style-1 btn-sm">Click Here</a>
                    </div>
                <!-- sidebar search end -->
              </div>
            <div class="sidebar-filter-box mb-30">
              <div class="title">Search Here</div>
              <!-- sidebar search -->
              <form class="sidebar-search">
                <input placeholder="Search Here" type="text">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
              <!-- sidebar search end -->
            </div>
            <!-- sidebar filter box end -->
            <!-- sidebar filter box -->
            <div class="sidebar-filter-box mb-30">
              <div class="title">Find Services</div>
              <!-- sidebar services -->
              <select class="form-select sidebar-find-services">
                <option selected="">Find Services</option>
                <option value="Doctors">Doctors</option>
                <option value="path">path</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Clinic">Clinic</option>
              </select>
              <!-- sidebar services end -->
            </div>
            <!-- sidebar filter box end -->
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
        </div> --}}
        <div class="col-lg-9">
          <!-- listing box -->
          @foreach ($get_pathology_data as $path)
          <div class="listing-box mb-30">
            <div class="row align-items-center">
              <div class="col-lg-4 col-md-4 mb-6">
                <div class="listbox-img"> <img src="{{ asset('/admin_assets/uploads/pathology/'.$path->image) }}" alt=""> <a href="#" class="add-favorites-btn"><i class="bi bi-heart-fill"></i></a>
                  <div class="star-div"> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i> <span class="ml-8">3/5 stars</span> </div>
                </div>
              </div>

              <div class="col-lg-8 col-md-8 mb-10">
                <div class="listing-box-des">
                  <div class="location mb-10"><i class="bi bi-geo-alt"></i> {{ $path->city_name }},{{ $path->district_name }},{{ $path->state_name }}</div>
                  <h4><a href="{{ url('Pathology-Details/'.$path->slug) }}">{{ $path->clininc_name }}</a></h4>
                  <div class="btn-div"> <a href="{{ url('Pathology-Details/'.$path->slug) }}" class="btn-style-1 btn-sm">View Details</a>
                   </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach


          <!-- pagination -->
          <ul class="pagination pagination-box mb-30">
            {{ $get_pathology_data->links() }}
          </ul>
          <!-- pagination end -->
        </div>
      </div>
    </div>
  </div>
  <!-- ================ Search results page end ================ -->
@endsection
