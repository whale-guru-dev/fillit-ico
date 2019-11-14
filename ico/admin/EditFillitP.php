<?php

include ('include/header.php');

if ($mypower<100) {

    redirect("$adminurl/Dashboard");

}

?>

</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo">



<?php

include ('include/sidebar.php');

?>



<div class="page-content-wrapper">

    <div class="page-content">

        <h3 class="page-title uppercase bold"> Edit Packege



            <span class=" pull-right">

<!--a href="<?php echo $adminurl; ?>/AddPackege" class="btn btn-primary btn-md ">

<i class="fa fa-plus"></i>   ADD NEW

</a-->



<a href="<?php echo $adminurl; ?>/FillitPack" class="btn btn-success btn-md">

<i class="fa fa-list"></i>  VIEW ALL

</a>

</span>

        </h3>



        <hr>







        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN SAMPLE FORM PORTLET-->

                <div class="portlet light bordered">



                    <div class="portlet-body form">

                        <form class="form-horizontal" action="" method="post" role="form">

                            <div class="form-body">





                                <?php

                                $iidd = $_GET["id"];

                                if($_POST){



                                    $name = $_POST["name"];

                                    $price = $_POST["price"];

                                    $coins = $_POST["coins"];

                                    $bonus = $_POST["bonus"];

                                    $status = $_POST["status"];








                                    if (!empty($name)&&!empty($price)&&!empty($coins)&&!empty($bonus)){

                                        $res = $db->query("UPDATE deposit_packages SET name='".$name."', maxamo='".$coins."', val1='".$bonus."', val2='".$price."', status=".$status." WHERE id='".$iidd."'");



                                        if($res){

                                            notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");

                                        }else{

                                            notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");

                                        }



                                    } else {


                                            notification("You left some fields uncompleted", "Please Check..", "error", false, "btn-success", "OKAY");


                                    }





                                }//post





                                $old = $db->query("SELECT name,  minamo, maxamo, val1, val2, status FROM deposit_packages WHERE id='".$iidd."'")->fetch();





                                ?>



                                <div class="alert alert-info" style="text-transform: uppercase;">

                                    Please input only <strong>numbers</strong> excepting the name.



                                </div>









                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Package Name</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="name" value="<?php echo $old[0]; ?>" type="text">

                                    </div>

                                </div>








                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Package Price</strong><small>(EUR)</small></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="price" value="<?php echo $old[4]; ?>" type="text">

                                    </div>

                                </div>









                                <div class="row">





                                    <div class="col-md-6">





                                        <div class="panel panel-primary">

                                            <div class="panel-heading">

                                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">FILLIT Virtual Coins</h1>

                                            </div>

                                            <div class="panel-body">

                                                <div class="row">





                                                    <div class="col-md-6">

                                                        <div class="form-group">

                                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Amount</strong></label>

                                                            <div class="col-md-12">

                                                                <div class="input-group mb15">

                                                                    <input class="form-control input-lg" name="coins" value="<?php echo $old[2]; ?>" type="text">

                                                                    <span class="input-group-addon"><?php echo $basecurrency; ?></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>







                                                    <div class="col-md-6">

                                                        <div class="form-group">

                                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Bonus</strong></label>

                                                            <div class="col-md-12">

                                                                <div class="input-group mb15">

                                                                    <input class="form-control input-lg" name="bonus" value="<?php echo $old[3]; ?>" type="text">

                                                                    <span class="input-group-addon"><?php echo '%'; ?></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>



                                                </div><!-- row 2nd	 -->

                                            </div>

                                        </div>





                                    </div><!-- col-6	 -->



                                </div>







                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Status</strong></label>

                                    <div class="col-md-12">

                                        <select class="form-control select-lg" name="status"  >
                                        <option  <?php if($old[5]=='1'){echo 'selected';} ?> value="1">ON</option>
                                        <option <?php if($old[5]=='0'){echo 'selected';} ?> value="0">OFF</option>
                                        </select>

                                    </div>

                                </div>



                                <br>

                                <br>

                                <br>



                                <div class="row">

                                    <div class="col-md-12">

                                        <button type="submit" class="btn blue btn-block btn-lg">UPDATE PACKAGE</button>

                                    </div>

                                </div>





                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div><!---ROW-->









    </div>

</div>

<?php

include ('include/footer.php');

?>

</body>

</html>