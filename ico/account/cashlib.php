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

Include('include-global.php');

$foo = file_get_contents("php://input");


//$res = $db->query("INSERT INTO logs SET log='" . print_r($_POST, true) . "', date='" . print_r($foo,true) . "' ");
$coios=json_decode($foo);

if(!empty($foo) && isset($coios->status)){  // nu uitat de scos x
    $trxx = $db->query("SELECT id,amountus FROM deposit_data WHERE cashlib_id='".$coios->transaction_id."'")->fetch();
    $money_tax= number_format((float)$trxx['amountus'], 2, '.', '');

    $money_tax = str_replace(".", "", $money_tax);
    $res = $db->query("INSERT INTO logs SET log='not empty', date='" . print_r($trxx,true) . "--".$coios->status."--".$money_tax."--".$trxx['amountus']."' ");

    if(!empty($trxx) && $coios->status=='0' && $coios->purchase_amount==$money_tax){
        $res = $db->query("INSERT INTO logs SET log='wat', date='" . print_r($trxx,true) . "--".$coios->status."--".$money_tax."--".$trxx['amountus']."' ");

        $DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE id=".$trxx['id']." ")->fetch();
        $PackageData = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$DepositData[2]."'")->fetch();
        $res = $db->query("INSERT INTO logs SET log='Tranzactie CashLib Notify Corecta', date='".date("Y-m-d H:i:s")."' ");
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
///
///
        $trx = $db->query("UPDATE deposit_data SET status=1, trx_ext='".$coios->transaction_reference."'  WHERE id='".$trxx['id']."'")->fetch();
/////////////------------------------->>>>>>>>>>> TRX
        $db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='0000697', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA CASHLIB', charge='".$DepositData[3]."', tm='".$tm."', trxid='".$coios->transaction_reference."', refund='7', payed='".$DepositData[4]."',coin='EUR', many='".($PackageData[0]*$DepositData[3])."'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
        $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();
        $cacatu = $PackageData[0]*$DepositData[3];
        $txt = "Your Deposit of $cacatu $basecurrency via CASHLIB Has Been Processed. Transaction # $trx";
        abiremail($su[3], "Deposited Successfully", $su[0], $txt);
        abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
    }

}


if(!empty($_POST) && isset($_GET['track'])){
    $res = $db->query("INSERT INTO logs SET log='" . print_r($_POST, true) . "', date='" . date("Y-m-d H:i:s") . "' ");
    $trx = $db->query("SELECT id,amountus FROM deposit_data WHERE track='".$_GET['track']."' AND status=3")->fetch();
    $money_ta= number_format((float)$trx['amountus'], 2, '.', '');

    if(empty($trx)){
        header('Location:https://fillit.eu/ico/account/Dashboard?success');
    }
    $money_ta = str_replace(".", "", $money_ta);
    if($_POST['status']=='0' && $money_ta==$_POST['purchase_amount']){

        $DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE track='".$_GET['track']."'")->fetch();
        $PackageData = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$DepositData[2]."'")->fetch();
        $res = $db->query("INSERT INTO logs SET log='Tranzactie CashLib Corecta', date='".date("Y-m-d H:i:s")."' ");
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
///
///
        $trx = $db->query("UPDATE deposit_data SET status=1, trx_ext='".$_POST['transaction_reference']."' WHERE track='".$_GET['track']."'")->fetch();
/////////////------------------------->>>>>>>>>>> TRX
        $db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='0000697', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA CASHLIB', charge='".$DepositData[3]."', tm='".$tm."', trxid='".$_POST['transaction_reference']."', refund='7', payed='".$DepositData[4]."',coin='EUR', many='".($PackageData[0]*$DepositData[3])."'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
        $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();
        $cacatu = $PackageData[0]*$DepositData[3];
        $txt = "Your Deposit of $cacatu $basecurrency via CASHLIB Has Been Processed. Transaction # $trx";
        abiremail($su[3], "Deposited Successfully", $su[0], $txt);
        abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

        header('Location:https://fillit.eu/ico/account/Dashboard?success');
    }
}elseif(!empty($_GET) && isset($_GET['code'])){

    $codx= base64_decode($_GET['code']);
   $cod= substr(parse_url($codx)['path'], 10);;
    ?>

<iframe width="100%" height="100%" frameBorder="0" src="https://backoffice-test.cashlib.com/purchase/<?php echo $cod ?>"></iframe>
<?php

}else{
    header('Location:https://fillit.eu/ico/account/Dashboard');

}