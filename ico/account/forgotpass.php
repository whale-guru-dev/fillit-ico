<?php
Include('include-global.php');
$pagename = "Forgot Password";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-nuser.php');
?>







<div class="row">
<div class="col-md-6 col-md-offset-3">

<div class="portlet light portlet-fit" style="margin-top: 40px;">


<div class="portlet-title">
<div class="caption">
<i class=" icon-layers font-green"></i>
<span class="caption-subject bold uppercase basecolor">Reset Account Password</span>
</div>
</div>


<div class="portlet-body">
<?php 
if ($_POST) {
$email = $_POST['email'];
$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$email."'")->fetch();

if ($count[0]==1) {

$rdata = $db->query("SELECT firstname, lastname, vsent, id FROM users WHERE email='".$email."'")->fetch();
$tmPass = time()-$rdata[2];
if ($tmPass>1000) {

$db->query("UPDATE users SET vsent='".$tm."' WHERE email='".$email."'");
$code = md5($email.$txn_id);
$db->query("INSERT INTO password_reset SET usid='".$rdata[3]."', code='".$code."'");


// ///////////////////------------------------------------->>>>>>>>>Send Email
$txt = "You requested for password reset. Please go to the below link to reset your password.<br><br>
<a href=\"$baseurl/ResetPassword/$code\">$baseurl/ResetPassword/$code</a>";
abiremail2($email, "PASSWORD RESET INFORMATION ", $rdata[0], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email


echo "<div class=\"alert alert-success alert-dismissable\">
<b>RESET INFORMATION SENT TO THE EMAIL.</b>
</div>";


}else{
$ll = timeleft(1000-$tmPass);
echo "<div class=\"alert alert-danger alert-dismissable\">
PLEASE WAIT <b> $ll </b> TO SEND THE RESET INFORMATION AGAIN :) 
</div>";
}

}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>NO ACCOUNT FOUND WITH THE EMAIL !!</b>
</div>";
}

}

?>
<form action="" method="post">
<h4 class="block">Email Address:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-envelope fa-2x"></i>
</span>
<input name="email" class="form-control input-lg" placeholder="Email Address" type="email" autocomplete="off" required=""> 
</div>
<br>
<br>
<button class="btn btn-primary btn-lg btn-block" type="submit">RESET NOW</button>
<br>
<br>




</form>




<p style="text-align: center; font-weight: bold; text-transform: uppercase;">
<a href="<?php echo $baseurl; ?>">Login</a> |  
<a href="<?php echo $baseurl; ?>/Register">Register</a> 
</p>




</div>
</div>


</div>
</div><!-- row -->

















<?php 
include('include-footer.php');
?>
</body>
</html>