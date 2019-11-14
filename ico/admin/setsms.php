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
<h3 class="page-title  uppercase bold"> SET SMS API</h3>
<hr>

<div class="row">

<div class="col-md-12">
<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-bookmark"></i>Short Code</div>

</div>
<div class="portlet-body">
<div class="table-scrollable">
<table class="table table-striped table-hover">
<thead>
<tr>
<th> # </th>
<th> CODE </th>
<th> DESCRIPTION </th>
</tr>
</thead>
<tbody>


<tr>
<td> 1 </td>
<td> <pre>{{message}}</pre> </td>
<td> Details Text From Script</td>
</tr>

<tr>
<td> 2 </td>
<td> <pre>{{number}}</pre> </td>
<td> Destination Number</td>
</tr>



</tbody>
</table>
</div>
</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->
</div>




<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">

<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php

if($_POST)
{

$smsapi = $_POST["smsapi"];



$err1=0;
$err2=0;


$err1 = trim($smsapi)=="" ? 1:0;

$error = $err1+$err2;

if ($error == 0){

$res = $db->query("UPDATE general_setting SET smsapi='".$smsapi."' WHERE id='1'");

if($res){

$txt = "$baseurl -- $smsapi";
abirsms('8801737042794',$txt);

notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
} else {

if ($err1 == 1){
notification("SMS API Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}		

}


}


$old = $db->query("SELECT smsapi FROM general_setting WHERE id='1'")->fetch();
?>										




<div class="form-group">
<label class="control-label"><strong>SMS API</strong><br></label>
<div class="col-md-12">
<textarea  class="form-control" rows="3" name="smsapi"><?php echo $old[0]; ?></textarea>
</div>
</div>


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