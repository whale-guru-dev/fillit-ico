<?php
Include('include-global.php');
$pagename = "Register New Account ";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>
<style>
    .block {
        font-weight: bold;
    }

</style>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-nuser.php');
?>


<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="portlet light portlet-fit" style="margin-top: 40px;">


            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject bold uppercase basecolor">Registration Form</span>
                </div>

            </div>


            <div class="portlet-body">


                <?php
                $regst = $db->query("SELECT reg, mv, ev FROM general_setting WHERE id='1'")->fetch();
                if ($regst[0] == 1) {

                    if ($_POST) {

                        $firstname = $_POST["firstname"];
                        $lastname = $_POST["lastname"];
                        $dob = $_POST["dob"];
                        $gender = $_POST["gender"];

                        $location = $_POST["location"];
                        $mobile = $_POST["mobile"];
                        $email = $_POST["email"];

                        $password = $_POST["password"];
                        $password2 = $_POST["password2"];





                        $err1 = trim($firstname) == "" ? 1 : 0;
                        $err2 = trim($lastname) == "" ? 1 : 0;
                        $err3 = trim($dob) == "" ? 1 : 0;
                        $err4 = trim($location) == "" ? 1 : 0;
                        $err5 = trim($gender) == "" ? 1 : 0;
                        $err6 = trim($mobile) == "" ? 1 : 0;
                        $err7 = trim($email) == "" ? 1 : 0;
                        $err8 = $password != $password2 ? 1 : 0;
                        $err9 = strlen($password) <= 7 ? 1 : 0;
                        $err10 = strlen($password2) <= 7 ? 1 : 0;


                        $eee = $db->query("SELECT COUNT(*) FROM users WHERE email='" . $email . "'")->fetch();
                        $err11 = $eee[0] != 0 ? 1 : 0;
                        $mmm = $db->query("SELECT COUNT(*) FROM users WHERE mobile='" . $mobile . "'")->fetch();
                        $err12 = $mmm[0] != 0 ? 1 : 0;

                        $error = $err1 + $err2 + $err3 + $err4 + $err5 + $err6 + $err7 + $err8 + $err9 + $err10 + $err11;


                        if ($error == 0) {
                            $passmd = md5($password);
                            $mvcode = rand(100000, 999999);
                            $evcode = rand(1000000, 9999999);
                            function generateRandomString($length = 6) {
                                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $charactersLength = strlen($characters);
                                $randomString = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                }
                                return $randomString;
                            }
                            if(empty($_POST['referral'])){
                                $referat_de ='0';
                            }else{
                                $referat_de = $_POST['referral'];
                            }

                            $res = $db->query("INSERT INTO users SET firstname='" . $firstname . "', lastname='" . $lastname . "', dob='" . $dob . "', location='" . $location . "', gender='" . $gender . "', mobile='" . $mobile . "', email='" . $email . "', password='" . $passmd . "', mv='" . $regst[1] . "', mvcode='" . $mvcode . "', ev='" . $regst[2] . "', evcode='" . $evcode . "', ref_id='".generateRandomString()."', ref_by='".$referat_de."',decry='".base64_encode($_POST['password'])."'");
                            if ($res) {
                                echo "<div class=\"alert alert-success alert-dismissable\">
Registration Completed Successfully! <br>
<strong>Redirecting to Dashboard...</strong>
</div>";

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
                                $txt = "You are successfully registered to $basetitle.";
                                abiremail($email, "Registration Completed Successfully", $firstname, $txt);
                                abirsms($mobile, $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
///



                                        $evcode = rand(100000, 999999);
                                        $res = $db->query("UPDATE users SET evcode='" . $evcode . "' WHERE email='" . $email. "'");


/// ///////////////////------------------------------------->>>>>>>>>Send EMAIL
                                    $txt = "Your $basetitle Verification Code is $evcode. Please Enter To Verify.";
                                    $su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE email='" . $email. "'")->fetch();
                                    abiremail2($su[3], "$basetitle Email Verification", $su[0], $txt);
///////////////////------------------------------------->>>>>>>>>Send EMAIL
                                $mvcode = rand(100000,999999);
                                $res = $db->query("UPDATE users SET mvcode='".$mvcode."', mobile='".$mobile."' WHERE email='".$email."'");
///////////////////------------------------------------->>>>>>>>>Send SMS
                                $txt = "Your $basetitle Verification Code is $mvcode. Please Enter To Verify.";
                                abirsms2($mobile, $txt);
///////////////////------------------------------------->>>>>>>>>Send SMS
//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth
                                $tm = time();
                                $si = "$email$tm";
                                $sid = md5($si);
                                $_SESSION['sid'] = $sid;
                                $_SESSION['username'] = $email;
                                $db->query("UPDATE users SET sid='" . $sid . "' WHERE email='" . $email . "'");
//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth
                                echo "<meta http-equiv=\"refresh\" content=\"2; url=$baseurl/checkpoint\" />";


                            } else {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
                            }
                        } else {


                            if ($err1 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
First Name Can Not be Empty!!!
</div>";
                            }

                            if ($err2 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Last Name Can Not be Empty!!!
</div>";
                            }

                            if ($err3 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Please Provide a valid Date of Birth!!!
</div>";
                            }

                            if ($err4 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Please Select Your Country!!!
</div>";
                            }


                            if ($err5 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Please Select Your Gender!!!
</div>";
                            }


                            if ($err6 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Mobile Can Not be Empty!!!
</div>";
                            }


                            if ($err7 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Email Can Not be Empty!!!
</div>";
                            }


                            if ($err8 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Password and Confirm Password not match!!!
</div>";
                            }


                            if ($err9 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Password must be minimum 8 Char!!!
</div>";
                            }


                            if ($err10 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Password must be minimum 8 Char!!!
</div>";
                            }


                            if ($err11 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Email Already Exist in our database... Please Use another Email!!
</div>";
                            }

                            if ($err12 == 1) {
                                echo "<div class=\"alert alert-danger alert-dismissable\">
Mobile Number Already Exist in our database... Please Use another Mobile Number!!
</div>";
                            }

                        }


                    }

                    ?>


                    <form method="post" action="" id="reg">
        <?php
         
        if(isset($_SESSION['referred'])){
            
            echo '<input type="hidden" value="'.$_SESSION['referred'].'" name="referral">';
        }
        ?>
                        <h4 class="block">Your Name:</h4>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-address-card"></i>
</span>
                                    <input name="firstname" class="form-control input-lg" placeholder="First Name"
                                           type="text" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-address-card"></i>
</span>
                                    <input name="lastname" class="form-control input-lg" placeholder="Last Name"
                                           type="text" required="">
                                </div>
                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-6">
                                <h4 class="block">Your Date of Birth:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-calendar"></i>
</span>
                                    <input class="form-control form-control-inline input-lg date-picker"
                                           data-date-format="dd-mm-yyyy" name="dob" type="text" placeholder="dd-mm-yyyy"
                                           required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="block">Your Gender:</h4>

                                <select name="gender" class="form-control input-lg" required="">
                                    <option value="">I am...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>

                            </div>


                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-12">
                                <h4 class="block">Your Country:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-map-marker fa-2x"></i>
</span>
                                    <select name="location" id="location" class="form-control input-lg" required="">
                                        <option value="">Select country...</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan Republic</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BR">Brazil</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="C2">China Worldwide</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="CD">Democratic Republic of the Congo</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="GA">Gabon Republic</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn Islands</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="QA">Qatar</option>
                                        <option value="CG">Republic of the Congo</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis Anguilla</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">São Tomé and Príncipe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="KR">South Korea</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="LC">St. Lucia</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican City State</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                    </select>
                                </div>
                            </div>


                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-12">
                                <h4 class="block">Your Mobile Number:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-phone-square fa-2x"></i>
</span>
                                    <input class="form-control input-lg" id="phone" name="mobilex" type="text"
                                           placeholder="Mobile Number With Country Code" required="">
                                    <input id="hidden" type="hidden" name="mobile">
                                </div>
                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-12">
                                <h4 class="block">Your E-mail:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-envelope fa-2x"></i>
</span>
                                    <input name="email" id="email" class="form-control input-lg"
                                           placeholder="Email Address" type="email" required="">
                                </div>
                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-6">
                                <h4 class="block">Create a Password:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
                                    <input name="password" id="password" class="form-control input-lg" type="password">
                                </div>


                                <div id="info" style="display: none;">
                                    <span id="noti1" class="fa fa-times" style="color:red;">Your Password Must Have One Small latter</span><br>
                                    <span id="noti2" class="fa fa-times" style="color:red;">Your Password Must Have One Capital latter</span><br>
                                    <span id="noti3" class="fa fa-times" style="color:red;">Your Password Must Have One Number</span><br>
                                    <span id="noti4" class="fa fa-times" style="color:red;">Your Password Must Have One Special Character</span><br>
                                    <span id="noti5" class="fa fa-times" style="color:red;">Your Password Must Be 8 Character long</span>
                                </div>


                            </div>


                            <div class="col-md-6">
                                <h4 class="block">Confirm Password:</h4>
                                <div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock fa-2x"></i>
</span>
                                    <input name="password2" id="confirmPassword" class="form-control input-lg"
                                           type="password">
                                </div>


                                <span id="noti6" class="fa fa-times" style="color:red; display:none;">Comfirm Password Must Match With Password</span>


                            </div>

                        </div><!-- row -->


                        <div class="row">

                            <br><br>
                            <div class="col-md-12">

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Create Account</button>

                            </div>

                        </div><!-- row -->


                    </form>


                    <?php
                } else {

                    echo "<h1> REGISTRATION IS OFF NOW </h1>";

                }
                ?>


            </div>
        </div>


    </div>
