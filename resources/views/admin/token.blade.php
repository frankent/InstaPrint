@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Token</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo action('AdminController@getIndex'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Token</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if (session('status')): ?>
        <?php if (session('status') == 'token_add_success') : ?>
            <div class="callout callout-info">
                <h4>Success!</h4>
                <p>ระบบได้เพิ่ม Token ใหม่เข้าระบบเรียบร้อยแล้ว</p>
            </div>
        <?php elseif (session('status') == 'token_error'): ?>
            <div class="callout callout-danger">
                <h4>Warning!</h4>
                <p>เกิดข้อผิดพลาดระหว่างการขอ Token ใหม่</p>
            </div>
        <?php elseif (session('status') == 'token_disabled_success'): ?>
            <div class="callout callout-info">
                <h4>Success!</h4>
                <p>ระบบได้ทำการยกเลิกการใช้งาน Token แล้ว</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <p>
        <a href="<?php echo $authorize_link; ?>" class="btn btn-flat btn-social btn-instagram">
            <i class="fa fa-instagram"></i> Sign in with Instagram
        </a>
        กรุณากดปุ่มนี้เพื่ออนุญาตให้ระบบสามารถดึงข้อมูลได้ 
    </p>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Token ทั้งหมดในระบบ</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php foreach ($token as $each_token): ?>
                    <?php $custom_css = $each_token['is_active'] == true ? '' : 'webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: grayscale(100%); filter: gray;'; ?>
                    <li class="item">
                        <div class="product-img" style="<?php echo $custom_css; ?>">
                            <img src="<?php echo $each_token['picture']; ?>" alt="<?php echo $each_token['name']; ?>">
                        </div>
                        <div class="product-info">
                            <a href="javascript:void(0)" data-href="<?php echo action('OperationController@getDisbleToken', array('id' => $each_token['id'])); ?>" class="product-title token_rec <?php echo!empty($custom_css) ? 'expire' : ''; ?>">
                                <span style="<?php echo $custom_css; ?>"><?php echo $each_token['name']; ?></span>
                                <?php if ($each_token['is_active'] == 1) : ?>
                                    <span class="label label-success pull-right">active</span>
                                <?php else: ?>
                                    <span class="label label-danger pull-right">expired</span>
                                <?php endif; ?>
                            </a>
                            <span class="product-description">
                                <?php echo $each_token['created_at']; ?> 
                            </span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $('a.token_rec').not('.expire').click(function (e) {
            e.preventDefault();
            var href = $(this).data('href');
            if (confirm('ต้องการยกเลิกการใช้งาน Token นี้หรือไม่')) {
                window.location.href = href;
            }
        });
    });
</script>
@endsection