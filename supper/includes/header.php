<?php
include_once 'core/init.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ໂຮງຮຽນ ປະຖົມໂນນສະອາດ</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <link href="<?php echo SITE_URL; ?>assets/fonts/style.css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>assets/css/vendor.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>assets/css/default/app.min.css" rel="stylesheet">


    <link href="<?php echo SITE_URL; ?>assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet">

    <link href="<?php echo SITE_URL; ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Lao CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/fonts/main.css">

    <link href="<?php echo SITE_URL; ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/assets/plugins/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet">

    <style>
        .select2-container{
            z-index:100000;
        }
    </style>

</head>
<body class='pace-top'>

<div id="loader" class="app-loader">
    <span class="spinner"></span>
</div>
