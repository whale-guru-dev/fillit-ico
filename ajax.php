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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function generateRandomString($length = 40)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

require('includes/config.php');

if (array_key_exists('loadx', $_GET) AND array_key_exists('mc_gross', $_POST)) {
    function currencyConverter($from_Currency, $to_Currency, $amount)
    {
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $get = file_get_contents("https://finance.google.com/finance/converter?a=1&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>", $get);
        $get = explode("</span>", $get[1]);
        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
        return $converted_currency;
    }

    $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
    $stmta->execute();
    $token = $stmta->fetch(PDO::FETCH_ASSOC);

    $stmta = $db->prepare('SELECT usr_id, proxy,card_type,card_currency,username FROM orders WHERE id=:ida');
    $stmta->execute(array(
        ':ida' => $_GET['loadx']
    ));
    $cardux = $stmta->fetch(PDO::FETCH_ASSOC);
//fee

    $fee = 6 / 100 * $_POST['mc_gross'];

    $final_fee = $fee;

    $money_ta = $_POST['mc_gross'] - $final_fee;

    if ($_POST['mc_currency'] == 'EUR') {
        if ($cardux['card_currency'] == 'EUR') {
         $maxid=generateRandomString();

            $userid = $cardux['usr_id'];
            $proxy = $cardux['proxy'];

            $money_ta= number_format((float)$money_ta, 2, '.', '');

            $money_ta = str_replace(".", "", $money_ta);

            $data_string = '
            {
    "refId":"'.$maxid.'",
	"channelType": "1", 
	"agentId":"1221429",
	"sourceTxnDateTime": "' . (new DateTime())->format('c') . '",
	"sourceName": "ProgramPartner",
	"transactionAmount": "' . $money_ta . '",
	"currencyCode": "EUR",
	"comments": "Card load"
            }
            ';
            $ch = curl_init();

            $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $userid . '/cards/' . $proxy . '/load');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
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

            //start decoding response and insert into db

            $json_a = json_decode($result, true);


            if ($json_a['errorDetails'][0]['errorCode'] == 0) {
                $stmt = $db->prepare('INSERT INTO transactions(username,card_id,date,type,amount,comment,pp_em,currency,refId) VALUES (:usr,:cid,:data,:tip,:val,:comm,:ip,:curr,:reff)');
                $stmt->execute(array(
                    ':usr' => $cardux['username'],
                    ':cid' => $_GET['loadx'],
                    ':data' => date("Y-m-d H:i:s"),
                    ':comm' => $json_a['errorDetails'][0]['errorDescription'],
                    ':tip' => 'Card Load(+fees)',
                    ':val' => $money_ta,
                    ':ip' => $_POST['payer_email'],
                    ':curr' => $cardux['card_currency'],
                    ':reff' => $maxid
                ));
            }else{

                //in case it fails send api output into db
                $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (2, :log, :date, :user)');
                $stmt->execute(array(
                    ':log' => $result,
                    ':date' => date("Y-m-d H:i:s"),
                    ':user' => $cardux['username']
                ));
            }


        }elseif ($cardux['card_currency'] == 'USD') {

            $converted_currency = currencyConverter('EUR', 'USD', $money_ta);

           $maxid=generateRandomString();

            $userid = $cardux['usr_id'];
            $proxy = $cardux['proxy'];

            $converted_currency= number_format((float)$converted_currency, 2, '.', '');


            $converted_currency = str_replace(".", "", $converted_currency);

            $data_string = '
            {
    "refId":"'.$maxid.'",            
	"channelType": "1", 
	"agentId":"1221429",
	"sourceTxnDateTime": "' . (new DateTime())->format('c') . '",
	"sourceName": "ProgramPartner",
	"transactionAmount": "' . $converted_currency . '",
	"currencyCode": "USD",
	"comments": "Card load"
            }
            ';
            $ch = curl_init();

            $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $userid . '/cards/' . $proxy . '/load');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
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

            //start decoding response and insert into db

            $json_a = json_decode($result, true);

            print_r($json_a);
            if ($json_a['errorDetails'][0]['errorCode'] == 0) {
                $stmt = $db->prepare('INSERT INTO transactions(username,card_id,date,type,amount,comment,pp_em,currency,refId) VALUES (:usr,:cid,:data,:tip,:val,:comm,:ip,:curr,:reff)');
                $stmt->execute(array(
                    ':usr' => $cardux['username'],
                    ':cid' => $_GET['loadx'],
                    ':data' => date("Y-m-d H:i:s"),
                    ':comm' => $json_a['errorDetails'][0]['errorDescription'],
                    ':tip' => 'Card Load(+fees)',
                    ':val' => $converted_currency,
                    ':ip' => $_POST['payer_email'],
                    ':curr' => $cardux['card_currency'],
                    ':reff' => $maxid
                ));
            }else{

                //in case it fails send api output into db
                $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (2, :log, :date, :user)');
                $stmt->execute(array(
                    ':log' => $result,
                    ':date' => date("Y-m-d H:i:s"),
                    ':user' => $cardux['username']
                ));
            }

        } elseif ($cardux['card_currency'] == 'GBP') {
            $converted_currency = currencyConverter('EUR', 'GBP', $money_ta);

           $maxid=generateRandomString();


            $userid = $cardux['usr_id'];
            $proxy = $cardux['proxy'];

            $converted_currency= number_format((float)$converted_currency, 2, '.', '');


            $converted_currency = str_replace(".", "", $converted_currency);

            $data_string = '
            {
    "refId":"'.$maxid.'",
	"channelType": "1", 
	"agentId":"1221429",
	"sourceTxnDateTime": "' . (new DateTime())->format('c') . '",
	"sourceName": "ProgramPartner",
	"transactionAmount": "' . $converted_currency . '",
	"currencyCode": "GBP",
	"comments": "Card load"
            }
            ';
            $ch = curl_init();

            $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $userid . '/cards/' . $proxy . '/load');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
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

            //start decoding response and insert into db

            $json_a = json_decode($result, true);

            print_r($json_a);
            if ($json_a['errorDetails'][0]['errorCode'] == 0) {
                $stmt = $db->prepare('INSERT INTO transactions(username,card_id,date,type,amount,comment,pp_em,currency,refId) VALUES (:usr,:cid,:data,:tip,:val,:comm,:ip,:curr,:reff)');
                $stmt->execute(array(
                    ':usr' => $cardux['username'],
                    ':cid' => $_GET['loadx'],
                    ':data' => date("Y-m-d H:i:s"),
                    ':comm' => $json_a['errorDetails'][0]['errorDescription'],
                    ':tip' => 'Card Load(+fees)',
                    ':val' => $converted_currency,
                    ':ip' => $_POST['payer_email'],
                    ':curr' => $cardux['card_currency'],
                    ':reff' => $maxid
                ));
            }else{

                //in case it fails send api output into db
                $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (2, :log, :date, :user)');
                $stmt->execute(array(
                    ':log' => $result,
                    ':date' => date("Y-m-d H:i:s"),
                    ':user' => $cardux['username']
                ));
            }

        } else {
            echo 'no currency on card found.';
        }
    } else {
 echo 'no currency on paypal card found.';
    }

}


