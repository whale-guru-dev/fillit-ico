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
//if logged in redirect to members page
// if( $user->is_logged_in() ){ header('Location: memberpage.php'); }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['passwordL'])) {

    $username = $_POST['emailL'];
    $password = $_POST['passwordL'];

        if (($user->login($username, $password)) AND (empty($error))) {
            $_SESSION['username'] = $username;
            $stmt = $db->prepare('UPDATE members SET last_login_ip= :last_ip WHERE username=:id_cur');
            $stmt->execute(array(
                ':last_ip' => $_SERVER['REMOTE_ADDR'],
                ':id_cur' => $username
            ));
            header('Location: dashboard.php');
            exit;

        } else {
            $error[] = 'Wrong username or password or your account has not been activated.';
        }



}//end if submit

?>

<!DOCTYPE html>
<html lang="en">
<h3> <?php if(isset($error)){ echo $error[0];} ?></h3>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="images/favi.png"/>
    <title>FILLIT</title>
    <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;Raleway:300,400,500,600,700,800,900">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="css/owl-carousel/owl.carousel.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup/magnific-popup.css"/>

    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>

    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Style customizer (Remove these two lines please) -->
    <link rel="stylesheet" href="css/style-customizer.css"/>

    <!-- custom style -->
    <link rel="stylesheet" href="css/custom.css"/>
    <link rel="stylesheet" href="style.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>

<!-- loading -->

<div id="loading" class="green-bg">
    <div id="loading-center">
        <div class="boxLoading"></div>
    </div>
</div>

<!-- loading End -->
<div id="started" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content w3-animate-zoom">

            <div class="modal-body">
                <button type="button" class="close" style="color:#fff!important;" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-sm-8">
                        <p class="h4 text-center" style="padding-top: 31px;font-size: 17px;">Activate your purchased
                            FILLIT Mychoice card. </p>
                    </div>
                    <div class="col-sm-4"><a href="#" class="btn btn-primary1 btn-sm">ACTIVATE NOW</a></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8 text-center">
                        <p class="h4 text-center">Register for a new FILLIT Virtual Card .</p>

                    </div>
                    <div class="col-sm-4"><a href="reg.html" class="btn btn-primary1 btn-sm">REGISTER NOW</a>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>




<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="images/ico-sign-up.svg" class="mx-auto py-4 d-block">
                <br><br>
                <form action="" method="POST">

                    <div class="form-group">
                        <input type="email" name="emailL" title="" required="" id="id_login" placeholder="E-mail address"
                               class="form-control"></div>
                    <div class="form-group">
                        <input type="password" name="passwordL" placeholder="Password" class="form-control"></div>
                    <button type="submit" onclick="$(field).closest('form').submit();" class="btn btn-primary btn-md d-block w-100 mt-4" style="padding:15px 100px;">
                        Login
                    </button>
                    <br>
                    <small class="text-center d-block mx-auto py-2">Don’t have an account? <a href="reg.html">Sign up
                            here</a></small>
                </form>
            </div>

        </div>

    </div>
</div>




<!-- Header -->

<header id="header-wrap" data-spy="affix" data-offset-top="55">
    <div class="container">
        <div class="row">
            <div class="col-xs-7">&nbsp;</div>
            <div class="hidden-lg col-xs-5" style="margin-top:5px">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle lag" id="menu1" type="button" data-toggle="dropdown">
                        Language
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">English &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                        src="images/1.png" style="width:25px; height:25px;" alt=""/></a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ελληνικά &&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                        src="images/2.png" style="width:25px; height:25px;" alt=""/></a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">български &nbsp;&nbsp;&nbsp;&nbsp;<img
                                        src="images/3.png" style="width:25px; height:25px;" alt=""/></a></li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-12">

                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="index.html">
                            <img src="images/logo.png" style="width:222px;height:38px" alt="logo">
                        </a>

                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="#iq-home">Home</a></li>
                            <li><a href="#fee">Fee</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="#faq">FAQ</a></li>
                            <li><a href="support.html">Support</a></li>
                            <li class="hidden-xs">
                                <div class="dropdown ">
                                    <button class="dropbtn lag">Language
                                        <span class="caret"></span></button>
                                    <div class="dropdown-content">
                                        <a role="menuitem" tabindex="-1" href="#">English &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                                    src="images/1.png" style="width:25px; height:25px;" alt=""/></a>
                                        <a role="menuitem" tabindex="-1" href="#">Ελληνικά &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                                    src="images/2.png" style="width:25px; height:25px;" alt=""/></a>
                                        <a role="menuitem" tabindex="-1" href="#">български &nbsp;&nbsp;&nbsp;<img
                                                    src="images/3.png" style="width:25px; height:25px;" alt=""/></a>
                                    </div>

                                </div>
                            </li>

                            <li>
                                <button type="button" class="myButton"><a href="reg.html">Register</a></button>
                            </li>
                            <li>
                                <button type="button" data-toggle="modal" data-target="#login" class="myButton">Login
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Header End -->

