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

$stmta = $db->prepare('SELECT MAX(refId) FROM orders');
$stmta->execute();
$maxid = $stmta->fetch(PDO::FETCH_ASSOC);


$stmta = $db->prepare('SELECT id FROM orders WHERE memberId=:mid AND status_card = "fraud"');
$stmta->execute(array(
    ':mid' => $_SESSION['memberID']
));
$fraud = $stmta->fetch(PDO::FETCH_ASSOC);

if(!empty($fraud)){
    $erroraxx = 'Your order has been put on hold due to the system of anti-fraud. Please contact us.';
}

$stmta = $db->prepare('SELECT id, card_type, status_card, card_currency, expiryDate, pan, usr_id, proxy FROM orders WHERE memberId=:mid AND status="Completed" AND pan IS NOT NULL');
$stmta->execute(array(
    ':mid' => $_SESSION['memberID']
));
$card_info = $stmta->fetchAll(PDO::FETCH_ASSOC);

$stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
$stmta->execute();
$token = $stmta->fetch(PDO::FETCH_ASSOC);


?>
<style>
    html, body {
        height: 100%
    }
</style>
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

<div class="inner">
    <div class="container all-content">
        <div class="page-header">
            <h3>
                My cards
                <?php if ((!empty($user->get_user_data()['country'])) AND (!empty($user->get_user_data()['zip'])) AND (!empty($user->get_user_data()['city'])) AND (!empty($user->get_user_data()['phone'])) AND (!empty($user->get_user_data()['date_of_birth'])) AND (!empty($user->get_user_data()['ip_user'])) AND (!empty($user->get_user_data()['address'])) AND (!empty($user->get_user_data()['first_name'])) AND !isset($erroraxx)) { ?>
                    <a href="order.php" class="pull-right btn btn-info">Order new card</a><?php } ?>
            </h3>
        </div>
        <div class="row">
            <div class="card-list">
                <div class="col-md-12">
                    <!--div class="alert alert-danger">
                        <p>IMPORTANT NOTICE : From 15.12.2016, due the new AML regulations, any third-party loads into the fillit card (PayPal withdrawals, Skrill unloads, Amazon refunds, betting sites payouts etc.) require the receiving card to be fully verified. Attempts to receive any third-party loads into an unverified card will cause it to block until valid identification documents are provided.</p>
                    </--div-->
                </div>
                <div class="col-lg-12">
                    <?php if (isset($_GET['action'])) {
                        if ($_GET['action'] == "resetAccount") { ?>
                            <div class="alert-success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                Password successfully changed!

                            </div>

                        <?php }
                    } ?>

                    <?php if (isset($erroraxx)) { ?>
                            <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                <?php echo $erroraxx; ?>

                            </div>

                        <?php
                    } ?>
                    <?php if (array_key_exists('success', $_GET)) {

                        $stmt = $db->prepare('SELECT status FROM orders WHERE id = :idd');
                        $stmt->execute(array(':idd' => $_GET['orderidd']));
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

                            <div class="alert-success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                Your order has been received and your card will be created in the next few minutes if
                                everything is okay.<br>
                                If more than 5 minutes pass , please contact our support.

                            </div>

                <?php    }

                     //  Welcome to your
                    //  dashboard <?php echo $user->get_user_data()['first_name'] . ' ' . $user->get_user_data()['last_name']; ?>
                    <br>
                    <?php if ((empty($user->get_user_data()['country'])) OR (empty($user->get_user_data()['zip'])) OR (empty($user->get_user_data()['city'])) OR (empty($user->get_user_data()['phone'])) OR (empty($user->get_user_data()['date_of_birth'])) OR (empty($user->get_user_data()['ip_user'])) OR (empty($user->get_user_data()['address'])) OR (empty($user->get_user_data()['first_name']))) { ?>   Please fill your personal info
                        <a href="profile.php" style="color:blue">here</a> before ordering the card. <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


        <link rel="stylesheet" type="text/css" href="card.css"/>
        <div class="row" style="margin:auto;">


            <?php
            $stmta = $db->prepare('SELECT kycLevel FROM members WHERE memberID=:idd');
            $stmta->execute(array(
                 ':idd' => $_SESSION['memberID']
                )
            );
            $kyca = $stmta->fetch(PDO::FETCH_ASSOC);

            if($kyca['kycLevel']=='LEVEL_1'){
                $kyclvl='Not verified';
            }elseif($kyca['kycLevel']=='LEVEL_2'){
                $kyclvl='Verified';
            }else{
                $kyclvl='Error';
            }


            foreach ($card_info as $inf) {
                ob_flush();
                flush();
                $ch = curl_init();

                $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $inf['usr_id'] . '/cards/' . $inf['proxy'] . '/balance');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = array();
                $headers[] = "Developerid: 8k3np8hcj6chmo9sn45d";
                $headers[] = "Developerpassword: Vhkgidduif@123";
                $headers[] = "AuthenticationToken: {$token['auth_token']}";
                $headers[] = "Content-Type:	application/json";
                $headers[] = "ProgramName: MyChoiceUK";
                $headers[] = "X-Method-Override: login";

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);


                $json_a = json_decode($result, true);
                if ($json_a['errorDetails'][0]['errorCode'] == 0) {
                    $balanta = $json_a['avlBal'] / 100;
                } else {
                    $balanta = 'Error';
                }

                ?>
                <div class="card-wrapper" style="float:left;width:50%;"
                     data-jp-card-initialized="true">
                    <div class="jp-card-container">

                        <div class="jp-card jp-card-visa jp-card-identified">
                            <div class="jp-card-front">
                                <div class="jp-card-logo jp-card-elo">
                                    <div class="e">e</div>
                                    <div class="l">l</div>
                                    <div class="o">o</div>
                                </div>
                                <div class="jp-card-logo jp-card-visa">Visa<br><font
                                            size="1"><?php echo strtoupper($inf['card_type']); ?></font></div>
                                <div class="jp-card-logo jp-card-visaelectron">Visa
                                    <div class="elec">Electron</div>
                                </div>
                                <div class="jp-card-logo jp-card-mastercard">Mastercard</div>
                                <div class="jp-card-logo jp-card-maestro">Maestro</div>
                                <div class="jp-card-logo jp-card-amex"></div>
                                <div class="jp-card-logo jp-card-discover">discover</div>
                                <div class="jp-card-logo jp-card-dinersclub"></div>
                                <div class="jp-card-logo jp-card-dankort">
                                    <div class="dk">
                                        <div class="d"></div>
                                        <div class="k"></div>
                                    </div>
                                </div>
                                <div class="jp-card-logo jp-card-jcb">
                                    <div class="j">J</div>
                                    <div class="c">C</div>
                                    <div class="b">B</div>
                                </div>
                                <div class="jp-card-lower">
                                    <div class="jp-card-shiny"></div>
                                    <div class="jp-card-cvc jp-card-display">•••</div>
                                    <div class="jp-card-number jp-card-display"><?php echo chunk_split($inf['pan'], 4, ' '); ?></div>
                                    <div class="jp-card-name jp-card-display"><?php echo $user->get_user_data()['first_name'] . ' ' . $user->get_user_data()['last_name']; ?></div>
                                    <div class="jp-card-expiry jp-card-display" data-before="month/year" data-after="valid
