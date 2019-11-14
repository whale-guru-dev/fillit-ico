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

include('nav.php');
$stmt = $db->prepare('SELECT memberID,id FROM orders WHERE status = "in-progress"');
$stmt->execute();
$primul_rez = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($primul_rez)) {
    $stmt = $db->prepare('INSERT INTO orders (memberID, date, ip, address, username, status ) VALUES (:memberid, :date, :ip, :address, :username, "in-progress")');
    $stmt->execute(array(
        ':ip' => $_SERVER['REMOTE_ADDR'],
        ':memberid' => $user->get_user_data()['memberID'],
        ':username' => $user->get_user_data()['username'],
        ':address' => $user->get_user_data()['address'] . ' ' . $user->get_user_data()['address2'],
        ':date' => date("Y/m/d")
    ));
}


?>

<link rel="stylesheet" type="text/css"
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;Raleway:300,400,500,600,700,800,900">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous">


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
<style>
    html,body{
        height:100%;
    }
    .iq-footer{
        margin-top:40px;
    }
</style>
<div class="inner">
    <div class="container all-content">


        <?php if (!isset($_GET['step'])) { ?>

            <!--   BEGIN ORDER NEW CARD STEP 1        -->
            <div class="page-header">
                <h3 class="text-heading">Order new card</h3>
            </div>
            <form method="POST" class="j_card_request" action="order.php?step=2" novalidate="">
                <h4 class="text-heading">Card details</h4>
                <div class="well">
                    <div class="row space_to_bottom">
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">Name on card</label>
                                <div
                                        class="controls readonly"><?php echo $user->get_user_data()['first_name'] . ' ' . $user->get_user_data()['last_name']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group required-input"><label class="control-label" for="id_card_type">Card
                                    type</label><select name="card_type" id="id_card_type" class="form-control"
                                                        title="">
                                    <option value="virtual" selected="">Virtual Debit Card</option>
                                    <option value="plastic">Plastic Debit Card</option>
                                </select></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required-input"><label class="control-label" for="id_currency">Currency</label><select
                                        name="card_currency" id="id_currency" class="form-control" title="">
                                    <option value="EUR" selected="">EUR</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                </select></div>
                        </div>
                        <div class="j_delivery_type col-md-4" style="display: none;">
                            <div class="form-group required-input"><label class="control-label" for="id_delivery_type">Delivey
                                    type</label><select name="delivery_type" id="id_delivery_type" class="form-control"
                                                        title="">
                                    <option value="standard" selected="">Standard</option>
                                    <option value="express">Express</option>
                                </select></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
                <h4 class="text-heading">Personal info</h4>
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">First name</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['first_name']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">Last name</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['last_name']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">Birthday</label>
                                <div
                                        class="controls readonly"><?php echo $user->get_user_data()['date_of_birth']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="text-heading">Billing address</h4>
                <div class="well">
                    <div class="row space_to_bottom">
                        <div class="col-md-8">
                            <div class="control-group">
                                <label class="control-label">Address 1</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['address']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="control-group">
                                <label class="control-label">Address 2</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['address2']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">Billing country</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['country']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">City</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['city']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="control-group">
                                <label class="control-label">ZIP Code</label>
                                <div class="controls readonly"><?php echo $user->get_user_data()['zip']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="j_no_delivery" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="checkbox"><label for="id_is_shipping_address_same_as_billing"><input
                                                type="checkbox" name="is_shipping_address_same_as_billing" checked=""
                                                class="" id="id_is_shipping_address_same_as_billing"> Shipping address
                                        same
                                        as billing</label></div>
                            </div>
                        </div>
                    </div>

                </div>


                <hr>
                <div class="form-actions text-center">
                    <div class="form-group">
                        <a href="dashboard.php" class="btn btn-default btn-lg pull-left">« Back to card list</a>
                        <input type="submit" value="Continue »" class="btn btn-primary btn-lg pull-right">
                    </div>
                </div>
            </form>

            <!--   END ORDER NEW CARD STEP 1        -->

            <?php
        }
        $stmt = $db->prepare('SELECT card_type FROM orders WHERE status = "Completed" AND username =:usr');
        $stmt->execute(array(
            ':usr' => $_SESSION['username']
        ));
        $facut = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //////////////////////
        function in_array_r($needle, $haystack, $strict = false) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }

            return false;
        }
        ///////////////////////

        if (array_key_exists('step', $_GET) && $_GET['step'] == 2 && !in_array_r($_POST['card_type'], $facut)) {




            if ((($_POST['card_type'] == 'virtual') OR ($_POST['card_type'] == 'plastic')) AND
                (($_POST['card_currency'] == 'GBP') OR ($_POST['card_currency'] == 'USD') OR ($_POST['card_currency'] == 'EUR')) AND
                ((!empty($user->get_user_data()['country'])) AND (!empty($user->get_user_data()['zip'])) AND  (!empty($user->get_user_data()['city']))  AND (!empty($user->get_user_data()['phone']))  AND (!empty($user->get_user_data()['date_of_birth']))  AND (!empty($user->get_user_data()['ip_user'])) AND (!empty($user->get_user_data()['address']))  AND (!empty($user->get_user_data()['first_name'])))
                ) {

                if ($_POST['card_type'] == 'virtual') {
                    $price = '7';
                } elseif ($_POST['card_type'] == 'plastic') {
                    $price = '15';
                } else {
                    $price = '9999999';
                }

                if ($_POST['card_type'] == 'virtual') {
                    $tip = 'Virtual Debit Card';
                } elseif ($_POST['card_type'] == 'plastic') {
                    $tip = 'Plastic Debit Card';
                } else {
                    $tip = 'eroare';
                }


                $stmt = $db->prepare('UPDATE orders SET card_type= :type, card_currency= :card_currency, card_value=:value WHERE id=:id_cur');
                $stmt->execute(array(
                    ':type' => $_POST['card_type'],
                    ':card_currency' => $_POST['card_currency'],
                    ':id_cur' => $primul_rez['id'],
                    ':value' => $price
                ));
            } else {
                header('Location: http://www.fillit.eu/profile.php');
            }

            ?>

            <!--   BEGIN ORDER NEW CARD STEP 2        -->

            <div class="page-header">
                <h3 class="text-heading">Order <?php echo $_POST['card_currency'] . ' ' . $tip; ?> </h3>
            </div>
            <h4 class="text-heading">Payment details</h4>
            <div class="well cardorder-summary">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Card price</label>
                            <div class="controls readonly"><?php echo $price; ?>.00 EUR</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Card type</label>
                            <div class="controls readonly"><?php echo $tip; ?></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Billing address</label>
                            <div class="controls readonly">
                                <?php echo $user->get_user_data()['country']; ?>,
                                <?php echo $user->get_user_data()['city']; ?>,
                                <?php echo $user->get_user_data()['address'] . ' ' . $user->get_user_data()['address2']; ?>
                                ,
                                <?php echo $user->get_user_data()['zip'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Shipping address</label>
                            <div class="controls readonly">
                                <?php echo $user->get_user_data()['country']; ?>,
                                <?php echo $user->get_user_data()['city']; ?>,
                                <?php echo $user->get_user_data()['address'] . ' ' . $user->get_user_data()['address2']; ?>
                                ,
                                <?php echo $user->get_user_data()['zip'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Total sum</label>
                            <div class="controls readonly total">
                                <?php echo $price; ?>.00 EUR
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="pay-methods">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <!--div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Order card using BITCOIN</div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <p>System generate invoice wich is valid 10 minutes</p>
                                    <input type="submit" id="j_bitcoin-submit" name="bitcoin-submit"
                                           value="Pay with bitcoin »" class="btn btn-warning">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Order card using PROMOCODE</div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <div class="form-group"><label class="sr-only control-label"
                                                                           for="id_code">Promo code</label><input
                                                        type="text" name="code" title="" placeholder="Promo code"
                                                        class="form-control" id="id_code"></div>
                                        </div>
                                    </div>
                                    <input type="submit" id="j_promocode-submit" name="promocode-submit" disabled=""
                                           value="Apply promocode »" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </div-->
                    <div class="col-sm-4">
                        <div class="panel panel-default panel-cc ">
                            <div class="panel-heading">Order card using Credit Cards</div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <img src="/static/img/cc.24b316dd2e22.png" alt="Visa Mastercard Maestro"
                                         class="img-responsive">
                                    <span class="cc-fee">
Additional fee of 0.35 EUR + 6.0% will be applied
</span>
                                    <?php if ($_POST['card_type'] == 'virtual') { ?>
                                        <!--input type="submit" id="j_cc-submit" name="cc-submit"
                                               value="Pay with Credit Cards »" class="btn btn-success"-->
                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                              target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="YH37MQ3HRG24G">
                                            <input name="notify_url"
                                                   value="https://www.fillit.eu/ajax.php?orderidd=<?php echo $primul_rez['id']; ?>"
                                                   type="hidden">
                                            <input type="hidden" value="https://www.fillit.eu/dashboard.php?orderidd=<?php echo $primul_rez['id']; ?>" name="return">
                                            <input type="image"
                                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
                                                   border="0" name="submit"
                                                   alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0"
                                                 src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                                                 height="1">
                                        </form>
                                    <?php } elseif ($_POST['card_type'] == 'plastic') {
                                        ?>
                                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                              target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="2YZ3NATB2R4VW">
                                            <input name="notify_url"
                                                   value="https://www.fillit.eu/ajax.php?orderidd=<?php echo $primul_rez['id']; ?>"
                                                   type="hidden">
                                            <input type="hidden" value="https://www.fillit.eu/dashboard.php?orderidd=<?php echo $primul_rez['id']; ?>" name="return">
                                            <input type="image"
                                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
                                                   border="0" name="submit"
                                                   alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0"
                                                 src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                                                 height="1">
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="form-group">
                    <a href="order.php" class="btn btn-lg btn-default pull-left">« Back</a>
                </div>
            </div>


            <!--   END ORDER NEW CARD STEP 2        -->

        <?php }elseif ((isset($_GET['step'])) AND ($_GET['step'] == '2') AND (!empty($_POST['card_type'])) AND (in_array_r($_POST['card_type'],$facut))) { ?>

            <div class="page-header">
                <h3 class="text-heading">Order a card </h3>
            </div>
            <div class="alert">

                You are limited to 1 plastic card and 1 virtual card.
            </div>
            <div class="form-actions text-center">
                <div class="form-group">
                    <a href="dashboard.php" class="btn btn-default btn-lg pull-left">« Back to card list</a>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>
</div>
<footer class="iq-footer " style="background-color:#222;    width: 100%;
    left: 0;
    bottom: 0;">
    <div class="container">
        <div class="row"></div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="footer-copyright iq-ptb-20"> “Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings Limited
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
