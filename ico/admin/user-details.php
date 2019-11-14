<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');

$id = $_GET['id'];

$count = $db->query("SELECT COUNT(*) FROM users WHERE id='".$id."'")->fetch();


?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> USER Details</h3>
<hr>


<div class="row">
<?php 
if ($count[0]==0) {
	echo "<h1 class='text-center'> NO RESULT FOUND !</h1>";
}else{


if ($_POST) {

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$location = $_POST['location'];
$pkg = $_POST['pkg'];
//$api = $_POST['api'];


$block = isset($_POST["block"])? 0:1;
$ev = isset($_POST["ev"])? 1:0;
$mv = isset($_POST["mv"])? 1:0;


    if(filter_var($_POST['ref_by'], FILTER_VALIDATE_EMAIL)){
        $dxa = $db->query("SELECT ref_id FROM users WHERE email='".$_POST['ref_by']."'")->fetch();
    }else {
        $dxa = array($_POST['ref_by']);
    }


$res =  $db->query("UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', mobile='".$mobile."', dob='".$dob."',  gender='".$gender."',  location='".$location."',  email='".$pkg."',  block='".$block."',  ev='".$ev."',  mv='".$mv."', ref_by='".$dxa[0]."' WHERE id='".$id."'");

if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}


}//post

$data = $db->query("SELECT * FROM users WHERE id='".$id."'")->fetch();
$login = $db->query("SELECT ip, location, ua, tm FROM logins WHERE usid='".$id."' ORDER BY id DESC")->fetch();


$bst = $data['block']==0 ? "checked" : "";
$evst = $data['ev']==1 ? "checked" : "";
$mvst = $data['mv']==1 ? "checked" : "";


?>

<div class="col-md-3">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-user"></i> PROFILE </div>
</div>
<div class="portlet-body text-center">
<img src="<?php echo "$fronturl/propic/$data[propic]"; ?>" class="img-responsive propic" alt="Profile Pic"> 
<h2 class="bold"><?php echo "$data[firstname] $data[lastname]" ; ?></h2>
<h3><?php echo "$data[email]"; ?></h3>
<h3 class="bold">BALANCE : <?php echo "$data[mallu]  $basecurrency"; ?></h3>
<br><hr><br>
<p class="bold">Active <?php echo timeago($tm-$data['last']); ?></p>
<br><hr><br>
<p>
<strong>Last Login From</strong> <br> <?php echo "$login[0] - $login[1]"; ?> <br> Using <?php echo "$login[2] "; ?>
<br>
<i class="bold"><?php echo timeago($tm-$login[3]); ?></i>
</p>

</div>
</div>
</div>


<div class="col-md-9">
<div class="row">



<div class="col-md-12">
<div class="portlet box purple">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-desktop"></i> Details </div>
</div>
<div class="portlet-body">

<?php 
$numtrx =  $db->query("SELECT COUNT(*) FROM trx WHERE who='".$id."'")->fetch();
$amounttrx =  $db->query("SELECT SUM(amount) FROM trx WHERE who='".$id."'")->fetch();
?>


<div class="row">


<!-- START -->
<a href="<?php echo "$adminurl/UsersTrx/$id"; ?>">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat blue">
<div class="visual">
<i class="fa fa-th"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numtrx[0]; ?>"><?php echo $numtrx[0]; ?></span>
</div>
<div class="desc uppercase"> TRANSACTIONS </div>
</div>
<div class="more">
<div class="desc uppercase bold text-center"> 
<?php echo $basecur; ?> 
<span data-counter="counterup" data-value="<?php echo round($amounttrx[0] , $baseDecimal); ?>"><?php echo round($amounttrx[0] , $baseDecimal); ?></span> TRANSACTED
</div>
</div>
</div>
</div>
</a>
<!-- END -->
<?php 
$numdeposit =  $db->query("SELECT COUNT(*) FROM deposit_data WHERE status='1' AND usid='".$id."'")->fetch();
$amountdeposit =  $db->query("SELECT SUM(amount) FROM deposit_data WHERE status='1' AND usid='".$id."'")->fetch();

$xxa =  $db->query("SELECT ref_id FROM users WHERE id='".$id."'")->fetch();

$numdeposita =  $db->query("SELECT COUNT(*) FROM users WHERE ref_by='".$xxa[0]."'")->fetch();

?>

<!-- START -->
<a href="<?php echo "$adminurl/UsersReferral/$id"; ?>">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-download"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numdeposita[0]; ?>"><?php echo $numdeposita[0]; ?></span>
</div>
<div class="desc uppercase"> Referrals </div>
</div>
<div class="more">
<div class="desc uppercase bold text-center"> 

<span data-counter="counterup" data-value="<?php echo $numdeposita[0];  ?>"><?php echo $numdeposita[0]; ?></span> Total
</div>
</div>
</div>
</div>
</a>
<!-- END -->

