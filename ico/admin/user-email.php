<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
$id = $_GET['id'];
?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> <i class="fa fa-envelope"></i> Send email to user</h3>
<hr>

<div class="row">
<div class="col-md-12">


<?php
$usernames = $db->query("SELECT firstname, lastname, email, mallu FROM users WHERE id='".$id."'")->fetch();
$boxtext = "Send email to $usernames[0] $usernames[1]";
if ($_POST) {
$subject = $_POST['subject'];
$message = $_POST['message'];

// ///////////////////------------------------------------->>>>>>>>>Send Email
abiremail2($usernames[2], $subject, $usernames[0], $message);
// ///////////////////------------------------------------->>>>>>>>>Send Email
notification("Sent Successfully!", "", "success", false, "btn-success", "OKAY");

}//post


?>




<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-envelope"></i>  <?php echo "$boxtext"; ?> 
</div>
</div>
<div class="portlet-body">


<form action="" method="post">
	

<div class="row uppercase">

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong>SUBJECT</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="subject"  type="text" required="">
</div>
</div>
</div>

</div><!-- row -->

<br><br>

<div class="row uppercase">
<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong>Message</strong> NB: EMAIL WILL SENT USING EMAIL TEMPLATE</label>
<div class="col-md-12">
<textarea name="message" rows="10" class="form-control" id="shaons"></textarea>
</div>
</div>
</div>
</div><!-- row -->

<br><br>
<div class="row uppercase">
<div class="col-md-12">

<button type="submit" class="btn btn-success btn-lg btn-block"> SUBMIT </button>

</div>
</div><!-- row -->



</form>
</div>
</div>
</div>





</div><!-- ROW-->


</div>
</div>
<?php
include ('include/footer.php');
?>
</body>
</html>