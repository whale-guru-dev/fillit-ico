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

<h3 class="page-title uppercase bold"> Edit Menu

<span class=" pull-right">
<a href="<?php echo $adminurl; ?>/AddMenu" class="btn btn-primary btn-md ">
<i class="fa fa-plus"></i>   ADD NEW
</a>

<a href="<?php echo $adminurl; ?>/MenuManager" class="btn btn-success btn-md">
<i class="fa fa-list"></i>  VIEW ALL
</a>
</span>
</h3>

<hr>



<div class="row">
<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">

<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php

$iidd = $_GET["id"];

if($_POST){

$name = $_POST["name"];
$btext = $_POST["btext"];


$err1=0;
$err2=0;



$err1 = trim($name)=="" ? 1:0;


$error = $err1+$err2;


if ($error == 0){

$res = $db->query("UPDATE menus SET name='".$name."', btext='".$btext."' WHERE id='".$iidd."'");

if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

} else {

if ($err1 == 1){
notification("Menu Name Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}       

}	

}//post


$old = $db->query("SELECT name, btext FROM menus WHERE id='".$iidd."'")->fetch();
?>										



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Menu Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">CONTENT</strong></label>
<div class="col-md-12">
<textarea id="shaons" class="form-control" rows="10" name="btext"><?php echo $old[1]; ?></textarea>
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