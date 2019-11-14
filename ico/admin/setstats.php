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
<h3 class="page-title  uppercase bold"> <i class="fa fa-bar-chart"></i> Statistics Setting

<a href="http://fontawesome.io/icons/" target="_blank" class="btn btn-info pull-right">Font Awesome Icon Codes</a>


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

for ($i=1; $i < 5; $i++) { 

$icon = $_POST["icon$i"];
$btxt = $_POST["btxt$i"];
$stxt = $_POST["stxt$i"];

$db->query("UPDATE stats SET icon='".$icon."', btxt='".$btxt."', stxt='".$stxt."' WHERE id='".$i."'");

}

}
?>										



<div class="row">
	
<div class="col-md-3">
<b class="btn green btn-outline btn-lg btn-block sbold uppercase">Font Awesome Icon Code</b>
</div>
	
<div class="col-md-4">
<b class="btn green btn-outline btn-lg btn-block sbold uppercase">BOLD TEXT</b>
</div>

<div class="col-md-5">
<b class="btn green btn-outline btn-lg btn-block sbold uppercase">Small Text</b>
</div>


</div>



<?php 
for ($i=1; $i < 5; $i++) { 

$count = $db->query("SELECT COUNT(*) FROM stats WHERE id='".$i."'")->fetch();
if ($count[0]==0) {
 $db->query("INSERT INTO stats SET id='".$i."'");
}

$old = $db->query("SELECT icon, btxt, stxt FROM stats WHERE id='".$i."'")->fetch();
?>

<br><br>
<div class="row">

<div class="col-md-3">
<div class="input-group mb15">
<span class="input-group-addon">fa fa-</span>
<input class="form-control input-lg" name="icon<?php echo $i; ?>" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>
	
<div class="col-md-4">
<input class="form-control input-lg" name="btxt<?php echo $i; ?>" value="<?php echo $old[1]; ?>" type="text">
</div>

<div class="col-md-5">
<input class="form-control input-lg" name="stxt<?php echo $i; ?>" value="<?php echo $old[2]; ?>" type="text">
</div>

</div>

<?php 
}
 ?>





<br><br>

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