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
<h3 class="page-title  uppercase bold"> Logo and Icon Setting</h3>
<hr>

<?php

if($_POST)
{

// IMAGE UPLOAD //////////////////////////////////////////////////////////
$folder = "../assets/images/";
$extention = strrchr($_FILES['bgimg']['name'], ".");
$new_name = "logo";
$bgimg = $new_name.'.png';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////

// IMAGE UPLOAD //////////////////////////////////////////////////////////
$folder = "../assets/images/";
$extention = strrchr($_FILES['bgimg2']['name'], ".");
$new_name = "favicon";
$bgimg2 = $new_name.'.png';
$uploaddir = $folder . $bgimg2;
move_uploaded_file($_FILES['bgimg2']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////


}
?>

<div class="row">
<div class="col-md-4">




<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="fa fa-repeat"></i> CHANGE IMAGES</div>
</div>
<div class="portlet-body">

<form action="" method="post" enctype="multipart/form-data" >

<div class="row">

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">logo</strong></label>
<div class="col-sm-12"><input name="bgimg" type="file" id="bgimg" /></div>
<input name="abir" type="hidden" value="bgimg" />
<br>
<br>
</div>
<br>
<br>
<br>

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">favicon</strong></label>
<div class="col-sm-12"><input name="bgimg2" type="file" id="bgimg" /></div>
<br>
<br>
</div>
<br>
<br>
<br>

<div class="form-group">
<div class="col-sm-12"> <button type="submit" class="btn btn-primary btn-block">UPLOAD</button></div>
</div>

</div>

</form>

</div>
</div>
</div>


<div class="col-md-4"> 
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption"><i class="fa fa-desktop"></i> CURRENT ICON</div>
</div>
<div class="portlet-body">
<img src="../assets/images/favicon.png"  alt="icon" style="width: 100%;">
</div>
</div>
</div>


<div class="col-md-4"> 
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption"><i class="fa fa-desktop"></i> CURRENT LOGO</div>
</div>
<div class="portlet-body">
<img src="../assets/images/logo.png"  alt="LOGO" style="width: 100%;">
</div>
</div>
</div>



</div>

</div>
</div>
<?php
include ('include/footer.php');
?>


</body>
</html>