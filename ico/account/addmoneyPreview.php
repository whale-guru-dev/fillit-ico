<?php
Include('include-global.php');
$pagename = "Deposit  Preview";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Add Money To Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-desktop"></i> DEPOSIT PREVIEW </div>
</div>

<div class="portlet-body">


<?php
$curente = array('BTC','LTC','XRP','BCC','DASH','CURE','DOGE','ETC','ETH','GLD','XMR','ZEC');
if ($_POST ) {
$method = $_POST["id"];
    $ddaax = $db->query("SELECT id, name, minamo, maxamo, val1,val2 FROM deposit_packages WHERE status='1' AND id=".$_POST['id_pk']." ORDER BY id");
    $data2 = $ddaax->fetch();


                        if(isset($_POST['pkn'])){
                            if($_POST['pkn']!=1 AND $_POST['pkn']!=0 AND !empty($_POST['pkn'])){
                                $totalam = $_POST['pkn'];
                            }else{
                                $totalam = 1;
                            }
                        }else{
                            $totalam = 1;
                        }


    $bon = $data2[4]/100 * $data2[2];
    $total = ($data2[2]* $totalam)+$bon;

$amount =  round($total, $baseDecimal);

$data = $db->query("SELECT name, minamo, maxamo, charged, chargep, rate, status FROM deposit_method WHERE id='".$method."'")->fetch();

    if($data[0]=='PayPal'){
        $paypal=1;


    }else {
        $paypal = 0;
    }
$err1 = $amount<=0 ? 1:0;
$err2 = $data[6]!=1 ? 1:0; // Status OFF
$err3 = $amount<$data[1]?1:0;
$err4 = $amount>$data[2]?1:0;


$error = $err1+$err2+$err3+$err4;
if ($error == 0){

$per = $amount*$data[4]/100;
$charge =  round($per+$data[3] , $baseDecimal);
$gt =  round($amount , $baseDecimal);
    if($paypal==1){
        $ab = $data2[5]*$totalam;
        $taxa = 2.2/100 * $ab;
        $inUS = round($ab + $taxa, $baseDecimal);

    }else {
        $inUS = round($data2[5] * $totalam, $baseDecimal);
    }

$un = uniqid();
$ra = rand(10000,99999);
$dtrx = md5($tm.$un.$ra);


?>






<div class="table-scrollable">
    <?php if($data[0]=='Crypto'){ ?>
<div style="display:none;">
<label for="cryptocoin">Coin</label>
    <select id="cryptocoin">
        <option value="<?php echo $_POST['coint']; ?>"><?php echo $_POST['coint']; ?></option>

    </select></div>
<?php } ?>
<table class="table table-bordered table-hover">
<tbody>


<tr>
<td><strong style="font-size: 1.5em;" class="pull-right">Method</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$data[0]"; ?></strong></td>
</tr>
<tr class="">
    <td><strong style="font-size: 1.5em;" class="pull-right">Packages</strong> </td>
    <td> <strong style="font-size: 1.5em;"><?php echo $totalam; ?></strong></td>
</tr>


<tr class="" >
<td style="width: 50%;"><strong style=" font-size: 1.5em;" class="pull-right">Amount(with <?php echo $data2[4]; ?>% bonus)</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$amount $basecurrency"; ?></strong></td>
</tr>


<tr class="info">
<td><strong style="font-size: 1.5em;" class="pull-right">TOTAL</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$gt $basecurrency"; ?></strong></td>
</tr>
<?php if($paypal==1){ ?>
<tr class="info">
    <td><strong style="font-size: 1.5em;" class="pull-right">PayPal Tax</strong> </td>
    <td> <strong style="font-size: 1.5em;"><?php echo "2.2%"; ?></strong></td>
</tr>
<?php } ?>
<tr class="success">
<td><strong style="font-size: 1.5em;" class="pull-right">IN EUR</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$inUS EUR"; ?></strong></td>
</tr>
<?php if($data[0]=='Crypto' AND in_array($_POST['coint'],$curente)){
    $cryptos ='y';
    ?>
<tr class="success">
    <td><strong style="font-size: 1.5em;" class="pull-right">IN <?php echo $_POST['coint'] ?> COINS</strong> </td>
    <td> <strong id="finalrez" style="font-size: 1.5em;">Loading...</strong></td>
</tr>


<?php } ?>




</tbody>
</table>
</div>





<div class="row"><br><br>

<?php
if(isset($cryptos) AND $cryptos=='y') {
    $res = $db->query("INSERT INTO deposit_data SET usid='" . $uid . "', tm='" . $tm . "', method='" . $method . "', track='" . $dtrx . "', amount='" . $_POST['id_pk'] . "', charge='" . $totalam . "',coin='" . $_POST['coint'] . "' , amountus='" . $inUS . "'");
}else{
    $res = $db->query("INSERT INTO deposit_data SET usid='" . $uid . "', tm='" . $tm . "', method='" . $method . "', track='" . $dtrx . "', amount='" . $_POST['id_pk'] . "', charge='" . $totalam . "' , amountus='" . $inUS . "'");

}
if ($res) {
$_SESSION['depoistTrack'] = $dtrx;
?>
<div class="col-md-6">
<a href="<?php echo $baseurl;?>/AddMoney" class="btn btn-danger btn-lg btn-block"> CANCEL </a>
</div>

<div class="col-md-6">
<a href="<?php echo $baseurl;?>/DepositNow" class="btn btn-success btn-lg btn-block"> DEPOSIT NOW</a>
</div>

<?php
}else{
echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>SOME PROBLEM OCCURE, PLEASE RELOAD THE PAGE !</b>
</div>";
}


 ?>








</div>




<?php
}else{
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>AMOUNT MUST BE A POSITIVE NUMBER!</b>
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>DEPOSIT  METHOD IS NOT AVAILABLE AT THIS TIME</b>
</div>";
}   

if ($err3 == 1 || $err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>You Can Only Deposit Between $data[1] - $data[2]  $basecurrency </b>
</div>";
}   

echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/AddMoney" class="btn blue btn-lg btn-block"> ADD MONEY </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';

}
}
?>




</div>
</div>


<?php 
include('include-footer.php');

?>
<?php if(isset($cryptos) && $cryptos=='y'){ ?>

    <script>
        $(document).ready(function() {


                var coinselected = $("#cryptocoin option:selected").val();

                document.getElementById("finalrez").innerHTML = coinselected;

                $("#cryptocoin").attr('disabled','disabled');
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: {
                        'getrate': 'yes',
                        'type': coinselected,
                        'val': <?php echo $inUS; ?>
                    },
                    success: function (msg) {
                        document.getElementById("finalrez").innerHTML = msg;
                        $("#cryptocoin").removeAttr('disabled');
                    }
                });

            });

    </script>
<?php } ?>
</body>
</html>