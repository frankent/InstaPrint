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
  <pre><?php print_r($token); ?></pre>
</section>
<!-- /.content -->

@endsection