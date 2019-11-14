<?php
Include('include-global.php');
$pagename = "Payment Preview";
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
<i class="fa fa-desktop"></i> PAYMENT PREVIEW </div>
</div>

<div class="portlet-body">


<?php 
if ($_POST) {
$sendto = $_POST["sendto"];
$amount = round($_POST["amount"], $baseDecimal);
$charge = isset($_POST['charge']) ? 1:0;
$message = $_POST["message"];


$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$sendto."'")->fetch();
if ($count[0]==0) {
echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">NO USER FOUND WITH THE EMAIL!</h1><br><br><br>';

}else{

if ($amount<=0) {

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">AMOUNT MUST BE A POSITIVE NUMBER!</h1><br><br><br>';

}else{


$todata = $db->query("SELECT firstname, lastname FROM users WHERE email='".$sendto."'")->fetch();

if ($charge==1) {
$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();

$per = $amount*$pkgdata[1]/100;
$chargeAmo = round($per+$pkgdata[0] , $baseDecimal);

}else{
  $chargeAmo = 0;
}

$gt = round($amount+$chargeAmo, $baseDecimal);
?>

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<tbody>


<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">To</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$todata[0] $todata[1] ($sendto)"; ?></strong></td>
</tr>

<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Message</strong> </td>
<td> <strong><?php echo "$message"; ?></strong></td>
</tr>


<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Amount</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$amount $basecurrency"; ?></strong></td>
</tr>

<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Charge</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$chargeAmo $basecurrency"; ?></strong></td>
</tr>


<tr class="info">
<td><strong style="font-size: 1.5em;" class="pull-right">TOTAL</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$gt $basecurrency"; ?></strong></td>
</tr>





</tbody>
</table>
</div>




  
<form action="<?php echo $baseurl;?>/Sent" method="post">

<input type="hidden" name="sendto" value="<?php echo $sendto; ?>">
<input type="hidden" name="amount" value="<?php echo $amount; ?>">
<input type="hidden" name="charge" value="<?php echo $charge; ?>">
<input type="hidden" name="message" value="<?php echo $message; ?>">

<div class="row"><br>
<br>
<div class="col-md-6">
<a href="<?php echo $baseurl;?>/SendMoney" class="btn btn-danger btn-lg btn-block"> CANCELL </a>
</div>

<div class="col-md-6">
<button type="submit" class="btn btn-success btn-lg btn-block"> SEND </button>
</div>
</div>

</form>

<?php 
}
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