<!-- Banner -->

<section id="iq-home" class="banner iq-box-shadow green-bg">

    <!-- Wrapper for slides -->
    <div class="container">

        <div class="banner-text">
            <div class="row">
                <div class="col-sm-7 col-lg-7 col-xs-12 col-md-7">
                    <h1 class="iq-font-white iq-tw-8">FILLIT
                        <small class="iq-font-white iq-tw-5" style="font-size:24px;padding:20px 0 0 5px">Load the card
                            from PayPal account and spend online, in stores or withdraw funds in ATM
                        </small>
                        <br>

                    </h1>

                    <img class="hidden-lg hidden-md hidden-sm" src="images/blue_Card.png">
                    <div class="link">
                        <button type="button" data-toggle="modal" data-target="#started" class="myButton"
                                style="font-size:30px;border-radius:30px; padding:15px 30px;text-transfer:uppercase">Get
                            started
                        </button>
                        <br><br>
                    </div>
                </div>
                <div class="col-sm-5 col-lg-5 col-md-5 card hidden-xs">
                    <div class="block-jumbotron">
                        <div class="container">
                            <div class="jumbotron row">
                                <div class="col-md-12 col-sm-12 hidden-sm-down">
                                    <div class="card-ill-holder player-card">
                                        <div class="card-item bottom-card parallax-element-two">
                                            <img src="images/black_Card.png">
                                        </div>
                                        <div class="card-item top-card parallax-element-one">
                                            <img src="images/blue_card.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</section>

<!-- Banner End -->

