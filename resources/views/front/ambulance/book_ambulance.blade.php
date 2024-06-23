@extends('front.layouts.layout')

@section('title', 'Book Ambulance')

@section('content')

<!-- ================ inner page header ================ -->
<div class="inner-page-title inner-page-header-bg">
    <div class="container">
      <h1>Ambulance List</h1>
      <div class="breadcrumb-box">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Book Ambulance</li>
        </ol>
      </div>
    </div>
  </div>
 
 

  <!-- ================ Doctors page ================ -->
  <div class="doctors-page pt-70 pb-40">
    <div class="container">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Book<small> Ambulance </small></h3>
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
                    <form class="forms-sample"  action="{{ url('Register-Ambulance') }}" id="distance_form"  method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row">

                        <div class="col-md-12">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="pickup_point">Pickup Location</label>
                                        <input type="text" class="form-control" name="pickup_point" id="from_places"  value="{{ old('pickup_point') }}"  placeholder="Enter Pickup Location" required="" >
                                        <input type="hidden" class="form-control" name="origin" id="from_places"  value="{{ old('pickup_point') }}"  placeholder="Enter Pickup Location"  >

                                    </div>
                                    <div class="form-group">
                                        <label for="drop_point">Drop Location</label>
                                        <input type="text" class="form-control" name="drop_point" id="to_places" value="{{ old('drop_point') }}"  placeholder="Enter Drop Location" required="">
                                        <input type="hidden" class="form-control" name="destination" id="to_places" value="{{ old('drop_point') }}"  placeholder="Enter Drop Location" >
                                    </div> 
                                </div>
                        </div>
                    </div>
                    <div class="card-footer" align="center">
                        <button type="submit" class="btn btn-primary" value="calculate">calculate</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>

                </div>







                </div>
                <!-- /.card -->


            </div>
            <!--/.col (left) -->


        </div>
       
       
       
     
    </div>
  </div>
  <!-- ================ Doctors page end ================ -->

@endsection
<script>
    $(function () {
    // add input listeners
    google.maps.event.addDomListener(window, "load", function () {
         var from places = new google.maps.places. Autocomplete(
    document.getElementById("from_places")
    );
    var to places = new google.maps.places. Autocomplete( 
        document.getElementById("to_places")
    );
    google.maps.event.addListener(
    from_places,
    "place_changed",
    function () {
    var from address =from_place.getPlace();
    var from_address = from_place.formatted_address;
    $("#origin").val(from_address);
    } );
    google.maps.event.addListener(
to_places,
"place_changed",
function () {
var to place = to_places.getPlace();
var to_address = to_place.formatted_address; $("#destination").val(to_address);
}
);
});
// calculate distance
function calculateDistance() {
     var origin = $("#origin").val();
var destination = $("#destination").val();
var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
    {

 origins: [origin],
 destinations: [destination],
 travelMode: google.maps.TravelMode.DRIVING,
  unitSystem: google.maps.UnitSystem. IMPERIAL, // miles and feet. 
 // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters 
 avoidHighways: false,
  avoidTolls: false,
},
callback
);
}
//get distance results
function callback (response, status) {
if (status = google.maps.DistanceMatrixStatus.OK) { $("#result").html(err);
} else {
var origin response.originAddresses[0];
console.log(origin);
var destination response.destinationAddresses[0];
console.log(destination);
if (response.rows[0].elements[0].status === "ZERO_RESULTS"){

$("#result").html(
"Better get on a plane. There are no roads between " +
origin +
" and " +
destination

);
} else {
var distance = response.rows[0].elements[0].distance;
console.log(distance);
var duration = response.rows[0].elements[0].duration;
console.log(duration);
console.log(response.rows[0].elements[0].distance);
 var distance_in_kilo distance.value / 1000; // the kilom
var distance_in_mile = distance.value / 1609.34; // the mile
console.log(distance_in_kilo);
console.log(distance_in_mile);
var duration_text = duration.text;
var duration_value duration.value;
$("#mile").html(
'Distance in Miles: ${distance_in_mile.toFixed(2)}'
);
$("#kilo").html(
'Distance in Kilometre: ${}distance_in_kilo.toFixed(2)}'
};
$("#text").html('Distance in Text: ${duration_text}');
 $("#minute").html('Distance in Minutes: ${duration_value}');
  $("#from").html('Distance From: ${origin}');
$("#to").text('Distance to: ${destination}');
}
}
}
// print results on submit the form
 $("#distance_form").submit(function (e) { 
    e.preventDefault();
     calculateDistance();
});
});
</script>
