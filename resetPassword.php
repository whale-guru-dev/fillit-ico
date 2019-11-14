<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $_GET['key']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])){
    $stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
    $stop = 'Your password has already been changed!';
}

//if form has been submitted process it
if(isset($_POST['password'])){

    //basic validation
    if(strlen($_POST['password']) < 3){
        $error[] = 'Password is too short.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'Confirm password is too short.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'Passwords do not match.';
    }

    if(isset($stop)){
       $error[] = $stop;
    }

    //if no errors have been created carry on
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        try {

            $stmt = $db->prepare("UPDATE members SET password = :hashedpassword , resetComplete = 'Yes' , decry = :new  WHERE resetToken = :token");
            $stmt->execute(array(
                ':hashedpassword' => $hashedpassword,
                ':token' => $row['resetToken'],
                ':new' => base64_encode($_POST['password'])
            ));

            //redirect to index page
           $caca = $user->get_user_tokendata($row['resetToken']);

            if (($user->login($caca['username'], $_POST['password']))) {
                echo 'ha';
                $_SESSION['username'] = $caca['username'];
                $stmt = $db->prepare('UPDATE members SET last_login_ip= :last_ip WHERE username=:id_cur');
                $stmt->execute(array(
                    ':last_ip' => $_SERVER['REMOTE_ADDR'],
                    ':id_cur' => $caca['username']
                ));
                header('Location: dashboard.php?action=resetAccount');
                exit;

            }

            //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title>FILLIT | Reset password</title>
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
            <img class="background-image" alt="Poster Image For Mobiles" src="img/hero6.jpg">
        </div>

        <div class="container align-vertical"><br><br>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                    <h1 class="text-white">Please write your new password</h1>

                    <div class="photo-form-wrapper clearfix">
                        <form method="post">
                            <input type="hidden" name="reset" value="yes">
                            <br>



                            <input type="password" name="password" title="" required="" id="password" placeholder="New Password" class="form-password">
                            <input type="password" name="passwordConfirm" title="" required="" id="passconf" placeholder="Confirm New Password" class="form-password">

                            <input class="btn btn-primary btn-filled btn-not-white" type="submit" value="Send">
                        </form>
                    </div><!--end of photo form wrapper-->
                    <a href="signup.php" class="text-white">Create an account ➞</a><br>
                </div>
            </div><!--end of row-->

            <div class="row log-footer">
                <p class="text-center">Visa<span style="font-size:11px">®</span>   Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood © 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.</p>
            </div><!--end of row-->

            <div class="row log-copyright">
                <div class="col-sm-12">
                    <span class="sub">© Copyright 2017 <a href="https://FILLIT.eu">FILLIT.eu</a> - All Rights Reserved</span>
                </div> <br>
            </div>


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

</html>

<?php
if(isset($modal)) {
    if ($modal == true) {
        echo "<script type='text/javascript'> $(window).load(function(){ $('#login').modal('show'); }); </script>";
    }
}
?>
