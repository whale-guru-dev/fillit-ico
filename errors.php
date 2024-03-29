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
        $modal = true;

    }


}//end if submit
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'joined') {
        $modal = true;
        $error[] = 'Account created succesfully. <br> Please log in.';
    }
}
?>

    <!DOCTYPE html>
<html lang="en">

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
</head>

<body>

<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="images/ico-sign-up.svg" class="mx-auto py-4 d-block">
                <br><br>
                <?php if(isset($error)){?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <?php echo  $error[0]; ?>
                    </div>
                <?php } ?>
                <form action="" method="POST">

                    <div class="form-group">
                        <input type="email" name="emailL" title="" required="" id="id_login"
                               placeholder="E-mail address"
                               class="form-control"></div>
                    <div class="form-group">
                        <input type="password" name="passwordL" placeholder="Password" class="form-control"></div>
                    <button type="submit" onclick="$(field).closest('form').submit();"
                            class="btn btn-primary btn-md d-block w-100 mt-4" style="padding:15px 100px;">
                        Login
                    </button>
                    <br>
                    <small class="text-center d-block mx-auto py-2">Forget password? <a href="forget.php">Reset
                            here</a></small><br>
                    <small class="text-center d-block mx-auto py-2">Don’t have an account? <a href="register.php">Sign
                            up
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

                        <a class="navbar-brand" href="index.php">
                            <img src="images/logo.png" style="width:222px;height:38px" alt="logo">
                        </a>

                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="fee.php">Fee</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="faq.php">FAQ</a></li>
                            <li class="active"><a href="support.php">Support</a></li>
                            <li class="hidden-xs">
                                <div class="dropdown">
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


<!--======= intro =======-->

<section class="iq-breadcrumb overview-block-pt text-center iq-box-shadow">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="heading-title iq-breadcrumb-title iq-mtb-100">
                    <h1 class="title iq-tw-8 iq-font-white">Errors and Fails</h1>
                    <div class="divider white"></div>
                </div>
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="ion-home"></i> Home</a></li>
                    <li class="active">Errors and Fails</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--======= End intro =======-->


<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 block-fee-details">
                <h6>**it happens</h6>
                <h2>I am trying to send money to another Fillit card, but it fails, why?</h2>
                <h6>There are several reasons why the card to card (p2p) transfer might fail:</h6>
                <ol>
                    <li>There is not enough money on your card;</li>
                    <li>Your card p2p limits do not allow that;</li>
                    <li>Your card is blocked;</li>
                    <li>You are trying to send money to a card created in different currency.</li>

                </ol>
                If you believe that none of above applies to your transaction, but it still fails, please contact us for
                an assistance.

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 block-fee-details">
                <h2>I am trying to add Fillit card to my PayPal account, but it is getting declined, why?</h2>
                The most frequent reason why the card is getting declined - insufficient funds. When you try to add the
                card to the PayPal, PayPal puts a small amount (about 1 EUR) at hold, to check that the card is fully
                operational. This hold is instantly released once the PayPal approves the card. In some rare cases,
                PayPal additionally charges additional 1.5 Euros during the same procedure. Our advice is to add 3 USD
                or euivalent to your Fillit card in order to add it to your PayPal account without issues.

            </div>
        </div>


    </div>
</div>


<div class="clear">&nbsp;</div>
<div class="footer">

    <!-- Footer -->

    <footer class="iq-footer " style="background-color:#222">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h6>Fees</h6>
                    <a href="fee.php">Virtual card fees and limits</a><br>
                    <a href="fee.php">Plastic card fees and limits</a>
                </div>
                <div class="col-md-3">
                    <h6>Info</h6>
                    <a href="support.php">Support</a><br>
                    <a href="contact.php">Contact us</a><br>
                    <a href="#">Affiliate program</a>
                </div>
                <div class="col-md-3">
                    <h6>Legal</h6>
                    <a href="t_c.php">Terms &amp; conditions</a><br>
                    <a href="#">Privacy policy</a><br>
                    <a href="#">Cardholder agreement</a><br>
                    <a href="cookie_policy.php">Cookie policy</a>
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

    This website user cookies. Click <a href="cookie_policy.php">here</a> for more information. If that's okay with you,
    just keep browsing. <a href="#" style="font-size:25px!important; color:#fff!important" class="close"
                           data-dismiss="alert" aria-label="close">×</a>
</div>
<!-- back-to-top End -->

<script type="text/javascript">

    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
    $(window).on("load resize ", function () {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right': scrollWidth});
    }).resize();
</script>
<!-- jQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>

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

<?php
if (isset($modal)) {
    if ($modal == true) {
        echo "<script type='text/javascript'> $(window).load(function(){ $('#login').modal('show'); }); </script>";
    }
}
?>