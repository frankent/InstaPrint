<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo asset('bootstrap/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo asset('dist/css/AdminLTE.min.css'); ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo asset('dist/css/skins/_all-skins.min.css'); ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo asset('plugins/iCheck/flat/blue.css'); ?>">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo asset('plugins/morris/morris.css'); ?>">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo asset('plugins/datepicker/datepicker3.css'); ?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo asset('plugins/daterangepicker/daterangepicker.css'); ?>">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

	  <header class="main-header">
		<!-- Logo -->
		<a href="index2.html" class="logo">
		  <!-- mini logo for sidebar mini 50x50 pixels -->
		  <span class="logo-mini"><b>A</b>LT</span>
		  <!-- logo for regular state and mobile devices -->
		  <span class="logo-lg"><b>Instaprint</b></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
		  <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>

		  <div class="navbar-custom-menu">

		  </div>

		</nav>
	  </header>
	  <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

		  <!-- sidebar menu: : style can be found in sidebar.less -->
		  <ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li><a href="<?php echo action('AdminController@getIndex') ?>"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
			<li><a href="<?php echo action('AdminController@getHashtag') ?>"><i class="fa fa-book"></i> <span>Hash Tags</span></a></li>
			<li><a href="<?php echo action('AdminController@getToken') ?>"><i class="fa fa-book"></i> <span>Token</span></a></li>
		  </ul>

		</section>
		<!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		@yield('content')
	  </div>
	  <!-- /.content-wrapper -->
	  <footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 2.3.7
		</div>
		<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
		reserved.
	  </footer>


	  <!-- Add the sidebar's background. This div must be placed
		   immediately after the control sidebar -->
	  <div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
				$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="plugins/morris/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/knob/jquery.knob.js"></script>
	<!-- daterangepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="plugins/daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js"></script>

	@section('script')
	@show

  </body>
</html>
