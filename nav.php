<?php

//--------------------------------
// @author: Băcilă Andrei        |
//            (an4rei)           |
// @IDE: phpStorm                |
// @skype: freerunningparkour    |
//--------------------------------
/*

                                 ,--,
                               ,--.'|
                            ,--,  | :                   ,--,
                   ,---, ,---.'|  : '  __  ,-.        ,--.'|
               ,-+-. /  |;   : |  | ;,' ,'/ /|        |  |,
   ,--.--.    ,--.'|'   ||   | : _' |'  | |' | ,---.  `--'_
  /       \  |   |  ,"' |:   : |.'  ||  |   ,'/     \ ,' ,'|
 .--.  .-. | |   | /  | ||   ' '  ; :'  :  / /    /  |'  | |
  \__\/: . . |   | |  | |\   \  .'. ||  | ' .    ' / ||  | :
  ," .--.; | |   | |  |/  `---`:  | ';  : | '   ;   /|'  : |__
 /  /  ,.  | |   | |--'        '  ; ||  , ; '   |  / ||  | '.'|
;  :   .'   \|   |/            |  : ; ---'  |   :    |;  :    ;
|  ,     .-./'---'             '  ,/         \   \  / |  ,   /
 `--`---'                      '--'           `----'   ---`-'
*/
require('includes/config.php');

if (!$user->is_logged_in()) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>

<html lang="en" data-logout-url="/profile/idle-logout/">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favi.png"/>
    <meta name="theme-color" content="#ffffff">
    <title>FILLIT</title>
    <link href="css/fillit-dash.css" rel="stylesheet" type="text/css">
    <link href="css/fillit-dash2.css" rel="stylesheet" type="text/css">


</head>
<body class="desktop">



<div class="wrap" style="height:100%;">
    <div class="header clearfix visible-xs">
        <a href="https://fillit.eu/" class="logo img-logo-color"></a>
        <div class="icon-menu"></div>
    </div>
    <nav class="navbar navbar-top navbar-fixed-top hidden-xs">
        <div class="container">
            <div class="navbar-header">
                <a href="dashboard.php" class="navbar-brand"><img style="margin-top: 8px;" src="images/logo.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="b_main-menu">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-credit-card"></span>
                            Cards</a></li>
                    <li>
                        <a href="transfer.php"><span class="glyphicon glyphicon-lock"></span> Transfer Money</a>
                    </li>
                    <li>
                        <a href="limits.php"><span class="fa fa-id-card" style="margin-right:5px;"></span>Limits</a> 
                    </li>
                    <!--li><a href="#"><span class="glyphicon glyphicon-transfer"></span> Affiliates</a></li-->
                  <?php  if($user->is_admin()){  ?><li><a href="bo.php"><span class="glyphicon glyphicon-flag"></span> Admin Panel</a></li> <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right right-menu-nav">
                    <li>
                        <a href="profile.php" class="btn btn-success btn-empty-bg"><span
                                    class="glyphicon glyphicon-user"></span>Account</a>
                    </li>
                    <li>
                        <a href="logout.php" class="btn btn-primary btn-empty-bg"><span
                                    class="glyphicon glyphicon-log-out"></span>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
