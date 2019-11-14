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

        <h3 class="page-title uppercase bold"> Add New Wire Requests

            <a href="<?php echo $adminurl; ?>/WireRequests" class="btn btn-success btn-md pull-right">

                <i class="fa fa-list"></i>  VIEW ALL</a>

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

                                if($_POST){






                                    $err1=0;

                                    $err2=0;







                                    $error = $err1+$err2;



                                    if ($error == 0) {

                                        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['bankinfo']) && !empty($_POST['country'])&& !empty($_POST['pkid'])&& !empty($_POST['pknr'])) {


                                            $sth = $db->prepare("INSERT INTO wire_requests (name,email,address,bankinfo,country,added_by,pkid,pknr,date,acc_email) VALUES(:name,:email,:address,:bankinfo,:country,:real_email,:pkid,:pknr,:date,:email)");
                                            $sth->execute(array(
                                                ':name' => $_POST['name'],
                                                ':email' => $_POST['email'],
                                                ':address' => $_POST['address'],
                                                ':bankinfo' => $_POST['bankinfo'],
                                                ':country' => $_POST['country'],
                                                ':real_email' => $_SESSION['username'],
                                                ':pkid' => $_POST['pkid'],
                                                ':pknr' => $_POST['pknr'],
                                                ':date' => date("Y-m-d H:i:s")

                                            ));


                                            if ($sth) {

                                                notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");

                                            } else {

                                                notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");

                                            }


                                        } else {




                                                notification("You forgot to complete some fields!", "Please Check..", "error", false, "btn-success", "OKAY");



                                        }

                                    }



                                }//post



                                ?>




                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Email(associated with user)</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="email" placeholder="" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Full Name of user</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="name" placeholder="" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Address</strong></label>

                                    <div class="col-md-12">

                                        <textarea  class="form-control" rows="4" name="address"></textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Bank Info</strong></label>

                                    <div class="col-md-12">

                                        <textarea  class="form-control" rows="4" name="bankinfo"></textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Country</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="country" placeholder="" type="text">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Package id(1 to 4)</strong></label>

                                    <div class="col-md-12">

                                        <select class="form-control select-lg" name="pkid" >
                                        <option value="1">100,00 EUR</option>
                                            <option value="2">300,00 EUR</option>
                                            <option value="3">1.000,00 EUR</option>
                                            <option value="4">3.000,00 EUR</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">How many packages?</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="pknr" placeholder="" type="text">

                                    </div>

                                </div>














                                <br>

                                <br>

                                <br>



                                <div class="row">

                                    <div class="col-md-12">

                                        <button type="submit" class="btn blue btn-block btn-lg">ADD WIRE REQUEST</button>

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