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

        <h3 class="page-title uppercase bold"> <i class="fa fa-users"></i> Referrals list</h3>

        <hr>







        <div class="row">

            <div class="col-md-12">





                <?php

                $refmain = $db->query("SELECT ref_id FROM users WHERE id='".$id."'")->fetch();


                $count = $db->query("SELECT COUNT(*) FROM users WHERE ref_by='".$refmain[0]."' ")->fetch();

                $ddaa = $db->query("SELECT * FROM users WHERE ref_by='".$refmain[0]."' ORDER BY mallu DESC");

                //  $usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE ref_by='".$refmain[0]."'")->fetch(); 
                $usernames = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$id."'")->fetch();

                $boxtext = "Referrals list Of $usernames[0] $usernames[1]";

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

                                        <th> NAME </th>

                                        <th> EMAIL </th>

                                        <th> Received </th>

                                        <th> Confirmed E-mail </th>

                                        <th> Confirmed Phone </th>


                                    </tr>

                                    </thead>

                                    <tbody>



                                    <?php

                                    $i = 1;

                                    while ($data = $ddaa->fetch()) {



                                        $UserDetails = $db->query("SELECT firstname,lastname,mallu,ev,mv FROM users WHERE id='".$data['id']."'")->fetch();

                                    //    $method = $db->query("SELECT name FROM deposit_method WHERE id='".$data[3]."'")->fetch();

                                        //$dt = date("dS F Y - h:i A ", $data[2]);


$emailsx=$data['email'];
$coins = (10/100)*$UserDetails['mallu'];
$idx= $data['id'];

if($UserDetails['ev']=='1'){
    $ev = 'Confirmed';
}else{
    $ev = 'Pending';
}



                                        if($UserDetails['mv']=='1'){
                                            $mv = 'Confirmed';
                                        }else{
                                            $mv = 'Pending';
                                        }
                                        echo "

<tr class=''>

<td> $i </td>

<td><a href='$adminurl/UserDetails/$idx'> $UserDetails[0] $UserDetails[1] </a></td>

<td class='bold'>$emailsx </td>

<td class='bold'> $coins </td>

<td class='bold'> $ev </td>

<td class='bold'> $mv </td>



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