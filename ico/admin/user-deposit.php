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

        <h3 class="page-title uppercase bold"> <i class="fa fa-money"></i> Deposit LOG</h3>

        <hr>







        <div class="row">

            <div class="col-md-12">





                <?php



                $count = $db->query("SELECT COUNT(*) FROM deposit_data WHERE usid='".$id."' AND status='1'")->fetch();

                $ddaa = $db->query("SELECT id, usid, tm, method, amount, charge, amountus, bcam, trx, trx_ext FROM deposit_data WHERE usid='".$id."' AND status='1' ORDER BY id");

                $usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$id."'")->fetch();

                $boxtext = "Deposit Log Of $usernames[0] $usernames[1]";

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

                                        <th> METHOD </th>

                                        <th> USER </th>

                                        <th> AMOUNT </th>

                                        <th> CHARGE </th>

                                        <th> EUR </th>

                                        <th> TIME </th>

                                        <th> TRX # </th>

                                        <th> EXTRENAL TRX # </th>

                                    </tr>

                                    </thead>

                                    <tbody>



                                    <?php

                                    $i = 1;

                                    while ($data = $ddaa->fetch()) {



                                        $UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();

                                        $method = $db->query("SELECT name FROM deposit_method WHERE id='".$data[3]."'")->fetch();

                                        $dt = date("dS F Y - h:i A ", $data[2]);



                                        echo "

<tr class=''>

<td> $i </td>

<td><img src='$fronturl/assets/images/deposit-method/method$data[3].jpg' alt='' style='width:24px; height:24px;'>  $method[0] </td>



<td><a href='$adminurl/UserDetails/$data[1]'> $UserDetails[0] $UserDetails[1] </a></td>

<td class='bold'> $data[4] $basecurrency </td>

<td class='bold'> $data[5] $basecurrency </td>

<td class='bold'> $data[6] </td>

<td> $dt </td>

<td> $data[8] </td>

<td> $data[9] </td>

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