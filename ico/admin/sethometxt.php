<?php
include ('include/header.php');
if ($mypower<100) {
redirect("$adminurl/Dashboard");
}
$id = $_GET['id'];

$count = $db->query("SELECT COUNT(*) FROM home_text WHERE id='".$id."'")->fetch();
if ($count[0]==0) {
$db->query("INSERT INTO home_text SET id='".$id."'")->fetch();
}

if ($id==4) {
$headtxt = "set Footer text";
}else{
$headtxt = "set home text - Section $id";
}
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>
<div class="page-content-wrapper">
<div class="page-content">

<h3 class="page-title uppercase bold"><?php echo $headtxt; ?></h3>

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
$err1 = trim($name)=="" ? 1:0;
$error = $err1;

if ($error == 0){

$res = $db->query("UPDATE home_text SET heading='".$name."', btxt='".$btext."' WHERE id='".$id."'");

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


$old = $db->query("SELECT heading, btxt FROM home_text WHERE id='".$id."'")->fetch();
?>										



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">HEADING</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">TEXT</strong></label>
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