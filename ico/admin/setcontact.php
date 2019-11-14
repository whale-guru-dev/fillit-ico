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
<h3 class="page-title uppercase bold"> Contact Setting</h3>
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

$cemail = $_POST["cemail"];
$cmobile = $_POST["cmobile"];
$clocation = $_POST["clocation"];

$res =  $db->query("UPDATE general_setting SET cemail='".$cemail."', cmobile='".$cmobile."', clocation='".$clocation."' WHERE id='1'");

if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}



} //post

$old = $db->query("SELECT cemail, cmobile, clocation FROM general_setting WHERE id='1'")->fetch();

?>										






<div class="form-group">
<label class="col-md-12 "><strong style="text-transform: uppercase;">EMAIL</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="cemail" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>

<br>
<br>
<br>




<div class="form-group">
<label class="col-md-12 "><strong style="text-transform: uppercase;">mobile</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="cmobile" value="<?php echo $old[1]; ?>" type="text">
</div>
</div>

<br>
<br>
<br>




<div class="form-group">
<label class="col-md-12 "><strong style="text-transform: uppercase;">location</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="clocation" value="<?php echo $old[2]; ?>" type="text">
</div>
</div>

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