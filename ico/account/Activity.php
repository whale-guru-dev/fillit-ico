<?php
Include('include-global.php');
$pagename = "Account Activity";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Transaction Activity of Your Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<?php 


//----------->>>>> PAGE
$itemPerPage = 15;
$ttl = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$uid."'")->fetch();
$tpg = ceil($ttl[0]/$itemPerPage);

$page = isset($_GET['page']) ? $_GET["page"]:0;

if($page<="0" || $page==""){
$page = 1;
}
$start = $page*$itemPerPage-$itemPerPage;
//----------->>>>> PAGE



$ddaa = $db->query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' ORDER BY id DESC LIMIT ".$start.",".$itemPerPage."");

$count = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$uid."'")->fetch();

$boxtext = "Account Activity";



if( isset($_POST['mail'])){
$ssiidd = $db->query("SELECT id FROM users WHERE email='".$_POST["mail"]."'")->fetch();
$ddaa = $db->query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' AND byy='".$ssiidd[0]."' ORDER BY id DESC");

$count = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$uid."' AND byy='".$ssiidd[0]."' ORDER BY id DESC")->fetch();

$boxtext = "Account Activity For <b> $_POST[mail]</b>";
}


if(isset($_POST['d2d'])){
$d1=strtotime($_POST["start"]);
$d2=strtotime($_POST["end"])+24*60*60;

$ddaa = $db->query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund FROM trx WHERE who='".$uid."' AND tm BETWEEN '".$d1."' AND '".$d2."' ORDER BY id DESC");

$count = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$uid."' AND tm BETWEEN '".$d1."' AND '".$d2."' ORDER BY id DESC")->fetch();

$boxtext = "Account Activity For <b> $_POST[start] TO $_POST[end]</b>";
}

?>




<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list"></i>  <?php echo "$boxtext"; ?> 
</div>

<!--div class="actions">

<span data-toggle="tooltip" title="Filter By Date" >
<a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" data-target="#dtModal" href="javascript:;">
<i class="fa fa-calendar"></i>
</a>
</span>


<span data-toggle="tooltip" title="Filter By Email" >
<a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" data-target="#EmailModal" href="javascript:;">
<i class="fa fa-envelope-o"></i>
</a>
</span>


</div-->

</div>

<div class="portlet-body">
<div class="panel-group accordion" id="accordion1">




