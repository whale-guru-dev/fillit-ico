<?php
Include('include-global.php');
$pagename = "Send Money";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Send Money To Another $basetitle Member ";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-paper-plane"></i> SEND MONEY </div>
</div>

<div class="portlet-body">


<?php 
if ($_POST) {

$sendto = $_POST["sendto"];
$amount = $_POST["amount"];
$charge = $_POST['charge'];
$message = $_POST["message"];


$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$sendto."'")->fetch();
$err1 = $count[0]==0?1:0;
$err2 = $amount<=0?1:0;

$pkgusersender = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdatasender = $db->query("SELECT minamo, maxamo FROM packs WHERE id='".$pkgusersender[0]."'")->fetch();


$err3 = $amount<$pkgdatasender[0]?1:0;
if ($pkgdatasender[1]=="-1") {
$err4 = 0;
}else{
$err4 = $amount>$pkgdatasender[1]?1:0;
}




$recid = $db->query("SELECT id, pkg FROM users WHERE email='".$sendto."'")->fetch();
////--------------------->>>>>>>>>>>>>>> CHARGES

if ($charge==1) {
$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$per = $amount*$pkgdata[1]/100;
$chargeAmo = $per+$pkgdata[0];

$cutbal = $amount+$chargeAmo;
$addbal = $amount;
$paycharge = $chargeAmo;
$reccharge = 0;

}else{

$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$recid[1]."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$per = $amount*$pkgdata[1]/100;
$chargeAmo = $per+$pkgdata[0];

$cutbal = $amount;
$addbal = $amount-$chargeAmo;
$paycharge = 0;
$reccharge = $chargeAmo;

}

$err5 = $cutbal>$mallu?1:0;
$err6 = $amount>remain30($uid)? 1:0;
$err7 = $amount>remain30($recid[0])? 1:0;


$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7;
if ($error == 0){
$newbal = $mallu-$cutbal;

$res = $db->query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Payment Completed Successfully!
</div>";


$trx = $txn_id;


$recdetails = $db->query("SELECT id, firstname, mallu FROM users WHERE email='".$sendto."'")->fetch();
$recnewbal = $recdetails[2]+$addbal;


$db->query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amount."', sig='-', typ='Payment Send', charge='".$paycharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

$db->query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amount."', sig='+', typ='Payment Received', charge='".$reccharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


 echo "<center><br><br><h1 class='uppercase bold'>
 You Sent $amount $basecurrency to $recdetails[1]</h1> <h4> Transaction # $trx
 </h4><br><br></center>";



// ///--------------------------TRX

// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$ru = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'")->fetch();

$txt = "You Sent $amount $basecurrency to $ru[0] $ru[1] ($ru[3]) . Transcetion # $trx";
abiremail($su[3], "Payment Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Payment Received From $su[0] $su[1] ($su[3]). Amount:  $amount $basecurrency . Transcetion # $trx";
abiremail($ru[3], "Payment Received", $ru[0], $txt);
abirsms($ru[2], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}

echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/SendMoney" class="btn blue btn-lg btn-block"> SEND ANOTHER </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';




} else {
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
NO USER FOUND WITH THE EMAIL !
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
AMOUNT MUST BE A POSITIVE NUMBER!
</div>";
}   

if ($err3 == 1 || $err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">

You Can Only Send Between $pkgdatasender[0] - $pkgdatasender[1]  $basecurrency 


</div>";
}   
  
if ($err5 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Don't Have Enough Money in Your Account!
</div>";
} 


  if ($err6 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Do Not Have Enough LIMIT For This Transaction !
</div>";
}   


if ($err7 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Receiver Do Not Have Enough LIMIT For This Transaction !
</div>";
}   


echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/SendMoney" class="btn blue btn-lg btn-block"> SEND MONEY </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';



}




}
?>


</div>
</div>


<?php 
include('include-footer.php');
?>
</body>
</html>