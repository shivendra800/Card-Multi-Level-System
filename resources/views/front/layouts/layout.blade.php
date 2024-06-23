<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> @yield('title')</title>
<meta name="description" content="@yield('meta_description')">
<meta name="keywords" content="@yield('meta_keyword')">
<meta name=" author" content="Hello India Life Care">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('front_assets/img/logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url('front_assets/img/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('front_assets/img/logo.png') }}">

<!-- page title -->
{{-- <title>Hello India Life Care</title> --}}
<!-- favicon -->
<link rel="icon" href="favicon.ico" />
<!-- bootstrap core CSS -->
<link rel="stylesheet" href="{{ url('/') }}/front_assets/css/bootstrap.min.css">
<!-- bootstrap icons -->
<link href="{{ url('/') }}/front_assets/css/bootstrap-icons.css" rel="stylesheet">
<!-- owl carousel -->
<link href="{{ url('/') }}/front_assets/css/owl.carousel.min.css" rel="stylesheet">
<link href="{{ url('/') }}/front_assets/css/owl.theme.default.min.css" rel="stylesheet">
<!-- venobox css -->
<link rel="stylesheet" href="{{ url('/') }}/front_assets/css/venobox.css">
<!-- custom styles for this template -->
<link href="{{ url('/') }}/front_assets/css/custom.css" rel="stylesheet">
<link href="{{ url('/') }}/front_assets/css/responsive.css" rel="stylesheet">
<link href="{{ url('/') }}/front_assets/css/helper.css" rel="stylesheet">
</head>

<body>
<!-- ================ Preloader ================ -->
<div id="preloader">
  <div class="spinner-grow" role="status"> <span class="visually-hidden">Loading...</span> </div>
</div>
<!-- ================ Preloader end ================ -->

      @include('front.layouts.header')
        @yield('content')
        @include('front.layouts.footer')

<!-- ================ Top scroll ================ -->
<a href="#" class="scroll-top"><i class="bi bi-capslock"></i></a>
<!-- ================ Top scroll end ================ -->

<!-- js files -->
<script src="{{ url('/') }}/front_assets/js/jquery-3.6.0.min.js"></script>
<script src="{{ url('/') }}/front_assets/js/bootstrap.bundle.min.js"></script>
<!-- counter js -->
<script src="{{ url('/') }}/front_assets/js/jquery-1.10.2.min.js"></script>
<script src="{{ url('/') }}/front_assets/js/waypoints.min.js"></script>
<script src="{{ url('/') }}/front_assets/js/jquery.counterup.min.js"></script>
<!-- venobox js -->
<script src="{{ url('/') }}/front_assets/js/venobox.min.js"></script>
<!-- owl carousel -->
<script src="{{ url('/') }}/front_assets/js/owl.carousel.min.js"></script>
<!-- sticky js -->
<script src="{{ url('/') }}/front_assets/js/jquery.sticky.js"></script>
<!-- script js -->
<script src="{{ url('/') }}/front_assets/js/custom.js"></script>
@yield('script')
@if (session()->has('message'))
<script type="text/javascript">
    swal("{{ session()->get('message') }}");

</script>
@php(session()->forget('message'))
@endif
  <!--- Date Script -->
<script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#card_reg_end").min = today;
    document.querySelector("#dob").max = today;
    document.querySelector("#card_reg_start").min = today;
    document.querySelector("#card_reg_start").max = today;
    </script>
          <!---End Date Script -->


        <!--- Current Date To Next Year Date -->
       <script>
        function nextYearDate(date1) {
            var date2 = new Date(date1);
            var date3 = date2.setDate(date2.getDate() - 1);
            var date = new Date(date3);
            var day = date.getDate();
            var month = date.getMonth()+1;
            var year = date.getFullYear()+1;
            var newdate = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
            $("#card_reg_end").val(newdate);
        }
                  </script>
                    <!---End Current Date To Next Year Date -->
</body>
</html>
