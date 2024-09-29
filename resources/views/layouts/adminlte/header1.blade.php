<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ Config::get('site.TITLE') }}</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<?php echo Html::style('public/assets/css/bootstrap.min.css'); ?>

			<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<?php echo Html::style('public/public/assets/css/select2.min.css'); ?>
			<!-- Theme style -->

	<?php echo Html::style('public/assets/dist/css/AdminLTE.min.css'); ?>

			<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <?php echo Html::style('public/assets/dist/css/_all-skins.min.css'); ?>
	<?php echo Html::style('public/assets/dist/css/select2.min.css'); ?>
