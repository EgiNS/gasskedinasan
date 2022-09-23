<!DOCTYPE html>
<html lang="en">
<?php date_default_timezone_set('Asia/Jakarta'); ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>

    <?php $company = company(); ?>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/' . $company['icon_for_browser']); ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <link href="<?= base_url('assets/vendor/datatables2/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet"
        type="text/css">
    <link href="<?= base_url('assets/vendor/datatables2/responsive.bootstrap4.min.css'); ?>" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/mystyle.css'); ?>">

    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/owl-carousel/dist/assets/owl.carousel.min.css'); ?>" />

    <!-- BREADCUMB -->
    <link rel="stylesheet" href="<?= latest_version(base_url('assets/dist/css/breadcumb.css')); ?>">

    <!-- MIDTRANS -->
    <script type="text/javascript" src="<?= javascript_snap_url(); ?>" data-client-key="<?= client_key(); ?>"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <input type="hidden" class="base_url" data-baseurl="<?= base_url(); ?>">