@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Archive</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo action('AdminController@getIndex'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo action('AdminController@getHashtag'); ?>">Hash Tag</a></li>
        <li class="active"><?php echo $tag['name'] ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php if (empty($feed)): ?>
        <div class="callout callout-danger">
            <h4>Warning!</h4>
            <p>ไม่พบข้อมูล Feed</p>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php foreach ($feed as $each_feed): ?>
            <div class="col-sm-4">
                <div class="box">
                    <div class="box-header with-border">
                        <img src="<?php echo $each_feed['profile_pic']; ?>" alt="" style="width: 50px; height: 50px; margin-right: 15px;" />
                        <h3 class="box-title">
                            <?php echo $each_feed['name']; ?>
                            <?php if (!empty($each_feed['location'])): ?>
                                <small><?php echo $each_feed['location']; ?></small>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <img src="<?php echo $each_feed['picture_m']; ?>" alt="" class="img-responsive" />
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php echo $each_feed['caption']; ?>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- /.content -->

@endsection

@section('script')
<script type="text/javascript">
    $(function () {

    });
</script>
@endsection