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

        <style type="text/css">
            #frame_slide {
                background-color: #000;
                height: 100vh;
            }

            #feed_list {
                background-color: #fff;
                height: 100vh;
            }

            #feed_display {
                background-color: #000;
                height: 100vh;
                background-position: center;
                background-repeat: no-repeat;
            }

            #profile_name{
                margin: 0;
                padding: 0px;
            }

            #post_caption{
                font-size: 25px;
            }
        </style>        

    </head>
    <body>
        <section id="frame_slide">
            <div class="row">
                <div class="col-xs-9">
                    <section id="feed_display" data-next-feed="<?php echo $next_feed; ?>">

                    </section>
                </div>
                <div class="col-xs-3">
                    <section id="feed_list">
                        <div class="clearfix" style="padding: 15px 0;">
                            <div class="col-xs-3" style="padding-right: 0px;">
                                <img src="" alt="" id="profile_pic" class="img-responsive" />
                            </div>
                            <div class="col-xs-9">
                                <h3 id="profile_name">Loading...</h3>
                                <p id="post_location_paragraph"><i class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;<span id="post_location">Loading...</span></p>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="col-xs-12" id="post_caption"></div>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <div class="hidden" id="slide_temp">
            <?php echo json_encode($feed); ?>
        </div>

        <script type="text/javascript">
            var slide = [];
            var slide_key = {};
            var index = 0;
            $(function () {
                slide = JSON.parse($('#slide_temp').text());
                $.each(slide, function (i, v) {
                    slide_key[v.id] = true;
                });

                setInterval(function () {
                    var total = slide.length;
                    index = index % total;
                    var current_slide = slide[index];
                    console.log(index, total);
                    index++;

                    var img_slide = current_slide['picture_l'];
                    $('#feed_display').fadeOut(function () {
                        $('#profile_name').text(current_slide['name']);
                        $('#profile_pic').attr('src', current_slide['profile_pic']);
                        $('#post_caption').text(current_slide['caption']);

                        if (current_slide['post_location']) {
                            $('#post_location').text(current_slide['post_location']);
                            $('#post_location_paragraph').show();
                        } else {
                            $('#post_location_paragraph').hide();
                        }

                        $(this).css({'background-image': 'url("' + img_slide + '")'}).fadeIn();
                    });
                }, 5000);
            });

            setInterval(function () {
                var url = $('#feed_display').data('next-feed');
                $.get(url, function (res) {
                    if (res.feed.length > 0) {
                        $.each(res.feed, function (i, v) {
                            if (!slide_key.hasOwnProperty([v.id])) {
                                slide_key[v.id] = true;
                                slide.push(v);
                            }
                        });

                        if (res.feed.length == 10) {
                            $('#feed_display').data('next-feed', res.next_feed);
                        }
                    }
                }, 'json');
            }, 15000);
        </script>
    </body>
</html>