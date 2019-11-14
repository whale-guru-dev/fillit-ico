<?php
require_once('include-global.php');
//$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='2'")->fetch();

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['bankinfo']) && !empty($_POST['country'])) {
    $sth = $db->prepare("INSERT INTO wire_requests (name,email,address,bankinfo,country,acc_email,pkid,pknr,date) VALUES(:name,:email,:address,:bankinfo,:country,:real_email,:pkid,:pknr,:date)");
    $sth->execute(array(
        ':name'=>$_POST['name'],
        ':email'=>$_POST['email'],
        ':address'=>$_POST['address'],
        ':bankinfo'=>$_POST['bankinfo'],
        ':country'=>$_POST['country'],
        ':real_email'=>$_SESSION['username'],
        ':pkid' =>$_POST['pkid'],
        ':pknr'=>$_POST['pknr'],
        ':date'=>date("Y-m-d H:i:s")

));
    header('Location:https://www.fillit.eu/ico/account/DepositNow?Success');
}else{
    header('Location:https://www.fillit.eu/ico/account/DepositNow?Error');
}








?>


