<?php 
require_once('../function.php');

$datas = new \stdClass();


if (isset($_GET['api'])) {
$api = $_GET['api'];
}else{
$api = "";
}

if (isset($_GET['trx'])) {
$trx = $_GET['trx'];
}else{
$trx = "";
}


$err1 = trim($api)==""?1:0;
$err2 = trim($trx)==""?1:0;

$countApi = $db->query("SELECT COUNT(*) FROM users WHERE  api='".$api."'")->fetch();
$countTrx = $db->query("SELECT COUNT(*) FROM trx WHERE  trxid='".$trx."'")->fetch();

$err3 = $countApi[0]==0?1:0;
$err4 = $countTrx[0]==0?1:0;

$APIuid = $db->query("SELECT id FROM users WHERE api='".$api."'")->fetch();
$countFinal = $db->query("SELECT COUNT(*) FROM trx WHERE  trxid='".$trx."' AND who='".$APIuid[0]."'")->fetch();

$err5 = $countFinal[0]==0?1:0;

$error = $err1+$err2+$err3+$err4+$err5;
if ($error == 0){

$print = $db->query("SELECT * FROM trx WHERE  trxid='".$trx."' AND who='".$APIuid[0]."' ORDER BY id DESC")->fetch();

$paidby = $db->query("SELECT email FROM users WHERE id='".$print['byy']."'")->fetch();
$payto = $db->query("SELECT email FROM users WHERE id='".$print['who']."'")->fetch();
$paytime =  date("d-m-Y h:i:s A", $print['tm']);

$datas->amount = $print['amount'];
$datas->charge = $print['charge'];
$datas->paidby = $paidby[0];
$datas->payto = $payto[0];
$datas->time = $paytime;



}else{
$datas->error = 1;

if ($err1 == 1 || $err3 == 1){
$datas->message = "INVALID API";
}elseif ($err2 == 1 || $err4 == 1){
$datas->message = "INVALID TRANSACTION ID";
}elseif ($err5 == 1){
$datas->message = "TRANSACTION NOT FOUND";
}else{
$datas->message = "UNKNOWN ERROR";
}

}

$json = json_encode($datas);
echo $json;
?>
