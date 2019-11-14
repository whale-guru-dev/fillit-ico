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

include('nav.php');
if (!$user->is_logged_in()) {
    header('Location: index.php');
}

if(array_key_exists('card',$_GET)) {

    $stmta = $db->prepare('SELECT id FROM orders WHERE id=:cic AND username=:usrs');
    $stmta->execute(array(
        ':cic' => $_GET['card'],
        ':usrs' => $_SESSION['username']
    ));
    $rez = $stmta->fetch(PDO::FETCH_ASSOC);

    if (!empty($rez)) {


        $_GET['card']
        ?>

        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;Raleway:300,400,500,600,700,800,900">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
              integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
              crossorigin="anonymous">


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

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <style>
            html, body {
                height: 100%;
            }
        </style>
        <div class="inner">
            <div class="container all-content">

                <!--   BEGIN ORDER NEW CARD STEP 2        -->

                <div class="page-header">
                    <h3 class="text-heading">Load Card </h3>
                </div>


                <div class="pay-methods">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="panel panel-default panel-cc ">
                                <div class="panel-heading">Load card using PayPal</div>
                                <div class="panel-body">
                                    <div class="text-center">

                        <span class="cc-fee">
Additional fee of 0.35 EUR + 6.0% will be applied
</span>

                                        <!--input type="submit" id="j_cc-submit" name="cc-submit"
                                               value="Pay with Credit Cards »" class="btn btn-success"-->

                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                              target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="J57FFXFA6F8XQ">
                                            <input name="notify_url"
                                                   value="https://www.fillit.eu/ajax.php?loadx=<?php echo $_GET['card']; ?>"
                                                   type="hidden">
                                            <input type="hidden" name="currency_code" value="EUR" >
                                            <input type="image"
                                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
                                                   border="0" name="submit"
                                                   alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0"
                                                 src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                                                 height="1">
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-group">
                        <a href="order.php" class="btn btn-lg btn-default pull-left">« Back</a>
                    </div>
                </div>

            </div>
        </div>


        <!--   END ORDER NEW CARD STEP 2        -->
        </div>
        <footer class="iq-footer " style="background-color:#222;    width: 100%;
    left: 0;
    bottom: 0;">
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
                      <a href="https://mychoicecorporate.com/privacy-policy/ ">MyChoice Privacy Policy</a>

                    </div>
                    <div class="col-md-2" style="padding-top:50px">
                        <img src="images/logo.png" style="width:140px;height:25px;opacity: 0.2;" alt="logo"><br><br>
                        <img src="images/logo1.png" style="width:150px;height:25px;" alt="logo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="footer-copyright iq-ptb-20"> “Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings
                            Limited
                            pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated.
                            Wave Crest Holdings Limited is a licensed electronic money institution by the Financial
                            Services
                            Commission, Gibraltar.
                            Streamflow Eood © 2017, All Rights Reserved.
                            Streamflow Eood is a company registered in Bulgaria UIC 202977139.”
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }else{
        header("Location:https://fillit.eu/dashboard.php");
    }
}else{
    header("Location:https://fillit.eu/dashboard.php");
}