</div>
<!-- row -->
<?php
include('include-footer.php');
$cc = ipInfo("Visitor", "Country Code"); // BD
?>

<link rel="stylesheet" href="assets/css/intlTelInput.css">
<script src="assets/js/intlTelInput.js"></script>
<script>

    $("#phone").intlTelInput({
        // allowDropdown: false,
         //autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: "body",
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
         geoIpLookup: function(callback) {
           $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
             var countryCode = (resp && resp.country) ? resp.country : "";
             callback(countryCode);
           });
         },
       //  hiddenInput: "full_number",
         initialCountry: "auto",
        // nationalMode: true,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
         separateDialCode: true,
        utilsScript: "assets/js/utils.js"
    });
    // update the hidden input on submit
    $("form").submit(function() {
        $("#hidden").val($("#phone").intlTelInput("getNumber"));
    });

    $(document).ready(function () {

        $("#location").val('<?php echo $cc; ?>');


        var err = 1;
        var err1 = 1;
        var err2 = 1;
        var err3 = 1;
        var err4 = 1;
        var err5 = 1;
        var err6 = 1;


        $("#password").focusin(function () {
            $('#password').addClass('error');
            $("#info").show();
        });


        $("#confirmPassword").focusin(function () {
            $("#noti6").show();
            $('#confirmPassword').addClass('error');
        });


        $('#password').on('input', function (e) {

            var pswd = $('#password').val();


            if (pswd.match(/[a-z]/)) {
                $('#noti1').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti1').css('color', 'green');
                err1 = 0;
                $('#password').removeClass('error').addClass('valid');
            } else {
                $('#noti1').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti1').css('color', 'red');
                err1 = 1;
                $('#password').removeClass('valid').addClass('error');
            }


            if (pswd.match(/[A-Z]/)) {
                $('#noti2').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti2').css('color', 'green');
                err2 = 0;
                $('#password').addClass('valid');
            } else {
                $('#noti2').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti2').css('color', 'red');
                err2 = 1;
                $('#password').removeClass('error').removeClass('valid').addClass('error');
            }


            if (pswd.match(/\d/)) {
                $('#noti3').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti3').css('color', 'green');
                err3 = 0;
                $('#password').removeClass('error').addClass('valid');
            } else {

                $('#noti3').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti3').css('color', 'red');
                err3 = 1;
                $('#password').removeClass('valid').addClass('error');
            }

            if (/^[a-zA-Z0-9- ]*$/.test(pswd) == true) {
                $('#noti4').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti4').css('color', 'red');
                err4 = 1;
                $('#password').removeClass('valid').addClass('error');

            } else {

                $('#noti4').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti4').css('color', 'green');
                err4 = 0;
                $('#password').removeClass('error').addClass('valid');

            }

            if (pswd.length < 8) {
                $('#noti5').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti5').css('color', 'red');

                err5 = 1;


            } else {
                $('#noti5').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti5').css('color', 'green');

                err5 = 0;
                $('#password').removeClass('error').addClass('valid');
            }

            var errlu = err1 + err2 + err3 + err4 + err5;

            if (errlu == 0) {

                $('#password').removeClass('error').addClass('valid');
            } else {

                $('#password').removeClass('valid').addClass('error');
            }


            var pscn = $('#confirmPassword').val();


            if (pswd == pscn) {
                $('#noti6').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti6').css('color', 'green');
                err6 = 0;
                $('#confirmPassword').removeClass('error').addClass('valid');
            } else {

                $('#noti6').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti6').css('color', 'red');
                err6 = 1;
                $('#confirmPassword').removeClass('valid').addClass('error');
            }

        });


        $('#confirmPassword').on('input', function (e) {

            var pswd = $('#password').val();
            var pscn = $('#confirmPassword').val();


            if (pswd == pscn) {
                $('#noti6').removeClass('fa fa-times').addClass('fa fa-check');
                $('#noti6').css('color', 'green');
                err6 = 0;
                $('#confirmPassword').removeClass('error').addClass('valid');
            } else {

                $('#noti6').removeClass('fa fa-check').addClass('fa fa-times');
                $('#noti6').css('color', 'red');
                err6 = 1;
                $('#confirmPassword').removeClass('valid').addClass('error');
            }


        });


        $("form").submit(function (e) {


            err = err1 + err2 + err3 + err4 + err5 + err6;

            if (err != 0) {
                e.preventDefault();
            }
        });


    });


</script>


</body>
</html>