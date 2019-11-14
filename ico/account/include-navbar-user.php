<?php

if (!is_user()) {
redirect("$baseurl/login");
}

$user = $_SESSION['username'];
$sid = $_SESSION['sid'];

$userdetails = $db->query("SELECT id, sid, block, mv, ev, mallu, firstname, lastname, propic, kyc FROM users WHERE email='".$user."'")->fetch();



$tokprice= $db->query("SELECT price_coin FROM general_setting WHERE id=1")->fetch();

$uid = $userdetails[0];


$mallu = round($userdetails[5], $baseDecimal);

$myNames = "$userdetails[6] $userdetails[7]";

if($sid!=$userdetails[1]){
redirect("$baseurl/signout");
}
if($userdetails[2]==1){
redirect("$baseurl/signout");
}
if($userdetails[3]==0){
redirect("$baseurl/VerifyMobile");
}
if($userdetails[4]==0){
redirect("$baseurl/VerifyEmail");
}
$overlimit=0;
if(($mallu*$tokprice[0])>1500){

    if($userdetails[9]==0) {
        $overlimit=1;
    }elseif($userdetails[9]==1){
        $overlimit=0;
    }
}


$db->query("UPDATE users SET last='".time()."' WHERE id='".$uid."'");
?>



 <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="https://www.fillit.eu/ico/">
                            <img src="<?php echo $fronturl; ?>/assets/images/logo2.png" alt="logo" class="logo-default" style="max-height: 79px;">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">

<span class="btn btn-success hidden-md hidden-lg" style="margin-top:8px; "> <i class="fa fa-money"></i> <?php echo number_format($mallu, 0, '.', ',').' '.$basecurrency; ?></span>

                        <ul class="nav navbar-nav pull-right">




<?php 
$reqmo = $db->query("SELECT COUNT(*) FROM reqmoney WHERE tto='".$uid."' AND status='0'")->fetch();
$plax = $db->query("SELECT ref_id FROM users WHERE id=".$uid."")->fetch();

?>








<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown dropdown-user dropdown-dark">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<img alt="" class="img-circle" src="<?php echo "$fronturl/propic/$userdetails[8]"; ?>">
<span class="username username-hide-mobile"><?php echo $myNames; ?> <i class="fa fa-angle-down"></i></span>
</a>
<ul class="dropdown-menu dropdown-menu-default">


<li>
<a href="<?php echo $baseurl; ?>/Profile">
<i class="fa fa-user" style="color: #<?php echo $basecolor; ?>;"></i> My Profile </a>
</li>


<li>
<a href="<?php echo $baseurl; ?>/ChangePassword">
<i class="fa fa-cog" style="color: #<?php echo $basecolor; ?>;"></i> Change Password </a>
</li>




<li class="divider"> </li>

<li>
<a href="<?php echo $baseurl; ?>/signout">
<i class="fa fa-sign-out" style="color: #<?php echo $basecolor; ?>;"></i> Log Out </a>
</li>
</ul>
</li>
<!-- END USER LOGIN DROPDOWN -->





                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                     <div class="hor-menu  ">
                        <ul class="nav navbar-nav">

                            <li><a href="<?php echo $baseurl; ?>/Dashboard"> Dashboard</a></li>
                            <li><a href="<?php echo $baseurl; ?>/Activity"> Activity</a></li>
                            <li><a href="<?php echo $baseurl; ?>/ExchangeRates"> Exchange Rates</a></li>
                            <li><a href="<?php echo $baseurl; ?>/Referral"> Referrals</a></li>
                            <li><a href="<?php echo $baseurl; ?>/AddMoney"> Buy Coins</a></li>




                            
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                    <strong class="hidden-xs hidden-sm" style="float: right; color: #fff; margin-top: 15px;"> BALANCE : <span id="balanceex"><?php echo number_format($mallu, 0, '.', ',').'</span> '.$basecurrency; ?></strong>
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->





        
<!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
<?php
Include('include-subhead.php');
?>
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                       <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">


