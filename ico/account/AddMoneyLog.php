<?php
Include('include-global.php');
$pagename = "Deposit Log";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Add Money Log of Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>




<?php 


//----------->>>>> PAGE
$itemPerPage = 15;
$ttl = $db->query("SELECT COUNT(*) FROM deposit_data WHERE usid='".$uid."' AND status='1'")->fetch();
$tpg = ceil($ttl[0]/$itemPerPage);

$page = isset($_GET['page']) ? $_GET["page"]:0;

if($page<="0" || $page==""){
$page = 1;
}
$start = $page*$itemPerPage-$itemPerPage;
//----------->>>>> PAGE



$ddaa = $db->query("SELECT id, tm, method, track, amount, charge, amountus, bcam, bcid, trx, trx_ext, status FROM deposit_data WHERE usid='".$uid."' AND status='1' ORDER BY id DESC LIMIT ".$start.",".$itemPerPage."");
$count = $db->query("SELECT COUNT(*) FROM deposit_data WHERE usid='".$uid."' AND status='1'")->fetch();
$boxtext = "ADD MONEY LOG";
?>




<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list"></i>  <?php echo "$boxtext"; ?> 
</div>
</div>

<div class="portlet-body">


<?php 
if ($count[0]!=0) {

 ?>


<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> # </th>
<th> DATE </th>
<th> METHOD </th>
<th> AMOUNT </th>
<th> PAID </th>
<th> Transaction ID </th>
</tr>
</thead>
<tbody>

<?php
$i = $start+1;
while ($data = $ddaa->fetch()) {
    if($data[4]==1){
        $coins = 2625 * $data[5];
    }elseif($data[4]==2){
        $coins = 8062* $data[5];
    }elseif($data[4]==3){
        $coins = 27500* $data[5];
    }elseif($data[4]==4){
        $coins = 86250* $data[5];
    }
$dt = date("dS F Y - h:i A ", $data[1]);
$method = $db->query("SELECT name  FROM deposit_method WHERE id='".$data[2]."'")->fetch();

echo "
<tr>
<td> $i </td>
<td> $dt </td>
<td> $method[0] </td>
<td> $coins $basecurrency </td>
<td> $data[6] EUR </td>
<td> $data[10] </td>
</tr>
";

$i++;
}
?>

</tbody>
</table>
</div>


<?php
}else{

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">No Add Money Log Found!</h1><br><br><br>';
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
$prev ="<li> <a href=\"$baseurl/AddMoneyLog/$prevnum\"> &lt;&lt;</a> </li>";
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
echo "<li><a href=\"$baseurl/AddMoneyLog/$pSt\"> $pSt</a> </li> ";
}

$pSt++;
}
$nextnum=$page+1;
$next ="<li> <a href=\"$baseurl/AddMoneyLog/$nextnum\">&gt;&gt;</a> </li> ";
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







<?php 
include('include-footer.php');
?>     
</body>
</html>