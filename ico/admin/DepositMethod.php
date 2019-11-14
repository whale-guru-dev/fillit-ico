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
<h3 class="page-title uppercase bold"> Deposit Method Setting</h3>
<hr>



<div class="row">
<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">

<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">
<div class="form-body">


<?php

$cc1 = $db->query("SELECT COUNT(*) FROM deposit_method WHERE id='1'")->fetch();
if ($cc1[0]==0) {
$db->query("INSERT INTO deposit_method SET id='1'");
}

$cc2 = $db->query("SELECT COUNT(*) FROM deposit_method WHERE id='2'")->fetch();
if ($cc2[0]==0) {
$db->query("INSERT INTO deposit_method SET id='2'");
}

$cc3 = $db->query("SELECT COUNT(*) FROM deposit_method WHERE id='3'")->fetch();
if ($cc3[0]==0) {
$db->query("INSERT INTO deposit_method SET id='3'");
}

$cc4 = $db->query("SELECT COUNT(*) FROM deposit_method WHERE id='4'")->fetch();
if ($cc4[0]==0) {
$db->query("INSERT INTO deposit_method SET id='4'");
}




if($_POST){

// POST THE DATA

$name1 = $_POST["name1"];
$min1 = $_POST["min1"];
$max1 = $_POST["max1"];
$cd1 = $_POST["cd1"];
$cp1 = $_POST["cp1"];
$rate1 = $_POST["rate1"];
$val11 = $_POST["val11"];
$st1 = isset($_POST["st1"])? 1:0;


/*
$min2 = $_POST["min2"];
$max2 = $_POST["max2"];
$cd2 = $_POST["cd2"];
$cp2 = $_POST["cp2"];
$rate2 = $_POST["rate2"];
$val21 = $_POST["val21"];
$val22 = $_POST["val22"];
$st2 = isset($_POST["st2"])? 1:0;
*/

$name3 = $_POST["name3"];
$min3 = $_POST["min3"];
$max3 = $_POST["max3"];
$cd3 = $_POST["cd3"];
$cp3 = $_POST["cp3"];
$rate3 = $_POST["rate3"];
$val31 = $_POST["val31"];
$val32 = $_POST["val32"];
$st3 = isset($_POST["st3"])? 1:0;


$name4 = $_POST["name4"];
$min4 = $_POST["min4"];
$max4 = $_POST["max4"];
$cd4 = $_POST["cd4"];
$cp4 = $_POST["cp4"];
$rate4 = $_POST["rate4"];
$val41 = $_POST["val41"];
$val42 = $_POST["val42"];
$st4 = isset($_POST["st4"])? 1:0;


// UPLOAD IMAGES
if (!empty($_FILES['img1']['name'])) {
$folder = "../assets/images/deposit-method/";
$new_name = "method1";
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['img1']['tmp_name'], $uploaddir);
}


if (!empty($_FILES['img2']['name'])) {
$folder = "../assets/images/deposit-method/";
$new_name = "method2";
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['img2']['tmp_name'], $uploaddir);
}


if (!empty($_FILES['img3']['name'])) {
$folder = "../assets/images/deposit-method/";
$new_name = "method3";
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['img3']['tmp_name'], $uploaddir);
}

if (!empty($_FILES['img4']['name'])) {
$folder = "../assets/images/deposit-method/";
$new_name = "method4";
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['img4']['tmp_name'], $uploaddir);
}

//---------->>>>>>>>>>>>>>>>>



$res1 = $db->query("UPDATE deposit_method SET name='".$name1."', minamo='".$min1."', maxamo='".$max1."', charged='".$cd1."', chargep='".$cp1."', rate='".$rate1."', val1='".$val11."', val2='".$val11."', status='".$st1."' WHERE id='1'");

//$res2 = $db->query("UPDATE deposit_method SET name='".$name2."', minamo='".$min2."', maxamo='".$max2."', charged='".$cd2."', chargep='".$cp2."', rate='".$rate2."', val1='".$val21."', val2='".$val22."', status='".$st2."' WHERE id='2'");

$res3 = $db->query("UPDATE deposit_method SET name='".$name3."', minamo='".$min3."', maxamo='".$max3."', charged='".$cd3."', chargep='".$cp3."', rate='".$rate3."', val1='".$val31."', val2='".$val32."', status='".$st3."' WHERE id='3'");

$res4 = $db->query("UPDATE deposit_method SET name='".$name4."', minamo='".$min4."', maxamo='".$max4."', charged='".$cd4."', chargep='".$cp4."', rate='".$rate4."', val1='".$val41."', val2='".$val42."', status='".$st4."' WHERE id='4'");



