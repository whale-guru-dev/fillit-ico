<?php
require_once('include-global.php');



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

//custom purposes
/*
$gxx = $db->query("SELECT id,who,amount,charge,sig FROM trx WHERE typ='Added By Staff'")->fetchAll();

foreach($gxx as $entry){
    $gxx = $db->query("SELECT ref_by FROM users WHERE id='".$entry['who']."'")->fetch();

    if($gxx['ref_by'] != '0'){

        //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
        $ctx = $db->query("SELECT mallu FROM users WHERE ref_id='".$gxx['ref_by']."'")->fetch();
        $ctna = $ctx[0]+(10/100 *$entry['amount']); //10 percent of package coins
        $db->query("UPDATE users SET mallu='".$ctna."' WHERE ref_id='".$gxx['ref_by']."'");
        //$res = $db->query("INSERT INTO logs SET log='adaugat la referal ".$usermain['id']."', date='".date("Y-m-d H:i:s")."' ");

        echo 'adaugat la referal<br>'.$gxx['ref_by'].'--'.$ctna;
//////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
    }

    //$db->query("UPDATE trx SET many='".$coins."' WHERE id=".$data[0]);

    //echo $entry['who'].'--'.$entry['amount'].'--'.$gxx['ref_by'].'<br>';
}


*/





/*
$gxx = $db->query("SELECT id,amount,charge,sig FROM trx")->fetchAll();


foreach($gxx as $data){
    if($data[1]==1){
        $coins = 2625 * $data[2];
    }elseif($data[1]==2){
        $coins = 8062* $data[2];
    }elseif($data[1]==3){
        $coins = 27500* $data[2];
    }elseif($data[1]==4){
        $coins = 86250* $data[2];
    }elseif($data[1]>4){
        $coins = $data[1];
    }elseif($data[3]=='-'){
        $coins = '-'.$data[1];
    }
    if($data[3]=='-'){
        $coins = '-'.$data[1];
    }
    $db->query("UPDATE trx SET many='".$coins."' WHERE id=".$data[0]);
    echo ' schimbat pt id '.$data[0].' in '.$coins.' banuti<br>';

}
*/