<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Hello India Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/adminlte.min.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/treeview.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('/')}}/admin_assets/img/logo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">

                </li>
                <li class="nav-item d-none d-sm-inline-block">

                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{-- <i class="far fa-comments"></i> --}}
                        {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
                    </a>

                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
<a class="nav-link" data-toggle="dropdown" href="#">
Profile
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

<div class="dropdown-divider"></div>
<a href="javascript:;" class="dropdown-item">

             @if(Auth::guard('admin')->user()->type !='Hospital')
            Member Id- <strong>{{ Auth::guard('admin')->user()->member_id }}</strong>

                <hr>
           <p style="color:brown;">Wallet Amount- <strong style="color:red;">{{ Auth::guard('admin')->user()->dummy_wallet }}</strong> </p>
           @endif
</a>
<div class="dropdown-divider"></div>
<a class="nav-link" href="{{url('/')}}/admin/logout">
                        Logout
                    </a>
</div>
</li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{url('/')}}/admin_assets/img/logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Hello India Life Care</span>
            </a>

            <!-- Sidebar -->
            @include('admin.layouts.sidebar')
    

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('admin.layouts.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{url('/')}}/admin_assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('/')}}/admin_assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{url('/')}}/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{url('/')}}/admin_assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/')}}/admin_assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{url('/')}}/admin_assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{url('/')}}/admin_assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{url('/')}}/admin_assets/plugins/moment/moment.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{url('/')}}/admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{url('/')}}/admin_assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('/')}}/admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('/')}}/admin_assets/js/adminlte.js"></script>
    {{-- <!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/admin_assets/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/')}}/admin_assets/js/pages/dashboard.js"></script>
    <script src="{{ url('/') }}/admin_assets/js/pages/custom.js"></script>
    <script src="{{ url('/') }}/admin_assets/js/treeview.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{url('/')}}/admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/jszip/jszip.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       <!-- sweet alert script-->
       {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
       <!-- End sweet alert script-->
    <script>



$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });




        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    </script>



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

