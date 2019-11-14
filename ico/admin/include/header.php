<?php
require_once('../function.php');session_start();if (!is_admin()) {
    redirect('index.php');
}$user = $_SESSION['ausername'];$sid = $_SESSION['asid'];$usid = $db->query("SELECT id, sid, pwr FROM admin WHERE username='" . $user . "'")->fetch();$uid = $usid[0];$mypower = $usid[2];if ($sid != $usid[1]) {
    redirect('signout.php');
}$gen = $db->query("SELECT sitetitle, currency, cur, colorcode, deci FROM general_setting WHERE  id='1'")->fetch();$basetitle = $gen[0];$basecurrency = $gen[1];$basecur = $gen[2];$basecolor = $gen[3];$baseDecimal = $gen[4];//////////////////GENERATE TRX #$a1 = date("ymd", time());$a2 = rand(100,999);$u = substr(uniqid(), 7);$c = chr(rand(97,122));$c2 = chr(rand(97,122));$c3 = chr(rand(97,122));$ok = "$c$u$c2$a2$c3";$txn_id = strtoupper($ok);//////////////////GENERATE TRX #?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Admin Panel | <?php echo $gen[0]; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta name="author" content="Abir Khan - abirkhan75@gmail.com"/>
    <link rel="shortcut icon" href="<?php echo $fronturl; ?>/assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/components-rounded.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/darkblue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="<?php echo $adminurl; ?>/assets/css/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $adminurl; ?>/assets/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="<?php echo $adminurl; ?>/assets/js/sweetalert.js"></script>
    <link rel="stylesheet" href="<?php echo $adminurl; ?>/assets/css/sweetalert.css">
    <script type="text/javascript" src="<?php echo $fronturl; ?>/nicEdit.js"></script>
    <script type="text/javascript">bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('shaons');
        });</script>