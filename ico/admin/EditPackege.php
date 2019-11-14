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
<h3 class="page-title uppercase bold"> Edit Packege

<span class=" pull-right">
<a href="<?php echo $adminurl; ?>/AddPackege" class="btn btn-primary btn-md ">
<i class="fa fa-plus"></i>   ADD NEW
</a>

<a href="<?php echo $adminurl; ?>/Packege" class="btn btn-success btn-md">
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
$min = $_POST["min"];
$max = $_POST["max"];
$charged = $_POST["charged"];
$chargep = $_POST["chargep"];
$limit30 = $_POST["limit30"];



$err1=0;
$err2=0;
$err3=0;
$err4=0;
$err5=0;
$err6=0;
$err7=0;
$err8=0;

$err1 = trim($name)=="" ? 1:0;
$err2 = trim($min)=="" ? 1:0;
$err3 = trim($max)=="" ? 1:0;
$err4 = trim($charged)=="" ? 1:0;
$err5 = trim($chargep)=="" ? 1:0;
$err6 = trim($limit30)=="" ? 1:0;
$err7 = $chargep<0 ? 1:0;
$err8 = $charged<0 ? 1:0;

$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7+$err8;

if ($error == 0){
$res = $db->query("UPDATE packs SET name='".$name."', details='".$btext."', minamo='".$min."', maxamo='".$max."', charged='".$charged."', chargep='".$chargep."', limit30='".$limit30."' WHERE id='".$iidd."'");

if($res){
notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

} else {

if ($err1 == 1){
notification("Packege Name Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}    
if ($err2 == 1 || $err3 == 1 || $err6 == 1){
notification("Limiting Factors Are Required!", "Please Check..", "error", false, "btn-success", "OKAY");
}    
if ($err4 == 1 || $err5 == 1 ){
notification("Charges Are required!", "Please Check..", "error", false, "btn-success", "OKAY");
}

if ($err7 == 1 || $err8 == 1 ){
notification("Charges Can Not be Negative!", "Please Check..", "error", false, "btn-success", "OKAY");
}    

}


}//post


$old = $db->query("SELECT name, details, minamo, maxamo, limit30, charged, chargep FROM packs WHERE id='".$iidd."'")->fetch();


?>										

<div class="alert alert-info" style="text-transform: uppercase;">
	on limiting factor, <strong>-1</strong> mean no limit or Unlimited

</div>




<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Packege Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Details</strong></label>
<div class="col-md-12">
<textarea id="shaons" class="form-control" rows="3" name="btext"><?php echo $old[1]; ?></textarea>
</div>
</div>




<div class="row">


<div class="col-md-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="min" value="<?php echo $old[2]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="max" value="<?php echo $old[3]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd	 -->
</div>
</div>


</div><!-- col-6	 -->


<div class="col-md-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-5"> <br>
<div class="input-group mb15">
<input class="form-control input-lg" name="charged" value="<?php echo $old[5]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div><br>
</div>

<div class="col-md-2"><br><b class="btn btn-success btn-lg btn-block">AND</b><br></div>


<div class="col-md-5"><br>
<div class="input-group mb15">
<input class="form-control input-lg" name="chargep" value="<?php echo $old[6]; ?>"  type="text">
<span class="input-group-addon">%</span>
</div><br>
</div>  

</div><!-- row 2nd	 -->
</div>
</div>


</div>



</div>
                    
                                        



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Maximum Transaction limit per 30 Days</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="limit30" value="<?php echo $old[4]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>  


<br>
<br>
<br>

<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block btn-lg">UPDATE PACKEGE</button>
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