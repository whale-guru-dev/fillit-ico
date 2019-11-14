<?php

include ('include/header.php');

?>

</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo">

<?php

include ('include/sidebar.php');

$id = $_GET['id'];
if ($mypower<100) {

    redirect("$adminurl/Dashboard");

}
?>

<div class="page-content-wrapper">

    <div class="page-content">

        <h3 class="page-title uppercase bold"> <i class="fa fa-money"></i> add / substruct balance</h3>

        <hr>



        <div class="row">

            <div class="col-md-8">





                <?php
                function generateRandomString($length = 10) {
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                $txn_id = generateRandomString();
                if ($_POST) {

                    $operation = isset($_POST["operation"])? 1:0; /// 1== Add

                    $amount = round($_POST["amount"], $baseDecimal);

                    $message = $_POST['message'];



                    if ($amount<=0) {

                        notification("WRONG AMOUNT", "AMOUNT MUST BE A POSITIVE NUMBER", "error", false, "btn-success", "OKAY");

                    }else{



                        if ($operation==1) {



////##################### ADD MONEY


                            $trx = $txn_id;



                            $recdetails = $db->query("SELECT mallu FROM users WHERE id='".$id."'")->fetch(); 

                            $recnewbal = $recdetails[0]+$amount;

                            $res = $db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$id."'");

                            if($res){

                                notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");





                                $db->query("INSERT INTO trx SET who='".$id."', byy='000900', amount='".$amount."', sig='+', typ='Added By Staff', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$message."', refund='8' , many='".$amount."'");

////##################### ADD MONEY
                                $copil= $db->query("SELECT ref_by,id FROM users WHERE id='".$id."' ",PDO::FETCH_ASSOC)->fetch();
                                $usermain= $db->query("SELECT id FROM users WHERE ref_id='".$copil['ref_by']."' ",PDO::FETCH_ASSOC)->fetch();
                                    //    echo 'inside res <br>';

                                if($copil['ref_by'] != '0' AND (!empty($usermain))){
//echo ' anoteher<br>';
                                    //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL

                                    $ctx = $db->query("SELECT mallu FROM users WHERE id=".$usermain['id']."")->fetch();
                                    $ctna = $ctx[0]+(10/100 *$amount); //10 percent of package coins
                                    $db->query("UPDATE users SET mallu='".$ctna."' WHERE id=".$usermain['id']."");
                                    $res = $db->query("INSERT INTO logs SET log='adaugat la referal ".$usermain['id']."', date='".date("Y-m-d H:i:s")."' ");
//////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
                                }
                             //   print_r($copil);
///////////////////add to generated

                                $db->query("INSERT INTO generated SET tto='".$id."', amount='".$amount."', trx='".$trx."', tm='".$tm."', msg='".$message."'");

                            }else{

                                notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");

                            }





                        }else{





////##################### CUT MONEY

                            $trx = $txn_id;



                            $recdetails = $db->query("SELECT mallu FROM users WHERE id='".$id."'")->fetch();

                            $recnewbal = $recdetails[0]-$amount;

                            $res = $db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$id."'");
////##################### ADD MONEY
                            $copil= $db->query("SELECT ref_by,id FROM users WHERE id='".$id."' ",PDO::FETCH_ASSOC)->fetch();
                            $usermain= $db->query("SELECT id FROM users WHERE ref_id='".$copil['ref_by']."' ",PDO::FETCH_ASSOC)->fetch();
                            //    echo 'inside res <br>';
                            if($copil['ref_by'] != '0' AND (!empty($usermain))){
//echo ' anoteher<br>';
                                //////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
                                $ctx = $db->query("SELECT mallu FROM users WHERE id=".$usermain['id']."")->fetch();
                                $ctna = $ctx[0]-(10/100 *$amount); //10 percent of package coins
                                $db->query("UPDATE users SET mallu='".$ctna."' WHERE id=".$usermain['id']."");
                                $res = $db->query("INSERT INTO logs SET log='adaugat la referal ".$usermain['id']."', date='".date("Y-m-d H:i:s")."' ");
//////////---------------------------------------->>>> ADD THE BALANCE TO REFERRAL
                            }


                            if($res){

                                notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");

                                $db->query("INSERT INTO trx SET who='".$id."', byy='000900', amount='".$amount."', sig='-', typ='Substructed By Staff', charge='0', tm='".$tm."', trxid='".$trx."', msg='".$message."', many='-".$amount."', refund='8'");



////##################### CUT MONEY

///////////////////add to generated

                                $db->query("INSERT INTO generated SET tto='".$id."', amount='-".$amount."', trx='".$trx."', tm='".$tm."', msg='".$message."'");



                            }else{

                                notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");

                            }









                        }





                    }//amount > 0



                }//post



                $usernames = $db->query("SELECT firstname, lastname, email, mallu FROM users WHERE id='".$id."'")->fetch();

                $boxtext = " add / substruct balance to $usernames[0] $usernames[1]";

                ?>









                <div class="portlet box blue">

                    <div class="portlet-title">

                        <div class="caption uppercase bold">

                            <i class="fa fa-cog"></i>  <?php echo "$boxtext"; ?>

                        </div>

                    </div>

                    <div class="portlet-body">





                        <form action="" method="post">





                            <div class="row uppercase">



                                <div class="col-md-5">

                                    <div class="form-group">

                                        <label class="col-md-12"><strong>OPERATION</strong></label>

                                        <div class="col-md-12">

                                            <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="Add Money" data-off="substruct Money"  data-width="100%" data-height="46" type="checkbox" name="operation">

                                        </div>

                                    </div>

                                </div>





                                <div class="col-md-7">

                                    <div class="form-group">

                                        <label class="col-md-12"><strong>Amount</strong></label>

                                        <div class="col-md-12">

                                            <div class="input-group mb15">

                                                <input class="form-control input-lg" name="amount"  type="text" required="">

                                                <span class="input-group-addon"><?php echo $basecurrency; ?></span>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div><!-- row -->



                            <br><br>



                            <div class="row uppercase">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="col-md-12"><strong>Message</strong></label>

                                        <div class="col-md-12">

                                            <textarea name="message" rows="2" class="form-control" placeholder="if any"></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div><!-- row -->



                            <br><br>

                            <div class="row uppercase">

                                <div class="col-md-12">



                                    <button type="submit" class="btn btn-success btn-lg btn-block"> SUBMIT </button>



                                </div>

                            </div><!-- row -->







                        </form>

                    </div>

                </div>

            </div>









            <div class="col-md-4">



                <div class="portlet box green">

                    <div class="portlet-title">

                        <div class="caption uppercase bold">

                            <i class="fa fa-money"></i>  CURRENT BALANCE</div>

                    </div>

                    <div class="portlet-body uppercase text-center">





                        <h1>CURRENT BALANCE OF <br> <strong><?php echo "$usernames[0] $usernames[1]"; ?></strong></h1>





                        <br>



                        <h1><strong><?php echo "$usernames[3] $basecurrency"; ?></strong></h1>







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