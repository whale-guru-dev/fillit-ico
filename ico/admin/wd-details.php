<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');

$id = $_GET['id'];
$count = $db->query("SELECT COUNT(*) FROM wd WHERE id='".$id."'")->fetch();
?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> Withdraw Details</h3>
<hr>


<div class="row">
<?php 
if ($count[0]==0) {
	echo "<h1 class='text-center'> NO RESULT FOUND !</h1>";
}else{

$data = $db->query("SELECT id, method, usr, amount, charge, tm, details, msg, status, trx FROM wd WHERE id='".$id."'")->fetch();
$UserDetails = $db->query("SELECT firstname, lastname, email, mobile FROM users WHERE id='".$data[2]."'")->fetch();
$method = $db->query("SELECT name FROM wd_method WHERE id='".$data[1]."'")->fetch();
$dt = date("dS F Y - h:i A ", $data[5]);


if ($_POST){
$wddetails = $_POST['wddetails'];
$status = $_POST['val'];

if ($data[8]==0) {


if ($status==1) {
$res = $db->query("UPDATE wd SET status='".$status."', wddetails='".$wddetails."' WHERE id='".$id."'");
if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$txt = "Your Withdraw Request Of $data[3]  $basecurrency via $method[0] has been Processed";
$mailtxt = "Your Withdraw Request Of $data[3]  $basecurrency via $method[0] has been Processed <br><br> $wddetails";
abiremail($UserDetails[2], "Withdraw Processed", $UserDetails[0], $mailtxt);
abirsms($UserDetails[3], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

}else{

$res = $db->query("UPDATE wd SET status='".$status."', wddetails='".$wddetails."' WHERE id='".$id."'");
if($res){
notification("Refunded Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$txt = "Your Withdraw Request Of $data[3]  $basecurrency via $method[0] has been Refunded";
$mailtxt = "Your Withdraw Request Of $data[3]  $basecurrency via $method[0] has been Refunded <br><br> $wddetails";
abiremail($UserDetails[2], "Withdraw Refunded", $UserDetails[0], $mailtxt);
abirsms($UserDetails[3], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


////##################### REFUND

$recdetails = $db->query("SELECT mallu FROM users WHERE id='".$data[2]."'")->fetch();
$recnewbal = $recdetails[0]+$data[3];
$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$data[2]."'");
$db->query("INSERT INTO trx SET who='".$data[2]."', byy='0', amount='".$data[3]."', sig='+', typ='Refund Of Withdraw', charge='0', tm='".$tm."', trxid='".$data[9]."', msg='', refund='8'");


$recdetails = $db->query("SELECT mallu FROM users WHERE id='".$data[2]."'")->fetch();
$recnewbal = $recdetails[0]+$data[4];
$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$data[2]."'");
$db->query("INSERT INTO trx SET who='".$data[2]."', byy='0', amount='".$data[4]."', sig='+', typ='Fee Revarsal Of Withdraw', charge='0', tm='".$tm."', trxid='".$data[9]."', msg='', refund='8'");

////##################### REFUND
}

}else{
notification("You Already Take Action", "", "error", false, "btn-success", "OKAY");
}


}//post

$data = $db->query("SELECT id, method, usr, amount, charge, tm, details, msg, status, trx, wddetails FROM wd WHERE id='".$id."'")->fetch();

if ($data[8]==0) {
$cls="warning";
$st = "PENDING";
}

if ($data[8]==1) {
$cls="success";
$st = "PROCESSED";
}

if ($data[8]==2) {
$cls="danger";
$st = "REFUNDED";
}

?>




<div class="col-md-6">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-upload"></i> Withdraw Request </div>
</div>
<div class="portlet-body">

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<tbody>


<tr class='bold'>
<td> Requested By </td>
<td>
<a href='<?php echo "$adminurl/UserDetails/$data[2]"; ?>'> <?php echo "$UserDetails[0] $UserDetails[1]" ;?></a>
( <i><?php echo "$UserDetails[2]" ;?></i> )
</td>
</tr>

<tr class='bold'>
<td> Requested On </td>
<td><?php echo "$dt" ;?></td>
</tr>

<tr class='bold'>
<td> Transaction # </td>
<td><?php echo "$data[9]" ;?></td>
</tr>

<tr class='bold'>
<td> Method </td>
<td><?php echo "$method[0]" ;?></td>
</tr>

<tr class='bold'>
<td> Amount </td>
<td><?php echo "$data[3]  $basecurrency" ;?></td>
</tr>

<tr class='bold'>
<td> Charge </td>
<td><?php echo "$data[4]  $basecurrency" ;?></td>
</tr>

<tr class='bold'>
<td> Status </td>
<td><button class="btn btn-<?php echo $cls;?>"> <?php echo $st;?></button>
</td>
</tr>


<tr class='bold'>
<td> Details </td>
<td><?php echo "$data[6]" ;?></td>
</td>
</tr>

<tr class='bold'>
<td> Message </td>
<td><?php echo "$data[7]" ;?></td>
</td>
</tr>



</tbody>
</table>
</div>

<i style="color: red;"> *** Charge Already taken. Send <strong><?php echo "$data[3]  $basecurrency" ;?></strong> To The User</i>

</div>
</div>
</div>


<div class="col-md-6">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-cogs"></i> Take Action </div>
</div>
<div class="portlet-body">

<form action="" method="post">
<strong style="text-transform: uppercase;">Message or Reason</strong><br><br>
<textarea name="wddetails" id="shaons" class="form-control" rows="10"><?php echo "$data[10]" ;?></textarea>

<br>
<br>

<div class="row">
	<div class="col-md-6">
		<button type="submit" name="val" value="1" class="btn blue btn-block btn-lg">PROCESSED</button>
	</div>
	<div class="col-md-6">
		<button type="submit" name="val" value="2" class="btn red btn-block btn-lg">REFUND</button>
	</div>
</div>






</form>








</div>
</div>
</div>

<?php 
}
?>
</div><!-- row -->




</div>
</div>


<?php
include ('include/footer.php');
?>
</body>
</html>