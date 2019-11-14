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
if( !$user->is_logged_in() ){ header('Location: https://fillit.eu/index.php'); }
$date_user = $user->get_user_data($_SESSION['username']);

$adresa = $date_user['address'];
$adresa2 = $date_user['address2'];
$telefon = $date_user['phone'];
$first_n = $date_user['first_name'];
$last_n = $date_user['last_name'];
$dof = $date_user['date_of_birth'];
$country = $date_user['country'];
$zip = $date_user['zip'];
$city = $date_user['city'];


if(isset($_POST['sentt'])){

    if((!empty($_POST['zip'])) AND (!empty($_POST['date_of_birth'])) AND (!empty($_POST['phone'])) AND (!empty($_POST['city'])) AND ($_POST['country']!='---------')  AND (!empty($_POST['address'])) AND (!empty($_POST['address2']))) {
        $stmt = $db->prepare('UPDATE members SET country=:country, phone=:phone, date_of_birth=:dof , address=:addr , address2=:addr2, zip=:zip, city=:city   WHERE username=:usercur');
        $stmt->execute(array(
            ':country' => $_POST['country'],
            ':phone' => $_POST['phone'],
            ':dof' => $_POST['date_of_birth'],
            ':addr' => $_POST['address'],
            ':addr2' => $_POST['address2'],
            ':zip' => $_POST['zip'],
            ':city' => $_POST['city'],
            ':usercur' => $_SESSION['username'],
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
        header('Location: https://fillit.eu/dashboard.php');
    }else{
        $error[]= 'Please complete ALL the fields.';
    }
}


?>

<style>

    @media (max-width: 668px) {
        .iq-footer  {
display:none;
        }
    }

    div.form-actions input.btn-primary{
        margin-bottom: 30px;
        margin-top:10px;
    }
</style>

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
    .alert{
        padding: 15px !important;
        margin-bottom: 20px !important;

        border-radius: 4px !important;
        background-color: #fcf8e3 !important;
        border-color: #faebcc !important;
        color: #8a6d3b !important;
    }
    html{height: 100% !important;}
    body{height:100% !important;}
</style>
<div class="inner">
    <div class="container all-content">
        <div class="page-header">
            <h3>
                My profile
                <!--a href="/accounts/password/change/" class="pull-right btn btn-default btn-empty-bg">
                    <span class="glyphicon glyphicon-pencil"></span> Password Change
                </a-->
            </h3>
        </div>
        <div class="alert alert-warning" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">If you wish to change any of your personal details, please contact us.</span>If you wish to change any of your personal details, please contact us.
            <br>
            <?php if(!empty($error)){ echo $error[0];} ?>
        </div>
        <form method="POST" id="profile" novalidate=""><input type="hidden" name="sentt" value="yes">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_first_name">First name</label>
                        <?php if(empty($date_user['first_name'])){ ?>
                        <input type="text" name="first_name" title="" id="id_first_name" maxlength="30" value="<?php echo $first_n; ?>" placeholder="First name" class="form-control">
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $first_n; ?></div>

                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_last_name">Last name</label>
                        <?php if(empty($date_user['last_name'])){ ?>
                        <input type="text" name="last_name" title="" id="id_last_name" maxlength="30" value="<?php echo $last_n; ?>" placeholder="Last name" class="form-control">
                    <?php }else{   ?>

                        <div class="form-control"><?php echo $last_n; ?></div>

                    <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group required-input"><label class="control-label" for="id_birthday">Date of birth</label>
                        <?php if(empty($date_user['country'])){ ?>
                        <input type="date" name="date_of_birth" title="" required="" id="id_birthday" value="<?php echo $dof; ?>" placeholder="dd.mm.yyyy" class="datepicker form-control">
                    <?php }else{   ?>

                            <div class="form-control"><?php echo $dof; ?></div>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_country">Country</label>
                <?php if (empty($date_user['country'])) { ?>
                        <select name="country" id="id_country" class="form-control" title="">
                                <option value="">---------</option>
                            <option value="AD" data-phone="+376">Andorra</option>
                            <option value="AT" data-phone="+43">Austria</option>
                            <option value="BE" data-phone="+32">Belgium</option>
                            <option value="BG" data-phone="+359">Bulgaria</option>
                            <option value="ES" data-phone="+34">Canary Islands</option>
                            <option value="HR" data-phone="+385">Croatia</option>
                            <option value="CY" data-phone="+357">Cyprus</option>
                            <option value="CZ" data-phone="+420">Czech Republic</option>
                            <option value="DK" data-phone="+45">Denmark</option>
                            <option value="EE" data-phone="+372">Estonia</option>
                            <option value="FI" data-phone="+358">Finland</option>
                            <option value="FR" data-phone="+33">France</option>
                            <option value="DE" data-phone="+49">Germany</option>
                            <option value="GI" data-phone="+350">Gibraltar</option>
                            <option value="GR" data-phone="+30">Greece</option>
                            <option value="GL" data-phone="+299">Greenland</option>
                            <option value="GG" data-phone="+44">Guernsey</option>
                            <option value="HU" data-phone="+36">Hungary</option>
                            <option value="IS" data-phone="+354">Iceland</option>
                            <option value="IE" data-phone="+353">Ireland</option>
                            <option value="IM" data-phone="+44">Isle of Man</option>
                            <option value="IL" data-phone="+972">Israel</option>
                            <option value="IT" data-phone="+39">Italy</option>
                            <option value="JE" data-phone="+44">Jersey</option>
                            <option value="LV" data-phone="+371">Latvia</option>
                            <option value="LI" data-phone="+423">Liechtenstein</option>
                            <option value="LT" data-phone="+370">Lithuania</option>
                            <option value="LU" data-phone="+352">Luxembourg</option>
                            <option value="MT" data-phone="+356">Malta</option>
                            <option value="MC" data-phone="+377">Monaco</option>
                            <option value="NL" data-phone="+31">Netherlands</option>
                            <option value="NO" data-phone="+47">Norway</option>
                            <option value="PL" data-phone="+48">Poland</option>
                            <option value="PT" data-phone="+351">Portugal</option>
                            <option value="RO" data-phone="+40">Romania</option>
                            <option value="SM" data-phone="+378">San Marino</option>
                            <option value="SK" data-phone="+421">Slovakia</option>
                            <option value="SI" data-phone="+386">Slovenia</option>
                            <option value="ES" data-phone="+34">Spain</option>
                            <option value="SE" data-phone="+46">Sweden</option>
                            <option value="CH" data-phone="+41">Switzerland</option>
                            <option value="TR" data-phone="+90">Turkey</option>
                            <option value="GB" data-phone="+44">United Kingdom</option>

                        </select>
                    <?php }else{
                    ?>
                        <div class="form-control">
                      <?php echo $country;?>
                        </div>
                <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_city">City</label>
                        <?php if (empty($date_user['city'])) { ?>
                        <input type="text" name="city" title="" id="id_city" maxlength="50" value="<?php echo $city; ?>" placeholder="City" class="form-control">
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $city; ?></div>

                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_address1">Address 1</label>
                        <?php if (empty($date_user['address'])) { ?>
                        <input type="text" name="address" title="" id="id_address1" value="<?php echo $adresa; ?>" maxlength="35" placeholder="Address 1" class="form-control">
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $adresa; ?></div>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_address2">Address 2</label>
                        <?php if (empty($date_user['address2'])) { ?>
                        <input type="text" name="address2"  title="" id="id_address2" value="<?php echo $adresa2; ?>" maxlength="35" placeholder="Address 2" class="form-control">
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $adresa2; ?></div>

                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_zip_code">ZIP Code</label>
                        <?php if (empty($date_user['zip'])) { ?>
                        <input type="text" name="zip" title="ex. LVXXXX" id="id_zip_code" value="<?php echo $zip; ?>" maxlength="50" placeholder="ZIP Code" class="form-control">
                        <div class="help-block">ex. 32421</div>
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $zip; ?></div>

                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="control-label" for="id_phone">Phone</label>
                        <?php if (empty($date_user['phone'])) { ?>
                        <input type="text" name="phone" title="" id="id_phone" maxlength="25" value="<?php echo $telefon; ?>" placeholder="Phone" class="form-control">
                        <?php }else{   ?>

                            <div class="form-control"><?php echo $telefon; ?></div>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <?php    if((empty($user->get_user_data()['country'])) OR (empty($user->get_user_data()['zip'])) OR  (empty($user->get_user_data()['city']))  OR (empty($user->get_user_data()['phone']))  OR (empty($user->get_user_data()['date_of_birth']))  OR (empty($user->get_user_data()['ip_user'])) OR (empty($user->get_user_data()['address']))  OR (empty($user->get_user_data()['first_name']))) {?>

    <div class="form-actions text-center">
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary btn-lg">
                </div>
            </div>

            <?php } ?>
        </form>

    </div>
</div>
<?php
if(empty($date_user['phone'])){
    ?>
<script>
    $(function(){
        $('#id_country').change(function(){
            var selected = $(this).find('option:selected');
            var extra = selected.data('phone');
            $('#id_phone').val(extra);
        });
    });

</script>

<?php
}
?>


<!-- Footer -->
</div>
</div>
<footer class="iq-footer " style="background-color:#222;width:100%;bottom:0; margin-top:10%; ">
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

<!-- Footer END -->