<div class="main-content">

    <!-- Feature -->

    <section class="overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-title">
                        <h4 class="iq-tw-6">Load the card from e-wallet or PayPal account and spend online, in stores or
                            withdraw funds in ATM</h4>
                        <div class="divider"></div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="iq-fancy-box text-left">
                        <p class="text-left"><i class="fa fa-globe"
                                                style="border:2px solid #1e50e2; color:#1e50e2;border-radius:50%; padding:0px 7px"
                                                aria-hidden="true"></i></p>
                        <h4 class="iq-tw-6">Easy to get!</h4>
                        <p>Use card at any site, shop and ATM worldwide that accepts Visa.</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 re-mt-30">
                    <div class="iq-fancy-box text-left">
                        <p class="text-left"><i class="fa fa-leaf"
                                                style="border:2px solid #1e50e2; color:#1e50e2;border-radius:50%; padding:0px 7px"
                                                aria-hidden="true"></i></p>
                        <h4 class="iq-tw-6">Instant</h4>
                        <p>Get the card and load it in seconds.<br><br></p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 re-mt-30">
                    <div class="iq-fancy-box text-left">
                        <p class="text-left"><i class="fa fa-angle-double-right"
                                                style="border:2px solid #1e50e2; color:#1e50e2;border-radius:50%; padding:0px 15px"
                                                aria-hidden="true"></i></p>
                        <h4 class="iq-tw-6">Features</h4>
                        <p>Both Chip & Pin and virtual cards are available in EUR, GBP, USD.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature END -->


    <!-- About Our App -->

    <section class="iq-about grey-bg iq-mtb-40">
        <div class="container">
            <div class="row row-eq-height">
                <div class="col-sm-12 col-lg-5 col-md-5 iq-about-bg">
                    <div class="iq-bg about-img popup-gallery play-video">
                        <img class="img-responsive center-block" src="images/about.jpg" alt="#">

                    </div>
                </div>
                <div class="col-sm-12 col-lg-7 col-md-7 iq-pall-50">
                    <h2 class="heading-left iq-tw-6 ">What is Fillit?</h2>
                    <p>Fillit is a prepaid card service that allows users to transfer money from their PayPal accounts
                        or other merchants such as betting companies and others on a plastic or virtual Fillit Visa card
                        and allows them to use this card as any other worldwide payment card. Fillit.eu and Fillit
                        trademarks belong to Streamflow EOOD, a company based in Bulgaria, founded in 2014.
                    </p>
                    <a class="button iq-mt-15" href="su_about.html">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Our App END -->


    <!-- Special Features -->

    <section class="overview-block-ptb iq-amazing-tab white-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-title">
                        <h2 class="title iq-tw-6">MyChoice debit card features</h2>
                        <div class="divider"></div>
                        <p>Some of great benefits you get with MyChoice card</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="wow fadeInLeft" data-wow-duration="1s">
                            <a class="round-right">
                                <div class="iq-fancy-box-01 text-right">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                    <h4 class="iq-tw-6">It's prepaid</h4>
                                    <div class="fancy-content-01">
                                        <p>No bank account needed, no credit check. Perfect solution for unbanked
                                            people.</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInLeft" data-wow-duration="1s">
                            <a class="round-right">
                                <div class="iq-fancy-box-01 text-right">
                                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                    <h4 class="iq-tw-6" style="font-size:17px;">Standard or Express delivery</h4>
                                    <div class="fancy-content-01">
                                        <p>We offer FREE standard delivery or DHL Express service for an extra
                                            charge.<br><br><br></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInLeft" data-wow-duration="1s">
                            <a class="round-right">
                                <div class="iq-fancy-box-01 text-right">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <h4 class="iq-tw-6">Premium support</h4>
                                    <div class="fancy-content-01">
                                        <p>We LOVE our customers and convinced that high level 24/7 support is our
                                            strongest side.</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 text-center hidden-sm hidden-xs" style="padding-top:120px">
                    <!-- Tab panes -->
                    <img src="images/fu.png" class="img-responsive wow fadeInUp center-block wow" alt=""/>

                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="wow fadeInRight" data-wow-duration="1s">
                            <a>
                                <div class="iq-fancy-box-01">
                                    <i aria-hidden="true" class="ion-ios-photos-outline"></i>
                                    <h4 class="iq-tw-6">Low Fees</h4>
                                    <div class="fancy-content-01">
                                        <p>We charge only 1% fee. Check all fees</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInRight" data-wow-duration="1s">
                            <a>
                                <div class="iq-fancy-box-01">
                                    <i aria-hidden="true" class="ion-ios-heart-outline"></i>
                                    <h4 class="iq-tw-6">Trusted and Secure</h4>
                                    <div class="fancy-content-01">
                                        <p>Card issuer is an authorised and regulated e-money institution in Gibraltar.
                                            Our technical platform meets high techical security requirements.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInRight" data-wow-duration="1s">
                            <a>
                                <div class="iq-fancy-box-01">
                                    <i aria-hidden="true" class="ion-ios-plus-outline"></i>
                                    <h4 class="iq-tw-6">High limits</h4>
                                    <div class="fancy-content-01">
                                        <p>High deposit and withdrawal limits.</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Features END -->


    <!-- App Screenshots -->

    <section id="fee" class="iq-app ca iq-font-white">
        <div class="container-fluid">
            <div class="row row-eq-height">
                <div class="col-md-12 iq-ptb-80 green-bg">
                    <div class="container">
                        <h2 class="title iq-tw-6 text-center iq-font-white" style="padding-top:35px;">Cardholder
                            Fees</h2>
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-10 col-centered ">
                            <div class="table-responsive">

                                <table cellpadding="0" class="tr" width="100%" cellspacing="0" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="font-size: 20px;">Fee Category</td>
                                        <td style="font-size: 20px;">Fee Type</td>
                                        <td style="font-size: 20px;">Fee Frequency</td>
                                        <td style="font-size: 20px;">Amount EUR</td>
                                    </tr>
                                    <tr>
                                        <td width="139" rowspan="2" valign="top"><p>Set Up</p></td>
                                        <td width="282" valign="top"><p>Account Creation/Activation Fee</p></td>
                                        <td width="138" valign="top"><p>&nbsp;</p></td>
                                        <td width="96" valign="top"><p>Free</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Monthly Maintenance Fee</p></td>
                                        <td width="138" valign="top"><p>Monthly</p></td>
                                        <td width="96" valign="top"><p>€1</p></td>
                                    </tr>
                                    <tr>
                                        <td width="139" rowspan="3" valign="top"><p>Get Cash</p></td>
                                        <td width="282" valign="top"><p>ATM Transaction (Domestic) ⃰</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>€2.25</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>ATM Transaction (International) ⃰</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>€2.75</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Purchase Transaction</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>Free</p></td>
                                    </tr>
                                    <tr>
                                        <td width="139" rowspan="2" valign="top"><p>Spend Money</p></td>
                                        <td width="282" valign="top"><p>Foreign Currency Conversion</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>3%</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Card to Card Transfer (P2P)</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>€0.25</p></td>
                                    </tr>
                                    <tr>
                                        <td width="139" rowspan="4" valign="top"><p>Information</p></td>
                                        <td width="282" valign="top"><p>IVR</p></td>
                                        <td width="138" valign="top"><p>Per Call</p></td>
                                        <td width="96" valign="top"><p>Free</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Balance Enquiry at ATM ⃰</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>Free</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Expedited Shipping</p></td>
                                        <td width="138" valign="top"><p>Per Occurrence</p></td>
                                        <td width="96" valign="top"><p>€69</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>PIN Change Fee</p></td>
                                        <td width="138" valign="top"><p>Per Request</p></td>
                                        <td width="96" valign="top"><p>€0.80</p></td>
                                    </tr>
                                    <tr>
                                        <td width="139" rowspan="3" valign="top"><p>Other Fees</p></td>
                                        <td width="282" valign="top"><p>Redemption of Unused Funds</p></td>
                                        <td width="138" valign="top"><p>Per Request</p></td>
                                        <td width="96" valign="top"><p>€10</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Card Replacement</p></td>
                                        <td width="138" valign="top"><p>Per Occurrence</p></td>
                                        <td width="96" valign="top"><p>€8</p></td>
                                    </tr>
                                    <tr>
                                        <td width="282" valign="top"><p>Original Credit Load Fee (OCT)</p></td>
                                        <td width="138" valign="top"><p>Per Transaction</p></td>
                                        <td width="96" valign="top"><p>1.99%</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:center;">⃰ You may also be charged a fee by
                                            the ATM network (and you may be charged a fee for a balance inquiry even if
                                            you do not complete a fund transfer)
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <p class=" text-center"><a class="button iq-mt-15" href="fee.html">Read More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Frequently Asked Questions -->

    <section id="faq" class="overview-block-ptb white-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-title">
                        <h2 class="title iq-tw-6">Frequently Asked Questions</h2>
                        <div class="divider"></div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6" style="padding-top:80px">
                    <img class="img-responsive center-block wow fadeInLeft" src="images/faq.jpg" alt="">
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="iq-accordion iq-mt-50">
                        <div class="ad-block ad-active"><a href="#" class="ad-title iq-tw-6 iq-font-grey"> <span
                                        class="ad-icon"><i class="ion-ios-infinite-outline"
                                                           aria-hidden="true"></i></span>How do I get a Fillit MyChoice
                                Prepaid Card?</a>

                            <div class="ad-details">
                                <div class="row">
                                    <div class="col-sm-12"> Fillit MyChoice Corporate Prepaid cards are only available
                                        through corporate invitation. If you work with an organization who offers this
                                        card program, please ask them for an invitation.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ad-block"><a href="#" class="ad-title iq-tw-6 iq-font-grey"> <span
                                        class="ad-icon"><i class="ion-ios-time-outline" aria-hidden="true"></i></span>
                                How long does it take to receive my Fillit MyChoice card?</a>
                            <div class="ad-details">Fillit MyChoice Virtual cards are created instantly, and the access
                                details are sent to you to your email id. Fillit MyChoice Plastic cards should reach you
                                approximately 7 to 10 business days after your card is ordered by the corporate partner
                            </div>
                        </div>
                        <div class="ad-block"><a href="#" class="ad-title iq-tw-6 iq-font-grey"> <span
                                        style="    padding: 8px 16px;" class="ad-icon"><i
                                            class="ion-ios-compose-outline" aria-hidden="true"></i></span>What do I do
                                when I receive my card in the mail?</a>
                            <div class="ad-details">
                                <div class="row">
                                    <div class="col-sm-12"> When your card arrives, simply activate it. Follow the
                                        printed activation instructions that arrive with your card.
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <p class=" text-right"><a class="button iq-mt-15" href="faq.html">Read More</a></p>
            </div>
        </div>
    </section>

    <!-- Frequently Asked Questions END -->

