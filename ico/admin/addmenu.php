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
<h3 class="page-title uppercase bold"> Add New Menu
<a href="<?php echo $adminurl; ?>/MenuManager" class="btn btn-success btn-md pull-right">
<i class="fa fa-list"></i>  VIEW ALL</a>
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
if($_POST){

$name = $_POST["name"];
$btext = $_POST["btext"];

$err1=0;
$err2=0;

$err1 = trim($name)=="" ? 1:0;

$error = $err1+$err2;

if ($error == 0){
$res = $db->query("INSERT INTO menus SET name='".$name."', btext='".$btext."'");


if($res){
notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

} else {

if ($err1 == 1){
notification("Menu Name Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}    

}


}//post

?>										


<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Menu Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name" placeholder="" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">CONTENT</strong></label>
<div class="col-md-12">
<textarea id="shaons" class="form-control" rows="10" name="btext"></textarea>
</div>
</div>

<br>
<br>
<br>

<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block btn-lg">ADD MENU</button>
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