<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello India -Login to your account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

        <div class="login-logo">
            <a href="{{url('/')}}/admin_assets/index2.html"><b>Login to </b>your account</a>
          </div>
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
      <form action="{{url('/')}}/admin/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email/Username" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">

            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('/')}}/admin_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/admin_assets/js/adminlte.min.js"></script>
</body>
</html>