</div>


<div class="footer">
    <!-- Subscribe Our Newsletter -->
    <section class="overview-block-ptb iq-newsletter green-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="heading-title iq-mb-40">
                        <h2 class="title iq-tw-6 iq-font-white">FILLIT - RECORDS</h2>
                        <div class="divider white"></div>
                        <div class="c-full-page__panel-info iq-font-white col-md-12 u-animate-slide-holder is-animated"
                             data-timing="section" style="line-height:24px;">
                            <ul class="f">
                                <li> Fillit ewallet is the solution for all your transactions. It gives you the ability
                                    to transfer money, accept payments, trade online, pay bills.
                                    <br>Sign in to the Global Borderless Payments Network. Get paid in any amount from
                                    anywhere in the world from any computer or mobile device.
                                </li>
                                <li>Move your money<br>
                                    Get your online bank account, worldwide debit cards, cheap money transfer and even
                                    more in one place.
                                </li>
                                <li>Fillit ewallet simplifies your transactions<br>
                                    Just create your account, fund it through a bank. You will receive exactly what you
                                    see, you do not pay fees for the purchase. You get a Mychoice debit card that you
                                    can use for shopping at any store that accepts Visa or MasterCard. The Mychoice card
                                    allows you to buy anything, anywhere.
                                </li>
                                <li>Fillit ewallet allows businesses to easily make payments around the world. Fillit is
                                    simple to manage and offers a seamless payment solution for everyone, for employees,
                                    partners and suppliers.
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Subscribe Our Newsletter END -->


    <!-- Address -->

    <section class="iq-our-info white-bg overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="iq-info-box text-center iq-pt-50">
                        <div class="info-icon green-bg"><i class="ion-ios-location-outline" aria-hidden="true"></i>
                        </div>
                        <h4 class="iq-tw-6 iq-mt-25 iq-mb-15">Address</h4>
                        <span class="lead iq-tw-6">Streamflow EOOD, 1142,
