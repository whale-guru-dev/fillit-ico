<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title uppercase bold"> <i class="fa fa-desktop"></i> View MOBILE UNVERIFIED USERS</h3>
<hr>

<span class=" pull-right">
<a class="btn btn-warning" data-toggle="modal" data-target="#nameModal" href="javascript:;">
<i class="fa fa-address-card"></i>  &nbsp; SEARCH BY USER NAME </a>
</span>
<br/><br/>

<div class="row">
<div class="col-md-12">


<?php 
//----------->>>>> PAGE
$itemPerPage = 15;
$ttl = $db->query("SELECT COUNT(*) FROM users WHERE mv='0'")->fetch();
$tpg = ceil($ttl[0]/$itemPerPage);
$page = isset($_GET['page']) ? $_GET["page"]:0;
if($page<="0" || $page==""){
$page = 1;
}
$start = $page*$itemPerPage-$itemPerPage;
//----------->>>>> PAGE


$ddaa = $db->query("SELECT id, firstname, lastname, mobile, email, mallu FROM users WHERE mv='0' ORDER BY id ASC LIMIT ".$start.",".$itemPerPage."");
$boxtext = "MOBILE UNVERIFIED USERS LIST";
$pagetxt = "PAGE $page OF $tpg";

if (isset($_POST['username'])) {
	$search = $_POST['username'];
	$boxtext = "USERS LIST";
	$pagetxt = "Search Result For $search";

    $ddaa = $db->query("SELECT id, firstname, lastname, mobile, email, mallu FROM users WHERE mv='0' AND firstname LIKE '%".$search."%' OR mv='0' AND lastname LIKE '%".$search."%' ORDER BY id ASC LIMIT ".$start.",".$itemPerPage."");
$ttl = $db->query("SELECT COUNT(*) FROM users WHERE email LIKE '%".$search."%'")->fetch();
}

?>




<div class="portlet box yellow">

<div class="portlet-title">
<div class="caption">
<i class="fa fa-list"></i>  <?php echo "$boxtext"; ?> 
</div>
<div class="actions">
<?php echo $pagetxt; ?>
</div>
</div>

<div class="portlet-body">

<?php 
if ($ttl[0]==0) {
echo "<h1 class='text-center'> NO RESULT FOUND !</h1>";
}else{
?>



<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> # </th>
<th> NAME </th>
<th> EMAIL </th>
<th> MOBILE </th>
<th> BALANCE </th>
<th> DETAILS </th>
</tr>
</thead>
<tbody>



<?php
$i = $start+1;
while ($data = $ddaa->fetch()) {

echo "
<tr class='bold'>
<td> $i </td>
<td> $data[1] $data[2]  </td>
<td> $data[4] </td>
<td> $data[3] </td>
<td> $data[5] $basecurrency </td>
<td><a href='$adminurl/UserDetails/$data[0]' class='btn btn-success btn-md'>
<i class='fa fa-desktop'></i> VIEW DETAILS</a> </td>
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



<!-- print pagination -->
<div class="row">
<div class="text-center">
<ul class="pagination">

<?php
if (!$_POST && $tpg>1){
echo "<br><br>";

$prevnum=$page-1;
$prev ="<li> <a href=\"$adminurl/MobileUnverifiedUsers/$prevnum\"> &lt;&lt;</a> </li>";
if($page<="1"){
$prev ="<li class=\"disabled\"> <a href=\"#\"> &lt;&lt;</a> </li>";
}
echo $prev;

$pSt = $page-2;
if ($pSt<=1) {
$pSt = 1;
}

$pEnd = $pSt+4;
if ($pEnd > $tpg) {
$pEnd = $tpg;
}

$pSt = $pEnd-4;
if ($pSt<=1) {
$pSt = 1;
}

while ($pSt <= $pEnd) {

if ($pSt==$page) {
echo "<li class=\"active\"><a href=\"#\"> $pSt</a> </li> ";
}else{
echo "<li><a href=\"$adminurl/MobileUnverifiedUsers/$pSt\"> $pSt</a> </li> ";
}

$pSt++;
}
$nextnum=$page+1;
$next ="<li> <a href=\"$adminurl/MobileUnverifiedUsers/$nextnum\">&gt;&gt;</a> </li> ";
if($page>=$tpg){
$next ="<li class=\"disabled\"> <a href=\"#\">&gt;&gt;</a> </li> ";
}

echo $next;
}
?>
</ul>
</div>
</div><!-- row -->
<!-- END print pagination -->



</div>
</div>



</div>
</div><!-- ROW-->

<!-- modal for username -->
<div class="modal fade" id="nameModal" tabindex="-1" role="dialog">

<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title uppercase bold">Search By Username</h4>
</div>
<form action="" method="post">


<div class="modal-body">
<div class="row">
<div class="form-group">
<div class="col-md-12">
<input type="text" class="form-control input-lg" name="username" placeholder="User Name" required="" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<div class="row">
<div class="col-md-6">
<button type="button" class="btn btn-block dark btn-outline" data-dismiss="modal">Close</button>
</div>
<div class="col-md-6">
<button type="submit" class="btn btn-block green"> <i class="fa fa-address-card"></i> Search</button>
</div>
</div>
</div>

</form>


</div>
</div>
<!-- /.modal -->

</div>
</div>
<?php
include ('include/footer.php');
?>
</body>
</html>