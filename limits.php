<?php

//--------------------------------
// @author: Băcilă Andrei        |
//            (an4rei)           |
// @IDE: phpStorm                |
// @skype: freerunningparkour    |
//--------------------------------
/*

                                 ,--,
                               ,--.'|
                            ,--,  | :                   ,--,
                   ,---, ,---.'|  : '  __  ,-.        ,--.'|
               ,-+-. /  |;   : |  | ;,' ,'/ /|        |  |,
   ,--.--.    ,--.'|'   ||   | : _' |'  | |' | ,---.  `--'_
  /       \  |   |  ,"' |:   : |.'  ||  |   ,'/     \ ,' ,'|
 .--.  .-. | |   | /  | ||   ' '  ; :'  :  / /    /  |'  | |
  \__\/: . . |   | |  | |\   \  .'. ||  | ' .    ' / ||  | :
  ," .--.; | |   | |  |/  `---`:  | ';  : | '   ;   /|'  : |__
 /  /  ,.  | |   | |--'        '  ; ||  , ; '   |  / ||  | '.'|
;  :   .'   \|   |/            |  : ; ---'  |   :    |;  :    ;
|  ,     .-./'---'             '  ,/         \   \  / |  ,   /
 `--`---'                      '--'           `----'   ---`-'
*/
require('includes/config.php');


