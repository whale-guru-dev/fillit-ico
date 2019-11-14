<?php
Include('include-global.php');
Include('include-header.php');
if (is_user()) {
redirect("$apiurl/pay");
}
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

<div class="row">
<div class="col-md-8 col-md-offset-2">



<div class="portlet light portlet-fit" style="margin-top: 40px;">
<div class="portlet-title">
<div class="caption">
<i class=" icon-layers font-green"></i>
<span class="caption-subject bold uppercase">Express Payment Wizard</span>
</div>
</div>
<div class="portlet-body">
<div class="row">
<div class="col-md-6">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<span class="caption-subject bold uppercase">Payment Information</span>
</div>
</div>
<div class="portlet-body text-center">

<br>

<?php
echo " <h4>Pay To <b>$_SESSION[xpaytoname]</b> <br> $_SESSION[xpayto]</h4><br><hr><br>";
echo " <h4><b>AMOUNT: </b>$_SESSION[xamount] $basecurrency <br><b>For: </b>$_SESSION[xitemname]<br></h4> <br><hr><br>";
echo "<a href=\"$_SESSION[xcancelurl]\" style='color:#f00; font-weight:bold;'>CANCEL PAYMENT</a>";
?>


 </div>
 </div>
 </div>

<div class="col-md-6">


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<span class="caption-subject bold uppercase">Login to Make The Payment</span>
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
<h4 class="block">Password:</h4>
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
<div id="error">
<!-- error will be shown here ! -->
</div>
</form>

</div>
</div>
</div>
</div>



</div>
</div>
</div>




</div><!-- row -->

<?php 
include('include-footer.php');
?>



<script src="<?php echo $baseurl; ?>/asset/js/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>


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
         
      $("#working").html('<div class="alert alert-success alert-dismissable"><h4 class="block"> <i class="fa fa-check"></i> &nbsp; Success! Redirecting to Payment Page...</h4></div>');
      setTimeout(' window.location.href = "<?php echo $apiurl; ?>/pay"; ',4000);
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