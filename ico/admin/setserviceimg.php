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
$new_name = "services-bg";
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////

}
?>

<div class="row">
<div class="col-md-4">




<div class="portlet box green">
<div class="portlet-title">
<div class="caption"><i class="fa fa-repeat"></i> CHANGE IMAGE</div>
</div>
<div class="portlet-body">

<form action="" method="post" enctype="multipart/form-data" >

<div class="row">

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">IMAGE</strong></label>
<div class="col-sm-12"><input name="bgimg" type="file" id="bgimg" /></div>
<input name="abir" type="hidden" value="bgimg" />
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


<div class="col-md-6 col-md-offset-2"> 
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption"><i class="fa fa-desktop"></i> CURRENT IMAGE</div>
</div>
<div class="portlet-body">
<img src="../assets/images/services-bg.JPG"  alt="IMG" style="width: 100%;">
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