thru"><?php echo $inf['expiryDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-card-back">
                                <div class="jp-card-bar"></div>
                                <div class="jp-card-cvc jp-card-display">•••</div>
                                <div class="jp-card-shiny"></div>
                            </div>
                        </div>
                        <div class="well">
                            Balance: <?php echo $balanta; ?><br>
                            Currency: <?php echo $inf['card_currency']; ?><br>
                            Card Type: <?php echo ucfirst($inf['card_type']); ?> <br>
                            Status: <?php echo $inf['status_card']; ?><br>
                            KYC Status: <?php echo $kyclvl; ?><br>



                                <button type="button" class="btn btn-default btn-sm" onclick="window.location.replace('load.php?card=<?php echo $inf['id']; ?>')">Load</button>
                                <button data-toggle="modal" data-target="#card1details" id="wca"  class="btn btn-default btn-sm clia-resend"  type="button"
                                        onClick="detailsx();$( '#card1details' ).toggle();$('.modal-backdrop').toggle();$('#killer').show(); ">Card Details
                                </button>
                            <button type="button" class="btn btn-default btn-sm" onclick="window.location.replace('transactions.php?card=<?php echo $inf['id']; ?>')">Transactions</button>


                        </div>
                        <script>
                            function chunk(str, n) {
                                var ret = [];
                                var i;
                                var len;

                                for(i = 0, len = str.length; i < len; i += n) {
                                    ret.push(str.substr(i, n))
                                }

                                return ret
                            }


                            function detailsx() {
                                $("#wca").attr("onclick","window.location.replace('dashboard.php');");
                                $.ajax({
                                    type: 'POST',
                                    url: 'ajax.php',
                                    data: {
                                        'checker': 'yes',
                                        'membid': '<?php echo $inf['id']; ?>',
                                        'type': '<?php echo $inf['card_type'];?>'
                                    },


                                    success: function (msg) {
                                        wc_cors.getCardData(msg);

                                        var interval = setInterval(function () {
                                            if ($("#timeout_wrap").length) {
                                                if ($('#timeout_wrap > h3').text() == 'ATM PIN') {
                                                    var pin = $('#timeout_wrap > h2').text();
                                                    $('.atm-pin').html("ATM PIN Number: " + pin);
                                                    $('.j_virtual_data').hide();
                                                    $('#timeout_wrap').hide();
                                                    $('#killer').hide();
                                                    $('.atm-pin').show();
                                                    clearInterval(interval);
                                                } else {
                                                    var numar =   chunk($('#timeout_wrap > table > tbody > tr:nth-child(1) > td:nth-child(2)').text(), 4).join(' ');
                                                    var ccv = $('#timeout_wrap > table > tbody > tr:nth-child(2) > td:nth-child(2)').text();
                                                    var expiry = $('#timeout_wrap > table > tbody > tr:nth-child(3) > td:nth-child(2)').text().slice(5);
                                                    $('.j_pan').html(numar);
                                                    $('.j_expiry').html(expiry);
                                                    $('.j_cvv').html(ccv);
                                                    $('#timeout_wrap').hide();
                                                    $('#killer').hide();
                                                    $('.j_virtual_data').show();
                                                    clearInterval(interval);
                                                }

                                            }}, 100);
                                        var count = 60;
                                        var timer = setInterval(function () {
                                            count--;

                                            document.getElementById("fag").innerHTML ='Window will close in '+count+' seconds';

                                            if (count === 0 ) {
                                               count=60;
                                               $('.j_virtual_data').hide();
                                               $('#card1details').hide();
                                                $('.modal-backdrop').hide();
                                               clearInterval(timer);

                                            }

                                        }, 1000);


                                    }
                                });
                            }
                        </script>
                    </div>


                </div>
                <div class="j_details modal fade in" id="card1details" tabindex="-1" role="dialog" aria-labelledby="modallabel1"  style="display: none; padding-right: 17px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick="$('#card1details').toggle();$('.modal-backdrop').toggle();$('.j_virtual_data').hide(); clearInterval(timer);" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="modallabel1"><?php echo $inf['card_currency']; ?> card *<?php echo substr($inf['pan'], -4); ?> details</h4>
                            </div>
                            <div class="modal-body j_details-modal-body">
                                <div id="wc_cors_wrap" class="j_cors_wrap cors_wrap" >
                                    <div class="center j_cors_token_loader" style="display: block;">
                                        <img id="killer" src="images/loader.gif" style="margin-left: 25%;width: 46%;" alt="loader">
                                    </div>
                                    <p class="atm-pin" style="display:none">ATM PIN Number: <span class="j_atm_pin"></span></p>
                                    <table class="table table-striped table-hover table-bordered j_virtual_data" style="display:none;">
                                        <tbody><tr>
                                            <td>Card number</td><td class="j_pan">4665 4401 7793 4607</td>
                                        </tr>
                                        <tr>
                                            <td>Expiration date</td><td class="j_expiry">10 / 20</td>
                                        </tr>
                                        <tr>
                                            <td>CVV code</td><td class="j_cvv">877</td>
                                        </tr>
                                        </tbody></table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="j_close btn btn-default" data-dismiss="modal" onclick="$('#card1details').toggle();$('.modal-backdrop').toggle();$('.j_virtual_data').hide(); clearInterval(timer);">Close</button>
                                </div>
                                <div id="fag"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ob_end_flush();
            ?>


        </div>
    </div>
