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



        <h3 class="page-title uppercase bold"> Edit Wire Request



            <span class=" pull-right">

<a href="<?php echo $adminurl; ?>/AddWire" class="btn btn-primary btn-md ">

<i class="fa fa-plus"></i>   ADD NEW

</a>



<a href="<?php echo $adminurl; ?>/WireRequests" class="btn btn-success btn-md">

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
                                $old = $db->query("SELECT name, email,country,address,bankinfo,pkid,pknr,status,acc_email FROM wire_requests WHERE id='".$iidd."'")->fetch();
                                $olde = $db->query("SELECT id FROM users WHERE email='".$old[1]."'")->fetch();
                                $PackageData = $db->query("SELECT maxamo,val2 FROM deposit_packages WHERE id='".$old[5]."'")->fetch();


                                if($_POST){











                                        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['bankinfo']) && !empty($_POST['country'])&& !empty($_POST['pkid'])&& !empty($_POST['pknr'])&& !empty($_POST['status']) ) {


                                            $sth = $db->prepare("UPDATE wire_requests SET name=:name, email=:email, address=:address,bankinfo=:bankinfo,country=:country,pkid=:pkid,pknr=:pknr WHERE id=".$_GET['id']);
                                            $sth->execute(array(
                                                ':name' => $_POST['name'],
                                                ':email' => $_POST['email'],
                                                ':address' => $_POST['address'],
                                                ':bankinfo' => $_POST['bankinfo'],
                                                ':country' => $_POST['country'],
                                                ':pkid' => $_POST['pkid'],
                                                ':pknr' => $_POST['pknr']


                                            ));


                                            if($_POST['status']==1){

//////////---------------------------------------->>>> ADD THE BALANCE
                                                $ct = $db->query("SELECT mallu FROM users WHERE email='" . $old[1] . "'")->fetch();
                                                $ctn = $ct[0] + $PackageData[0];
                                                $db->query("UPDATE users SET mallu='" . $ctn . "' WHERE email='" . $old[1] . "'");
//////////---------------------------------------->>>> ADD THE BALANCE


                                                $copil= $db->query("SELECT ref_by,id FROM users WHERE email='".$old[1]."' ",PDO::FETCH_ASSOC)->fetch();
                                                $usermain= $db->query("SELECT id FROM users WHERE ref_id='".$copil['ref_by']."' ",PDO::FETCH_ASSOC)->fetch();

                                                if($copil['ref_by'] != 0 AND !empty($copil)){

                                                    //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
                                                    $ct = $db->query("SELECT mallu FROM users WHERE id=".$usermain['id']."")->fetch();
                                                    $ctn = $ct[0]+(10/100 *$PackageData[0]); //10 percent of package coins
                                                    $db->query("UPDATE users SET mallu='".$ctn."' WHERE id=".$usermain['id']."");
//////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
                                                }


/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
                                                $db->query("UPDATE wire_requests SET status='1' WHERE id='" . $_GET['id']. "'");

/////////////------------------------->>>>>>>>>>> TRX
                                                $db->query("INSERT INTO trx SET who='" . $olde[0] . "', byy='000069', amount='" . $old[5] . "', sig='+', typ='ADD MONEY VIA WIRE REQUEST',tm='".$tm."' , charge='".$_POST['pknr']."', payed= '".$PackageData[1]."',coin='EUR', refund='7'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
                                                $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE email='" . $old[1] . "'")->fetch();

                                                $txt = "Your Deposit of $PackageData[0] $basecurrency via WIRE Request Has Been Processed. ";
                                                abiremail($su[3], "Deposited Successfully", $su[0], $txt);
                                                abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
                                            }

                                            if ($sth) {

                                                notification("Edited Successfully!", "", "success", false, "btn-success", "OKAY");

                                            } else {

                                                notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");

                                            }


                                        } else {




                                            notification("You forgot to complete some fields!", "Please Check..", "error", false, "btn-success", "OKAY");



                                        }





                                }//post




                if(!isset($_POST['status'])){
                                    $_POST['status']=0;
                }


                                ?>







                                <div class="form-group">
                                    User account associated email: <?php echo $old[8] ?>

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Email Address of user(from request)</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="email" <?php if($old[7]==1 or $_POST['status']==1){ echo 'disabled';} ?> value="<?php echo $old[1]; ?>" type="email">

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Full name of user</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="name" <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> value="<?php echo $old[0]; ?>" type="text">

                                    </div>

                                </div>




                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Address</strong></label>

                                    <div class="col-md-12">

                                        <textarea class="form-control" rows="10" <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> name="address"><?php echo $old[3]; ?></textarea>

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Bank Info</strong></label>

                                    <div class="col-md-12">

                                        <textarea class="form-control" rows="10" <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> name="bankinfo"><?php echo $old[4]; ?></textarea>

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Country</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="country" <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> placeholder="" value="<?php echo $old[2]; ?>" type="text">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Package id(1 to 4)</strong></label>

                                    <div class="col-md-12">

                                        <select class="form-control select-lg" name="pkid" <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?>>
                                            <option <?php if($old[5]=='1'){echo 'selected';} ?> value="1">100,00 EUR</option>
                                            <option <?php if($old[5]=='2'){echo 'selected';} ?> value="2">300,00 EUR</option>
                                            <option  <?php if($old[5]=='3'){echo 'selected';} ?> value="3">1.000,00 EUR</option>
                                            <option  <?php if($old[5]=='4'){echo 'selected';} ?> value="4">3.000,00 EUR</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">How many packages?</strong></label>

                                    <div class="col-md-12">

                                        <input class="form-control input-lg" name="pknr" placeholder=""  <?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> value="<?php echo $old[6]; ?>" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Wire Request Status</strong><br>
                                        Warning , status <strong>COMPLETED</strong> will add the coins to the user's balance.</label><br>


                                    <div class="col-md-12">
                                        <?php if($old[7]==1  or $_POST['status']==1){  ?>
                                        <select<?php if($old[7]==1  or $_POST['status']==1){ echo 'disabled';} ?> class="form-control select-lg" name="status" >

                                            <option >Completed</option>
                                        </select>
 <?php }else{
?>  <select class="form-control select-lg" name="status" >
                                                <option value="0">Pending</option>
                                                <option value="1">Completed</option>
                                            </select>

                                        <?php
                                        } ?>
                                    </div>

                                </div>



                                <br>

                                <br>

                                <br>



                                <div class="row">

                                    <div class="col-md-12">

                                        <button type="submit" class="btn blue btn-block btn-lg">UPDATE</button>

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