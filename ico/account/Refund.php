<?php
Include('include-global.php');
$pagename = "Refund";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Refund A Transaction";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-repeat"></i> REFUND A TRANSACTION </div>
</div>

<div class="portlet-body">


<?php 

$gid = $_GET['id'];
$id = substr($gid, 4, -4);


$details = $db->query("SELECT who, byy, amount, sig, typ, charge, tm, trxid, msg, refund FROM trx WHERE id='".$id."'")->fetch();

$amo = $details[2]-$details[5];

if($details[0]!=$uid || $details[9]!=0){
echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>You Don't Have Permission For This Action Or You Already Refunded This !!</b>
</div>";
}else{




if ($_POST) {

$msg = $_POST['message'];

if($amo>$mallu){

echo "<div class=\"alert alert-danger alert-dismissable uppercase\"> 
<b>You Don't Have Enough Money in Your Account!</b>
</div>";
}else{

$newbal = $mallu-$amo;
$res = $db->query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");
if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<b>Refunded Successfully!</b>
</div>";

///--------------------------TRX
$trx = $details[7];

$recdetails = $db->query("SELECT id, firstname, mallu FROM users WHERE id='".$details[1]."'")->fetch();
$recnewbal = $recdetails[2]+$amo;


$db->query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amo."', sig='-', typ='Refund Send', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");

$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

$db->query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amo."', sig='+', typ='Refund Received', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");


$db->query("UPDATE trx SET refund='1' WHERE trxid='".$trx."'");

echo "<center><h1>You Refunded $amo $basecurrency to $recdetails[1]</h1> <p class='lead'> Transcetion # $trx</p><br/><br/></center>";



///--------------------------TRX

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$ru = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'")->fetch();

$txt = "You Refund $amo $basecurrency to $ru[0] $ru[1] ($ru[3]) . Transcetion # $trx";
abiremail($su[3], "Refund Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Refund Received From $su[0] $su[1] ($su[3]). Amount:  $amo $basecurrency . Transcetion # $trx";
abiremail($ru[3], "Refund Received", $ru[0], $txt);
abirsms($ru[2], $txt);

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

}else{
 echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}
}
echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/Activity" class="btn blue btn-lg btn-block"> ACTIVITY </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';

}else{


$todata = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$details[1]."'")->fetch();
echo "<h1 class='text-center'> You Are Refunding <strong> $amo $basecurrency </strong> to $todata[0] $todata[1] </h1>";
?>

<hr>
<form action="" method="post">

<div class="row">

<div class="col-md-8">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Refunding to</strong></label>
<div class="col-md-12">
<input type="email" class="form-control input-lg" value="<?php echo $todata[2]; ?>" disabled="">
<br>
<div id="sendtoerr"></div>

</div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Amount</strong></label>
<div class="col-md-12">

       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" value="<?php echo $amo; ?>" disabled="">
         <span class="input-group-addon"><?php echo $basecurrency; ?></span>
       </div>
</div>
</div>
</div>




</div><!-- row   -->


<div class="row">

<br>
<br>

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Message</strong></label>
<div class="col-md-12">

<textarea class="form-control" rows="3" name="message" placeholder="Your Message (Optional)"></textarea>

</div>
</div>
</div>


</div><!-- row   -->



<div class="row"><br>
<br>
<div class="col-md-6">
<a href="<?php echo $baseurl;?>/Dashboard" class="btn btn-danger btn-lg btn-block"> CANCELL </a>
</div>

<div class="col-md-6">
<button type="submit" class="btn btn-success btn-lg btn-block"> SEND </button>
</div>
</div>

</form>

<?php 
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