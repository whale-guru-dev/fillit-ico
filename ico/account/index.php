<?php
Include('include-global.php');
$pagename = "Account Login";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>

<style>
   .abir{
display: fixed;
z-index: 299;
position: absolute;
width: 85%;
color: #FFF;
background-color: #28acb8;
border-color: #28acb8;
}

</style>

</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-nuser.php');

if (is_user()) {
redirect("$baseurl/Dashboard");
}
?>







<div class="row">
    
<div class="col-md-6 col-md-offset-3">

<div class="portlet light portlet-fit" style="margin-top: 40px;">


<div class="portlet-title">
<div class="caption">
<i class=" icon-layers font-green"></i>
<span class="caption-subject bold uppercase basecolor">Login to your Account</span>
</div>

</div>


<div class="portlet-body">



<form  id="login-form" action="">



<h4 class="block">Email Address:</h4>

<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-envelope fa-2x"></i>
</span>
<input name="username" id="username" class="form-control input-lg" placeholder="Email Address" type="email" required=""> 
</div>


<h4 class="block">Password:
<a href="<?php echo $baseurl; ?>/ForgotPassword" class="pull-right">Forgot Password?</a>
</h4>
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
<input name="password" id="password" class="form-control input-lg" placeholder="Password" type="password" required=""> 
</div>

<br>
<br>
<div id="working"></div>
<button class="btn btn-success btn-lg btn-block" type="submit" id="btn-login">Sign in</button>

<br>
<br>
<div id="error">
<!-- error will be shown here ! -->
</div>



</form>




<p style="text-align: center; font-weight: bold;">
Don't Have An Account? <a href="<?php echo $baseurl; ?>/Register"> Register Now </a> 
</p>




</div>
</div>


</div>
</div><!-- row -->

















<?php 
include('include-footer.php');
?>



<script src="<?php echo $baseurl; ?>/assets/js/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>


<script>
  
$(document).ready(function () {
  
setTimeout(function(){ 
                $("#load").hide();
           $("#result").show();
      
        }, 2000);

 });












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
   url  : '<?php echo $baseurl; ?>/checklogin.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#working").html('<div class="btn btn-success btn-lg uppercase btn-block abir" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-spin"></i>  Validating Your Data.... </strong></div>');
   },
   success :  function(response)
      {      
     if(response=="ok"){
         
      $("#working").html('<div class="alert alert-success alert-dismissable"><h4 class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Dashboard...</h4></div>');
      setTimeout(' window.location.href = "<?php echo $baseurl; ?>/checkpoint"; ',4000);
     }
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<div class="alert alert-danger"> <i class="fa fa-times"></i> &nbsp; '+response+' !</div>');
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