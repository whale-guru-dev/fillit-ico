<?php
Include('include-global.php');
$pagename = "Change Password";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Change Password of $basetitle Account";
?>

<style>
.propic{
    float: none;
    margin: 0 auto;
    width: 50%;
    height: 50%;
    -webkit-border-radius: 50% !important;
    -moz-border-radius: 50% !important;
    border-radius: 50% !important;
}

</style>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');

if ($_POST) {


$cpass = $_POST["cpass"];
$password = $_POST["password"];
$password2 = $_POST["password2"];


$err1 = $password!=$password2 ? 1:0;
$err2 = strlen($password)<=7 ? 1:0;
$err3 = strlen($password2)<=7 ? 1:0;


$oldmd = MD5($cpass);
$cpass = $db->query("SELECT password FROM users WHERE id='".$uid."'")->fetch();
$err4 = $cpass[0]!=$oldmd ? 1:0;



$error = $err1+$err2+$err3+$err4;

if ($error == 0){

$passmd = MD5($password);
$res = $db->query("UPDATE users SET password='".$passmd."' WHERE id='".$uid."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Updated Successfully!
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}
} else {
  




 
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Password and Confirm Password not match!!!
</div>";
}   
   

  
if ($err2 == 1 || $err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Password must be minimum 8 Char!!!
</div>";
}   
  





if ($err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Current Password Not Match !!
</div>";
}   

}
}



$data = $db->query("SELECT * FROM users WHERE id='".$uid."'")->fetch();
?>

<div class="row">


<div class="col-md-5">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-user"></i> PROFILE </div>
</div>
<div class="portlet-body text-center">



<img src="<?php echo $fronturl; ?>/propic/<?php echo $data['propic']; ?>" class="img-responsive propic" alt="Profile Pic"> 


<h2 class="bold"><?php echo "$data[firstname] $data[lastname]"; ?></h2>
<h3><?php echo "$data[mobile]"; ?></h3>
<h3><?php echo "$data[email]"; ?></h3>
</div>
</div>

</div>



<div class="col-md-7">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-cog"></i> CHANGE PASSWORD</div>
</div>
<div class="portlet-body">






<form action="" method="post">
	


<h4 class="bold">Current Password:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
 <input name="cpass" class="form-control input-lg" type="password" required="">
</div>

<br>

<h4 class="bold">Create New Password:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
 <input name="password" class="form-control input-lg" type="password" required="">
</div>

<br>

<h4 class="bold">Confirm New Password:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
<input name="password2" class="form-control input-lg" type="password" required="">
</div>




<br><br>
<button type="submit" class="btn btn-success btn-lg btn-block">UPDATE</button>



</form>

</div>
</div>

</div>


</div><!-- row -->





<?php 
include('include-footer.php');
?>
</body>
</html>