<?php
require_once('include-global.php');

$raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }


    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }


    //$paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    $paypalURL = "https://secure.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));




    //if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {


$receiver_email   = $_POST['receiver_email'];
$mc_currency    = $_POST['mc_currency'];
$depoistTrack       = $_POST['custom'];
$mc_gross     = $_POST['mc_gross'];
$payer = $_POST['payer_email'];


$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='1'")->fetch();

$DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE track='".$depoistTrack."'")->fetch();
$PackageData = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$DepositData[2]."'")->fetch();


if( $mc_currency=="EUR" && $mc_gross >= $DepositData[4]){
    $res = $db->query("INSERT INTO logs SET log='Tranzactie PayPal Corecta', date='".date("Y-m-d H:i:s")."' ");

  //  $reful_principal = $db->query("SELECT ref_by,id FROM users WHERE id='".$DepositData[0]."' ",PDO::FETCH_ASSOC)->fetch();

    $copil= $db->query("SELECT ref_by,id FROM users WHERE id='".$DepositData[0]."' ",PDO::FETCH_ASSOC)->fetch();
    $usermain= $db->query("SELECT id FROM users WHERE ref_id='".$copil['ref_by']."' ",PDO::FETCH_ASSOC)->fetch();

    if($copil['ref_by'] != '0'){

        //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
        $ctx = $db->query("SELECT mallu FROM users WHERE id=".$usermain['id']."")->fetch();
        $ctna = $ctx[0]+(10/100 *($PackageData[0]*$DepositData[3])); //10 percent of package coins
        $db->query("UPDATE users SET mallu='".$ctna."' WHERE id=".$usermain['id']."");
        $res = $db->query("INSERT INTO logs SET log='adaugat la referal ".$usermain['id']."', date='".date("Y-m-d H:i:s")."' ");
//////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
    }

    $pla = $db->query("SELECT email FROM users WHERE id=".$DepositData[0]."")->fetch();


//////////---------------------------------------->>>> ADD THE BALANCE 
$ct = $db->query("SELECT mallu FROM users WHERE id='".$DepositData[0]."'")->fetch();
    $ctn = $ct[0]+($PackageData[0]*$DepositData[3]);
$db->query("UPDATE users SET mallu='".$ctn."' WHERE id='".$DepositData[0]."'");
//////////---------------------------------------->>>> ADD THE BALANCE

$trx = $txn_id;

/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
$db->query("UPDATE deposit_data SET trx='".$trx."', trx_ext='".$_POST['ipn_track_id']."', paypal_em='".$payer."', status='1' WHERE track='".$depoistTrack."'");

/////////////------------------------->>>>>>>>>>> TRX
$db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='000111', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA ".$gatewayData[2]."', charge='".$DepositData[3]."', tm='".$tm."', trxid='".$trx."', refund='7', payed='".$DepositData[4]."',coin='EUR', many='".($PackageData[0]*$DepositData[3])."', paypal_em='".$payer."'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();
    $cacatu = $PackageData[0]*$DepositData[3];
    $txt = "Your Deposit of $cacatu $basecurrency via $gatewayData[2] Has Been Processed. Transaction # $trx";
abiremail($su[3], "Deposited Successfully", $su[0], $txt);
abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


}else {
    $res = $db->query("INSERT INTO logs SET log='".print_r($_POST,true)."', date='" . date("Y-m-d H:i:s") . "' ");
}


   /* }else{
        $res = $db->query("INSERT INTO logs SET log='ERROR AT PAYPAL IPN #002', date='" . date("Y-m-d H:i:s") . "' ");

    }

*/


//////////////////////EMAIL TEST DATA

$aa = "";
foreach ($_POST as $key => $value){
$aa .=  "$key  :::::: $value<br>";
}
$aa .=  "$baseurl<br>";
$ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
if (preg_match('~^(?:.+[.])?paypal[.]com$~', gethostbyaddr($_SERVER['REMOTE_ADDR'])) > 0){
$uuuu = "PayPal - $ip";
}else{
$uuuu = "not Paypal - $ip";
}
$ips = $_SERVER['REMOTE_ADDR'];
$to = "abirkhan7.com";
$subject = "PAYPAL IPN TEST - eWallet";
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
$aa <br>
<h1>$uuuu</h1><h1>$ips</h1>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <i@abir.biz>' . "\r\n";
mail($to,$subject,$message,$headers);

 
 ?>