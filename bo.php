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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!$user->is_logged_in()) {
    header('Location: index.php');
}
if (!$user->is_admin()) {
    header('Location: index.php');
}


// pentru aratare admin panel
$stmt = $db->prepare('SELECT role FROM members WHERE username = :email');
$stmt->execute(array(':email' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// pentru count useri


$stmta = $db->prepare('SELECT memberID,username,first_name,last_name,country,pay_address,ip_user,last_login_ip,date_registered,active FROM members ');
$stmta->execute();
$row = $stmta->fetchAll(PDO::FETCH_ASSOC);

$numar_conturi = count($row);


?>

<!DOCTYPE html>

<html lang="en" data-logout-url="/profile/idle-logout/" style="height:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;Raleway:300,400,500,600,700,800,900">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">

    <link rel="shortcut icon" href="images/favi.png"/>
    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="css/owl-carousel/owl.carousel.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup/magnific-popup.css"/>

    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>

    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Style customizer (Remove these two lines please) -->
    <link rel="stylesheet" href="css/style-customizer.css"/>

    <!-- custom style -->
    <link rel="stylesheet" href="css/custom.css"/>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <meta name="theme-color" content="#ffffff">
    <title>FILLIT</title>
    <link href="css/fillit-dash.css" rel="stylesheet" type="text/css">
    <link href="css/fillit-dash2" rel="stylesheet" type="text/css">


</head>
<body class="desktop" style="height:100%">


<div class="wrap" style="height:110%">
    <div class="header clearfix visible-xs">
        <a href="https://fillit.com/cards/" class="logo img-logo-color"></a>
        <div class="icon-menu"></div>
    </div>
    <nav class="navbar navbar-top navbar-fixed-top hidden-xs">
        <div class="container">
            <div class="navbar-header">
                <a href="bo.php" class="navbar-brand"><img style="margin-top: 8px;" src="images/logo.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="b_main-menu">
                <ul class="nav navbar-nav">
                    <li <?php if (!array_key_exists('orders', $_GET)) { ?> class="active" <?php } ?>><a
                                href="bo.php"><span class="glyphicon glyphicon-equalizer"></span> Accounts</a></li>
                    <li>
                        <a href="dashboard.php"><span class="glyphicon glyphicon-lock"></span> User Dashboard</a>
                    </li>
                    <li <?php if (array_key_exists('orders', $_GET)) { ?> class="active" <?php } ?>><a
                                href="bo.php?orders"><span class="glyphicon glyphicon-transfer"></span> Orders</a></li>
                    <li <?php if (array_key_exists('limits', $_GET)) { ?> class="active" <?php } ?>><a
                                href="bo.php?limits"><span class="fa fa-id-card" style="margin-right:5px;"></span> KYC
                            Requests</a></li>
                    <li <?php if (array_key_exists('blog', $_GET)) { ?> class="active" <?php } ?>><a
                                href="bo.php?blog"><span class="fa fa-id-card" style="margin-right:5px;"></span> Blog
                        </a></li>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

    <div class="inner">
        <div class="container all-content">

            <div class="row">
                <div class="card-list">
                    <div class="col-md-12">
                        <!--div class="alert alert-danger">
                            <p>IMPORTANT NOTICE : From 15.12.2016, due the new AML regulations, any third-party loads into the fillit card (PayPal withdrawals, Skrill unloads, Amazon refunds, betting sites payouts etc.) require the receiving card to be fully verified. Attempts to receive any third-party loads into an unverified card will cause it to block until valid identification documents are provided.</p>
                        </--div-->
                    </div>
                    <div class="col-lg-12">


                        <?php
                        // PARTI DIN ADMIN PANEL
                        // 1. edit user
                        // 2. main view

                        if (isset($_GET['edit'])) {

                            $date_user = $user->get_user_fardata($_GET['edit']);

                            $adresa = $date_user['address'];
                            $adresa2 = $date_user['address2'];
                            $telefon = $date_user['phone'];
                            $first_n = $date_user['first_name'];
                            $last_n = $date_user['last_name'];
                            $dof = $date_user['date_of_birth'];
                            $country = $date_user['country'];
                            $zip = $date_user['zip'];
                            $city = $date_user['city'];

                            if (isset($_POST['sentt'])) {

                                if ((!empty($_POST['first_name'])) AND (!empty($_POST['last_name']))) {
                                    $stmt = $db->prepare('UPDATE members SET first_name=:first_n, last_name=:last_n, country=:country, phone=:phone, date_of_birth=:dof , address=:addr , address2=:addr2, zip=:zip, city=:city   WHERE username=:usercur');
                                    $stmt->execute(array(
                                        ':first_n' => $_POST['first_name'],
                                        ':last_n' => $_POST['last_name'],
                                        ':country' => $_POST['country'],
                                        ':phone' => $_POST['phone'],
                                        ':dof' => $_POST['date_of_birth'],
                                        ':addr' => $_POST['address'],
                                        ':addr2' => $_POST['address2'],
                                        ':zip' => $_POST['zip'],
                                        ':city' => $_POST['city'],
                                        ':usercur' => $_GET['edit'],
                                    ));
                                    $adresa = $_POST['address'];
                                    $adresa2 = $_POST['address2'];
                                    $telefon = $_POST['phone'];
                                    $first_n = $_POST['first_name'];
                                    $last_n = $_POST['last_name'];
                                    $dof = $_POST['date_of_birth'];
                                    $country = $_POST['country'];
                                    $zip = $_POST['zip'];
                                    $city = $_POST['city'];
                                } else {
                                    $error[] = 'You left a field uncompleted.';
                                }
                            }

                            ?>
                            <div class="page-header">
                                <h3>
                                    Accounts
                                </h3>
                            </div>
                            <?php if (isset($error)) { ?>
                                <div class="alert">
                                    <span class="closebtn"
                                          onclick="this.parentElement.style.display='none';">&times;</span>
                                    <?php echo $error[0]; ?>
                                </div>
                            <?php } ?>
                            You are now editing <?php echo $date_user['first_name'] . ' ' . $date_user['last_name'] . '\'s profile.'; ?>
                            <br>

                            <form method="POST" id="profile" novalidate=""><input type="hidden" name="sentt"
                                                                                  value="yes">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label" for="id_first_name">First
                                                name</label><input type="text" name="first_name" title=""
                                                                   id="id_first_name" maxlength="30"
                                                                   value="<?php echo $first_n; ?>"
                                                                   placeholder="First name" class="form-control"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label" for="id_last_name">Last
                                                name</label><input type="text" name="last_name" title=""
                                                                   id="id_last_name" maxlength="30"
                                                                   value="<?php echo $last_n; ?>"
                                                                   placeholder="Last name" class="form-control"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required-input"><label class="control-label"
                                                                                      for="id_birthday">Date of
                                                birth</label><input type="date" name="date_of_birth" title=""
                                                                    required="" id="id_birthday"
                                                                    value="<?php echo $dof; ?>" placeholder="dd.mm.yyyy"
                                                                    class="datepicker form-control"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label"
                                                                       for="id_country">Country</label>

                                            <select name="country" id="id_country" class="form-control" title="">
                                                <option selected=""><?php echo $country; ?></option>
                                                <option value="">---------</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AT">Austria</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="ES">Canary Islands</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="EE">Estonia</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="DE">Germany</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JE">Jersey</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MT">Malta</option>
                                                <option value="MC">Monaco</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NO">Norway</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="RO">Romania</option>
                                                <option value="SM">San Marino</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="ES">Spain</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="TR">Turkey</option>
                                                <option value="GB">United Kingdom</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label"
                                                                       for="id_city">City</label><input type="text"
                                                                                                        name="city"
                                                                                                        title=""
                                                                                                        id="id_city"
                                                                                                        maxlength="50"
                                                                                                        value="<?php echo $city; ?>"
                                                                                                        placeholder="City"
                                                                                                        class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label" for="id_address1">Address
                                                1</label><input type="text" name="address" title="" id="id_address1"
                                                                value="<?php echo $adresa; ?>" maxlength="35"
                                                                placeholder="Address 1" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label" for="id_address2">Address
                                                2</label><input type="text" name="address2" title="" id="id_address2"
                                                                value="<?php echo $adresa2; ?>" maxlength="35"
                                                                placeholder="Address 2" class="form-control"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label" for="id_zip_code">ZIP
                                                Code</label><input type="text" name="zip" title="ex. LVXXXX"
                                                                   id="id_zip_code" value="<?php echo $zip; ?>"
                                                                   maxlength="50" placeholder="ZIP Code"
                                                                   class="form-control">
                                            <div class="help-block">ex. 32421</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label class="control-label"
                                                                       for="id_phone">Phone</label><input type="text"
                                                                                                          name="phone"
                                                                                                          title=""
                                                                                                          id="id_phone"
                                                                                                          maxlength="25"
                                                                                                          value="<?php echo $telefon; ?>"
                                                                                                          placeholder="Phone"
                                                                                                          class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions text-center">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-lg">
                                    </div>
                                </div>
                            </form>

                            <?php


                        } elseif (isset($_GET['orders'])) {

                        if (!array_key_exists('oedit', $_GET)) {
                        $stmta = $db->prepare('SELECT id,username,date,ip,card_type,card_currency,card_value,status,status_card FROM orders');
                        $stmta->execute();
                        $rowac = $stmta->fetchAll(PDO::FETCH_ASSOC);


                        ?>
                        <div class="page-header">
                            <h3>
                                Orders
                            </h3>
                        </div>
                        <div class="card-body no-padding table-responsive">
                            <table id="killerr" class="datatable table table-striped primary" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="right">E-mail</th>
                                    <th>Card Type</th>

                                    <th>Card Currency</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Card Status</th>

                                    <th>Info</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php


                                foreach ($rowac as $cuc) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cuc['id']; ?></td>
                                        <td><?php echo $cuc['username']; ?></td>
                                        <td><?php echo $cuc['card_type']; ?></td>

                                        <td><?php echo $cuc['card_currency']; ?></td>
                                        <td><?php echo $cuc['card_value']; ?></td>
                                        <td><?php echo $cuc['status']; ?></td>
                                        <td><?php if ($cuc['status_card'] == 'Completed') { ?><span
                                                    class="badge badge-success badge-icon"><i
                                                        class="fa fa-check"
                                                        aria-hidden="true"></i><span>Active</span></span> <?php } else {
                                                echo $cuc['status_card'];
                                            } ?> </td>
                                        <td><a href="bo.php?orders&oedit=<?php echo $cuc['id'] ?>">
                                                <button class="btn">
                                                    More info
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
    </div>
    <?php
    } else {

        $stmta = $db->prepare('SELECT id,username,date,ip,card_type,card_currency,card_value,status,status_card, usr_id, proxy, pan,txnId,expiryDate FROM orders WHERE id=:usr');
        $stmta->execute(array(
            ':usr' => $_GET['oedit']
        ));
        $rowacx = $stmta->fetch(PDO::FETCH_ASSOC);


        ?>
        <div class="page-header">
            <h3>
                User Info
            </h3>
        </div>
        <div class="col-lg-12">


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_first_name">User
                            name</label>
                        <div class="form-control"><?php echo $rowacx['username'] ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_last_name">IP
                            Used</label>
                        <div class="form-control"><?php echo $rowacx['ip'] ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_last_name">Payment
                            Status</label>
                        <div class="form-control" <?php if ($rowacx['status'] == 'Completed') {
                            echo 'style="color:green;"';
                        } ?> ><?php echo $rowacx['status'] ?></div>
                    </div>
                </div>


            </div>

            <div class="page-header">
                <h3>
                    Card Info
                </h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_country">Card
                            PAN</label>

                        <div class="form-control"><?php echo $rowacx['pan']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_city">User
                            ID</label>
                        <div class="form-control"><?php echo $rowacx['usr_id']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_address1">Proxy
                            ID</label>
                        <div class="form-control"><?php echo $rowacx['proxy']; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_address2">Card
                            Status</label>
                        <div class="form-control"><?php echo $rowacx['status_card']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_zip_code">Card
                            Type</label>
                        <div class="form-control"><?php echo $rowacx['card_type']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_phone">Card
                            Currency</label>
                        <div class="form-control"><?php echo $rowacx['card_currency']; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_phone">Expiry
                            Date</label>
                        <div class="form-control"><?php echo $rowacx['expiryDate']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_phone">TXN
                            ID</label>
                        <div class="form-control"><?php echo $rowacx['txnId']; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_phone">Date
                            Created</label>
                        <div class="form-control"><?php echo $rowacx['date']; ?></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-actions text-center">
                <a href="bo.php?orders">
                    <div class="form-group">
                        <input type="submit" value="Back" class="btn btn-primary btn-lg">
                    </div>
                </a>
            </div>


        </div>


        <?php
    }

    } elseif (isset($_GET['blog'])){


	//show message from add / edit page
	if(isset($_GET['action'])){
        echo '<h3>Post '.$_GET['action'].'.</h3>';
    }

    if (!array_key_exists('addpost', $_GET) AND !array_key_exists('editpost', $_GET)){
    ?>
    <link rel="stylesheet" href="blog/style/normalize.css">
    <link rel="stylesheet" href="blog/style/main.css">
    <div class="page-header">
        <h3>
            Blog Posts
        </h3>
    </div>

    <script language="JavaScript" type="text/javascript">
        function delpost(id, title) {
            if (confirm("Are you sure you want to delete '" + title + "'")) {
                window.location.href = 'bo.php?blog&delpost=' + id;
            }
        }
    </script>

    <?php

    if(isset($_GET['delpost'])){
        $stmt = $db->query('DELETE FROM blog_posts WHERE postID='.$_GET['delpost'].' ');

    }
    ?>

    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php

        try {

            $stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
            while ($row = $stmt->fetch()) {

                echo '<tr>';
                echo '<td>' . $row['postTitle'] . '</td>';
                echo '<td>' . date('jS M Y', strtotime($row['postDate'])) . '</td>';
                ?>

                <td>
                    <a href="bo.php?blog&editpost&id=<?php echo $row['postID']; ?>">Edit</a> |
                    <a href="javascript:delpost('<?php echo $row['postID']; ?>','<?php echo $row['postTitle']; ?>')">Delete</a>
                </td>

                <?php
                echo '</tr>';

            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>

    <p><a href='bo.php?blog&addpost'>Add Post</a></p>

</div>
</div>
</div>
</div>
</div>

<?php
}elseif(array_key_exists('editpost',$_GET)){
        ?>
    <style>
        .iq-footer{
            margin-top: 18%;
        }
        .wrap{
            height:200% !important;
        }
    </style>
    <link rel="stylesheet" href="blog/style/normalize.css">
    <link rel="stylesheet" href="blog/style/main.css">
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>

<?php

//if form has been submitted process it
if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    //collect form data
    extract($_POST);

    //very basic validation
    if($postID ==''){
        $error[] = 'This post is missing a valid id!.';
    }

    if($postTitle ==''){
        $error[] = 'Please enter the title.';
    }

    if($postDesc ==''){
        $error[] = 'Please enter the description.';
    }

    if($postCont ==''){
        $error[] = 'Please enter the content.';
    }

if(isset($_POST['changepic'])) {
    if (empty($_FILES)) {
        $error[] = 'Please upload the image.';
    }

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
// echo $generareimg;
    $target_dir = "images/blog/";
    $beforee = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
    $target_file = $target_dir . $generareimg . "." . $beforee;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
    if (!empty($_FILES)) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error[] = "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        $error[] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if (($imageFileType != "jpg") && ($imageFileType != "png") && ($imageFileType != "jpeg")
        && ($imageFileType != "gif") && ($imageFileType != "PNG") && ($imageFileType != "JPG") && ($imageFileType != "JPEG")
    ) {
        $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

            $stmt = $db->prepare('SELECT postImg FROM blog_posts WHERE postID = :postID');
            $stmt->execute(array(
                ':postID' => $postID
            ));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ((file_exists($row['postImg'])) AND ($row['postImg'] !== 'uploads/default.png')) {
                unlink($row['postImg']); //delete
            }


            $stmt = $db->prepare('UPDATE blog_posts SET postImg= :postImg WHERE postID = :postID') ;
            $stmt->execute(array(
                ':postImg' => $target_file,
                ':postID' => $postID
            ));


        } else {
            $error[] = "Sorry, there was an error uploading your file.";
        }
    }
}else{
        $error[]='notset';
}

    if(!isset($error)){

        try {

            //insert into database
            $stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
            $stmt->execute(array(
                ':postTitle' => $postTitle,
                ':postDesc' => $postDesc,
                ':postCont' => $postCont,
                ':postID' => $postID,
            ));

            //redirect to index page
            header('Location: bo.php?blog&action=updated');
            exit;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

}

?>


<?php
//check for any errors
if(isset($error)){
    foreach($error as $error){
        echo $error.'<br />';
    }
}

try {

    $stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont, postImg FROM blog_posts WHERE postID = :postID') ;
    $stmt->execute(array(':postID' => $_GET['id']));
    $row = $stmt->fetch();

} catch(PDOException $e) {
    echo $e->getMessage();
}

?>

    <form action='' method='post' enctype="multipart/form-data">
        <input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

        <p><label>Title</label><br />
            <input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

        <p><label>Description</label><br />
            <textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

        <p><label>Content</label><br />
            <textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>
        <img src="<?php echo $row['postImg']; ?>">
        <input class="btn btn-info" type="file" name="fileToUpload" id="fileToUpload">

        <input type="checkbox" name="changepic" value="yes"> Change picture<br>

        <p><input type='submit' name='submit' value='Update'></p>

    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    <?php

} else { ?>
    <style>
        .iq-footer{
            margin-top: 18%;
        }
    </style>
    <link rel="stylesheet" href="blog/style/normalize.css">
    <link rel="stylesheet" href="blog/style/main.css">
    <div class="page-header">
        <h3>
            Add a post
        </h3>
    </div>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>

<?php

//if form has been submitted process it
if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    //collect form data
    extract($_POST);

    //very basic validation
    if($postTitle ==''){
        $error[] = 'Please enter the title.';
    }

    if($postDesc ==''){
        $error[] = 'Please enter the description.';
    }

    if($postCont ==''){
        $error[] = 'Please enter the content.';
    }
    if(empty($_FILES)){
        $error[] = 'Please upload the image.';
    }

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
// echo $generareimg;
    $target_dir = "images/blog";
    $beforee = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
    $target_file = $target_dir . $generareimg . "." . $beforee;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
    if (!empty($_FILES)) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
           // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error[] = "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        $error[]= "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if (($imageFileType != "jpg") && ($imageFileType != "png") && ($imageFileType != "jpeg")
        && ($imageFileType != "gif") && ($imageFileType != "PNG") && ($imageFileType != "JPG") && ($imageFileType != "JPEG")
    ) {
        $error[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error[]= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        } else {
            $error[]= "Sorry, there was an error uploading your file.";
        }
    }


    if(!isset($error)){

        try {

            //insert into database
            $stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate,postImg) VALUES (:postTitle, :postDesc, :postCont, :postDate, :postImg)') ;
            $stmt->execute(array(
                ':postTitle' => $postTitle,
                ':postDesc' => $postDesc,
                ':postCont' => $postCont,
                ':postDate' => date('Y-m-d H:i:s'),
                ':postImg'  => $target_file
            ));

            //redirect to index page
            header('Location: bo.php?blog&action=added');
            exit;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

}

//check for any errors
if(isset($error)){
    foreach($error as $error){
        echo '<p class="error">'.$error.'</p>';
    }
}
?>

    <form action='' enctype="multipart/form-data" method='post'>

        <p><label>Title</label><br />
            <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

        <p><label>Description</label><br />
            <textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

        <p><label>Content</label><br />
            <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

        <p><label>Image</label><br />
            <input class="btn btn-info" type="file" name="fileToUpload"  id="fileToUpload">
        <p><input type='submit' name='submit' value='Submit'></p>

    </form>
    </div>
    </div>
    </div>
    </div>
    </div>

<?php }
} elseif (isset($_GET['limits'])) {

    if (!array_key_exists("ledit", $_GET)) {
        $stmt = $db->prepare('SELECT id,username,status FROM kyc');
        $stmt->execute(array(':usercur' => $_SESSION['username']));
        $rowabs = $stmt->fetchAll(PDO::FETCH_ASSOC);


        ?>
        <div class="page-header">
            <h3>
                KYC Request
            </h3>
        </div>
        <div class="card-body no-padding table-responsive">
            <table id="killerr" class="datatable table table-striped primary" cellspacing="0"
                   width="100%">
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
                    $stmt = $db->prepare('SELECT first_name ,last_name FROM members WHERE username=:usercur');
                    $stmt->execute(array(':usercur' => $cuc['username']));
                    $rowabs = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($cuc['status'] == 'not sent') {
                        $pla = 'Not sent';
                    } elseif ($cuc['status'] == 'declined') {
                        $pla = 'Declined';
                    } else {
                        $pla = ' More details ->';
                    }
                    ?>
                    <tr>
                        <td><?php echo $cuc['id']; ?></td>
                        <td><?php echo $cuc['username']; ?></td>
                        <td><?php echo $rowabs['first_name']; ?></td>

                        <td><?php echo $rowabs['last_name']; ?></td>
                        <td><?php echo $pla; ?></td>

                        <td><a href="bo.php?limits&ledit=<?php echo $cuc['id'] ?>">
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

            $stmt = $db->prepare('SELECT usr_id FROM orders WHERE username=:get AND usr_id IS NOT NULL');
            $stmt->execute(array(':get' => $rowfuk['username']));
            $rowfuka = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $db->prepare('SELECT status_card FROM orders WHERE username=:get AND status_card="fraud"');
            $stmt->execute(array(':get' => $rowfuk['username']));
            $fraude= $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($rowfuk)) {
                $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
                $stmta->execute();
                $token = $stmta->fetch(PDO::FETCH_ASSOC);
                $front= preg_replace('#^data:image/[^;]+;base64,#', '', $rowfuk['front']);
                $back = preg_replace('#^data:image/[^;]+;base64,#', '', $rowfuk['bill']);
                if(empty($fraude)) {
                    $data_string = '{
	                                    "identityProof": "' . $front . '",
	                                    "addressProof": "' . $back . '",
	                                    "alertCategory": "KYC"
                                         }';
                }else{
                    $data_string = '{
	                                    "identityProof": "' . $front . '",
	                                    "addressProof": "' . $back . '",
	                                    "alertCategory": "VERIFICATION"  
                                         }';
                    $sentforverif = 'true';
                }

                $ch = curl_init();

                $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $rowfuka['usr_id'] . '/kyc');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = array();
                $headers[] = "Developerid: 8k3np8hcj6chmo9sn45d";
                $headers[] = "Developerpassword: Vhkgidduif@123";
                $headers[] = "AuthenticationToken: {$token['auth_token']}";
                $headers[] = "Content-Type:	application/json";
                $headers[] = "ProgramName: MyChoiceUK";
                $headers[] = "X-Method-Override: login";

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);