if($res1  && $res3 && $res4){
notification("UPDATED Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}


}//post


$old1 = $db->query("SELECT name, rate,  minamo, maxamo, charged, chargep, val1, val2, status FROM deposit_method WHERE id='1'")->fetch();
$old2 = $db->query("SELECT name, rate,  minamo, maxamo, charged, chargep, val1, val2, status FROM deposit_method WHERE id='2'")->fetch();
$old3 = $db->query("SELECT name, rate,  minamo, maxamo, charged, chargep, val1, val2, status FROM deposit_method WHERE id='3'")->fetch();
$old4 = $db->query("SELECT name, rate,  minamo, maxamo, charged, chargep, val1, val2, status FROM deposit_method WHERE id='4'")->fetch();


$st1 = $old1[8]==1 ? "checked" : "";
$st2 = $old2[8]==1 ? "checked" : "";
$st3 = $old3[8]==1 ? "checked" : "";
$st4 = $old4[8]==1 ? "checked" : "";

?>										

<div class="row">



<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">PayPal</h1>
</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
<div class="col-md-9">
<input name="img1" type="file">
<br> 
<b style="color: red;">Square Size(800X800) JPG image Recommended</b>
<br>
<br>
</div>
<div class="col-md-3">
<img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method1.jpg" alt="Display Image" style="width: 100%;">
</div>

</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name1" value="<?php echo $old1[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<span class="input-group-addon">1 EUR = </span>
<input class="form-control input-lg" name="rate1" value="<?php echo $old1[1]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>




<div class="panel panel-success">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="min1" value="<?php echo $old1[2]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="max1" value="<?php echo $old1[3]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>



<div class="panel panel-warning">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cd1" value="<?php echo $old1[4]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cp1" value="<?php echo $old1[5]; ?>" type="text">
<span class="input-group-addon"> % </span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>




<br>
<br>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PayPal Business Email</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val11" value="<?php echo $old1[6]; ?>" type="text">
</div>
</div>


<br>
<br>
<hr>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $st1; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="st1">
</div>
</div>




</div>
</div>
</div><!-- col-3 -->



<?php /*
<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Perfect Money</h1>
</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
<div class="col-md-9">
<input name="img2" type="file">
<br> 
<b style="color: red;">Square Size(800X800)  JPG image Recommended</b>
<br>
<br>
</div>
<div class="col-md-3">
<img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method2.jpg" alt="Display Image" style="width: 100%;">
</div>

</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name2" value="<?php echo $old2[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<span class="input-group-addon">1 EUR = </span>
<input class="form-control input-lg" name="rate2" value="<?php echo $old2[1]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>


<div class="panel panel-success">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="min2" value="<?php echo $old2[2]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="max2" value="<?php echo $old2[3]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>



<div class="panel panel-warning">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cd2" value="<?php echo $old2[4]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cp2" value="<?php echo $old2[5]; ?>" type="text">
<span class="input-group-addon"> % </span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>






<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PM EUR ACCOUNT</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val21" value="<?php echo $old2[6]; ?>" type="text">
</div>
</div>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Alternate Passphrase</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val22" value="<?php echo $old2[7]; ?>" type="text">
</div>
</div>

<hr>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $st2; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="st2">
</div>
</div>




</div>
</div>
</div><!-- col-3 -->

*/
?>

<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">BlockChain (BitCoin)</h1>
</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
<div class="col-md-9">
<input name="img3" type="file">
<br> 
<b style="color: red;">Square Size(800X800)  JPG image Recommended</b>
<br>
<br>
</div>
<div class="col-md-3">
<img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method3.jpg" alt="Display Image" style="width: 100%;">
</div>

</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name3" value="<?php echo $old3[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<span class="input-group-addon">1 EUR = </span>
<input class="form-control input-lg" name="rate3" value="<?php echo $old3[1]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>




<div class="panel panel-success">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="min3" value="<?php echo $old3[2]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="max3" value="<?php echo $old3[3]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>



<div class="panel panel-warning">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cd3" value="<?php echo $old3[4]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cp3" value="<?php echo $old3[5]; ?>" type="text">
<span class="input-group-addon"> % </span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>





<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">API KEY</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val31" value="<?php echo $old3[6]; ?>" type="text">
</div>
</div>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">XPub Code</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val32" value="<?php echo $old3[7]; ?>" type="text">
</div>
</div>


<hr>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $st3; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="st3">
</div>
</div>




</div>
</div>
</div><!-- col-3 -->





<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Stripe (Card)</h1>
</div>
<div class="panel-body">


<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
<div class="col-md-9">
<input name="img4" type="file">
<br> 
<b style="color: red;">Square Size(800X800)  JPG image Recommended</b>
<br>
<br>
</div>
<div class="col-md-3">
<img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method4.jpg" alt="Display Image" style="width: 100%;">
</div>

</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name4" value="<?php echo $old4[0]; ?>" type="text">
</div>
</div>



<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<span class="input-group-addon">1 EUR = </span>
<input class="form-control input-lg" name="rate4" value="<?php echo $old4[1]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>




<div class="panel panel-success">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="min4" value="<?php echo $old4[2]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="max4" value="<?php echo $old4[3]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>



<div class="panel panel-warning">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cd4" value="<?php echo $old4[4]; ?>" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="cp4" value="<?php echo $old4[5]; ?>" type="text">
<span class="input-group-addon"> % </span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>





<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">secret key</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val41" value="<?php echo $old4[6]; ?>" type="text">
</div>
</div>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">publishable key</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="val42" value="<?php echo $old4[7]; ?>" type="text">
</div>
</div>


<hr>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
<div class="col-md-12">
<input data-toggle="toggle" <?php echo $st4; ?> data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="st4">
</div>
</div>




</div>
</div>
</div><!-- col-3 -->



</div><!-- row -->





<br>
<br>
<br>

<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block btn-lg">UPDATE SETTING</button>
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