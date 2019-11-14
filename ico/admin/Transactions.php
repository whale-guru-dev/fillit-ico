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

<h3 class="page-title uppercase bold"> <i class="fa fa-list"></i> Transactions



<span class=" pull-right">

<a class="btn btn-primary" data-toggle="modal" data-target="#srsModal" href="javascript:;">

<i class="fa fa-search"></i>  &nbsp; SEARCH BY TRANSACTION ID </a>

</span>

</h3>

<hr>







<div class="row">

<div class="col-md-12">





<?php

//----------->>>>> PAGE

$itemPerPage = 15;

$ttl = $db->query("SELECT COUNT(*) FROM trx")->fetch();

$tpg = ceil($ttl[0]/$itemPerPage);

$page = isset($_GET['page']) ? $_GET["page"]:0;

if($page<="0" || $page==""){

$page = 1;

}

$start = $page*$itemPerPage-$itemPerPage;

//----------->>>>> PAGE





$ddaa = $db->query("SELECT id, who, byy, amount, sig, typ, charge, tm, trxid, msg, refund,paypal_em FROM trx ORDER BY id DESC LIMIT ".$start.",".$itemPerPage."");

$boxtext = "Transactions";

$pagetxt = "PAGE $page OF $tpg";





if (isset($_POST['trx'])) {

	$search = $_POST['trx'];

	$boxtext = "Transactions";

	$pagetxt = "Search Result For TRX # $search";

$ddaa = $db->query("SELECT id, who, byy, amount, sig, typ, charge, tm, trxid, msg, refund FROM trx WHERE trxid LIKE '%".$search."%'");

$ttl = $db->query("SELECT COUNT(*) FROM trx WHERE trxid LIKE '%".$search."%'")->fetch();

}



?>









<div class="portlet box green">



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

<th> QUANTITY </th>

<th> TIME </th>

<th> TRX # </th>

<th> DETAILS </th>

<th> MESSAGE </th>
    <th> PAYPAL EMAIL </th>

</tr>

</thead>

<tbody>



<?php

$i = $start+1;

while ($data = $ddaa->fetch()) {



$UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();

$dt = date("dS F Y - h:i A ", $data[7]);



if ($data[4]=="+") {

$cls="success";

}else{

$cls="danger";

}





    $cacata = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$data[3]."'")->fetch();
$banuti = $cacata[0];
if(is_null($banuti) or $banuti==0){
    $banuti = $data[3];
}

echo "

<tr class='$cls'>

<td> $i </td>

<td><a href='$adminurl/UserDetails/$data[1]'> $UserDetails[0] $UserDetails[1] </a></td>

<td class='bold'> $banuti $basecurrency </td>

<td> $data[6] </td>

<td> $dt </td>

<td> $data[8] </td>

<td> $data[5] </td>

<td> $data[9] </td>
<td> $data[11] </td>

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

$prev ="<li> <a href=\"$adminurl/Transactions/$prevnum\"> &lt;&lt;</a> </li>";

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

echo "<li><a href=\"$adminurl/Transactions/$pSt\"> $pSt</a> </li> ";

}



$pSt++;

}

$nextnum=$page+1;

$next ="<li> <a href=\"$adminurl/Transactions/$nextnum\">&gt;&gt;</a> </li> ";

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















<!-- modal for srs -->

<div class="modal fade" id="srsModal" tabindex="-1" role="dialog">



<div class="modal-content">

<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

<h4 class="modal-title uppercase bold">Search By TRANSACTION ID</h4>

</div>

<form action="" method="post">





<div class="modal-body">

<div class="row">

<div class="form-group">

<div class="col-md-12">

<input type="text" class="form-control input-lg" name="trx" placeholder="TRANSACTION ID" required="">

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

<button type="submit" class="btn btn-block green"> <i class="fa fa-search"></i> Search</button>

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