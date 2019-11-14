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

        <h3 class="page-title uppercase bold"> <i class="fa fa-money"></i> Invested Currencies</h3>

        <hr>







        <div class="row">

            <div class="col-md-12">





                <?php






                $ddaa = $db->query("SELECT DISTINCT coin FROM trx")->fetchAll();

                $boxtext = "Invested";



                ?>









                <div class="portlet box yellow">



                    <div class="portlet-title">

                        <div class="caption">

                            <i class="fa fa-list"></i>  <?php echo "$boxtext"; ?>

                        </div>

                        <div class="actions">


                        </div>

                    </div>



                    <div class="portlet-body">



                        <?php

                        if ($ddaa[0]==0) {

                            echo "<h1 class='text-center'> NO RESULT FOUND !</h1>";

                        }else{

                            ?>







                            <div class="table-scrollable">

                                <table class="table table-bordered table-hover">

                                    <thead>

                                    <tr>


                                        <th> Coin </th>

                                        <th> Payed </th>


                                    </tr>

                                    </thead>

                                    <tbody>







                                    <?php

                                 foreach ($ddaa as $cur){

if(!empty($cur['coin'])) {
    $da = $db->query("SELECT SUM(payed) as x FROM trx WHERE coin='" . $cur['coin'] . "'")->fetch();


    echo "

<tr class='success'>

";

if($cur['coin']=='BTC') {
    $symb = '<i class="fa fa-btc"></i> ';
}elseif($cur['coin']=='EUR'){
    $symb='<i class="fa fa-eur"></i> ';
}else{
    $symb='<i class="fa fa-connectdevelop"></i>';
}

    echo "

<td class='bold'>$symb $cur[coin]  </td>


";

    if($cur['coin']=='EUR') {
        echo "
<td class='bold'>".number_format($da['x'], 2, '.', ',') . " </td>


</tr>

";
    }else{
        echo "
<td class='bold'> $da[x] </td>


</tr>

";
    }

}

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