$stmt = $db->prepare('SELECT id,status FROM kyc WHERE username = :usercur');
$stmt->execute(array(':usercur' => $_SESSION['username']));
$rowc = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT kycLevel FROM members WHERE username = :usercur');
$stmt->execute(array(':usercur' => $_SESSION['username']));
$rowca = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['killa'])) {
if($_POST['killa']=='Reupload and verify'){
    $stmt = $db->prepare('UPDATE kyc SET status="reuploaded" WHERE username=:user');
    $stmt->execute(array(
        ':user' => $_SESSION['username']
    ));
}
}
if (array_key_exists('passport',$_FILES) AND array_key_exists('passport_backside',$_FILES) AND array_key_exists('utility_bill',$_FILES)) {
    if (!empty($_FILES['passport']) AND !empty($_FILES['passport_backside']) AND !empty($_FILES['utility_bill'])) {

        function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $generareimg = generateRandomString();
        $generareimg2 = generateRandomString();
        $generareimg3 = generateRandomString();

        $target_dir = "4FbGaxxAfsB/";
        $beforee = pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);
        $beforee2 = pathinfo($_FILES['passport_backside']['name'], PATHINFO_EXTENSION);
        $beforee3 = pathinfo($_FILES['utility_bill']['name'], PATHINFO_EXTENSION);

        $target_file = $target_dir . $generareimg . "." . $beforee;
        $target_file2 = $target_dir . $generareimg2 . "." . $beforee2;
        $target_file3 = $target_dir . $generareimg3 . "." . $beforee3;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $imageFileType2 = pathinfo($target_file2, PATHINFO_EXTENSION);
        $imageFileType3 = pathinfo($target_file3, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
        if (array_key_exists('passport', $_FILES) AND array_key_exists('passport_backside', $_FILES) AND array_key_exists('utility_bill', $_FILES)) {
            $check = getimagesize($_FILES["passport"]["tmp_name"]);
            $check2 = getimagesize($_FILES['passport_backside']["tmp_name"]);
            $check3 = getimagesize($_FILES['utility_bill']["tmp_name"]);
            if ($check !== false AND $check2 !== false AND $check3 !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Some files uploaded aren't images.";
                $uploadOk = 0;
            }
        } else {
            echo 'You missed a file.';
        }


// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG" &&
            $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
            && $imageFileType2 != "gif" && $imageFileType2 != "PNG" && $imageFileType2 != "JPG" && $imageFileType2 != "JPEG" &&
            $imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg"
            && $imageFileType3 != "gif" && $imageFileType3 != "PNG" && $imageFileType3 != "JPG" && $imageFileType3 != "JPEG"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["passport_backside"]["tmp_name"], $target_file2)
                && move_uploaded_file($_FILES["utility_bill"]["tmp_name"], $target_file3)
            ) {

                //  echo "The file " . basename($_FILES["passport"]["name"]) . " has been uploaded.";
                //  echo "The file " . basename($_FILES["passport_backside"]["name"]) . " has been uploaded.";
                //   echo "The file " . basename($_FILES["utility_bill"]["name"]) . " has been uploaded.";

                ?>
                <div class="alert-success alert" style="    margin: 0 auto;width: 30%;">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    Your documents have been sent to be reviewed by the admins.<br>
                    This process can take up to 1 week.
                </div>
                <?php
// CHECKING IF pic exists ->

                $stmt = $db->prepare('SELECT front_orig,back_orig,bill_orig FROM kyc WHERE username = :usercur');
                $stmt->execute(array(':usercur' => $_SESSION['username']));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($row)) {

                    $type = pathinfo($target_file, PATHINFO_EXTENSION);
                    $type2 = pathinfo($target_file2, PATHINFO_EXTENSION);
                    $type3 = pathinfo($target_file3, PATHINFO_EXTENSION);

                    $data = file_get_contents($target_file);
                    $data2 = file_get_contents($target_file2);
                    $data3 = file_get_contents($target_file3);

                    $base64_1 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                    $base64_3 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);


                    $stmt = $db->prepare('INSERT INTO kyc (username, front, back, bill, front_orig, back_orig, bill_orig,status) VALUES (:user, :b1, :b2, :b3, :fro, :bac, :bil,"not sent")');
                    $stmt->execute(array(
                        ':b1' => $base64_1,
                        ':b2' => $base64_2,
                        ':b3' => $base64_3,
                        ':fro' => $target_file,
                        ':bac' => $target_file2,
                        ':bil' => $target_file3,
                        ':user' => $_SESSION['username']
                    ));
                } else {
                    if (file_exists($row['front_orig']) AND file_exists($row['back_orig']) AND file_exists($row['bill_orig'])) {
                        unlink($row['front_orig']); //delete
                        unlink($row['back_orig']); //delete
                        unlink($row['bill_orig']); //delete

                        $type = pathinfo($target_file, PATHINFO_EXTENSION);
                        $type2 = pathinfo($target_file2, PATHINFO_EXTENSION);
                        $type3 = pathinfo($target_file3, PATHINFO_EXTENSION);

                        $data = file_get_contents($target_file);
                        $data2 = file_get_contents($target_file2);
                        $data3 = file_get_contents($target_file3);

                        $base64_1 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        $base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                        $base64_3 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);
                        $stmt = $db->prepare('UPDATE kyc SET front_orig=:fro, back_orig=:bac, bill_orig=:bil, front=:b1, back=:b2, bill=:b3 ,status="not sent" WHERE username=:user');
                        $stmt->execute(array(
                            ':b1' => $base64_1,
                            ':b2' => $base64_2,
                            ':b3' => $base64_3,
                            ':fro' => $target_file,
                            ':bac' => $target_file2,
                            ':bil' => $target_file3,
                            ':user' => $_SESSION['username']
                        ));
                    }
                }


            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {

    }
}else{

}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favi.png"/>
    <meta name="theme-color" content="#ffffff">
    <title>FILLIT</title>
    <link href="css/fillit-dash.css" rel="stylesheet" type="text/css">
    <link href="css/fillit-dash2" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;Raleway:300,400,500,600,700,800,900">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">


    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="css/owl-carousel/owl.carousel.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>


    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom style -->
    <link rel="stylesheet" href="css/custom.css"/>

    <script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body class="desktop">


