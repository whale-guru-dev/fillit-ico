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
<h3 class="page-title uppercase bold"> <i class="fa fa-sign-in"></i> Login Information</h3>
<hr>

<div class="row">
<div class="col-md-12">


<?php 
$count = $db->query("SELECT COUNT(*) FROM logins WHERE usid='".$id."'")->fetch();
$ddaa = $db->query("SELECT id, usid, ip, location, ua, tm FROM logins WHERE usid='".$id."' ORDER BY id DESC");
$usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$id."'")->fetch();
$boxtext = "Login Information Of $usernames[0] $usernames[1]";
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
<th> USER </th>
<th> IP </th>
<th> IP LOCATION </th>
<th> USING </th>
<th> TIME </th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
while ($data = $ddaa->fetch()) {

$UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();
$dt = date("dS F Y - h:i A ", $data[5]);

echo "
<tr class=''>
<td> $i </td>
<td><a href='$adminurl/UserDetails/$data[1]'> $UserDetails[0] $UserDetails[1] </a></td>
<td class='bold'> $data[2]</td>
<td class='bold'> $data[3]</td>
<td> $data[4] </td>
<td> $dt </td>
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