//start decoding response and insert into db

                $json_a = json_decode($result, true);


                $stmt = $db->prepare('UPDATE kyc SET status= :status WHERE id=:id_cur');
                $stmt->execute(array(
                    ':status' => $json_a['errorDetails'][0]['errorDescription'],
                    ':id_cur' => $_POST['id_kyc']
                ));
               // echo $json_a['errorDetails'][0]['errorDescription'];

            }
        }
        $stmt = $db->prepare('SELECT id,front_orig,back_orig,bill_orig,username,status FROM kyc WHERE id=:get');
        $stmt->execute(array(':get' => $_GET['ledit']));
        $rowabs = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare('SELECT first_name ,last_name,address,address2,country,zip,city,date_of_birth FROM members WHERE username=:usercur');
        $stmt->execute(array(':usercur' => $rowabs['username']));
        $rowabsa = $stmt->fetch(PDO::FETCH_ASSOC);


        ?>
        <div class="page-header">
            <h3>
                KYC Review
            </h3>
        </div>
        <?php if (!empty($rowabs['status'])) {
            echo $rowabs['status'];
        }
        $stmt = $db->prepare('SELECT status_card FROM orders WHERE username=:get AND status_card="fraud"');
        $stmt->execute(array(':get' =>$rowabs['username']));
        $fraude= $stmt->fetch(PDO::FETCH_ASSOC);
       // print_r($fraude);
        ?>
        <?php if (!empty($fraude)){
            echo '<br>fraud name detected ';
          //  print_r($fraude);
        }
        
        if (isset(  $sentforverif )){
            echo 'User files sent for anti-fraud verification.';
        }

         ?>

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
                    <div class="form-control"><?php echo $rowabsa['first_name'] ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label class="control-label" for="id_last_name">Last
                        Name</label>
                    <div class="form-control"> <?php echo $rowabsa['last_name']; ?></div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group"><label class="control-label"
                                               for="id_first_name">Address</label>
                    <div class="form-control"><?php echo $rowabsa['address'] ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label class="control-label" for="id_last_name">Address
                        2</label>
                    <div class="form-control"><?php echo $rowabsa['address2'] ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label class="control-label"
                                               for="id_last_name">Country</label>
                    <div class="form-control"> <?php echo $rowabsa['country']; ?></div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group"><label class="control-label"
                                               for="id_first_name">ZIP</label>
                    <div class="form-control"><?php echo $rowabsa['zip'] ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label class="control-label"
                                               for="id_last_name">City</label>
                    <div class="form-control"><?php echo $rowabsa['city'] ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label class="control-label" for="id_last_name">Date of
                        Birth</label>
                    <div class="form-control"> <?php echo $rowabsa['date_of_birth']; ?></div>
                </div>
            </div>


        </div>
        <div class="row well">
            <div class="col-md-4"><a href="<?php echo $rowabs['front_orig']; ?>"><img
                            width="100%" src="<?php echo $rowabs['front_orig']; ?>"></a></div>
            <div class="col-md-4"><a href="<?php echo $rowabs['back_orig']; ?>"><img
                            width="100%" src="<?php echo $rowabs['back_orig']; ?>"></a></div>
            <div class="col-md-4"><a href="<?php echo $rowabs['bill_orig']; ?>"><img
                            width="100%" src="<?php echo $rowabs['bill_orig']; ?>"></a></div>
        </div>

        <div class="form-actions text-center">
            <div class="form-group">
                <form method="POST">
                    <input type="hidden" name="id_kyc" value="<?php echo $_GET['ledit']; ?>">
                    <input type="submit" name="verf" value="Submit to API" class="btn btn-primary btn-lg">
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


    <?php }
} else { ?>
    <div class="page-header">
        <h3>
            Accounts
        </h3>
    </div>
    <div class="card-body no-padding table-responsive">
        <table id="killerr" class="datatable table table-striped primary" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th class="right">E-mail</th>
                <th>Full Name</th>

                <th>Country</th>
                <th>Registered IP</th>
                <th>Last Login IP</th>
                <th>Registered on</th>
                <th>Confirmed</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($row as $cuc) {
                ?>
                <tr>
                    <td><?php echo $cuc['memberID']; ?></td>
                    <td><?php echo $cuc['username']; ?></td>
                    <td><?php echo $cuc['first_name'] . ' ' . $cuc['last_name']; ?></td>

                    <td><?php echo $cuc['country']; ?></td>
                    <td><?php echo $cuc['ip_user']; ?></td>
                    <td><?php echo $cuc['last_login_ip']; ?></td>
                    <td><?php echo $cuc['date_registered']; ?></td>
                    <td><?php if ($cuc['active'] == 'Yes') { ?><span
                                class="badge badge-success badge-icon"><i class="fa fa-check"
                                                                          aria-hidden="true"></i><span>Active</span></span> <?php } else { ?>
                            <span class="badge badge-warning badge-icon"><i
                                        class="fa fa-clock-o"
                                        aria-hidden="true"></i><span>Pending</span></span> <?php } ?>
                    </td>
                    <td><a href="bo.php?edit=<?php echo $cuc['username'] ?>">
                            <button class="btn">
                                Edit
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
<?php } ?>

<div class="clearfix"></div>


<div class="mask"></div>

<script type="text/javascript" src="./fillit_files/fillit-back.min.ca7fee069eab.js.download" charset="utf-8"></script>
<script>
    $(document).ready(function () {
        $('#killerr').DataTable();
    });
</script>

</body>
</html>
</div>
<!-- Footer >

<footer class="iq-footer " style="background-color:#222;    width: 100%;
margin-bottom:-10%;
    left: 0;
    bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h6>Fees</h6>
                <a href="fee.php">Virtual card fees and limits</a><br>
                <a href="fee.php">Plastic card fees and limits</a>
            </div>
            <div class="col-md-3">
                <h6>Info</h6>
                <a href="support.php">Support</a><br>
                <a href="contact.php">Contact us</a><br>
                <a href="#">Affiliate program</a>
            </div>
            <div class="col-md-3">
                <h6>Legal</h6>
                <a href="t_c.php">Terms &amp; conditions</a><br>
                <a href="#">Privacy policy</a><br>
                <a href="#">Cardholder agreement</a><br>
                <a href="cookie_policy.php">Cookie policy</a>
            </div>
            <div class="col-md-2" style="padding-top:50px">
                <img src="images/logo.png" style="width:140px;height:25px;opacity: 0.2;" alt="logo"><br><br>
                <img src="images/logo1.png" style="width:150px;height:25px;" alt="logo">
            </div>
        </div>
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
