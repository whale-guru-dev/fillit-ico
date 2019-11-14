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

/*
 *   [is_fiat] =&gt; 0
                    [rate_btc] =&gt; 1.000000000000000000000000
                    [last_update] =&gt; 1375473661
                    [tx_fee] =&gt; 0.00070000
                    [status] =&gt; online
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if( isset($_POST['getrate']) AND $_POST['getrate']) {
    require('./coinpayments.inc.php');
    $cps = new CoinPaymentsAPI();
    $cps->Setup();

    $result = $cps->GetRates();
    if ($result['error'] == 'ok') {

        $eur = $result['result']['EUR']['rate_btc']; // EUROOOO
        $val_in_btc = $eur * $_POST['val'];

        if($_POST['type']=='--'){
            echo 'Select Coin';
        }
        if($_POST['type']=='BTC') {
            $btc = $result['result']['BTC']['rate_btc']; //btc
            $totalbtc =  $btc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            $exchange = $_POST['val']/$totalbtc;

            echo $exchange;
        }
        if($_POST['type']=='LTC') {
              $ltc = $result['result']['LTC']['rate_btc']; //ltc
            $totalbtc =  $ltc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='XRP') {
              $xrp = $result['result']['XRP']['rate_btc']; //ripple
            $totalbtc =  $xrp/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='BCC') {
           $bcc = $result['result']['BCC']['rate_btc']; //Bitcoin Cash -- de verificat
            $totalbtc =  $bcc/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='DASH') {
           $dash = $result['result']['DASH']['rate_btc']; //Dash
            $totalbtc =  $dash/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='CURE') {
           $cure = $result['result']['CURE']['rate_btc']; //Curecoin
            $totalbtc =  $cure/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='DOGE') {
            $doge = $result['result']['DOGE']['rate_btc']; //Dogecoin
            $totalbtc =  $doge/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='ETC') {
            $etc = $result['result']['ETC']['rate_btc']; //Etherum Classic
            $totalbtc =  $etc/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='ETH') {
            $eth = $result['result']['ETH']['rate_btc']; // Etherum
            $totalbtc =  $eth/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='GLD') {
             $gld = $result['result']['GLD']['rate_btc']; // Gold Coin
            $totalbtc =  $gld/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='XMR') {
            $xmr = $result['result']['XMR']['rate_btc']; // Monero
            $totalbtc =  $xmr/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }
        if($_POST['type']=='ZEC') {
            $zec = $result['result']['ZEC']['rate_btc']; // ZCash
            $totalbtc =  $zec/$eur;
            $exchange = $_POST['val']/$totalbtc;
            echo $exchange;
        }


    } else {
        print 'Error: ' . $result['error'] . "\n";
    }
}
setlocale(LC_MONETARY, 'it_IT');

if(isset($_POST['getrate2']) AND $_POST['getrate2']) {
    require('./coinpayments.inc.php');
    $cps = new CoinPaymentsAPI();
    $cps->Setup();

    $result = $cps->GetRates();
    if ($result['error'] == 'ok') {

        $eur = $result['result']['EUR']['rate_btc']; // EUROOOO
        $val_in_btc = $eur * $_POST['val'];

        if($_POST['type']=='--'){
            echo 'Select Coin';
        }
        if($_POST['type']=='BTC') {
            $btc = $result['result']['BTC']['rate_btc']; //btc

            $totalbtc =  $btc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";
        }
        if($_POST['type']=='LTC') {
            $ltc = $result['result']['LTC']['rate_btc']; //ltc
            $totalbtc =  $ltc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";
        }
        if($_POST['type']=='XRP') {
            $xrp = $result['result']['XRP']['rate_btc']; //ripple
            $totalbtc =  $xrp/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='BCC') {
            $bcc = $result['result']['BCC']['rate_btc']; //Bitcoin Cash -- de verificat
            $totalbtc =  $bcc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='DASH') {
            $dash = $result['result']['DASH']['rate_btc']; //Dash
            $totalbtc =  $dash/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='CURE') {
            $cure = $result['result']['CURE']['rate_btc']; //Curecoin
            $totalbtc =  $cure/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='DOGE') {
            $doge = $result['result']['DOGE']['rate_btc']; //Dogecoin
            $totalbtc =  $doge/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='ETC') {
            $etc = $result['result']['ETC']['rate_btc']; //Etherum Classic
            $totalbtc =  $etc/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='ETH') {
            $eth = $result['result']['ETH']['rate_btc']; // Etherum
            $totalbtc =  $eth/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='GLD') {
            $gld = $result['result']['GLD']['rate_btc']; // Gold Coin
            $totalbtc =  $gld/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='XMR') {
            $xmr = $result['result']['XMR']['rate_btc']; // Monero
            $totalbtc =  $xmr/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }
        if($_POST['type']=='ZEC') {
            $zec = $result['result']['ZEC']['rate_btc']; // ZCash
            $totalbtc =  $zec/$eur;
            $totalbtc = $totalbtc - ((1/100)*$totalbtc);
            echo money_format('%.2n',$totalbtc)."\n";

        }


    } else {
        print 'Error: ' . $result['error'] . "\n";
    }
}

if(isset($_POST['coi']) && !empty($_POST['coi2'])){
    require_once('include-global.php');
    $pla = $db->query("SELECT mallu FROM users WHERE id=".$_POST['coi']." AND ref_id='".$_POST['coi2']."'")->fetch();
if($pla){
    echo number_format($pla[0], 0, '.', ',');
}
}