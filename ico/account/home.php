<?php
Include('include-global.php');
$pagename = "Dashboard";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Welcome Back to FILLITCROWD";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list"></i> RECENT TRANSACTIONS </div>
</div>

<div class="portlet-body">
<div class="panel-group accordion" id="accordion1">


<?php 



$count = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$uid."'")->fetch();
if ($count[0]==0) {
echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">NO TRANSACTION YET!</h1><br><br><br>';
}


$ddaa = $db->query("SELECT id, byy, amount, sig, typ, charge, tm, trxid, msg, byy, refund,many FROM trx WHERE who='".$uid."' ORDER BY id DESC LIMIT 0,12");

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

    if($data[1]=="0000697"){
        $nna = 'CASHLIB';
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

<div class="col-xs-10 col-md-8"><b><?php echo "$byy[0] $byy[1]"; ?></b><br><?php echo $data[4]; ?>
</div>


<div class="col-xs-6 col-md-2 pull-right">
<style>
    .fa-plus {
        margin-top: 14px;
    }
</style>
<?php echo "$sig"; ?>
	
</div>


</div>


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
<a href="#<?php echo "$byy[2]"; ?>" style="font-size: 16px;"><?php echo "SYSTEM"; ?></a></p>
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



    ?>
<p><b>TOTAL <span class="pull-right"><?php echo number_format($data[11], 0, '.', ','); ?> <?php echo $basecurrency; ?></span>  </b><br></p>
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
 ?>
        





</div>
</div>
</div>


<?php 
include('include-footer.php');
?>
</body>
</html>