23 Vasil Levski Str. Fl.2, Ap.6,
Sofia, Bulgaria
</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="iq-info-box text-center iq-pt-50">
                        <div class="info-icon green-bg"><i class="ion-ios-telephone-outline" aria-hidden="true"></i>
                        </div>
                        <h4 class="iq-tw-6 iq-mt-25 iq-mb-15">Phone</h4>
                        <span class="lead iq-tw-6">+0123 456 789</span>
                        <p>Mon-Fri 8:00am - 8:00pm</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="iq-info-box text-center iq-pt-50">
                        <div class="info-icon green-bg"><i class="ion-ios-email-outline" aria-hidden="true"></i></div>
                        <h4 class="iq-tw-6 iq-mt-25 iq-mb-15">Mail</h4>
                        <span class="lead iq-tw-6">info@fillit.com</span>
                        <p>24 X 7 online support</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <ul class="info-share">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Address END -->


    <!-- MAP Info -->

    <div class="iq-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2932.7387115236065!2d23.33623901512971!3d42.68807682916625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40aa859f636d00db%3A0xea1869eb8c58894a!2sVasil+Levski+Monument%2C+1164+Borisova+Gradina%2C+Sofia%2C+Bulgaria!5e0!3m2!1sen!2sin!4v1507552273771"
                style="border:0" allowfullscreen></iframe>
    </div>

    <!-- MAP Info END -->


    <!-- Get in Touch -->

    <section id="contact-us" class="iq-our-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="iq-get-in iq-pall-40 white-bg">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="heading-title iq-mb-60">
                                    <h2 class="title iq-tw-6">Get in Touch</h2>
                                    <div class="divider"></div>
                                    <p>Do you have a question for us? we'd love to here from you and we would be happy
                                        to answer your questions. Reach out to us and we'll respond as soon as we
                                        can.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="formmessage">Success/Error Message Goes Here</div>
                            <form class="form-horizontal" id="contactform" method="post"
                                  action="../php/contact-form.php">
                                <div class="contact-form">
                                    <div class="col-sm-6">
                                        <div class="section-field">
                                            <input id="name" type="text" placeholder="Name*" name="name">
                                        </div>
                                        <div class="section-field">
                                            <input type="email" placeholder="Email*" name="email">
                                        </div>
                                        <div class="section-field">
                                            <input type="text" placeholder="Phone*" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="section-field textarea">
                                            <textarea class="input-message" placeholder="Comment*" rows="7"
                                                      name="message"></textarea>
                                        </div>
                                        <input type="hidden" name="action" value="sendEmail"/>
                                        <button id="submit" name="submit" type="submit" value="Send"
                                                class="button pull-right iq-mt-40">Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div id="ajaxloader" style="display:none"><img class="center-block mt-30 mb-30"
                                                                           src="images/ajax-loader.gif" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Get in Touch END -->


    <!-- Footer -->

    <footer class="iq-footer " style="background-color:#222">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h6>Fees</h6>
                    <a href="fee.html">Virtual card fees and limits</a><br>
                    <a href="fee.html">Plastic card fees and limits</a>
                </div>
                <div class="col-md-3">
                    <h6>Info</h6>
                    <a href="support.html">Support</a><br>
                    <a href="contact.html">Contact us</a><br>
                    <a href="#">Affiliate program</a>
                </div>
                <div class="col-md-3">
                    <h6>Legal</h6>
                    <a href="t_c.html">Terms &amp; conditions</a><br>
                    <a href="#">Privacy policy</a><br>
                    <a href="#">Cardholder agreement</a><br>
                    <a href="cookie_policy.html">Cookie policy</a>
                </div>
                <div class="col-md-2" style="padding-top:50px">
                    <img src="images/logo.png" style="width:140px;height:25px;opacity: 0.2;" alt="logo"><br><br>
                    <img src="images/logo1.png" style="width:150px;height:25px;" alt="logo">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="footer-copyright iq-ptb-20"> “Visa Prepaid card is issued by Wave Crest Holdings Limited
                        pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated.
                        Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services
                        Commission, Gibraltar.
                        Streamflow Eood © 2017, All Rights Reserved.
                        Streamflow Eood is a company registered in Bulgaria UIC 202977139.”
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer END -->

