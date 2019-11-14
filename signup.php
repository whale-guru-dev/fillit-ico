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
//if logged in redirect to members page
// if( $user->is_logged_in() ){ header('Location: memberpage.php'); }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_GET['action'])) {
    if ($_GET['action'] == 'joined') {
        $modal = true;
        $error[] = 'Account created succesfully. <br> Please log in.';
    }
}






//if logged in redirect to members page
if ($user->is_logged_in()) {
    header('Location: dashboard.php');
}

//if form has been submitted process it
if (isset($_POST['register'])) {
    if ($_POST['register'] == 'yes') {

//very basic validation( if bitotal wants username auth) -- HOPE NOT!
        /*	if(strlen($_POST['email']) < 3){
        $error[] = 'E-mail is too short.';
        } else {
        $stmt = $db->prepare('SELECT username FROM members WHERE username = :email');
        $stmt->execute(array(':email' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['email'])){
        $error[] = 'E-mail provided is already in use.';
        }

        }

        if (!isset($_POST['tos'])) {
            $error[] = 'Please accept our terms of service.';
        }
        */
        if (strlen($_POST['password']) < 3) {
            $error[] = 'Password is too short.';
        }

        if (strlen($_POST['password2']) < 3) {
            $error[] = 'Confirm password is too short.';
        }

        if ($_POST['password'] != $_POST['password2']) {
            $error[] = 'Passwords do not match.';
        }

        //new

        if (isset($_POST['fname']) && strlen($_POST['fname'])<3) {
            $error[] = 'First name is too short.';
        }
        if (isset($_POST['lname']) && strlen($_POST['lname'])<3) {
            $error[] = 'Last name is too short.';
        }

        if (isset($_POST['dob']) && strlen($_POST['dob'])<3) {
            $error[] = 'Birthday date is too short.';
        }

        if (!isset($_POST['tos'])) {
            $error[] = 'Please accept our terms of service.';
        }

        if (isset($_POST['country']) && strlen($_POST['country'])<1) {
            $error[] = 'Country is too short.';
        }

        if (isset($_POST['city']) && strlen($_POST['city'])<3) {
            $error[] = 'City name is too short.';
        }

        if (isset($_POST['address1']) && strlen($_POST['address1'])<3) {
            $error[] = 'Address 1 is too short.';
        }
        if (isset($_POST['address2']) && strlen($_POST['address2'])<1) {
            $error[] = 'District must be completed.';
        }
        if (isset($_POST['zip']) && strlen($_POST['zip'])<3) {
            $error[] = 'Zip code is too short.';
        }
        if (isset($_POST['phone']) && strlen($_POST['phone'])<3) {
            $error[] = 'Phone is too short.';
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LeKADkUAAAAABvC-zUYgCwtzqj_zHioenfgiJy6',
            'response' => $_POST["g-recaptcha-response"]
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        if ($captcha_success->success==false) {
            $error[]="<p>Wrong Captcha!</p>";
        }

//email validation
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Please enter a valid email address';
        } else {
            $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
            $stmt->execute(array(':email' => $_POST['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($row['email'])) {
                $error[] = 'Email provided is already in use.';
            }

        }


//if no errors have been created carry on
        if (!isset($error)) {

//hash the password
            $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

//create the activasion code
            $activasion = md5(uniqid(rand(), true));

            try {



//insert into database with a prepared statement
                $stmt = $db->prepare('INSERT INTO members (username,password,email,active,ip_user,date_registered,role,avatar,decry,kycLevel,first_name,last_name,date_of_birth,country,city,address,address2,zip,phone) VALUES (:username, :password, :email,:active,:ip_user,:date_registered,:role,:avatar,:decry,:kyc,:fname,:lname,:dob,:country,:city,:address1,:address2,:zip,:phone)');
                $stmt->execute(array(
                    ':username' => $_POST['email'],
                    ':password' => $hashedpassword,
                    ':email' => $_POST['email'],
                    ':active' => $activasion,
                    ':ip_user' => $_SERVER['REMOTE_ADDR'],
                    ':date_registered' => date("Y-m-d H:i:s"),
                    ':role' => 'member',
                    ':avatar' => 'uploads/default.png',
                    ':decry' => base64_encode($_POST['password']),
                    ':kyc' => 'LEVEL_1',
                    ':fname' => $_POST['fname'],
                    ':lname' => $_POST['lname'],
                    ':dob' => $_POST['dob'],
                    ':country' => $_POST['country'],
                    ':city' => $_POST['city'],
                    ':address1' => $_POST['address1'],
                    ':address2' => $_POST['address2'],
                    ':zip' => $_POST['zip'],
                    ':phone' => $_POST['phone']
                ));
                $id = $db->lastInsertId('memberID');

//send email
                $to = $_POST['email'];
                $subject = "Registration Confirmation";
                $body = "<p>Thank you for registering at FILLIT.EU.</p>
<p>To activate your account, please click on this link: <a href='" . DIR . "activate.php?x=$id&y=$activasion'>" . DIR . "activate.php?x=$id&y=$activasion</a></p>";

                $mail = new Mail();
                $mail->setFrom('noreply@fillit.eu');
                $mail->addAddress($to);
                $mail->subject($subject);
                $mail->body($body);
                $mail->send();

//redirect to index page
                header('Location: index.php?action=activator');
                exit;

//else catch the exception and show the error.
            } catch (PDOException $e) {
                $error[] = $e->getMessage();
            }

        }

    }
}


?>
<?php
if(isset($error)){
    ?>
    <div id=badnote>
        <?php

        foreach($error as $eroare){
            echo $eroare.'<br>';
        }?>
    </div>

<?php echo '<script>
setTimeout(function(){  $( "#badnote" ).slideUp( "slow", function() {}); }, 10000);
 
</script>'; }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    
<head>
        <meta charset="utf-8">
        
        <title>FILLIT | Signup</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/flexslider.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/line-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/theme-tronic.css" rel="stylesheet" type="text/css" media="all"/>
        <link rel="icon" type="image/png" href="img/ico.png" />
        <!--[if gte IE 9]>
        	<link rel="stylesheet" type="text/css" href="css/ie9.css" />
		<![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
    	<div class="loader">
    		<div class="spinner">
			  <div class="double-bounce1"></div>
			  <div class="double-bounce2"></div>
			</div>
    	</div>
				
		<div class="nav-container">
			<nav class="top-bar">
				<div class="container">
				
					<div class="row utility-menu">
						<div class="col-sm-12">
							<div class="utility-inner clearfix">
								<span class="alt-font"><i class="icon icon_mail"></i> info@FILLIT.eu</span>
							
								<div class="pull-right">
									<ul class="social-icons social-white top-social text-right">
										<li>
											<a href="#">
												<i class="icon social_twitter"></i>
											</a>
										</li>
									
										<li>
											<a href="#">
												<i class="icon social_facebook"></i>
											</a>
										</li>
									
										<li>
											<a href="#">
												<i class="icon social_instagram"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div><!--end of row-->
				
				
					<div class="row nav-menu">
						<div class="col-sm-3 col-md-2 columns">
							<a href="index.php">
								<img class="logo logo-light" alt="Logo" src="img/logo-dark.png">
								<img class="logo logo-dark" alt="Logo" src="img/logo-light.png">
							</a>
						</div>
					
						<div class="col-sm-12 col-md-8 col-md-offset-3 sol-sm-offset-2 columns tablet-nav">
							<ul class="menu">
								<li><a href="index.php">Home</a></li>
								<li><a href="fee.php">Fee</a></li>
								<li><a href="blog.php">Blog</a></li>
								<li><a href="faq.php">FAQ</a></li>
								<li><a href="support.php">Support</a></li>
								<li class="for-dropdown"><a href="login.php">Login</a></li>
								<li class="for-dropdown"><a href="singup.html">Signup</a></li>
								<li class="has-dropdown">
									<a href="#" class="language"><img alt="English" src="img/english.png"></a>
									<ul class="subnav">
										<li><a href="#" class="language"><img alt="English" src="img/english.png"></a></li>
										<li><a href="#" class="language"><img alt="English" src="img/greek.png"></a></li>
										<li><a href="#" class="language"><img alt="English" src="img/bulgaria.png"></a></li>
									</ul>
								</li>
							</ul>


							<ul class="social-icons text-right">
								<li>
									<a href="login.php" class="btn btn-primary login-button btn-xs new-btn btn-white">Login</a>
								</li>
							
								<li>
									<a href="signup.php" class="btn btn-primary btn-filled btn-xs new-btn btn-not-white">Signup</a>
								</li>
								
							
							</ul>
						</div>
					</div><!--end of row-->
					
					<div class="mobile-toggle">
						<i class="icon icon_menu"></i>
					</div>
					
				</div><!--end of container-->
			</nav>
		</div>
		<div class="main-container">
			<section class="no-pad login-page">
			
				<div class="background-image-holder">
					<img class="background-image" alt="Poster Image For Mobiles" src="img/signup.jpg">
				</div>
			
				<div class="container align-vertical" style="margin-top: 25px;padding-bottom: 25px;">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 text-center">
							<h1 class="text-white">Get FILLIT prepaid card today!</h1>

							<div class="photo-form-wrapper clearfix">
								<form method="post">
                                    <input type="hidden" value="yes" name="register">
									<div class="col-md-6">
										<input class="form-fname" required name="fname" type="text" placeholder="Enter First Name">
									</div>
									
									<div class="col-md-6">
										<input class="form-lname" required name="lname" type="text" placeholder="Enter Last Name">
									</div>
									
									<div class="col-md-6">
										<input class="form-email" name="email" required type="email" placeholder="Enter Email">
									</div>

									<div class="col-md-6">
										<input placeholder="Date of birth" name="dob" required class="textbox-n"
										type="text" onfocus="(this.type='date')"  id="date"> 
									</div>
									
									<div class="col-md-6">
										<input class="form-password" name="password" required type="password" placeholder="Enter Password">
									</div>
									
									<div class="col-md-6">
										<input class="form-password-re" required name="password2"  type="password" placeholder="Repeat Password">
									</div>
									
									<div class="col-md-6">
										<select required id="id_country" name="country" class="form-control form-country" title="">
		                                	<option value="">Select Country</option>
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
									</div>
									
									<div class="col-md-6">
										<input required class="form-lname" name="city" type="text" placeholder="Enter City Name">
									</div>
									
									<div class="col-md-12">
										<input required class="form-lname" name="address1" type="text" placeholder="Enter Address">
									</div>
									
									<div class="col-md-12">
										<input required class="form-lname" name="address2" type="text" placeholder="Enter District">
									</div>
									
									<div class="col-md-6">
										<input required class="form-lname" name="phone" id="id_phone" type="text" placeholder="Enter Phone">
									</div>
									
									<div class="col-md-6">
										<input required class="form-lname" name="zip" type="text" placeholder="Enter Zip Code">
									</div>
                                    <div class="col-md-6 col-md-offset-2" style="margin-left:20% !important;color:white;"><label style=" display: block;padding-left: 15px;text-indent: -15px;" for="id_tos"><input style="  width: 13px; height: 13px;padding: 0; margin:0;vertical-align: bottom;position: relative;top: -5px;*overflow: hidden;" type="checkbox" name="tos" required="" class="" id="id_tos"> I
                                            have read <a style="color:#55b0ff !important;" href="terms.php" target="_blank">terms of service</a></label>
                                    </div>
									<div class="col-md-6 col-md-offset-2">
										<div class="g-recaptcha" data-sitekey="6LeKADkUAAAAAAJb47qCFebm8WzhL-znRhQBplUh"></div>
									</div>
									<div class="clearfix"></div><br>
									<input required class="btn btn-primary btn-filled btn-not-white" type="submit" value="Register">
								</form>
							</div><!--end of photo form wrapper-->
							<a href="login.php" class="text-white">Already a member of FILLIT?. ➞</a><br>


						</div>
					</div><!--end of row-->

					<div class="row log-footer">
						<p class="text-center">Visa<span style="font-size:11px">®</span>  Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood © 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.</p>
					</div><!--end of row-->
					
					<div class="row log-copyright">
						<div class="col-sm-12">
							<span class="sub">© Copyright 2017 <a href="https://FILLIT.eu">FILLIT.eu</a> - All Rights Reserved</span>
						</div>
					</div>
					
				</div><!--end of container-->


				</div><!--end of container-->


			</section>
		</div>
				
		<script src="js/jquery.min.js"></script>
        <script src="js/jquery.plugin.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.flexslider-min.js"></script>
        <script src="js/smooth-scroll.min.js"></script>
        <script src="js/skrollr.min.js"></script>
        <script src="js/spectragram.min.js"></script>
        <script src="js/scrollReveal.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/twitterFetcher_v10_min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
<script>
    $(function(){
        $('#id_country').change(function(){
            var selected = $(this).find('option:selected');
            var extra = selected.data('phone');
            $('#id_phone').val(extra);
        });
    });

</script>

    <style>
    	.photo-form-wrapper input{
    		margin-bottom: 25px;
    	}
    </style>

</html>
				