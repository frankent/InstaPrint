@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Hash Tag</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo action('AdminController@getIndex'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hash Tag</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if (session('status')): ?>
        <?php if (session('status.state') == true) : ?>
            <div class="callout callout-info">
                <h4>Success!</h4>
                <p>{{ session('status.msg') }}</p>
            </div>
        <?php elseif (session('status.state') == false): ?>
            <div class="callout callout-danger">
                <h4>Warning!</h4>
                <p>{{ session('status.msg') }}</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">เพิ่ม Hash Tag ใหม่ (ไม่ต้องมี #)</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="">
            <div class="box-body">
                <div class="form-group">
                    <label for="hash_tag_field">Hash Tag</label>
                    <input type="text" class="form-control" id="hash_tag_field" placeholder="Hash Tag" required="required" name="hash_tag">
                </div>
            </div>
            <!-- /.box-body -->
            <?php echo csrf_field(); ?>
            <div class="box-footer">
                <button type="submit" class="btn btn-sm btn-primary btn-flat">Submit</button>
            </div>
        </form>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Hash Tag ในระบบ</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Hash Tag</th>
                            <th>Total Feed</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tag as $each_tag): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo action('AdminController@getFeed', array('tag_id' => $each_tag['id'])); ?>">
                                        <?php echo $each_tag['name']; ?>
                                    </a>
                                </td>
                                <td><?php echo $each_tag['total_feed'] ?></td>
                                <td>
                                    <select name="" id="" class="tag_status" data-tag_id="<?php echo $each_tag['id']; ?>">
                                        <option value="1" <?php echo $each_tag['is_active'] == true ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo $each_tag['is_active'] == false ? 'selected' : ''; ?>>Disable</option>
                                    </select>
                                </td>
                                <td><?php echo $each_tag['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <form action="<?php echo action('OperationController@postHashtagStatus'); ?>" method="post">
                <input type="hidden" name="tag_status" id="form_tag_status" value="[]" />
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-info btn-flat" id="save_tags_status" type="submit">Save</button>
            </form>
        </div>
        <!-- /.box-footer -->
    </div>

</section>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $('.tag_status').change(function () {
            var data = [];
            $.each($('.tag_status'), function (i, v) {
                var tag_id = $(v).data('tag_id');
                data[i] = {tag_id: tag_id, is_active: $(v).val()};
            });
            $('#form_tag_status').val(JSON.stringify(data));
        });
    });
</script>
@endsection