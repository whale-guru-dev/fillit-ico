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
<h3 class="page-title uppercase bold"> <i class="fa fa-money"></i> Admin Generated Fund</h3>
<hr>



<div class="row">
<div class="col-md-12">


<?php 
//----------->>>>> PAGE
$itemPerPage = 15;
$ttl = $db->query("SELECT COUNT(*) FROM generated")->fetch();
$tpg = ceil($ttl[0]/$itemPerPage);
$page = isset($_GET['page']) ? $_GET["page"]:0;
if($page<="0" || $page==""){
$page = 1;
}
$start = $page*$itemPerPage-$itemPerPage;
//----------->>>>> PAGE


$ddaa = $db->query("SELECT id, tto, amount, trx, tm, msg FROM generated ORDER BY id DESC LIMIT ".$start.",".$itemPerPage."");
$boxtext = "Admin Generated Fund";
$pagetxt = "PAGE $page OF $tpg";
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
<th> USER </th>
<th> AMOUNT </th>
<th> TIME </th>
<th> TRX # </th>
<th> DETAILS </th>
</tr>
</thead>
<tbody>



<?php
$i = $start+1;
while ($data = $ddaa->fetch()) {

$UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();
$dt = date("dS F Y - h:i A ", $data[4]);
if ($data[2]>0) {
$cls="success";
}else{
$cls="danger";
}



echo "
<tr class='$cls'>
<td> $i </td>
<td>
	<a href='$adminurl/UserDetails/$data[1]'>
	 $UserDetails[0] $UserDetails[1]  ( <small>$UserDetails[2]</small> )</a>
</td>
<td class='bold'> $data[2] $basecurrency </td>
<td> $dt </td>
<td> $data[3] </td>
<td> $data[5] </td>
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
$prev ="<li> <a href=\"$adminurl/AdminGeneratedFund/$prevnum\"> &lt;&lt;</a> </li>";
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
echo "<li><a href=\"$adminurl/AdminGeneratedFund/$pSt\"> $pSt</a> </li> ";
}

$pSt++;
}
$nextnum=$page+1;
$next ="<li> <a href=\"$adminurl/AdminGeneratedFund/$nextnum\">&gt;&gt;</a> </li> ";
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



</div>
</div>
<?php
include ('include/footer.php');
?>
</body>
</html>