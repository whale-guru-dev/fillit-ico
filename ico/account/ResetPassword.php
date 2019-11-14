<?php
Include('include-global.php');
$pagename = "Reset Password";
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
$code = $_GET['code'];
$count = $db->query("SELECT COUNT(*) FROM password_reset WHERE code='".$code."' AND status='0'")->fetch();

if ($count[0]==1) {


if ($_POST) {
$password = $_POST['password'];
$rdata = $db->query("SELECT usid FROM password_reset WHERE code='".$code."' AND status='0'")->fetch();
$newpass = md5($password);

$db->query("UPDATE password_reset SET status='1' WHERE code='".$code."'");
$db->query("UPDATE users SET password='".$newpass."', vsent='0' WHERE id='".$rdata[0]."'");

echo "<div class=\"alert alert-success alert-dismissable\">
<b>PASSWORD RESET SUCCESSFULLY !!</b>
</div>";

}

}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>WRONG URL OR CODE MAY EXPIRE !!</b>
</div>";
}
?>

<form action="" method="post">
<h4 class="block">New Password:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
<input name="password" class="form-control input-lg" placeholder="New Password" type="password" autocomplete="off" required=""> 
</div>
<br>
<br>
<button class="btn btn-primary btn-lg btn-block" type="submit">UPDATE PASSWORD</button>
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