if (array_key_exists('checker', $_POST) AND array_key_exists('membid', $_POST) AND array_key_exists('type', $_POST)) {
    if ($_POST['checker'] == 'yes' AND is_numeric($_POST['membid']) AND !empty($_POST['type'])) {

        $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
        $stmta->execute();
        $token = $stmta->fetch(PDO::FETCH_ASSOC);

        $stmta = $db->prepare('SELECT usr_id, proxy FROM orders WHERE id=:ida');
        $stmta->execute(array(
            ':ida' => $_POST['membid']
        ));
        $cardu = $stmta->fetch(PDO::FETCH_ASSOC);


        if ($_POST['type'] == 'virtual') {
            $operatie = "ViewVirtualCard";
        } elseif ($_POST['type'] == 'plastic') {
            $operatie = "ViewPin";
        } else {
            $operatie = 'error';
        }

        $userid = $cardu['usr_id'];
        $proxy = $cardu['proxy'];

        $ch = curl_init();

        $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $userid . '/cards/' . $proxy . '/carddatasession?operation=' . $operatie);
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

        //start decoding response and insert into db

        $json_a = json_decode($result, true);
        echo $json_a['corsToken'];
    }
}


if (isset($_GET['orderidd']) AND isset($_POST['payment_status']) ) {

    // sortare order card


    print_r($_POST);
    $stmt = $db->prepare('UPDATE orders SET status= :status WHERE id=:id_cur');
    $stmt->execute(array(
        ':status' => $_POST['payment_status'],
        ':id_cur' => $_GET['orderidd']
    ));

    $stmta = $db->prepare('SELECT username, card_currency, card_type FROM orders WHERE id=:fuck');
    $stmta->execute(array(
        ':fuck' => $_GET['orderidd']
    ));
    $row = $stmta->fetch(PDO::FETCH_ASSOC);

    $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
    $stmta->execute();
    $token = $stmta->fetch(PDO::FETCH_ASSOC);

    $maxid=generateRandomString();

    $info_user = $user->get_user_fardata($row['username']);

    if ($row['card_type'] == 'virtual') {
        $tip_card = '1';
    } elseif ($row['card_type'] == 'plastic') {
        $tip_card = '0';
    } else {
        $tip_card = $row['card_type'];
    }

    $data_string = '{
    "nameOnCard":"' . $info_user['first_name'] . '",
    "userDetail": {
        "lastName":"' . $info_user['last_name'] . '",
        "firstName":"' . $info_user['first_name'] . '",
        "dateOfBirth":"' . $info_user['date_of_birth'] . '",
        "addressLine1":"' . $info_user['address'] . '",
        "addressLine2":"' . $info_user['address2'] . '",
        "city":"' . $info_user['city'] . '",
        "zipCode":"' . $info_user['zip'] . '",
        "country":"' . $info_user['country'] . '",
        "mobileNumber":"' . $info_user['phone'] . '",
        "email":"' . $info_user['username'] . '",
        "currencyCode":"' . $row['card_currency'] . '",
        "registeredFromIp":"' . $info_user['ip_user'] . '",
        "acceptTermsAndConditions": true,
        "acceptEsign" : true
    }, 
    "channelType": "1",
    "cardProgramId": "' . $tip_card . '",
    "localeTime": "' . (new DateTime())->format('c') . '",
    "refId": "' . $maxid . '",
    "dlvAddress": {
        "addressLineOne":"' . $info_user['address'] . ' ' . $info_user['address2'] . '",
        "city":"' . $info_user['city'] . '",
        "zipCode":"' . $info_user['zip'] . '",
        "country":"' . $info_user['country'] . '"
    }
}';


    $ch = curl_init();

    $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/cards');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
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

    //start decoding response and insert into db

    $json_a = json_decode($result, true);


    if ($json_a['errorDetails'][0]['errorCode'] == '0') {
        $stmt = $db->prepare('UPDATE orders SET 
                                    refId= :refId, 
                                    status_card=:status_card,
                                    usr_id=:usrid,
                                    proxy =:proxy,
                                    txnId = :txnId,
                                    expiryDate = :expiryDate,
                                    pan = :pan
                                    WHERE id=:id_cur');
        $stmt->execute(array(
            ':pan' => $json_a['cardDetail']['pan'],
            ':expiryDate' => $json_a['cardDetail']['expiryDate'],
            ':proxy' => $json_a['cardDetail']['proxy'],
            ':txnId' => $json_a['cardDetail']['txnId'],
            ':usrid' => $json_a['userId'],
            ':refId' => $json_a['refId'],
            ':status_card' => $json_a['cardDetail']['cardStatus'],
            ':id_cur' => $_GET['orderidd']
        ));

        $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
        $stmt->execute(array(
            ':log' => $result,
            ':date' => json_encode($maxid),
            ':user' => $row['username']
        ));

        print_r($maxid);
        print_r($result);
    }elseif($json_a['errorDetails'][0]['errorCode'] == '1026'){
        $noactive = 1;
        print_r($maxid);
        print_r($result);
        echo 'fuckx';
        $stmt = $db->prepare('UPDATE orders SET status_card="fraud", usr_id=:usr_id WHERE id=:id_cur');
        $stmt->execute(array(
            ':usr_id' => $json_a['usrId'],
            ':id_cur' => $_GET['orderidd']
        ));

        $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
        $stmt->execute(array(
            ':log' => $result,
            ':date' => 'fraud',
            ':user' => $row['username']
        ));
    } else {

        //in case it fails send api output into db
        $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
        $stmt->execute(array(
            ':log' => $result,
            ':date' => json_encode($maxid),
            ':user' => $row['username']
        ));
        print_r($maxid);
        print_r($result);
    }


    ////
    /// ACTIVATE CARD after order succesfull
    ///
if(!isset($noactive)) {
    $data_string = '{
    "reasonCode":"220",
	"comment":"Card activated from API",
	"actMethod":"6"
}';


    $ch = curl_init();

    $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $json_a['userId'] . '/cards/' . $json_a['cardDetail']['proxy'] . '/activate');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
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

