<?php
require_once('include-global.php');
$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='3'")->fetch();

$depoistTrack = $_GET['invoice_id'];
$secret = $_GET['secret'];


    // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = '8e96787f286b59d865ee74df51c7cedd';
    $cp_ipn_secret = 'V!ronas4711';
    $cp_debug_email = 'andreibacila35@yahoo.com';


$DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status, bcam, bcid, coin FROM deposit_data WHERE track='".$depoistTrack."'")->fetch();
$PackageData = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$DepositData[2]."'")->fetch();


    $order_currency = $DepositData[8];
    $order_total = $DepositData[6];

    function errorAndDie($error_msg) {
        global $cp_debug_email;
        global $db;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
            $db->query("INSERT INTO logs SET log='".$report."', date='".date("Y-m-d H:i:s")."' ");

        }
        $db->query("INSERT INTO logs SET log='".$error_msg."', date='".date("Y-m-d H:i:s")."' ");
        die('IPN Error: '.$error_msg);

    }

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
        errorAndDie('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
   // if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
        if ($hmac != $_SERVER['HTTP_HMAC']) { //<-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
        errorAndDie('HMAC signature does not match');
    }

    // HMAC Signature verified at this point, load some variables.

    $txn_id = $_POST['txn_id'];
    $amount1 = floatval($_POST['amount1']);
    $amount2 = floatval($_POST['amount2']);
    $currency1 = $_POST['currency1'];
    $currency2 = $_POST['currency2'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];

    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

    // Check the original currency to make sure the buyer didn't change it.
    if ($currency1 != $order_currency) {
        errorAndDie('Original currency mismatch!');
    }

    // Check amount against order total
    if ($amount1 < $order_total) {
        errorAndDie('Amount is less than order total!');
    }

    if ($status >= 100 || $status == 2) {
        $resx = $db->query("INSERT INTO logs SET log='Tranzactie Crypto Corecta', date='".date("Y-m-d H:i:s")."' ");
        $copil= $db->query("SELECT ref_by,id FROM users WHERE id='".$DepositData[0]."' ",PDO::FETCH_ASSOC)->fetch();
        $usermain= $db->query("SELECT id FROM users WHERE ref_id='".$copil['ref_by']."' ",PDO::FETCH_ASSOC)->fetch();

        if($copil['ref_by'] != '0' AND !empty($copil)){

            //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
        $ct = $db->query("SELECT mallu FROM users WHERE id=".$usermain['id']."")->fetch();
        $ctn = $ct[0]+(10/100 *($PackageData[0]*$DepositData[3])); //10 percent of package coins
        $db->query("UPDATE users SET mallu='".$ctn."' WHERE id=".$usermain['id']."");
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
        $db->query("UPDATE deposit_data SET trx='".$trx."', trx_ext='".$status_text."', status='1' WHERE track='".$depoistTrack."'");

/////////////------------------------->>>>>>>>>>> TRX
        $db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='000333', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA ".$gatewayData[2]."', charge='".$DepositData[3]."', tm='".$tm."', trxid='".$trx."', refund='7' ,payed='".$DepositData[6]."', many='".($PackageData[0]*$DepositData[3])."',coin='".$DepositData[8]."'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
        $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();
       $cacatu = $PackageData[0]*$DepositData[3];
        $txt = "Your Deposit of $cacatu $basecurrency via $gatewayData[2] Has Been Processed. Transaction # $trx";
        abiremail($su[3], "Deposited Successfully", $su[0], $txt);
      //  abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
    } else if ($status < 0) {
        $rezxaa = $db->query("INSERT INTO logs SET log='Tranzactie Crypto status -- ".$status."', date='".date("Y-m-d H:i:s")."' ");
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else {
        //payment is pending, you can optionally add a note to the order page
       // $resxa = $db->query("INSERT INTO logs SET log='Tranzactie Corecta else ??', date='".date("Y-m-d H:i:s")."' ");
    }
$resxa = $db->query("INSERT INTO logs SET log='Tranzactie Crypto FINISH', date='".date("Y-m-d H:i:s")."' ");
    die('IPN OK');






//Already Done ?


########################################################
/*
$msg = "";
foreach ($_GET as $key => $value){
$msg .= " - ".htmlspecialchars($key)." ==== ".htmlspecialchars($value)."<br>";
}

echo "$msg"; 



$to = "abirkhan75@gmail.com";
$subject = "BTC TEST DATA";
$txt = "$msg";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <i@mypaidbills.com>' . "\r\n";

$a = mail($to,$subject,$txt,$headers);
if($a){
    echo "00001";
    
}else{
    echo "00";
}

*/
?>