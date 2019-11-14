<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo"><a href="home.php"><img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="logo"
                                                       class="logo-default"
                                                       style="width: 152px; height: 40px; filter: brightness(0) invert(1);">
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <style>    .page-header.navbar .page-logo .logo-default {
                margin-top: 7px !important;
            }</style>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                                      data-hover="dropdown" data-close-others="true"><span
                                class="username"> <?php echo $user; ?> </span><i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="<?php echo $adminurl; ?>/ChangePassword"><i class="fa fa-cog"></i> Change Password
                            </a></li>
                        <li><a href="<?php echo $adminurl; ?>/Profile"><i class="fa fa-user"></i> Profile Management
                            </a></li>
                        <li><a href="<?php echo $adminurl; ?>/signout"><i class="fa fa-sign-out"></i> Log Out </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler"></div>
                </li>
                <li class="nav-item start"><a href="<?php echo $adminurl; ?>/Dashboard" class="nav-link "><i
                                class="fa fa-home"></i><span class="title">Dashboard</span></a></li>
                <li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-bars"></i><span
                                class="title">Website Control</span><span class="arrow "></span></a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/GeneralSetting" class="nav-link"><i
                                        class="fa fa-cogs"></i> General Setting </a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/EmailSetting" class="nav-link"><i
                                        class="fa fa-envelope"></i> Email Setting </a></li>
                        <li class="nav-item">
                            <a href="<?php echo $adminurl; ?>/SMSSetting" class="nav-link"><i class="fa fa-mobile"></i> SMS Setting </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $adminurl; ?>/FillitPack" class="nav-link"><i class="fa fa-get-pocket"></i> Fillit Packages </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $adminurl; ?>/Invested" class="nav-link"><i class="fa fa-money"></i> Invested Currencies </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"><i
                                class="fa fa-desktop"></i><span class="title">Interface Control</span><span
                                class="arrow "></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/LogoSetting" class="nav-link"><i
                                        class="fa fa-cogs"></i> Logo+icon Setting</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/SocialSetting" class="nav-link"><i
                                        class="fa fa-cogs"></i> Social Setting</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/ContactSetting" class="nav-link"><i
                                        class="fa fa-cogs"></i> Contact Setting</a></li>

                    </ul>
                </li>

                <li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"><i
                                class="fa fa-download"></i><span class="title">Deposit Money</span><span
                                class="arrow"></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/UserDepositedFund" class="nav-link"><i
                                        class="fa fa-desktop"></i> Deposit Log</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/WireRequests" class="nav-link"><i
                                        class="fa fa-desktop"></i> Wire Requests</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/KYC" class="nav-link"><i
                                        class="fa fa-desktop"></i> KYC Requests</a></li>

                    </ul>
                </li>
                <li class="nav-item"><a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-users"></i><span
                                class="title">Users Management</span><span class="arrow "></span></a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/Staffs" class="nav-link"><i
                                        class="fa fa-desktop"></i> Staff</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/AllUsers" class="nav-link"><i
                                        class="fa fa-desktop"></i> All Users</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/BannedUsers" class="nav-link"><i
                                        class="fa fa-times"></i> Banned Users</a></li>
                        <li class="nav-item">
                            <a href="<?php echo $adminurl; ?>/MobileUnverifiedUsers" class="nav-link"><i class="fa fa-mobile"></i> Mobile Unverified</a>
                        </li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/VerifiedUsers" class="nav-link"><i
                                        class="fa fa-check"></i> Verified Users</a></li>
                        <li class="nav-item"><a href="<?php echo $adminurl; ?>/EmailUnverifiedUsers" class="nav-link"><i
                                        class="fa fa-envelope"></i> Email Unverified</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>