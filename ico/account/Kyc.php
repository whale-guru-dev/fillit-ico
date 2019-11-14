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





Include('include-global.php');
$pagename = "KYC Limits";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "KYC Limits for your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');

$stmt = $db->prepare('SELECT id,status FROM kyc WHERE username = :usercur');
$stmt->execute(array(':usercur' => $_SESSION['username']));
$rowc = $stmt->fetch(PDO::FETCH_ASSOC);

if (array_key_exists('passport',$_FILES) AND array_key_exists('passport_backside',$_FILES) AND array_key_exists('utility_bill',$_FILES)) {
    if (!empty($_FILES['passport']['name']) AND !empty($_FILES['passport_backside']['name']) AND !empty($_FILES['utility_bill']['name'])) {

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

        $target_dir = "4FbGaXxxAfsB/";
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

            if($imageFileType !='pdf') {
                $check = getimagesize($_FILES["passport"]["tmp_name"]);
            }else{
                $check=6000;
            }
            if($imageFileType2 !='pdf') {
                $check2 = getimagesize($_FILES['passport_backside']["tmp_name"]);
            }else{
                $check2=6000;
            }
            if($imageFileType3 !='pdf') {
                $check3 = getimagesize($_FILES['utility_bill']["tmp_name"]);
            }else{
                $check3=6000;
            }

            if ($check !== false AND $check2 !== false AND $check3 !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Some files uploaded aren't images/pdf.";
                $uploadOk = 0;
            }
        } else {
            echo 'You missed a file.';
        }


// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "PDF"
            && $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG" &&
            $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "pdf" && $imageFileType2 != "PDF"
            && $imageFileType2 != "gif" && $imageFileType2 != "PNG" && $imageFileType2 != "JPG" && $imageFileType2 != "JPEG" &&
            $imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg" && $imageFileType3 != "pdf" && $imageFileType3 != "PDF"
            && $imageFileType3 != "gif" && $imageFileType3 != "PNG" && $imageFileType3 != "JPG" && $imageFileType3 != "JPEG"
        ) {
            echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
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
                <div class="alert-success alert" style="    margin: 0 auto;width: 50%;">
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




                    $stmt = $db->prepare('INSERT INTO kyc (username, front_orig, back_orig, bill_orig,status) VALUES (:user, :fro, :bac, :bil,"pending")');
                    $stmt->execute(array(
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


                        $stmt = $db->prepare('UPDATE kyc SET front_orig=:fro, back_orig=:bac, bill_orig=:bil , status="pending" WHERE username=:user');
                        $stmt->execute(array(
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


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-desktop"></i> Raise your FILLIT wallet limits</div>
    </div>

    <div class="portlet-body">




        <div style="text-align:center;">
            <h1><span id="finalreza">Please upload the next documents</span> </h1><br>
            <h4><span id="finalrez"></span>Your wallet value is currently <?php echo number_format(($mallu * $tokprice[0]), 0,'.',',');  ?> EURO </label>
                <?php if(isset($_GET['deposit'])){
                    echo '<br><br>You have exceeded the 1500 EUR limit therefore you can\'t own any more coins until verification<br>';
                }?> </h4></div>
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
                        <div class="panel-body" style="min-height: 212px;">
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
                        <div class="panel-body" style="min-height: 212px;">
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
                        <div class="panel-body" style="min-height: 212px;">
                            <p>You need to send us utility bill to aprove your address.<br><br>
                                Document must be of a good quality, with all details clearly visible.</p>
                            <div class="form-group required-input"><label class="sr-only control-label" for="id_utility_bill">Utility bill</label><div class="row bootstrap3-multi-input"><div class="col-xs-12"><input type="file" name="utility_bill" title="" required="" class="" id="id_utility_bill"></div></div></div>
                            <small>Supported file formats: JPEG, JPG or PDF (max. 50MB)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions text-center">
                <div class="form-group">
                    <?php

                    if(empty($rowc)  && empty($_FILES['utility_bill']['name'])){ ?>
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
<?php
include('include-footer.php');

?>


</body>
</html>