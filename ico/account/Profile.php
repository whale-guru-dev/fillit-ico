<?php
Include('include-global.php');
$pagename = "Profile";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Your $basetitle Profile";
?>

<style>
.propic{
    float: none;
    margin: 0 auto;
    width: 50%;
    height: 50%;
    -webkit-border-radius: 50% !important;
    -moz-border-radius: 50% !important;
    border-radius: 50% !important;
}

</style>
<link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/filestyle.css" type="text/css" />
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');

if ($_POST) {

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$err1 = trim($firstname)=="" ? 1:0;
$err2 = trim($lastname)=="" ? 1:0;
$err3 = 0;


// IMAGE UPLOAD //////////////////////////////////////////////////////////

if (empty($_FILES['img']['name'])) {
$data = $db->query("SELECT * FROM users WHERE id='".$uid."'")->fetch();
	$img = $data['propic'];

}else{

    $folder = "../propic/";
    $extention = strrchr($_FILES['img']['name'], ".");
	$ex = strtoupper($extention);

if ($ex==".JPG" || $ex==".JPEG") {
    $new_name = $txn_id.rand(100000,999999);
    $img = $new_name.$extention;
    $uploaddir = $folder . $img;
move_uploaded_file($_FILES['img']['tmp_name'], $uploaddir);


//------------------>>> RESIZE
include_once("abirimageclass.php");
$target_file = $folder.$img;
$resized_file = $folder.$img;
$wmax = 800;
$hmax = 800;
$ext = ".jpg";
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $ext);



}else{
$err3 = 1;
}
}
// //////////////////////////////////////////////////////////////////////////



$error = $err1+$err2+$err3;

if ($error == 0){

$res = $db->query("UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', propic='".$img."' WHERE id='".$uid."'");


if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Updated Successfully!
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}
} else {
  

if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
First Name Can Not be Empty!!!
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Last Name Can Not be Empty!!!
</div>";
}   

if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Only Jpg Image Allowed !!
</div>";
}   

}
}



$data = $db->query("SELECT * FROM users WHERE id='".$uid."'")->fetch();
?>

<div class="row">


<div class="col-md-5">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-user"></i> PROFILE </div>
</div>
<div class="portlet-body text-center">



<img src="<?php echo $fronturl; ?>/propic/<?php echo $data['propic']; ?>" class="img-responsive propic" alt="Profile Pic"> 


<h2 class="bold"><?php echo "$data[firstname] $data[lastname]"; ?></h2>
<h3><?php echo "$data[mobile]"; ?></h3>
<h3><?php echo "$data[email]"; ?></h3>
</div>
</div>

</div>



<div class="col-md-7">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-user"></i> UPDATE PROFILE </div>
</div>
<div class="portlet-body">






<form action="" method="post" enctype="multipart/form-data" >
	

<h4 class="bold">First Name:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-address-card"></i>
</span>
<input name="firstname" class="form-control input-lg" placeholder="First Name" type="text" value="<?php echo "$data[firstname]"; ?>" required=""> 
</div>

<br>
<h4 class="bold">Last Name:</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-address-card"></i>
</span>
<input name="lastname" class="form-control input-lg" placeholder="Last Name" type="text" value="<?php echo "$data[lastname]"; ?>" required=""> 
</div>

<br>
<h4 class="bold">Profile Picture: <small>Square Size Image Recomanded</small></h4>


<input id="input-8" type="file" accept="image/*" name="img" class="file-loading" data-allowed-file-extensions='["jpg", "jpeg"]'>


<br><br>
<button type="submit" class="btn btn-success btn-lg btn-block">UPDATE</button>



</form>

</div>
</div>

</div>


</div><!-- row -->





<?php 
include('include-footer.php');
?>
<script type="text/javascript" src="<?php echo $baseurl; ?>/assets/js/filestyle.js"></script>
<script  type="text/javascript">
		$(document).on('ready', function() {

		$("#input-8").fileinput({
				mainClass: "input-group-lg",
				showUpload: true,
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "Pick Image",
				browseIcon: "<i class=\"fa fa-file-image-o\"></i> ",
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: "<i class=\"fa fa-trash\"></i> ",
				uploadClass: "hidden",
				uploadLabel: "",
				uploadIcon: ""
			});



		});

	</script>

</body>
</html>