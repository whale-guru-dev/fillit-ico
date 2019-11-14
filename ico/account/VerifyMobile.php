<?php
Include('include-global.php');
$pagename = "Mobile Verification";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Verify Your Mobile Number To Use $basetitle";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-verify.php');

$verifyStat = $db->query("SELECT mv FROM users WHERE id='".$uid."'")->fetch();
if($verifyStat[0]!=0){
redirect("$baseurl/Dashboard");
}

?>



<div class="row">
<div class="col-md-12">


<?php 
if(isset($_POST['verify'])){

$code = trim($_POST["code"])=="" ? 0:$_POST["code"];

$original = $db->query("SELECT mvcode FROM users WHERE id='".$uid."'")->fetch();
if($code==$original[0]){

$res = $db->query("UPDATE users SET mv='1', vsent='0' WHERE id='".$uid."'");
if ($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<strong>Account Verified Successfully!!!</strong>
</div>";

echo "<meta http-equiv=\"refresh\" content=\"3; url=$baseurl/Dashboard\" />";

///////////////////------------------------------------->>>>>>>>>Send SMS
$deta = $db->query("SELECT mobile FROM users WHERE id='".$uid."'")->fetch();
$txt = "Your Mobile Number Verified Successfully on $basetitle Account.";
abirsms($deta[0], $txt);
///////////////////------------------------------------->>>>>>>>>Send SMS 

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
$num = $_POST["num"];
$exist = $db->query("SELECT COUNT(*) FROM users WHERE mobile='".$num."' AND id<>$uid")->fetch();

if($exist[0]!=0){
echo "<div class=\"alert alert-danger alert-dismissable\"> 
<strong>Mobile Number Already Exist in our Database... Please Use another Mobile Number!!</strong>
</div>";
}else{
$lastsent = $db->query("SELECT vsent FROM users WHERE id='".$uid."'")->fetch();
$tmPass = $tm-$lastsent[0];

if ($tmPass>1000) {
$mvcode = rand(100000,999999);
$res = $db->query("UPDATE users SET mvcode='".$mvcode."', mobile='".$num."' , vsent='".$tm."' WHERE id='".$uid."'");
if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
<strong>CODE Sent Successfully To $num !</strong>
</div>";

///////////////////------------------------------------->>>>>>>>>Send SMS
$txt = "Your $basetitle Verification Code is $mvcode. Please Enter To Verify.";
abirsms2($num, $txt);
///////////////////------------------------------------->>>>>>>>>Send SMS 
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
$num = $db->query("SELECT mobile FROM users WHERE id='".$uid."'")->fetch();
?> 

<strong class="uppercase text-center">Your Mobile Number</strong>

<span> ( With COUNTRY CODE, Only Number and No Space )</span>

<input type="hidden" name="again" value="1">
<br><br><input type="text" disabled class="form-control input-lg" value="<?php echo $num[0]; ?>" placeholder="Your Mobile" required><br>
    <input type="hidden" name="num" value="<?php echo $num[0]; ?>">
<button type="submit" class="btn btn-primary btn-block btn-lg">RE-SEND CODE TO ABOVE MOBILE NUMBER</button><br>
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