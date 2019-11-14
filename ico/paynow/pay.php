<?php
Include('include-global.php');
Include('include-header.php');
if (!is_user()) {
redirect("$apiurl/signin");
}






$user = $_SESSION['username'];
$sid = $_SESSION['sid'];

$userdetails = $db->query("SELECT id, sid, block, mv, ev, mallu, firstname, lastname, propic FROM users WHERE email='".$user."'")->fetch();



$uid = $userdetails[0];
$mallu = round($userdetails[5], $baseDecimal);

$myNames = "$userdetails[6] $userdetails[7]";

if($sid!=$userdetails[1]){
redirect("$baseurl/signout");
}
if($userdetails[2]==1){
redirect("$baseurl/signout");
}
if($userdetails[3]==0){
redirect("$baseurl/VerifyMobile");
}
if($userdetails[4]==0){
redirect("$baseurl/VerifyEmail");
}
$db->query("UPDATE users SET last='".time()."' WHERE id='".$uid."'");
?>


<div class="row">
<div class="col-md-8 col-md-offset-2">


<div class="portlet light portlet-fit" style="margin-top: 40px;">
<div class="portlet-title">
<div class="caption">
<i class=" icon-layers font-green"></i>
<span class="caption-subject bold uppercase">Express Payment Wizard</span>
</div>
</div>
<div class="portlet-body">
<div class="row">
<div class="col-md-6">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<span class="caption-subject bold uppercase">Payment Information</span>
</div>
</div>
<div class="portlet-body text-center">

<br>

<?php
echo " <h4>Pay To <b>$_SESSION[xpaytoname]</b> <br> $_SESSION[xpayto]</h4><br><hr><br>";
echo " <h4><b>AMOUNT: </b>$_SESSION[xamount] $basecurrency <br><b>For: </b>$_SESSION[xitemname]<br></h4> <br><hr><br>";

if (!$_POST) {
echo "<a href=\"$_SESSION[xcancelurl]\" style='color:#f00; font-weight:bold;'>CANCEL PAYMENT</a>";
}

?>


 </div>
 </div>
 </div>


<div class="col-md-6">


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<span class="caption-subject bold uppercase">Make The Payment</span>
</div>
</div>
<div class="portlet-body">


<?php 


$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$_SESSION['xpayto']."'")->fetch();
if($count[0]!=1){
echo "<div class=\"alert alert-danger alert-dismissable text-center\">
<strong>NO USER FOUND WITH THIS EMAIL. <br> PLEASE CHECK BACK WITH API OWNER !!</strong>
</div>";


echo "<br><br><br><a href=\"$_SESSION[xcancelurl]\" class='btn btn-danger btn-block'>Back To $_SESSION[xpaytoname] </a>";

}else{
if ($_POST) {
$message = $_POST['message'];
$amount = $_SESSION[xamount];
$sendto = $_SESSION[xpayto];
$newbal = $mallu-$amount;


if($mallu<$amount || $amount<0){
echo "<div class=\"alert alert-danger alert-dismissable text-center\">
<strong>YOU DO NOT HAVE ENOUGH BALANCE IN YOUR WALLET!!</strong>
</div>";
}else{

$res = $db->query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");
if($res){

echo "<div class=\"alert alert-success alert-dismissable text-center\">
<strong>Payment Completed Successfully!!!</strong>
</div>";





$recid = $db->query("SELECT id, pkg FROM users WHERE email='".$sendto."'")->fetch();
////--------------------->>>>>>>>>>>>>>> CHARGES

$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$recid[1]."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$per = $amount*$pkgdata[1]/100;
$chargeAmo = $per+$pkgdata[0];

$cutbal = $amount;
$addbal = $amount-$chargeAmo;
$paycharge = 0;
$reccharge = $chargeAmo;


$trx = $txn_id;

$recdetails = $db->query("SELECT id, firstname, mallu, api FROM users WHERE email='".$sendto."'")->fetch();
$recnewbal = $recdetails[2]+$addbal;


$db->query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amount."', sig='-', typ='Payment For ".$_SESSION[xitemname]."', charge='".$paycharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

$db->query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amount."', sig='+', typ='Payment For ".$_SESSION[xitemname]."', charge='".$reccharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


 echo "<center><br><br>
 <h4>You Send $amount $basecurrency to $_SESSION[xpaytoname]</h1> <h4> Transaction # $trx</h4> 
 <br><br></center>";



// ///--------------------------TRX

// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$ru = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'")->fetch();

$txt = "You Send $amount $basecurrency to $ru[0] $ru[1] ($ru[3]) . Transcetion # $trx";
abiremail($su[3], "Express Payment Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Payment Received From $su[0] $su[1] ($su[3]). Amount:  $amount $basecurrency . Transcetion # $trx";
abiremail($ru[3], "Express Payment Received", $ru[0], $txt);
abirsms($ru[2], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



echo "<br/><br/><a href=\"$_SESSION[xsuccessurl]\" class='btn btn-success btn-block'>BACK TO $_SESSION[xpaytoname]</a>";



//////////////////---------------RESPONSE
$cus = urlencode($_SESSION[xcustom]);
$datasss = "amount=$amount&paidby=$user&payto=$sendto&custom=$cus&trx=$trx&secret=$recdetails[3]";
$hit = "$_SESSION[xresponseurl]?$datasss";
$letshit = file_get_contents($hit);
}
}





}else{
?>
<form action="" method="post">
<strong style="text-transform: uppercase;">Pay  to</strong><br>
<input class="form-control input-lg" type="text" value="<?php echo $_SESSION['xpayto'] ?>" disabled="">

<br>
<strong style="text-transform: uppercase;">Amount</strong><br>
<div class="input-group mb15">
<input class="form-control input-lg" type="text" value="<?php echo $_SESSION['xamount'] ?>" disabled="">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>


<br>
<textarea class="form-control" rows="3" name="message" placeholder="Your Message (Optional)"></textarea>
<br>
<button type="submit" class="btn btn-success btn-lg btn-block uppercase">pay Now</button>
</form>
<?php
}
}
?>












</div>
</div>
</div>
</div>



</div>
</div>
</div>




</div><!-- row -->



























<?php
Include('include-footer.php');
?>
</body>
</html>