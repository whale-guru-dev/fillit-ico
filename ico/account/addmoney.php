<?php
Include('include-global.php');
$pagename = "Deposit";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Buy FILL Coins";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');

if($overlimit==1){
    redirect("$baseurl/KYC?deposit");
}
?>


<div class="row">

    <br>
    <div class="col-md-6 col-md-offset-3">
        <a href="<?php echo $baseurl; ?>/AddMoneyLog" class="btn btn-info btn-lg btn-block uppercase">FILL Coins LOG</a>
    </div>

    <br><br><br>
    <br><br><br>
</div><!-- row -->

<div class="row">


    <?php


    if (array_key_exists('step2', $_GET)) {

    ////COL SIZE

    $countActive = $db->query("SELECT COUNT(*) FROM deposit_method WHERE status='1'")->fetch();

    if ($countActive[0] == 1) {
        $col = "6 col-md-offset-3";
    } elseif ($countActive[0] == 2) {
        $col = "6";
    } elseif ($countActive[0] == 3) {
        $col = "4";
    } elseif ($countActive[0] == 4) {
        $col = "3";
    } elseif ($countActive[0] == 0) {

        echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">NO PAYMENT METHOD IS AVAILABLE AT THIS TIME!</h1><br><br><br>';

    } else {
        $col = "4";
    }


    ////COL SIZE
if($_GET['step2']=='1' OR $_GET['step2']=='2' OR $_GET['step2']=='3' OR $_GET['step2']=='4') {
    $ddaax = $db->query("SELECT id, name, minamo, maxamo FROM deposit_packages WHERE status='1' AND id=".$_GET['step2']." ORDER BY name");
    $data2 = $ddaax->fetch();
    $ddaa = $db->query("SELECT id, name, minamo, maxamo FROM deposit_method WHERE status='1' ORDER BY name");
    while ($data = $ddaa->fetch()) {
        ?>


        <!-- start box -->
        <div class="col-md-<?php echo $col; ?>">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption bold">
                        <?php echo $data[1]; ?> </div>
                </div>
                <div class="portlet-body text-center">


                    <img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method<?php echo $data[0]; ?>.jpg"
                         class="img-responsive" style="width:100%;<?php if($data[0]==2){ echo "max-height: 217px;";} ?> " alt="Pic">

                    <br>
                    <form method="post" action="<?php echo $baseurl; ?>/DepositPreview">

                                             <input type="hidden" value="<?php echo $data[0]; ?>" name="id">
                                            <input type="hidden" value="<?php echo $data2[0]; ?>" name="id_pk">

                        <?php
                        if(isset($_POST['pkn'])){
                           $totalam = $_POST['pkn'];
                        }else{
                            $totalam = 1;
                        }
                        ?>

                        <input type="hidden" name="pkn" value="<?php echo $totalam; ?>"
                                            <input value="<?php echo $data[2]; ?>" name="amount" type="hidden"
                                                   autocomplete="off">


                    <?php
if($data[0] ==3){
    ?>
    <label for="cryptocoin">Coin</label>
    <select name="coint" id="cryptocoin">
        <option value="--">Select Coin</option>
        <option value="BTC">Bitcoin</option>
        <option value="LTC">Litecoin</option>
        <option value="XRP">Ripple</option>
        <option value="BCC">Bitcoin cash</option>
        <option value="DASH">Dash</option>
        <option value="CURE">Curecoin</option>
        <option value="DOGE">Dogecoin</option>
        <option value="ETC">Ether classic</option>
        <option value="ETH">Ether</option>
        <option value="GLD">Goldcoin</option>
        <option value="XMR">Monero</option>
        <option value="ZEC">Zcash</option>
    </select>

    <?php

    $atribute ="id='crypto' disabled";
}else{
    $atribute = '';
    echo '<div style="height:28px" class=clearfix></div>';
}

if($data[0]!=6) {
    echo "
<input " . $atribute . " type=\"submit\" class=\"btn btn-success btn-block bold deposit_button\" 
 data-target=\"#DepositModal\">



";
}                    ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- end box -->


        <?php
    }
}
    ?>


</div><!-- row -->


<!-- Modal for DEPOSIT button -->
    <div class="modal fade" id="DepositModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">BUY COINS VIA <b class="abir_name">-</b></h4>
                </div>

                <form method="post" action="<?php echo $baseurl; ?>/DepositPreview">


                    <div class="modal-body">

                        <input class="form-control abir_id" type="hidden" name="id">

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">DEPOSIT
                                        AMOUNT</strong>
                                    <span class="abir_limits"></span>
                                </label>
                                <div class="col-md-12">
                                    <div class="input-group mb15">
                                        <input class="form-control input-lg" name="amount" type="text"
                                               autocomplete="off">
                                        <span class="input-group-addon"><?php echo $basecurrency; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">PREVIEW</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- Modal 
    <div id="myModalxa" class="modal fade" role="dialog">
        <div class="modal-dialog">

            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">PayPal Temporary Issues</h4>
                </div>
                <div class="modal-body">
                    <p>Hello!<br>We are currently having issues with the PayPal payments<br>
                    We will do our best to fix them as soon as possible!<br>
                    Thank you!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
-->

<?php

}else{
    $ddaa = $db->query("SELECT id, name, minamo, maxamo,val1,val2 FROM deposit_packages WHERE status='1' ORDER BY id");
    while ($data = $ddaa->fetch()) {
        ?>


        <!-- start box -->
        <div class="col-md-3">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption bold">
                        <?php echo $data[1]; ?> </div>
                </div>
                <div class="portlet-body text-center">


                    <img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method3.jpg"
                         class="img-responsive" style="width:100%;" alt="Pic">

                    <br>
                    Coins: <?php
                    setlocale(LC_MONETARY, 'it_IT');
                    echo $data[2];  ?> FILLIT<br>
                    Bonus: <?php echo $data[4]; ?> %<br>
                    <?php $bon = $data[4]/100 * $data[2];
                          $total = $data[2]+$bon; ?>
                    Total: <?php echo number_format($total); ?> FILLIT<br>
                     <?php echo money_format('%.2n',$data[5]); ?>
                    <hr>
                    <form method="post" action="AddMoney?step2=<?php echo $data[0]; ?>">
                    How many? <input style="width:35px;margin-bottom:5px" type="number" name="pkn">
<br>
                    <?php
                    echo "
<a href='#' onclick=\"this.closest('form').submit();\" type=\"button\" class=\"btn btn-success btn-block bold deposit_button\" 

<i class=\"fa fa-money\"></i> BUY NOW
</a> 
</form>
";
                    ?>

                </div>
            </div>
        </div>

        <!-- end box -->


        <?php


    }
}
include('include-footer.php');
?>

<script>
    $(document).ready(function () {


        $('#cryptocoin').change(function () {
            var coinselected = $("#cryptocoin option:selected").val();

            if(coinselected != '--'){
                $("#crypto").removeAttr('disabled');
            }else{
                $("#crypto").attr('disabled','disabled');
            }

        });

        $('#myModalxa').modal('show');

        $(document).on("click", '.deposit_button', function (e) {

            var name = $(this).data('name');
            var id = $(this).data('id');
            var min = $(this).data('min');
            var max = $(this).data('max');


            $(".abir_id").val(id);
            $(".abir_name").text(name);
            $(".abir_limits").text("( " + min + "-" + max + " <?php echo $basecurrency; ?> )");
        });


    });


</script>
</body>
</html>