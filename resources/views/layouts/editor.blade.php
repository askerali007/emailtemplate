<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{{ URL::asset('bootstrap/css/bootstrap.min.css')}}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{{ URL::asset('css/AdminLTE.min.css')}}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{{ URL::asset('css/skins/_all-skins.min.css')}}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="{{{ URL::asset('bootstrap/css/bootstrap-colorpicker.min.css')}}}">
  <link rel="stylesheet" href="{{{ URL::asset('bootstrap/css/bootstrap-slider.min.css')}}}">
  <link rel="stylesheet" href="{{{ URL::asset('css/jquery.wysiwyg.css')}}}" media="screen">
  <link rel="stylesheet" href="{{{ URL::asset('css/cropper.min.css')}}}">
  <link rel="stylesheet" href="{{{ URL::asset('css/editor-style.css')}}}">
  <link rel="stylesheet" href="{{{ URL::asset('css/cms-style.css')}}}">
  <!-- jQuery 2.2.0 -->
  <script src="{{{ URL::asset('plugins/jQuery/jQuery-2.2.0.min.js')}}}"></script>
  <script src="{{{ URL::asset('plugins/jQuery/jquery-migrate-1.4.0.js')}}}"></script>
  <script src="{{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js')}}}"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  @include('partials.header')
  <!-- Full Width Column -->
  <div class="content-wrapper">    
    @yield('content')
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  @include('partials.footer')
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.6 -->
<script src="{{{ URL::asset('bootstrap/js/bootstrap.min.js')}}}"></script>
<!-- SlimScroll -->
<script src="{{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}}"></script>
<!-- FastClick -->
<script src="{{{ URL::asset('plugins/fastclick/fastclick.js')}}}"></script>
<!-- AdminLTE App -->
<script src="{{{ URL::asset('js/app.min.js')}}}"></script>
<script src="{{{ URL::asset('bootstrap/js/bootstrap-colorpicker.min.js')}}}"></script>

<script src="{{{ URL::asset('js/jquery.wysiwyg.js')}}}" type="text/javascript"></script>
<script src="{{{ URL::asset('js/jquery.jeditable.js')}}}" type="text/javascript"></script> 
<script src="{{{ URL::asset('js/jquery.jeditable.wysiwyg.js')}}}" type="text/javascript"></script>
<script src="{{{ URL::asset('js/cropper.min.js')}}}"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{{{ URL::asset('js/demo.js')}}}"></script>-->
<script src="{{{ URL::asset('js/editor-app.js')}}}"></script>
</body>
</html>