//start decoding response and insert into db

    $json_a = json_decode($result, true);
}

    if ($json_a['errorDetails'][0]['errorCode'] == 0) {
        $stmt = $db->prepare('UPDATE orders SET status_card= :status WHERE id=:id_cur');
        $stmt->execute(array(
            ':status' => $json_a['newStatus'],
            ':id_cur' => $_GET['orderidd']
        ));
        if (1 == 1) {
////

            $stmta = $db->prepare('SELECT username FROM orders WHERE id=:ida');
            $stmta->execute(array(
                ':ida' => $_GET['orderidd']
            ));
            $prost = $stmta->fetch(PDO::FETCH_ASSOC);
            //send email
            $date = date("Y-m-d");
            $to = $prost['username'];
            $subject = "Successful Card Order";
            $body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">
  body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0; }
  img, a img { border:0; outline:none; text-decoration:none; }
  .imagefix { display:block; }
  p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
  img{-ms-interpolation-mode: bicubic;}
  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type=\"text/css\">
@media only screen and (max-width: 600px) {
    .rtable {width: 100% !important; table-layout: fixed;}
    .rtable tr {height:auto !important; display: block;}
    .contenttd {max-width: 100% !important; display: block;}
    .contenttd:after {content: \"\"; display: table; clear: both;}
    .hiddentds {display: none;}
    .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
    .imgtable.btnset td {display: inline-block;}
    .imgtable img {width: 100%; height: auto; display: block;}
    table{float: none; table-layout: fixed;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style=\"overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#225ebe\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#225ebe\">
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\"></td>
</tr>
<tr>
<td valign=\"top\">
<table class=\"rtable\" style=\"WIDTH: 600px; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 327px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 273px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/C87FF2AA-531D-1C9A-D167-5AC93230A9BD_Image_1_6a265d40-c636-4162-b9ea-7160744715c3.png\" width=\"293\" height=\"41\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: bottom; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 19px; BACKGROUND-COLOR: #225ebe; mso-line-height-rule: exactly\" align=\"right\"><strong>Date:{$date}</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/03D8C862-10C6-EE98-7CDC-AA9EF0F81D5D_Image_2_4f90588a-b531-4fac-88e5-14eece2ef192.jpg\" width=\"566\" height=\"377\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 12px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><span style='FONT-SIZE: 36px; FONT-FAMILY: \"arial black\", gadget, sans-serif; LINE-HEIGHT: 43px'><strong>Card Order</strong></span></p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 17px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><strong>Your card order has been successfully completed. <br>The Fillit Prepaid Visa plastic card will be delivered to your declared delivery details in 5 to 10 business days.</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #225ebe 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable btnset\" style=\"TEXT-ALIGN: center; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"VERTICAL-ALIGN: middle; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px\"> </td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style=\"FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 36px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; LINE-HEIGHT: 21px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\"><span style=\"BACKGROUND-COLOR: #feffff\"><br />
</span><span style=\"FONT-SIZE: 9px; LINE-HEIGHT: 14px\"><span style=\"COLOR: #efefef\"><span style=\"COLOR: #959595\"><br />
&ldquo;Visa Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood &copy; 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.&rdquo;</span></span></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</th>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"></th>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.0.1.300 -->
</body>
</html>";
            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();
        }
    } else {
        //in case it fails send api output into db
        $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
        $stmt->execute(array(
            ':log' => $result,
            ':date' => date("Y-m-d H:i:s"),
            ':user' => $row['username']
        ));
    }

} else {
    //header('Location: https://fillit.eu/');
}