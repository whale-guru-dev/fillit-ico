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
//if( $user->is_logged_in() ){ header('Location: memberpage.php'); }




//if form has been submitted process it
if(isset($_POST['reset'])){

    if(isset($_GET['action']) && $_GET['action']=='reset'){
        echo '<div id="note">
   If you provided the right e-mail , there will be an e-mail in the inbox concerning reseting information <a id="close">[close]</a>
    
</div>';
        echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';
    }
    //email validation
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'Please enter a valid email address';
    } else {
        $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($row['email'])){
            $error[]='are';
            echo '<div id="badnote">
   No account found with that address <a id="close">[close]</a>
    
</div>';
            echo '<script>
setTimeout(function(){  $( "#badnote" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';
        }else{
            echo '<div id="note">
   If you provided the right e-mail , there will be an e-mail in the inbox concerning reseting information <a id="close">[close]</a>
    
</div>';
            echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';
        }

    }

    //if no errors have been created carry on
    if(!isset($error)){

        //create the activasion code
        $token = md5(uniqid(rand(),true));

        try {

            $stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
            $stmt->execute(array(
                ':email' => $row['email'],
                ':token' => $token
            ));

            //send email
            $date=date("Y-m-d");
            $to = $row['email'];
            $subject = "Password Reset";
            $body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">
  body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0; }
  img, a img { border:0; outline:none; text-decoration:none; }
  .imagefix { display:block; }
  p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
  img{-ms-interpolation-mode: bicubic;}
  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type=\"text/css\">
@media only screen and (max-width: 600px) {
    .rtable {width: 100% !important; table-layout: fixed;}
    .rtable tr {height:auto !important; display: block;}
    .contenttd {max-width: 100% !important; display: block;}
    .contenttd:after {content: \"\"; display: table; clear: both;}
    .hiddentds {display: none;}
    .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
    .imgtable.btnset td {display: inline-block;}
    .imgtable img {width: 100%; height: auto; display: block;}
    table{float: none; table-layout: fixed;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style=\"overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#225ebe\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#225ebe\">
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\"></td>
</tr>
<tr>
<td valign=\"top\">
<table class=\"rtable\" style=\"WIDTH: 600px; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 327px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 273px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/C87FF2AA-531D-1C9A-D167-5AC93230A9BD_Image_1_6a265d40-c636-4162-b9ea-7160744715c3.png\" width=\"293\" height=\"41\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: bottom; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 19px; BACKGROUND-COLOR: #225ebe; mso-line-height-rule: exactly\" align=\"right\"><strong>Date:{$date}</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/03D8C862-10C6-EE98-7CDC-AA9EF0F81D5D_Image_2_4f90588a-b531-4fac-88e5-14eece2ef192.jpg\" width=\"566\" height=\"377\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 12px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><span style='FONT-SIZE: 36px; FONT-FAMILY: \"arial black\", gadget, sans-serif; LINE-HEIGHT: 43px'><strong>Forgot you password?</strong></span></p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 17px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><strong>No need to worry about it! To reset your password, click the button below</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #225ebe 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable btnset\" style=\"TEXT-ALIGN: center; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"VERTICAL-ALIGN: middle; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px\"><a href='https://fillit.eu/resetPassword.php?key={$token}' target=\"_blank\"><img title=\"Password Reset\" border=\"none\" alt=\"Reset Password \" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/74D9D710-D2B9-483F-A1E0-0AC78C33652C_Image_3_837c2587-587e-4089-ac75-2363b0a9868d.png\" /></a> </td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style=\"FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 36px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; LINE-HEIGHT: 21px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\"><span style=\"BACKGROUND-COLOR: #feffff\"><br />
</span><span style=\"FONT-SIZE: 9px; LINE-HEIGHT: 14px\"><span style=\"COLOR: #efefef\"><span style=\"COLOR: #959595\"><br />
&ldquo;Visa<span style=\"font-size:11px\">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood &copy; 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.&rdquo;</span></span></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</th>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"></th>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.0.1.300 -->
</body>
</html>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();

            //redirect to index page
            header('Location: forget.php?action=reset');
            exit;

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

    <title>FILLIT | Login</title>
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
                    <h1 class="text-white">Provide the e-mail you forgot the password to</h1>

                    <div class="photo-form-wrapper clearfix">
                        <form method="post">
                            <input class="form-email" type="text" name="email" placeholder="Email Address">
<input type="hidden" name="reset" value="yes">
                            <div class="col-md-6">
                                <div class="g-recaptcha" data-sitekey="6LeKADkUAAAAAAJb47qCFebm8WzhL-znRhQBplUh"></div>
                            </div>
                            <div class="clearfix"></div><br>

                            <input class="btn btn-primary btn-filled btn-not-white" type="submit" value="Send">
                        </form>
                    </div><!--end of photo form wrapper-->
                    <a href="signup.php" class="text-white">Create an account ➞</a><br>
                </div>
            </div><!--end of row-->

            <div class="row log-footer">
                <p class="text-center">Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood © 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.</p>
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