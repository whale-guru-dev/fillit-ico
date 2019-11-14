<?php
require_once('../function.php');
session_start();

if (is_admin()) {
    redirect("$adminurl/Dashboard");
}
$general = $db->query("SELECT sitetitle FROM general_setting WHERE  id='1'")->fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="utf-8" />
        <title>Admin Login | <?php echo $general[0]; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />


<link href="<?php echo $adminurl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $adminurl; ?>/assets/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo $adminurl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $adminurl; ?>/assets/css/login.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $fronturl; ?>/assets/images/favicon.png">

<style>
    

 .abir{
display: fixed;
z-index: 299;
position: absolute;
width: 85%;
color: #FFF;
background-color: #26a1ab;
border-color: #26a1ab;
}

.slow-spin {
  -webkit-animation: fa-spin 2s infinite linear;
  animation: fa-spin 2s infinite linear;
}
</style>

</head>



<body class=" login">


<div class="menu-toggler sidebar-toggler"></div>
<div class="logo">
<a href="#">
<img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="X" style="width:20%;    -webkit-filter: brightness(0) invert(1); filter: brightness(0) invert(1);" /> </a>
</div>





<div class="content">









<form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">
<h3 class="form-title font-green uppercase">Sign In</h3>

<div class="form-group">
<input name="username" class="form-control input-lg" placeholder="Username" type="text">
</div>

<div class="form-group">
<input name="password" class="form-control input-lg" placeholder="Password" type="password">
</div>

<div class="form-actions">
<div id="working"></div>


<button class="btn green uppercase btn-block" id="login-form-submit" name="login-form-submit">Login</button>
</div>





</form>

<div id="error">
</div>






</div>
<div class="copyright"> <?php echo date("Y"); ?> © <?php echo $general[0]; ?> </div>





<script src="<?php echo $adminurl; ?>/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $adminurl; ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $adminurl; ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script>



<script>
  


$('document').ready(function()
{ 
     /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   username: {
            required: true,

            },
    },
       messages:
    {
            password:{
                      required: ""
                     },
            username: "",
       },
    submitHandler: submitForm 
       });  
    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : '<?php echo $adminurl; ?>/checklogin.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#working").html('<div class="btn btn-success uppercase btn-block abir" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner slow-spin"></i>  Validating Your Data.... </strong></div>');
   },
   success :  function(response)
      {      
     if(response=="ok"){
         
      $("#working").html('<br><br><div class="alert alert-success alert-dismissable"><strong class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Dashboard...</strong></div>');
      setTimeout(' window.location.href = "Dashboard"; ',1000);
     }
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<br><br><div class="alert alert-danger"> <i class="fa fa-times"></i> &nbsp; '+response+' !</div>');
           $("#working").html('');
         });
     }
     }
   });
    return false;
  }
    /* login submit */
});

</script>
    </body>

</html>