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
<h3 class="page-title uppercase bold"> <i class="fa fa-desktop"></i> Withdraw Log</h3>
<hr>

<div class="row">
<div class="col-md-12">


<?php 
$count = $db->query("SELECT COUNT(*) FROM wd WHERE usr='".$id."'")->fetch();

$ddaa = $db->query("SELECT id, method, usr, amount, charge, tm, details, msg, status, trx FROM wd WHERE usr='".$id."' ORDER BY id DESC");

$usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$id."'")->fetch();
$boxtext = "Withdraw Log Of $usernames[0] $usernames[1]";
?>




<div class="portlet box blue">

<div class="portlet-title">
<div class="caption uppercase bold">
<i class="fa fa-list"></i>  <?php echo "$boxtext"; ?> 
</div>
</div>

<div class="portlet-body">

<?php 
if ($count[0]==0) {
echo "<h1 class='text-center'> NO RESULT FOUND !</h1>";
}else{
?>



<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> # </th>
<th> METHOD </th>
<th> USER </th>
<th> AMOUNT </th>
<th> CHARGE </th>
<th> TIME </th>
<th> TRX # </th>
<th> STATUS</th>
<th> DETAILS </th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
while ($data = $ddaa->fetch()) {

$UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[2]."'")->fetch();

$method = $db->query("SELECT name FROM wd_method WHERE id='".$data[1]."'")->fetch();
$dt = date("dS F Y - h:i A ", $data[5]);

if ($data[8]==0) {
$cls="warning";
$st = "PENDING";
}

if ($data[8]==1) {
$cls="success";
$st = "PROCESSED";
}

if ($data[8]==2) {
$cls="danger";
$st = "REFUNDED";
}



echo "
<tr class='$cls'>
<td> $i </td>
<td> $method[0] </td>
<td><a href='$adminurl/UserDetails/$data[2]'> $UserDetails[0] $UserDetails[1] </a></td>
<td class='bold'> $data[3] $basecurrency </td>
<td> $data[4] $basecurrency </td>
<td> $dt </td>
<td> $data[9] </td>
<td> $st </td>
<td> <a href='$adminurl/WithdrawDetails/$data[0]' class='btn btn-primary'> <i class='fa fa-desktop'></i> DETAILS </a> </td>
</tr>
";


$i++;
}
?>


</tbody>
</table>
</div>

<?php 
}
?>


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