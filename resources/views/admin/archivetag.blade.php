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
    
    <?php $feed_chunk = array_chunk($feed, 3); ?>
    <?php foreach($feed_chunk as $feed_split): ?>
        <div class="row">
            <?php foreach ($feed_split as $each_feed): ?>
                <div class="col-sm-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="clearfix">
                                <div class="col-xs-3" style="padding: 0px;">
                                    <img src="<?php echo $each_feed['profile_pic']; ?>" alt="" class="img-responsive" />
                                </div>
                                <div class="col-xs-9">
                                    <h3 class="box-title">
                                        <?php echo $each_feed['name']; ?>
                                        <?php if (!empty($each_feed['location'])): ?>
                                            <small><?php echo $each_feed['location']; ?></small>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($each_feed['post_location'])): ?>
                                        <p><i class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;<span id="post_location"><?php echo $each_feed['post_location']; ?></span></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <img src="<?php echo str_replace('150x150', '640x640', $each_feed['picture_s']); ?>" alt="" class="img-responsive" />
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
    <?php endforeach; ?>


    <?php if ($pagination['last_page'] >= 1): ?>
        <div class="row">
            <div class="col-xs-12 text-right">
                <ul class="pagination">
                    <?php if (!empty($pagination['prev_page_url'])): ?>
                        <li class="paginate_button previous <?php echo empty($pagination['prev_page_url']) ? "disabled" : ""; ?>">
                            <a href="<?php echo $pagination['prev_page_url']; ?>" tabindex="0">Previous</a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
                        <li class="paginate_button <?php echo $i == $pagination['current_page'] ? 'active' : ''; ?>">
                            <a href="<?php echo action('AdminController@getFeed', array('tag_id' => $tag['id'], 'page' => $i)); ?>" data-dt-idx="<?php echo $i; ?>" tabindex="0">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <?php if (!empty($pagination['next_page_url'])): ?>
                        <li class="paginate_button next <?php echo empty($pagination['next_page_url']) ? "disabled" : ""; ?>">
                            <a href="<?php echo $pagination['next_page_url']; ?>" tabindex="0">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</section>
<!-- /.content -->

@endsection

@section('script')
<script type="text/javascript">
    $(function () {

    });
</script>
@endsection