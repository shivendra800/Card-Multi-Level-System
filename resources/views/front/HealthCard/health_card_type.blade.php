@extends('front.layouts.layout')

@section('title', 'Health Card Type')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Health Card Type</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Health Card Type</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- ================ inner page header end ================ -->

  <!-- ================ Health Card Type page ================ -->
  <div class="doctors-page pt-70 pb-40">
    <div class="container">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
        @foreach ($healthcardType as $type )
        <div class="col mb-30">
          <!-- team box -->
          <div class="team-box">
            <div class="team-info"><a href="{{ url('HealthCard-Type-Wise-From/'.$type['slug']) }}"> <span class="designation">{{ $type['health_card_type'] }}</span>
              <h5 class="name">Rs.{{ $type['health_card_amount'] }}</h5></a>
            </div>
            <div class="image"><img src="{{ url('/') }}/front_assets/img/team/11.png" alt=""></div>
        </div>
          <!-- team box end -->
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- ================ Health Card Type page end ================ -->


@endsection