</div>
</div>
<!-- Footer -->
<div class="modal-backdrop fade in" style="display:none;"></div>
<script src="https://api.wavecrest.gi/static/lib/js/wc/wc-cors/1.0/wavecrest-cors.min.js"></script>
<script type="text/javascript">
    wc_cors.init('https://wcapi.wavecrest.in');
</script>
<footer class="iq-footer " style="background-color:#222;    width: 100%;
   ">
    <div class="container">
        <div class="row"></div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="footer-copyright iq-ptb-20"> “Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings Limited
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
<script type="text/javascript" src="/js/owl-carousel/owl.carousel.min.js"></script>

<!-- Counter -->
<script type="text/javascript" src="/js/counter/jquery.countTo.js"></script>

<!-- Jquery Appear -->
<script type="text/javascript" src="/js/jquery.appear.js"></script>

<!-- Magnific Popup -->
<script type="text/javascript" src="/js/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Retina -->
<script type="text/javascript" src="/js/retina.min.js"></script>

<!-- wow -->
<script type="text/javascript" src="/js/wow.min.js"></script>

<!-- Countdown -->
<script type="text/javascript" src="/js/jquery.countdown.min.js"></script>


<!-- Style Customizer -->
<script type="text/javascript" src="/js/style-customizer.js"></script>

<!-- Custom -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

<div class="mask"></div>
<script type="text/javascript" src="./fillit_files/fillit-back.min.ca7fee069eab.js.download" charset="utf-8"></script>


</body></html>