<div class="wrap" style="height:100%;">
    <div class="header clearfix visible-xs">
        <div class="icon-menu"></div>
    </div>
    <nav class="navbar navbar-top navbar-fixed-top hidden-xs">
        <div class="container">
            <div class="navbar-header">
                <a href="dashboard.php" class="navbar-brand"><img style="margin-top: 8px;" src="images/logo.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="b_main-menu">
                <ul class="nav navbar-nav">
                    <li><a href="dashboard.php"><span class="glyphicon glyphicon-credit-card"></span>
                            Cards</a></li>
                    <li>
                        <a href="transfer.php"><span class="glyphicon glyphicon-lock"></span> Transfer Money</a>
                    </li>
                    <li class="active">
                        <a href="#"><span class="fa fa-id-card" style="margin-right:5px;"></span>Limits</a>
                    </li>
                    <!--li><a href="#"><span class="glyphicon glyphicon-transfer"></span> Affiliates</a></li-->
                    <?php if ($user->is_admin()) { ?>
                        <li><a href="bo.php"><span class="glyphicon glyphicon-flag"></span> Admin Panel</a>
                        </li> <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right right-menu-nav">
                    <li>
                        <a href="profile.php" class="btn btn-success btn-empty-bg"><span
                                    class="glyphicon glyphicon-user"></span>Account</a>
                    </li>
                    <li>
                        <a href="logout.php" class="btn btn-primary btn-empty-bg"><span
                                    class="glyphicon glyphicon-log-out"></span>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        html, body {
            height: 100%
        }
    </style>


<div class="j_verification_form id-doc-uplouds">
    <div class="container">
        <h4 class="text-heading">Please upload the following document in order to fully verify your FILLIT account.</h4>
        <form method="POST" novalidate="" enctype="multipart/form-data">
            <br>
            <div class="clearfix">
                <div class="row">
                    <div class="col-md-12 j_id_doc_type">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="control-label" for="id_passport">Frontside</label>
                        </div>
                        <div class="panel-body">
                            <p>Please provide photo of the front side of your personal identification document.<br><br>
                                Document must be of a good quality, with all details clearly visible.</p>
                            <div class="form-group required-input"><label class="sr-only control-label" for="id_passport">Passport</label><div class="row bootstrap3-multi-input"><div class="col-xs-12"><input type="file" name="passport" title="" required="" class="" id="id_passport"></div></div></div>
                            <small>Supported file formats: JPEG, JPG or PDF (max. 50MB)</small>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 j_passport_backside" style="display: block;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="control-label" for="id_passport_backside">Backside</label>
                        </div>
                        <div class="panel-body">
                            <p>Please provide photo of the back side of your personal identification document<br><br>
                                Document must be of a good quality, with all details clearly visible.</p>
                            <div class="form-group"><label class="sr-only control-label" for="id_passport_backside">Passport backside</label><div class="row bootstrap3-multi-input"><div class="col-xs-12"><input type="file" name="passport_backside" id="id_passport_backside" class="" title=""></div></div></div>
                            <small>Supported file formats: JPEG, JPG or PDF (max. 50MB)</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="control-label" for="id_utility_bill">Residence document</label>
                        </div>
                        <div class="panel-body">
                            <p>You need to send us utility bill to aprove your address.</p>
                            <div class="form-group required-input"><label class="sr-only control-label" for="id_utility_bill">Utility bill</label><div class="row bootstrap3-multi-input"><div class="col-xs-12"><input type="file" name="utility_bill" title="" required="" class="" id="id_utility_bill"></div></div></div>
                            <small>Supported file formats: JPEG, JPG or PDF (max. 50MB)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions text-center">
                <div class="form-group">
                    <?php if(empty($rowc) && $rowca['kycLevel']=="LEVEL_1" && !array_key_exists('utility_bill',$_FILES)){ ?>
                    <input type="submit" value="Upload and Verify" class="btn btn-primary btn-lg">
                    <?php }elseif($rowc['status']=='declined' AND !isset($_POST['killa'])) { ?>
                        <br>
                        Your last request was declined. Please reupload the correct information.<br>
                        <input type="submit" name="killa" value="Reupload and verify" class="btn btn-primary btn-lg">
                        <?php
                    }else{
                        echo 'You have the documents already sent.';
                    } ?>
                </div>
            </div>


        </form>
    </div>
</div>

    <!-- Footer -->
</div>
    <footer class="iq-footer " style="background-color:#222;    width: 100%;
margin-bottom:-10%;
    left: 0;
    bottom: 0;">
        <div class="container">
            <div class="row"></div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="footer-copyright iq-ptb-20" style="color:grey"> “Visa Prepaid card is issued by Wave Crest
                        Holdings Limited
                        pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated.
                        Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services
                        Commission, Gibraltar.
                        Streamflow Eood © 2017, All Rights Reserved.
                        Streamflow Eood is a company registered in Bulgaria UIC 202977139.”
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer END -->

