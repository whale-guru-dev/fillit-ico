<?php

if (!is_user()) {
redirect("$baseurl/login");
}

$user = $_SESSION['username'];
$sid = $_SESSION['sid'];

$userdetails = $db->query("SELECT id, sid, block, mv, ev, mallu, firstname, lastname, propic FROM users WHERE email='".$user."'")->fetch();



$uid = $userdetails[0];
$mallu = round($userdetails[5], $baseDecimal);

$myNames = "$userdetails[6] $userdetails[7]";

if($sid!=$userdetails[1]){
redirect("$baseurl/signout");
}
if($userdetails[2]==1){
redirect("$baseurl/signout");
}

// if($userdetails[3]==0){
// redirect("$baseurl/VerifyMobile");
// }
// if($userdetails[4]==0){
// redirect("$baseurl/VerifyEmail");
// }


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
                            <img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="logo" class="logo-default" style="max-height: 40px;">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">

<span class="btn btn-success hidden-md hidden-lg" style="margin-right: 50px; "> <i class="fa fa-money"></i> <?php echo "$mallu $basecurrency"; ?></span>

                        <ul class="nav navbar-nav pull-right">




<?php 
$reqmo = $db->query("SELECT COUNT(*) FROM reqmoney WHERE tto='".$uid."' AND status='0'")->fetch();
?>



<!-- BEGIN NOTIFICATION DROPDOWN -->
<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<i class="fa fa-bell"></i>
<span class="badge basecolor-bg"><?php echo $reqmo[0]; ?></span>
</a>
<ul class="dropdown-menu">

<li class="external">
<h3>You have <strong><?php echo $reqmo[0]; ?> pending</strong> Request</h3>
<a href="<?php echo $baseurl; ?>/RequestToMe">view all</a>
</li>



<li>
<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
<?php
$rr = $db->query("SELECT id, frm, amount, msg FROM reqmoney WHERE tto='".$uid."' AND status='0' ORDER BY id DESC");
while ($req = $rr->fetch()) {

$byy = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$req[1]."'")->fetch();

?>

<li>
<a href="<?php echo "$baseurl/RequestDetails/$req[0]"; ?>">
<span class="details">
Request Of <b><?php echo "$req[2] $basecurrency"; ?></b> From <?php echo "$byy[0] $byy[1]"; ?>
</span>
</a>
</li>

<?php 
}
?>



</ul>
</li>
</ul>
</li>
<!-- END NOTIFICATION DROPDOWN -->




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

                            <li><a href="<?php echo $baseurl; ?>/AddMoney"> Buy Coins</a></li>





                            
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                    <strong class="hidden-xs hidden-sm" style="float: right; color: #fff; margin-top: 15px;"> BALANCE : <?php echo "$mallu $basecurrency"; ?></strong>
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


