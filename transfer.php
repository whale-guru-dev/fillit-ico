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

if (!$user->is_logged_in()) {
    header('Location: index.php');
}


$stmta = $db->prepare('SELECT id, card_type, status_card, card_currency, expiryDate, pan, usr_id, proxy FROM orders WHERE memberId=:mid AND status="Completed" AND pan IS NOT NULL');
$stmta->execute(array(
    ':mid' => $_SESSION['memberID']
));
$card_info = $stmta->fetchAll(PDO::FETCH_ASSOC);


if (array_key_exists('amount', $_POST) AND array_key_exists('to_user_email', $_POST) AND
    array_key_exists('from_card', $_POST) AND array_key_exists('card_type', $_POST)
) {


    // daca exista cardul de pe care se trimite si e activ
    $stmta = $db->prepare('SELECT username,proxy FROM orders WHERE id=:fuck AND status_card="ACTIVE"');
    $stmta->execute(array(
        ':fuck' => $_POST['from_card']
    ));
    $rowfuck = $stmta->fetch(PDO::FETCH_ASSOC);
    if (empty($rowfuck)) {
        $errors[] = 'Your selected card is not activated or doesn\'t exist. ';
    }
    // daca emailul catre care se trimite exista + tipul de card se asociaza
    $stmta = $db->prepare('SELECT username,proxy FROM orders WHERE username=:fuck AND card_type=:tip');
    $stmta->execute(array(
        ':fuck' => $_POST['to_user_email'],
        ':tip' => $_POST['card_type']
    ));
    $rowfuck2 = $stmta->fetch(PDO::FETCH_ASSOC);
    if (empty($rowfuck2)) {
        $errors[] = 'Wrong e-mail entered or type of card doesn\'t exist';
    }

    if ($_POST['amount'] > 1000) {
        $errors[] = 'Amount needs to be under 1000';
    }

    if (empty($errors)) {


        $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
        $stmta->execute();
        $token = $stmta->fetch(PDO::FETCH_ASSOC);

        $stmta = $db->prepare('SELECT MAX(refId) FROM orders');
        $stmta->execute();
        $maxid = $stmta->fetch(PDO::FETCH_ASSOC);


        $data_string = '{
        "refId":"' . ($maxid['refId'] + 1) . '",
	"channelType":"5",
	"toCardProxy":"' . $rowfuck2['proxy'] . '",
	"amount":"' . $_POST['amount'] . '",
	"localeTime":"' . date('Y-m-d') . '",
	"message":"Card to Card Transfer",
	"userType":"DEFAULT",
	"isDirect":"true"
}';


        $ch = curl_init();

        $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/cards/' . $rowfuck['proxy'] . '/transfers');
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


        if ($json_a['errorDetails'][0]['errorCode'] == '0') {
            print_r($json_a);
            // insertdb in transactions
            // header location pentru a nu se repeta tranzactia in caz de refresh


        } else {
            ?>
            <div class="alert" style="    margin: 0 auto;
    width: 40%;">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php
                echo ucfirst(strtolower($json_a['errorDetails'][0]['errorDescription']));

                ?>
            </div>
            <?php
        }
    } else {
        foreach ($errors as $eroare) {
            ?>
            <div class="alert" style="    margin: 0 auto;
    width: 40%;">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo $eroare; ?>
            </div>
            <?php
        }
    }

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
                    <li class="active">
                        <a href="#"><span class="glyphicon glyphicon-lock"></span> Transfer Money</a>
                    </li>
                    <li>
                        <a href="limits.php"><span class="fa fa-id-card" style="margin-right:5px;"></span>Limits</a>
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


    <div class="inner">
        <div class="container all-content">
            <div class="page-header">
                <h3>
                    Transfer money
                </h3>
            </div>
            <form method="POST" class="j_money_transfer" novalidate="">
                <div class="col-sm-6 col-sm-offset-3 well">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group required-input"><label class="control-label" for="id_from_card">From
                                    card</label><select name="from_card" id="id_from_card" class="form-control"
                                                        title="">
                                    <?php foreach ($card_info as $inf) { ?>
                                        <option value="<?php echo $inf['id']; ?>"><?php echo strtoupper($inf['card_type']) ?>
                                            Debit Card *<?php echo substr($inf['pan'], -4) ?></option>
                                    <?php } ?>
                                </select></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group required-input"><label class="control-label" for="id_to_user_email">To
                                    user email</label><input type="email" name="to_user_email" title="" required=""
                                                             id="id_to_user_email" placeholder="user@email.com"
                                                             class="form-control"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group required-input"><label class="control-label" for="id_card_type">User
                                    card
                                    type</label><select name="card_type" id="id_card_type" class="form-control"
                                                        title="">
                                    <option value="virtual">Virtual Debit Card</option>
                                    <option value="plastic">Plastic Debit Card</option>
                                </select></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group required-input"><label class="control-label"
                                                                          for="id_amount">Amount</label><input
                                        type="number"
                                        name="amount"
                                        required=""
                                        title=""
                                        min="1"
                                        id="id_amount"
                                        step="0.01"
                                        placeholder="Amount"
                                        class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-3" style="padding: 20px;">
                    <div class="row text-center">
                        <div class="alert-info" style="padding: 20px;">Transaction fee is 0.25 EUR per transfer</div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="form-actions text-center">
                    <div class="form-group">
                        <input type="submit" value="Transfer" class="btn btn-primary btn-lg">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
<footer class="iq-footer " style="background-color:#222;    width: 100%;
    left: 0;
    bottom: 0;">
    <div class="container">
        <div class="row"></div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="footer-copyright iq-ptb-20"> “Visa Prepaid card is issued by Wave Crest Holdings Limited
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