</div>

<!-- back-to-top -->

<div id="back-to-top">
    <a class="top" id="top" href="#top"> <i class="ion-ios-upload-outline"></i> </a>
</div>
<div class="alert alert-success alert-dismissable al">

    This website user cookies. Click <a href="cookie_policy.html">here</a> for more information. If that's okay with
    you, just keep browsing. <a href="#" style="font-size:25px!important; color:#fff!important" class="close"
                                data-dismiss="alert" aria-label="close">×</a>
</div>
<!-- back-to-top End -->

<!-- jQuery -->

<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links
        $("a").on('click', function (event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<!-- owl-carousel -->
<script type="text/javascript" src="js/owl-carousel/owl.carousel.min.js"></script>

<!-- Counter -->
<script type="text/javascript" src="js/counter/jquery.countTo.js"></script>

<!-- Jquery Appear -->
<script type="text/javascript" src="js/jquery.appear.js"></script>

<!-- Magnific Popup -->
<script type="text/javascript" src="js/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Retina -->
<script type="text/javascript" src="js/retina.min.js"></script>

<!-- wow -->
<script type="text/javascript" src="js/wow.min.js"></script>

<!-- Countdown -->
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>

<!-- bootstrap -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- Style Customizer -->
<script type="text/javascript" src="js/style-customizer.js"></script>

<!-- Custom -->
<script type="text/javascript" src="js/custom.js"></script>
<script src="js/frontv2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
</body>

</html>