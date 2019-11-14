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

include ('include/header.php');



?>

    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo">





<?php

include ('include/sidebar.php');


if (!array_key_exists("ledit", $_GET)) {
    $stmt = $db->prepare('SELECT id,username,status FROM kyc');
    $stmt->execute(array(':usercur' => $_SESSION['username']));
    $rowabs = $stmt->fetchAll(PDO::FETCH_ASSOC);


    ?>

    <div class="page-content-wrapper">

    <div class="page-content">

        <h3 class="page-title uppercase bold"> View KYC Requests



        </h3>

        <hr>





        <div class="row">

            <div class="col-md-12">

                <div class="portlet light bordered">

                    <div class="portlet-title">

                        <div class="caption font-dark">

                        </div>

                        <div class="tools"> </div>

                    </div>

                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
            <tr>
                <th>ID</th>
                <th class="right">E-mail</th>
                <th>First Name</th>

                <th>Last Name</th>
                <th>Status</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
            <?php


            foreach ($rowabs as $cuc) {
                $stmt = $db->prepare('SELECT firstname ,lastname FROM users WHERE email=:usercur');
                $stmt->execute(array(':usercur' => $cuc['username']));
                $rowabs = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($cuc['status'] == 'pending') {
                    $pla = 'Pending';
                } elseif ($cuc['status'] == 'declined') {
                    $pla = 'Declined';
                } elseif ($cuc['status'] == 'accepted') {
                    $pla = 'Accepted';
                } else {
                    $pla = ' More details ->';
                }
                ?>
                <tr>
                    <td><?php echo $cuc['id']; ?></td>
                    <td><?php echo $cuc['username']; ?></td>
                    <td><?php echo $rowabs['firstname']; ?></td>

                    <td><?php echo $rowabs['lastname']; ?></td>
                    <td><?php echo $pla; ?></td>

                    <td><a href="KYC?ledit=<?php echo $cuc['id'] ?>">
                            <button class="btn">
                                View
                            </button>
                        </a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <?php

} else {
    if (array_key_exists('declined', $_POST)) {
        $stmt = $db->prepare('UPDATE kyc SET status= :status WHERE id=:id_cur');
        $stmt->execute(array(
            ':status' => 'declined',
            ':id_cur' => $_POST['id_kyc']
        ));
    }

    if (array_key_exists('verf', $_POST)) {
        $stmt = $db->prepare('SELECT id,front,back,bill,username FROM kyc WHERE id=:get');
        $stmt->execute(array(':get' => $_POST['id_kyc']));
        $rowfuk = $stmt->fetch(PDO::FETCH_ASSOC);





        if (!empty($rowfuk)) {
            $stmt = $db->prepare('UPDATE users SET kyc=1 WHERE email=:get');
            $stmt->execute(array(':get' => $rowfuk['username']));



            $stmt = $db->prepare('UPDATE kyc SET status= :status WHERE id=:id_cur');
            $stmt->execute(array(
                ':status' => 'accepted',
                ':id_cur' => $_POST['id_kyc']
            ));


        }
    }
    $stmt = $db->prepare('SELECT id,front_orig,back_orig,bill_orig,username,status FROM kyc WHERE id=:get');
    $stmt->execute(array(':get' => $_GET['ledit']));
    $rowabs = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare('SELECT firstname ,lastname,gender,mobile,location,dob FROM users WHERE email=:usercur');
    $stmt->execute(array(':usercur' => $rowabs['username']));
    $rowabsa = $stmt->fetch(PDO::FETCH_ASSOC);


    ?>

        <div class="page-content-wrapper">

            <div class="page-content">

                <h3 class="page-title uppercase bold"> Review KYC

                    <a href="<?php echo $adminurl; ?>/KYC" class="btn btn-primary btn-md pull-right">

                      Back
                    </a>

                </h3>

                <hr>





                <div class="row">

                    <div class="col-md-12">

                        <div class="portlet light bordered">
                            <?php if (!empty($rowabs['status'])) {
                                echo '<h1>Status: '.ucfirst($rowabs['status']).'</h1>';
                            }


                            ?>
                            <div class="portlet-title">

                                <div class="caption font-dark">

                                </div>

                                <div class="tools"> </div>

                            </div>

                            <div class="portlet-body">


    <div class="row">
        <div class="col-md-4">
            <div class="form-group"><label class="control-label" for="id_first_name">User
                    name</label>
                <div class="form-control"><?php echo $rowabs['username'] ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"><label class="control-label" for="id_last_name">First
                    Name</label>
                <div class="form-control"><?php echo $rowabsa['firstname'] ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"><label class="control-label" for="id_last_name">Last
                    Name</label>
                <div class="form-control"> <?php echo $rowabsa['lastname']; ?></div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group"><label class="control-label"
                                           for="id_first_name">Gender</label>
                <div class="form-control"><?php echo $rowabsa['gender'] ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"><label class="control-label" for="id_last_name">Date of
                    Birth</label>
                <div class="form-control"> <?php echo $rowabsa['dob']; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"><label class="control-label"
                                           for="id_last_name">Country</label>
                <div class="form-control"> <?php echo $rowabsa['location']; ?></div>
            </div>
        </div>


    </div>

    <div class="row well">
        <div class="col-md-4">
            <a href="../account/<?php echo $rowabs['front_orig']; ?>">
                <?php if((substr($rowabs['front_orig'], -3)) != 'pdf'){ ?>
                <img width="100%" src="../account/<?php echo $rowabs['front_orig']; ?>">
                <?php }else{
                    echo 'Download PDF';
                } ?>
            </a>
        </div>


        <div class="col-md-4">
            <a href="../account/<?php echo $rowabs['back_orig']; ?>">
                <?php if((substr($rowabs['back_orig'], -3)) != 'pdf'){ ?>
                    <img width="100%" src="../account/<?php echo $rowabs['back_orig']; ?>">
                <?php }else{
                    echo 'Download PDF';
                } ?>
            </a>
        </div>

        <div class="col-md-4">
            <a href="../account/<?php echo $rowabs['bill_orig']; ?>">
                <?php if((substr($rowabs['bill_orig'], -3)) != 'pdf'){ ?>
                    <img width="100%" src="../account/<?php echo $rowabs['bill_orig']; ?>">
                <?php }else{
                    echo 'Download PDF';
                } ?>
            </a>
        </div>
    </div>

    <div class="form-actions text-center">
        <div class="form-group">
            <form method="POST">
                <input type="hidden" name="id_kyc" value="<?php echo $_GET['ledit']; ?>">
                <input type="submit" name="verf" value="Upgrade Account" class="btn btn-primary btn-lg">
            </form>
            <form method="POST">
                <input type="hidden" name="id_kyc" value="<?php echo $_GET['ledit']; ?>">
                <input style="margin-top:5%;" type="submit" name="declined" value="Decline"
                       class="btn btn-primary btn-lg">
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>


<?php } ?>
    </body>
</div>
<?php

include ('include/footer.php');

?>