<?php 
$numwd =  $db->query("SELECT COUNT(*) FROM wd WHERE usr='".$id."'")->fetch();
$amountwd =  $db->query("SELECT SUM(amount) FROM wd WHERE status='1' AND usr='".$id."'")->fetch();
?>
<!-- START -->
<a href="<?php echo "$adminurl/UsersWithdraw/$id"; ?>">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat red">
<div class="visual">
<i class="fa fa-upload"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numwd[0]; ?>"><?php echo $numwd[0]; ?></span>
</div>
<div class="desc uppercase"> WITHDRAW  Request</div>
</div>
<div class="more">
<div class="desc uppercase bold text-center"> 
<?php echo $basecur; ?> 
<span data-counter="counterup" data-value="<?php echo round($amountwd[0] , $baseDecimal); ?>"><?php echo round($amountwd[0] , $baseDecimal); ?></span> WITHDRAWN
</div>
</div>
</div>
</div>
</a>
<!-- END -->
<?php 
$numlogin =  $db->query("SELECT COUNT(*) FROM logins WHERE usid='".$id."'")->fetch();
?>
<!-- START -->
<a href="<?php echo "$adminurl/UsersLogins/$id"; ?>">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-sign-in"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numlogin[0]; ?>"><?php echo $numlogin[0]; ?></span>
</div>
<div class="desc uppercase"> LOGINS</div>
</div>
<div class="more">
<div class="desc uppercase bold text-center"> 
view details
</div>
</div>
</div>
</div>
</a>
<!-- END -->



</div>

</div>
</div>
</div>




<div class="col-md-12">
<div class="portlet box blue-ebonyclay">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-cogs"></i> Operations </div>
</div>
<div class="portlet-body">
<div class="row">

<div class="col-md-6 uppercase">
	<a href="<?php echo "$adminurl/BalanceUser/$id"; ?>" class="btn btn-primary btn-lg btn-block"> <i class="fa fa-money"></i> add / substruct balance  </a>
</div>

<div class="col-md-3 uppercase">
	<a href="<?php echo "$adminurl/SMStoUser/$id"; ?>" class="btn btn-success btn-lg btn-block"> <i class="fa fa-envelope"></i> send SMS  </a>
</div>

    <div class="col-md-3 uppercase">
        <a href="<?php echo "$adminurl/EMAILtoUser/$id"; ?>" class="btn btn-success btn-lg btn-block"> <i class="fa fa-envelope"></i> send EMAIL  </a>
    </div>


</div>
</div>
</div>
</div>





<div class="col-md-12">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-cog"></i> Update Profile </div>
</div>
<div class="portlet-body">

<form action="" method="post">
	




<div class="row uppercase">

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>firstname</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="firstname" value="<?php echo $data['firstname']; ?>" type="text">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>lastname</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="lastname" value="<?php echo $data['lastname']; ?>" type="text">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>mobile</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="mobile" value="<?php echo $data['mobile']; ?>" type="text">
</div>
</div>
</div>


</div><!-- row -->

<br><br>


<div class="row uppercase">




<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>Date of birth</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="dob" value="<?php echo $data['dob']; ?>" type="text">
</div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>gender</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="gender" value="<?php echo $data['gender']; ?>" type="text">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>Country</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="location" value="<?php echo $data['location']; ?>" type="text">
</div>
</div>
</div>


</div><!-- row -->

<br><br>

<div class="row uppercase">


<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>STATUS</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $bst; ?> data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="Blocked"  data-width="100%" type="checkbox" name="block">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>EMAIL VERIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $evst; ?> data-onstyle="success" data-offstyle="danger" data-on="Verified" data-off="Not Verified"  data-width="100%" type="checkbox" name="ev">
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong>SMS VERIFICATION</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $mvst; ?> data-onstyle="success" data-offstyle="danger" data-on="Verified" data-off="Not Verified"  data-width="100%" type="checkbox" name="mv">
</div>
</div>
</div>

</div><!-- row -->

<br><br>

<div class="row uppercase">


<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong>E-mail</strong></label>
<div class="col-md-12">
<input type="text" name="pkg" class="form-control input-lg" value="<?php echo $data['email']; ?>">

</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong>Referred by(email converts to ref code)</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="ref_by" placeholder="input referred by email" value="<?php echo $data['ref_by']; ?>" type="text">
</div>
</div>
</div>


</div><!-- row -->

<br><br>

<div class="row">
<div class="col-md-12">
    <?php
    if ($mypower==100) {

        ?>

<button type="submit" class="btn blue btn-block btn-lg">UPDATE</button>
    <?php } ?>
</div>
</div>




</form>


</div>
</div>
</div>



</div>
</div><!-- col-9 -->



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