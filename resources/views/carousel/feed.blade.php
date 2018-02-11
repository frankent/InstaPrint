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
        <script src="<?php echo asset('js/iscroll.js') ?>"></script>

        <style type="text/css">
            body {
                background-color: #fafafa;
                overflow:hidden;
            }

            #all_record {
                margin-right: -10px;
                margin-left: -10px;
            }

            #frame_slide {
                /*background-color: #000;*/
                height: 100vh;
            }

            #feed_list {
                /*background-color: #fff;*/
                height: 95vh;
            }

            #feed_display {
                /*background-color: #000;*/
                height: 95vh;
                background-position: center;
                background-repeat: no-repeat;
                /*                background-image: url("<?php echo asset('img/footer_logo.jpg'); ?>");
                                background-position: bottom left;
                                background-size: auto 80px;*/
            }

            #profile_name{
                margin: 0;
                padding: 0px;
                font-size: 28px;
            }

            #post_caption{
                font-size: 20px;
            }

            #profile_pic {
                width: 80px;
            }

            #post_location_paragraph {
                font-size: 20px;
                float: right;
            }

            #feed_list::-webkit-scrollbar { 
                display: none; 
            }

            #feed_list h1{
                padding-top: 20px;
                padding-bottom: 10px;
                margin: 0px;
            }

            #feed_inside {
                position: absolute;
                z-index: 1;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                /*background: #ccc;*/
                overflow: hidden;
            }

            #scroller {
                position: absolute;
                z-index: 1;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
                width: 100%;
                -webkit-transform: translateZ(0);
                -moz-transform: translateZ(0);
                -ms-transform: translateZ(0);
                -o-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-text-size-adjust: none;
                -moz-text-size-adjust: none;
                -ms-text-size-adjust: none;
                -o-text-size-adjust: none;
                text-size-adjust: none;
                padding: 0 30px 0 0;
            }

            .random_img {
                background-color: #000;
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
                display: block;
                margin: 10px 10px;
                position: relative;
            }

            #caption_bar {
                background-color: rgba(0,0,0,0.7);
                position: absolute;
                bottom: 0px;
                width: 100%;
            }

            .ins_caption{
                padding: 10px;
                color: #fff;
            }
        </style>        

    </head>
    <body>
        <section id="frame_slide">
            <div class="content">
                <div class="row">
                    <div class="col-xs-6">
                        <section id="feed_display">
                            <div class="col-xs-10 col-xs-offset-1">
                                <!--<h1>&nbsp;</h1>-->
                                <div class="text-center">
                                    <img src="<?php echo asset('img/logo.jpg'); ?>" alt="" style='width: 140px; margin-bottom: 10px;' />
                                </div>
                                <div class="thumbnail" style='margin-bottom: 0px'>
                                    <div class="random_img">
                                        <div id='caption_bar'>
                                            <div class="ins_caption">
                                                <div class="clearfix">
                                                    <div class="pull-left" style='width: 80px; margin-right: 10px;'>
                                                        <img id="profile_pic" class="img-circle" src="" alt="" />
                                                    </div>
                                                    <div style='padding-left: 90px;'>
                                                        <p style='margin: 0;'>
                                                            <strong id='profile_name'></strong>
                                                            &nbsp;<span id="post_location_paragraph"><i class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;<span id="post_location">Loading...</span></span>
                                                        </p>
                                                        <p style='margin: 0;' id='post_caption'></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <img src="<?php echo asset('img/hash_tag_footer.jpg'); ?>" alt="" style='height: 150px; margin-top: 5px;' />
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-xs-6">
                        <section id="feed_list" data-next-feed="<?php echo $next_feed; ?>">
                            <div id="feed_inside">
                                <div id="scroller">
                                    <h1>&nbsp;</h1>
                                    <div class="row" id="all_record"></div>
                                    <hr />
                                </div>
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
            var slide = [];
            var index = 0;

            function frame(each_feed) {
                var html = '<div class="col-xs-4" style="display:none; padding-left:10px; padding-right: 10px;" id="feed-' + each_feed.id + '">\n\
                            <div class="thumbnail" data-profile_pic="' + each_feed.profile_pic + '" data-picture="' + each_feed.picture_l + '" data-name="' + each_feed.name + '" data-location="' + each_feed.post_location + '">\n\
                            <img style="width:100%;" class="img-responsive" src="' + each_feed.thumb + '">\n\
                            <textarea class="hidden">' + each_feed.caption + '</textarea>\n\
                            </div>\n\
                            </div>';
                return html;
            }

            function slideShow() {
                var total = slide.length;
                index = index % total;
                var r_index = total - (index + 1);
                var current_slide = slide[r_index];
                index++;

                var img_slide = current_slide['picture_l'];
                $('.random_img').fadeOut(function () {
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
            }

            $(function () {
                var feed = $('#slide_temp').text();
                feed = JSON.parse(feed);
                $.each(feed, function (i, v) {
                    feed_key['s' + v.post_id] = true;
                    $('#feed_list').find('.row').prepend(frame(v));
                    $('#feed-' + v.post_id).fadeIn(500);
                    slide.push(v);
                });

                slideShow();
                setInterval(function () {
                    slideShow();
                }, 10000);

                setInterval(function () {
                    var url = $('#feed_list').data('next-feed');
                    var new_entry = false;
                    $.get(url, function (res) {
                        if (res.feed.length > 0) {
                            $('#feed_list').data('next-feed', res.next_feed);
                            $.each(res.feed, function (i, v) {
                                if (!feed_key.hasOwnProperty('s' + v.post_id)) {
                                    feed_key['s' + v.post_id] = true;
                                    $('#all_record').prepend(frame(v));
                                    $('#feed-' + v.post_id).fadeIn();
                                    slide.push(v);
                                    new_entry = true;
                                }
                            });

                            if (res.feed.length == 9) {
                                $('#feed_list').data('next-feed', res.next_feed);
                            }

                            if (new_entry == true) {
                                index = 0;
                                setTimeout(function () {
                                    new IScroll('#feed_inside');
                                }, 1000);
                            }
                        }
                    }, 'json');
                }, 15000);
            });

            $(window).load(function () {
                setTimeout(function () {
                    new IScroll('#feed_inside');
                    var slide_width = $('.random_img').width();
                    $('.random_img').height(slide_width);
                }, 1000);
            });
        </script>
    </body>
</html>