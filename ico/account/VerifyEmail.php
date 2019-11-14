<?php
Include('include-global.php');
$pagename = "Email Verification";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Verify Your Email To Use $basetitle";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-verify.php');

$verifyStat = $db->query("SELECT ev FROM users WHERE id='".$uid."'")->fetch();
if($verifyStat[0]!=0){
redirect("$baseurl/Dashboard");
}

?>



<div class="row">
<div class="col-md-12">


<?php 
if(isset($_POST['verify'])){

$code = trim($_POST["code"])=="" ? 0:$_POST["code"];

$original = $db->query("SELECT evcode FROM users WHERE id='".$uid."'")->fetch();
if($code==$original[0]){

$res = $db->query("UPDATE users SET ev='1', vsent='0' WHERE id='".$uid."'");
if ($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<strong>Account Verified Successfully!!!</strong>
</div>";

echo "<meta http-equiv=\"refresh\" content=\"3; url=$baseurl/Dashboard\" />";

///////////////////------------------------------------->>>>>>>>>Send EMAIL
$txt = "Your Email Verified Successfully on $basetitle Account.";
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
abiremail2($su[3], "$basetitle Email Verified Successfully", $su[0], $txt);
///////////////////------------------------------------->>>>>>>>>Send EMAIL 


}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<strong>Some Problem Occurs, Please Try Again. </strong>
</div>";	
}



}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<strong>WRONG CODE !!!</strong>
</div>";
}
}//post code



if(isset($_POST['again'])){

$lastsent = $db->query("SELECT vsent FROM users WHERE id='".$uid."'")->fetch();
$tmPass = $tm-$lastsent[0];

if ($tmPass>1000) {
$evcode = rand(100000,999999);
$res = $db->query("UPDATE users SET evcode='".$evcode."', vsent='".$tm."' WHERE id='".$uid."'");
if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<strong>CODE Sent Successfully!</strong>
</div>";

///////////////////------------------------------------->>>>>>>>>Send EMAIL
$txt = "Your $basetitle Verification Code is $evcode. Please Enter To Verify.";
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
abiremail2($su[3], "$basetitle Email Verification", $su[0], $txt);
///////////////////------------------------------------->>>>>>>>>Send EMAIL 
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<strong>Some Problem Occurs, Please Try Again. </strong>
</div>";
}
}else{

$ll = timeleft(1000-$tmPass);

echo "<div class=\"alert alert-danger alert-dismissable\"> 
PLEASE WAIT <b> $ll </b> TO SEND THE CODE AGAIN :) 
</div>";

}
}//post again

?>

</div>
</div>



<div class="row">
<div class="col-md-6 col-sm-12">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-check"></i> VERIFY NOW </div>
</div>

<div class="portlet-body">
  
<form action="" method="post">
<?php
echo "<strong style='text-transform: uppercase;'>Input The Code To Verify Your Account</strong>";
?> 
<br><br><input type="text" class="form-control input-lg"  name="code" placeholder="CODE" required><br>
<input type="hidden" name="verify" value="1">
<button type="submit" class="btn btn-success btn-block btn-lg">VERIFY ME</button><br>
</form>


</div>
</div>
</div>








<div class="col-md-6 col-sm-12">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase">
<i class="fa fa-repeat"></i> Request The Code </div>
</div>

<div class="portlet-body">
  
<form action="" method="post">
<?php
$num = $db->query("SELECT email FROM users WHERE id='".$uid."'")->fetch();
?> 

<strong class="uppercase text-center">Your Email Address</strong>

<input type="hidden" name="again" value="1">
<br><br><input type="text" disabled class="form-control input-lg"  value="<?php echo $num[0]; ?>" placeholder="Your Email"><br>
    <input type="hidden" name="num" value="<?php echo $num[0]; ?>" >
<button type="submit" class="btn btn-primary btn-block btn-lg">RE-SEND CODE TO ABOVE EMAIL</button><br>
</form>
</div>
</div>
</div>

</div>



<?php 
include('include-footer.php');
?>
</body>
</html>