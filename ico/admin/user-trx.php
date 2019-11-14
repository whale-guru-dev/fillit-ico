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

        <h3 class="page-title uppercase bold"> <i class="fa fa-list"></i> Transactions</h3>

        <hr>





        <div class="row">

            <div class="col-md-12">



                <?php
              //  $axa = $db->query("SELECT email FROM users WHERE id='".$id."'")->fetch();
               // $id = $axa[0];
                $count = $db->query("SELECT COUNT(*) FROM trx WHERE who='".$id."'")->fetch();

                $ddaa = $db->query("SELECT id, who, byy, amount, sig, typ, charge, tm, trxid, msg, refund FROM trx WHERE who='".$id."' ORDER BY id DESC");

                $usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$id."'")->fetch();

                $boxtext = "Transactions Of $usernames[0] $usernames[1]";

                ?>









                <div class="portlet box green">



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

                                        <th> FROM / TO </th>

                                        <th> AMOUNT </th>

                                        <th> CHARGE </th>

                                        <th> TIME </th>

                                        <th> TRX # </th>

                                        <th> DETAILS </th>

                                        <th> MESSAGE </th>

                                    </tr>

                                    </thead>

                                    <tbody>



                                    <?php

                                    $i = 1;

                                    while ($data = $ddaa->fetch()) {



                                        $UserDetails = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[2]."'")->fetch();

                                        $dt = date("dS F Y - h:i A ", $data[7]);



                                        if ($data[4]=="+") {

                                            $cls="success";

                                        }else{

                                            $cls="danger";

                                        }







                                        $uri = "$adminurl/UserDetails/$data[2]";



                                        if($data[2]=="0"){

                                            $UserDetails = array($basetitle, 'SYSTEM', '' );

                                            $uri = "#";

                                        }





                                        if($data[2]=="000wd"){

                                            $UserDetails = array($basetitle, 'SYSTEM', '' );

                                            $uri = "#";

                                        }



                                        if($data[2]=="000111"){

                                            $nnn = $db->query("SELECT name FROM deposit_method WHERE id='1'")->fetch();

                                            $UserDetails = array($nnn[0], 'Deposit', '' );

                                            $uri = "#";

                                        }



                                        if($data[2]=="000222"){

                                            $nnn = $db->query("SELECT name FROM deposit_method WHERE id='2'")->fetch();

                                            $UserDetails = array($nnn[0], 'Deposit', '' );

                                            $uri = "#";

                                        }



                                        if($data[2]=="000333"){

                                            $nnn = $db->query("SELECT name FROM deposit_method WHERE id='3'")->fetch();

                                            $UserDetails = array($nnn[0], 'Deposit', '' );

                                            $uri = "#";

                                        }



                                        if($data[2]=="000444"){

                                            $nnn = $db->query("SELECT name FROM deposit_method WHERE id='4'")->fetch();

                                            $UserDetails = array($nnn[0], 'Deposit', '' );

                                            $uri = "#";

                                        }



                                        if($data[2]=="000900"){

                                            $UserDetails = array($basetitle, 'Staff', '' );

                                            $uri = "#";

                                        }







                                        $cacata = $db->query("SELECT maxamo FROM deposit_packages WHERE id='".$data[3]."'")->fetch();
                                        $banuti = $cacata[0];

                                        echo "

<tr class='$cls'>

<td> $i </td>

<td><a href='$uri'> $UserDetails[0] $UserDetails[1] </a></td>

<td class='bold'> $banuti $basecurrency </td>

<td> $data[6] $basecurrency </td>

<td> $dt </td>

<td> $data[8] </td>

<td> $data[5] </td>

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