<?php
while ($data = $ddaa->fetch()) {

$month = date("M", $data[6]);
$tarikh = date("d", $data[6]);
$monthname =  strtoupper($month);

$byy = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();

if($data[3]=="-"){
$sig = "<i class=\"fa fa-minus\"></i>";
$amo = round($data[2]+$data[5], $baseDecimal);
$amount = "<b style=\"font-size: 20px;\"> $basecur $amo</b>";
$paytxt = "Sent To";
$printrefund = "";
$accls = "danger";
}

if($data[3]=="+"){
$sig = "<i class=\"fa fa-plus\"></i>";
$amo = round($data[2]-$data[5], $baseDecimal);
$amount = "<b style=\"font-size: 20px;\"> $basecur $amo</b>";
$paytxt = "Paid By";

$r1 = rand(10,99);
$r2 = rand(10,99);
$c1 = chr(rand(97,122));
$c2 = chr(rand(97,122));
$c3 = chr(rand(97,122));
$c4 = chr(rand(97,122));
$rrtxt = strtoupper("$c1$c2$r1$data[0]$c3$c4$r2");

$printrefund = "<a href=\"$baseurl/Refund/$rrtxt\" class=\"btn btn-warning btn-sm pull-right\"> <i class=\"fa fa-repeat\"></i> REFUND</a>";

$accls = "success";
}

if($data[10]!=0){
$printrefund = "";
}


if(trim($data[8])==""){
$messageprint ="";
}else{
$messageprint="<b>Message:</b> $data[8]";
}





if($data[1]=="0"){
$byy = array($gen[0], 'SYSTEM', '' );
$paytxt = "Added By";
}


if($data[1]=="000wd"){
$byy = array($gen[0], 'SYSTEM', '' );
$paytxt = "Withdraw To";
}

if($data[1]=="000111"){
$nnn = $db->query("SELECT name FROM deposit_method WHERE id='1'")->fetch();
$byy = array($nnn[0], 'Deposit', '' );
$paytxt = "Added By";
}

if($data[1]=="000222"){
$nnn = $db->query("SELECT name FROM deposit_method WHERE id='2'")->fetch();
$byy = array($nnn[0], 'Deposit', '' );
$paytxt = "Added By";
}

if($data[1]=="000333"){
$nnn = $db->query("SELECT name FROM deposit_method WHERE id='3'")->fetch();
$byy = array($nnn[0], 'Deposit', '' );
$paytxt = "Added By";
}

if($data[1]=="000444"){
$nnn = $db->query("SELECT name FROM deposit_method WHERE id='4'")->fetch();
$byy = array($nnn[0], 'Deposit', '' );
$paytxt = "Added By";
}

if($data[1]=="000900"){
$byy = array($gen[0], 'Staff', '' );
$paytxt = "Added By";
}


    if($data[1]=="000069"){
        $nna = 'Wire Request';
        $byy = array($nna, 'Deposit', '' );
        $paytxt = "Added By";
    }

?>



<div class="panel panel-<?php echo $accls;?>">
<div class="panel-heading">
<h4 class="panel-title">


<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?php echo $data[0] ?>"> 



<div class="row">

<div class="col-xs-2 col-md-2">
	<b style="font-size: 20px;"><?php echo $tarikh; ?></b><br><?php echo $monthname; ?>
</div>

<div class="col-xs-10 col-md-8">
	<b><?php echo "$byy[0] $byy[1]"; ?></b><br><?php echo $data[4]; ?>
</div>


<div class="col-xs-6 col-md-2 pull-right">
	<?php echo "$sig "; ?>
</div>


</div>

    <style>
        .fa-plus {
            margin-top: 14px;
        }
    </style>
</a>
</h4>
</div>
<div id="collapse_<?php echo $data[0] ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
<div class="panel-body">



<div class="row">
<div class="col-md-11 col-md-offset-1 col-sm-12">

<div class="col-md-4 col-sm-12">
<h4 style="font-weight: bold;"><?php echo "$paytxt"; ?></h4>
<p class="lead"><?php echo "$byy[0] $byy[1]"; ?> <br>
<a href="mailto:<?php echo "$byy[2]"; ?>" style="font-size: 16px;"><?php echo "$byy[2]"; ?></a></p>
</div>


    <div class="col-md-4 col-sm-12">
        <h4 style="font-weight: bold;">Transaction ID</h4>
        <p class="lead" style="margin-bottom: 5px;"><?php echo "$data[7]"; ?></p>

        <i class="fa fa-calendar"></i> <b class="uppercase">  <?php echo date("d F Y", $data[6]); ?> </b> &nbsp;&nbsp;&nbsp; <i class="fa fa-clock-o"></i>  <b>  <?php echo date("h:i A", $data[6]); ?> </b>

    </div>


    <div class="col-md-4 col-sm-12">
        <h4 style="font-weight: bold;">Details</h4>

        <div class="col-xs-12">
            <?php echo "Package ID"; ?>
            <span class="pull-right"><?php echo 'Package #'.$data[2] ?> </span>  <br>

        </div>
        <div class="col-xs-12">
            Amount  <span class="pull-right"><?php echo $data[5].' QTY'; ?></span>  <br> </div>
        <div class="col-xs-12">

            <?php

            if($data[2]==1){
                $coins = 2625 * $data[5];
            }elseif($data[2]==2){
                $coins = 8062* $data[5];
            }elseif($data[2]==3){
                $coins = 27500* $data[5];
            }elseif($data[2]==4){
                $coins = 86250* $data[5];
            }


            ?>
            <p><b>TOTAL <span class="pull-right"><?php echo number_format($coins, 0, '.', ','); ?> <?php echo $basecurrency; ?></span>  </b><br></p>
        </div>
        <p><?php echo $printrefund; ?></p>


</div>

<div class="col-md-12">
  
<?php echo "$messageprint"; ?>

</div>


</div>

</div><!-- row -->



</div>
</div>
</div>


        
<?php 
}

if ($count[0]==0) {

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">No Activity Found!</h1><br><br><br>';
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
$prev ="<li> <a href=\"$baseurl/Activity/$prevnum\"> &lt;&lt;</a> </li>";
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
echo "<li><a href=\"$baseurl/Activity/$pSt\"> $pSt</a> </li> ";
}

$pSt++;
}
$nextnum=$page+1;
$next ="<li> <a href=\"$baseurl/Activity/$nextnum\">&gt;&gt;</a> </li> ";
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






<!-- modal for date -->
<div class="modal fade" id="dtModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Filter By Date</h4>
</div>
<form action="" method="post">


<div class="modal-body">
<div class="row">
<div class="form-group">
<label class="control-label col-md-4"><strong>Select Date Range</strong></label>
<div class="col-md-8">
<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
<input type="text" class="form-control" name="start">
<span class="input-group-addon"> to </span>
<input type="text" class="form-control" name="end"> </div>
<input type="hidden" name="d2d" value="1">
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
<button type="submit" class="btn green">Filter</button>
</div>


</form>


</div>
</div>
</div>
<!-- /.modal -->



<!-- modal for Email -->
<div class="modal fade" id="EmailModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Filter By Email</h4>
</div>
<form action="" method="post">


<div class="modal-body">
<div class="row">
<div class="form-group">
<label class="control-label col-md-4"><strong>Enter Email</strong></label>
<div class="col-md-8">

<input type="text" class="form-control input-lg" name="mail" placeholder="Email Address">


</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
<button type="submit" class="btn green">Filter</button>
</div>


</form>


</div>
</div>
</div>
<!-- /.modal -->






<?php 
include('include-footer.php');
?>     
</body>
</html>