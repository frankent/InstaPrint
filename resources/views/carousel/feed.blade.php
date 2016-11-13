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
        <script src="<?php echo asset('js/jquery.nicescroll.min.js') ?>"></script>

        <style type="text/css">
            body {
                background-color: #fafafa;
            }

            #frame_slide {
                /*background-color: #000;*/
                height: 100vh;
            }

            #feed_list {
                /*background-color: #fff;*/
                height: 95vh;
                overflow-x: hidden;
                overflow-y: scroll;
            }

            #feed_display {
                /*background-color: #000;*/
                height: 95vh;
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

            #feed_list::-webkit-scrollbar { 
                display: none; 
            }

            #feed_list h1{
                padding-top: 20px;
                padding-bottom: 10px;
                margin: 0px;
            }
        </style>        

    </head>
    <body>
        <section id="frame_slide">
            <div class="content">
                <div class="row">
                    <div class="col-xs-6">
                        <section id="feed_display">

                        </section>
                    </div>
                    <div class="col-xs-6">
                        <section id="feed_list" data-next-feed="<?php echo $next_feed; ?>">
                            <h1 class="text-center"><?php echo '#' . $tag_name ?></h1>
                            <div class="row"></div>
                            <div class="row">
                                <h1 class="text-center" style="padding: 5px 0;">#End</h1>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        <div class="hidden" id="slide_temp">
            <?php echo json_encode($feed); ?>
        </div>

        <script type="text/javascript">
            var feed_key = {};
            $('#feed_list').niceScroll();
            function frame(each_feed) {
                var html = '<div class="col-xs-4" style="display:none;" id="feed-' + each_feed.id + '">\n\
                            <div class="thumbnail" data-profile_pic="' + each_feed.profile_pic + '" data-picture="' + each_feed.picture_l + '" data-name="' + each_feed.name + '" data-location="' + each_feed.post_location + '">\n\
                            <img class="img-responsive" src="' + each_feed.thumb + '">\n\
                            <textarea class="hidden">' + each_feed.caption + '</textarea>\n\
                            </div>\n\
                            </div>';
                return html;
            }

            $(function () {
                var feed = $('#slide_temp').text();
                feed = JSON.parse(feed);
                $.each(feed, function (i, v) {
                    feed_key['s' + v.id] = true;
                    $('#feed_list').find('.row').prepend(frame(v));
                    $('#feed-' + v.id).fadeIn(500);
                });

                setInterval(function () {
                    var url = $('#feed_list').data('next-feed');
                    $.get(url, function (res) {
                        if (res.feed.length > 0) {
                            $.each(res.feed, function (i, v) {
                                if (!feed_key.hasOwnProperty('s' + v.id)) {
                                    feed_key['s' + v.id] = true;
                                    $('#feed_list').find('.row').prepend(frame(v));
                                    $('#feed-' + v.id).fadeIn();
                                }
                            });

                            if (res.feed.length == 9) {
                                $('#feed_list').data('next-feed', res.next_feed);
                            }
                        }
                    }, 'json');
                }, 15000);
            });
        </script>
    </body>
</html>