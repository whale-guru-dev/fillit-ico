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
<h3 class="page-title uppercase bold"> Profile Management</h3>
<hr>

<div class="row">
<div class="col-md-12">


<div class="portlet light bordered">
<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php
if($_POST){

$name = $_POST["name"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];

$res = $db->query("UPDATE admin SET fullname='".$name."', email='".$email."', mobile='".$mobile."' WHERE id='".$uid."'");

if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

}

$old =  $db->query("SELECT fullname, email, mobile FROM admin WHERE id='".$uid."'")->fetch();
?>									






<div class="form-group">
<label class="col-md-3 control-label"><strong>FULL NAME</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" placeholder="Your Full Name" type="text" required="">
</div>
</div>



<div class="form-group">
<label class="col-md-3 control-label"><strong>EMAIL</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="email" value="<?php echo $old[1]; ?>" placeholder="Your Email" type="email" required="">
</div>
</div>



<div class="form-group">
<label class="col-md-3 control-label"><strong>MOBILE</strong></label>
<div class="col-md-6">
<input class="form-control input-lg" name="mobile" value="<?php echo $old[2]; ?>" placeholder="Your Mobile Number" type="text" required="">
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