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
$stmta = $db->prepare('SELECT usr_id,proxy,pan FROM orders WHERE username=:fucka AND id=:canci');
$stmta->execute(array(
    ':fucka' => $_SESSION['username'],
    ':canci' => $_GET['card']
));
$rowfuckx = $stmta->fetch(PDO::FETCH_ASSOC);

if(array_key_exists('card',$_GET) AND (!empty($rowfuckx))){
    $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
    $stmta->execute();
    $token = $stmta->fetch(PDO::FETCH_ASSOC);
// daca exista cardul de pe care se trimite si e activ
$stmta = $db->prepare('SELECT usr_id,proxy,pan FROM orders WHERE id=:fucka');
$stmta->execute(array(
    ':fucka' => $_GET['card']
));
$rowfuck = $stmta->fetch(PDO::FETCH_ASSOC);
$usrid=$rowfuck['usr_id'];
$proxy=$rowfuck['proxy'];

$data_string='
  {
   "channelType":"1",
   "offset":"0",
   "txnCount":"0",
   "localeTime": "'.(new DateTime('17 Oct 2008'))->format('c').'"
  }
';
$ch = curl_init();

$ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/'.$usrid.'/cards/'.$proxy.'/transactions');
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
$transactions = $json_a['transactionDetails'];

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
                    <li>
                        <a href="#"><span class="fa fa-id-card" style="margin-right:5px;"></span>Transactions</a>
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
                <h3>My transactions on EUR Virtual Debit Card</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="form well" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="action">Transaction action</label>
                                    <select name="action" id="action" class="form-control">
                                        <option value="">All</option>
                                        <option value="Load">Load</option>
                                        <option value="TransactionFee">TransactionFee</option>
                                        <option value="Unload">Unload</option>
                                        <option value="FundsTransfer">FundsTransfer</option>
                                        <option value="BalanceAdjustment">BalanceAdjustment</option>
                                        <option value="Reversal">Reversal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="spacer">&nbsp;</label>

                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h4 class="transaction-title">
                        <big><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?></big>
                            <?php
                            $ch = curl_init();

                            $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $rowfuck['usr_id'] . '/cards/' . $rowfuck['proxy'] . '/balance');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 0);
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


                            $json_a = json_decode($result, true);
                            if ($json_a['errorDetails'][0]['errorCode'] == 0) {
                                $balanta = $json_a['avlBal'];
                            } else {
                                $balanta = 'Error';
                            }
                            $balanta = $balanta/100;
                            ?>

                        <span>Statement of card <?php echo $rowfuck['pan']; ?> </span>
                        <span class="pull-right">Current balance <?php echo $balanta; ?> <small>EUR</small></span>
                    </h4>
                    <hr>
                    <table id="killerrr" class="table table-striped invoice-table">
                        <thead>
                        <tr><th>Created at</th>
                            <th>Merchant</th>
                            <th>Action</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr></thead>
                        <tbody>
                        <?php foreach($transactions as $tran){


                               $price =  $tran['transactionAmount'] / 100;


                            ?>
                        <tr class="j_expand">
                            <td><?php  echo substr(str_replace('T',' ',$tran['tranDate']) , 0, 19);?></td>
                            <td><?php echo $tran['merchantName']; ?></td>
                            <td><?php echo $tran['comment'] ?></td>
                            <td><?php echo $price; ?></td>
                            <th><?php echo $tran['status'];?></th>
                        </tr>
<?php }?>
                        </tbody>
                    </table>
                </div>
            </div>

            <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
            <script>
                $(document).ready(function () {
                    $('#killerrr').DataTable();
                });
            </script>
            <div class="footer">
                <div class="col-md-4 col-sm-6 footer-nav-item">
                    <b>Fees</b>
                    <a href="/fees/virtual/">Virtual card fees and limits</a>
                    <a href="/fees/plastic/">Plastic card fees and limits</a>
                </div>
                <div class="col-md-4 col-sm-6 footer-nav-item">
                    <b>Info</b>
                    <a href="https://support.loadoo.com">Support</a>
                    <a href="/info/contact-us/">Contact us</a>
                    <a href="/info/affiliate-program/">Affiliate program</a>
                </div>
                <div class="col-md-4 col-sm-6 footer-nav-item">
                    <b>Legal</b>
                    <a href="/legal/terms-conditions/">Terms &amp; conditions</a>
                    <a href="/legal/privacy-policy/">Privacy policy</a>
                    <a href="/legal/cardholder-agreement/">Cardholder agreement</a>
                    <a href="/legal/cookie-policy/">Cookie policy</a>
                    <a href="https://mychoicecorporate.com/privacy-policy/ ">MyChoice Privacy Policy</a>

                </div>
                <div class="info"><p>Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe.&nbsp;Visa is a registered trademark of Visa Incorporated.&nbsp;Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar.<br>Loadoo LLP © 2016, All Rights Reserved.</p></div>
                <a href="/en/" class="logo img-logo-gray"></a>
                <div class="social">
                    <a href="https://www.facebook.com/loadoo" target="_blank" class="icon-fb"></a>
                    <a href="#twitter" target="_blank" class="icon-tw"></a>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    header('Location:dashboard.php');
} ?>