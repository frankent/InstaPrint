<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Feed Carousel | Instagram Image Slider</title>
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

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo asset('plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo asset('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') ?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo asset('bootstrap/js/bootstrap.min.js') ?>"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo asset('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') ?>"></script>
        <script src="<?php echo asset('plugins/morris/morris.min.js') ?>"></script>
        <!-- Sparkline -->
        <script src="<?php echo asset('plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
        <!-- jvectormap -->
        <script src="<?php echo asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
        <script src="<?php echo asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo asset('plugins/knob/jquery.knob.js') ?>"></script>
        <!-- daterangepicker -->
        <script src="<?php echo asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') ?>"></script>
        <script src="<?php echo asset('plugins/daterangepicker/daterangepicker.js') ?>"></script>
        <!-- datepicker -->
        <script src="<?php echo asset('plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
        <!-- Slimscroll -->
        <script src="<?php echo asset('plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo asset('plugins/fastclick/fastclick.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo asset('dist/js/app.min.js') ?>"></script>
        <script src="<?php echo asset('js/iscroll.js') ?>"></script>

        <style type="text/css">
            #fram_login {
                min-height: 100vh;
                background-color: #efefef;
            }
        </style>        

    </head>
    <body>
        <section id='fram_login' class='text-center'>
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <?php if (session('status')): ?>
                            <?php if (session('status') == 'token_add_success') : ?>
                                <div class="callout callout-info">
                                    <h4>Success!</h4>
                                    <p>Thank you to join us !!</p>
                                </div>
                            <?php elseif (session('status') == 'token_error'): ?>
                                <div class="callout callout-danger">
                                    <h4>Warning!</h4>
                                    <p>Something error</p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <h2 style='padding: 15px 0; margin: 0px;'>Please login to share your moment with our event</h2>
                        <p>
                            <img style="width:200px;" src="{{asset('img/static_qr_code_without_logo.jpg')}}" alt="" />
                        </p>
                        <p>Or</p>
                        <p>
                            <a href="<?php echo $authorize_link; ?>" class="btn btn-flat btn-social btn-instagram">
                                <i class="fa fa-instagram"></i> Sign in with Instagram
                            </a>
                        </p>

                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Our Latest Guest</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    <?php foreach ($token as $each_token): ?>
                                        <li>
                                            <img src="<?php echo $each_token['picture']; ?>" alt="User Image">
                                            <a class="users-list-name" href="#"><?php echo $each_token['name']; ?></a>
                                            <span class="users-list-date"><?php echo $each_token['created_at']; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->
                        </div>

                        <p>
                            <a href="<?php echo $authorize_link; ?>" class="btn btn-flat btn-social btn-instagram">
                                <i class="fa fa-instagram"></i> Sign in with Instagram
                            </a>
                        </p>
                    </div>
                </div>    
            </div>
        </section>
    </body>
</html>