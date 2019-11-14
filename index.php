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
if (isset($_POST['passwordL'])) {

    $username = $_POST['emailL'];
    $password = $_POST['passwordL'];

    if (($user->login($username, $password)) AND (empty($error))) {
        $_SESSION['username'] = $username;
        $stmt = $db->prepare('UPDATE members SET last_login_ip= :last_ip WHERE username=:id_cur');
        $stmt->execute(array(
            ':last_ip' => $_SERVER['REMOTE_ADDR'],
            ':id_cur' => $username
        ));
        header('Location: dashboard.php');
        exit;

    } else {
        $error[] = 'Wrong username or password or your account has not been activated.';
        $modal = true;

    }


}//end if submit
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'joined') {



        echo '<div id="note">
    Account activated succesfully.  Please log in. <a id="close">[close]</a>
    
</div>';
        echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';
    }
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'activator') {

        echo '<div id="note">
   Account created succesfully. Please check your e-mail for activation link. <a id="close">[close]</a>
</div>';
        echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';

    }
}


// get in touch

if(isset($_POST['actionc'])) {
    if($_POST['actionc']=='sendEmail'){

        if((!empty($_POST['namec'])) AND (!empty($_POST['emailc'])) AND (!empty($_POST['messagec']))) {
            $to = "support@fillit.eu";
            $subject = "Get in touch - " . $_POST['namec'];
            $body = "<p>Name: " . $_POST['namec'] . "
 <br>           E-mail: " . $_POST['emailc'] . "
 </p>
 <p>Message:</p>
<p>" . $_POST['messagec'] . "</p>";

            $mail = new Mail();
            $mail->setFrom('webmaster@fillit.eu');
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();
            echo '<div id="note">
  Message sent! <a id="close">[close]</a>
</div>';
            echo '<script>
setTimeout(function(){  $( "#note" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';

        }else{
            echo '<div id="badnote">
  You left a field uncompleted <a id="close">[close]</a>
</div>';
            echo '<script>
setTimeout(function(){  $( "#badnote" ).slideUp( "slow", function() {}); }, 10000);
 
</script>';     }
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
        
        <title>FILLIT | Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/flexslider.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/line-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        <link href="css/theme-tronic.css" rel="stylesheet" type="text/css" media="all"/>
        <link rel="icon" type="image/png" href="img/ico.png" />

        <!--[if gte IE 9]>
        	<link rel="stylesheet" type="text/css" href="css/ie9.css" />
		<![endif]-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
								<li class="for-dropdown"><a href="signup.php">Signup</a></li>
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
			<section class="hero-slider">
				<ul class="slides">
					<li class="overlay">
						<div class="background-image-holder parallax-background">
							<img class="background-image" alt="Background Image" src="img/hero4.jpg">
						</div>
						
						<div class="container align-vertical">
							<div class="row">
								<div class="col-md-6 col-sm-9">
									<h1 class="text-white animate-text">Load the card from PayPal account and spend online, in stores or withdraw funds in ATM</h1>
									<a href="signup.php" class="animate-text btn btn-primary btn-filled btn-not-white">Get Started</a>
								</div>
							</div>
						</div><!--end of container-->
					</li><!--end of individual slide-->
					
					<!--end of individual slide-->
					
					<li class="overlay">
						<div class="background-image-holder parallax-background">
							<img class="background-image" alt="Background Image" src="img/hero1.jpg">
						</div>
						
						<div class="container align-vertical">
							<div class="row">
								<div class="col-md-6 col-sm-9">
									<h1 class="text-white">Load the card from PayPal account and spend online, in stores or withdraw funds in ATM</h1>
									<a href="signup.php" class="btn btn-primary btn-filled btn-not-white">Get Started</a>
								</div>
							</div>
						</div><!--end of container-->
					</li><!--end of individual slide-->

					<li class="overlay">
						<div class="background-image-holder parallax-background">
							<img class="background-image" alt="Background Image" src="img/hero3.jpg">
						</div>
						
						<div class="container align-vertical">
							<div class="row">
								<div class="col-md-6 col-sm-9">
									<h1 class="text-white">Load the card from PayPal account and spend online, in stores or withdraw funds in ATM</h1>
									<a href="signup.php" class="btn btn-primary btn-filled btn-not-white">Get Started</a>
								</div>
							</div>
						</div><!--end of container-->
					</li><!--end of individual slide-->
					<li class="overlay">
						<div class="background-image-holder parallax-background">
							<img class="background-image" alt="Background Image" src="img/hero2.jpg">
						</div>
						
						<div class="container align-vertical">
							<div class="row">
								<div class="col-md-6 col-sm-9">
									<h1 class="text-white">Load the card from PayPal account and spend online, in stores or withdraw funds in ATM</h1>
									<a href="signup.php" class="btn btn-primary btn-filled btn-not-white">Get Started</a>
								</div>
							</div>
						</div><!--end of container-->
					</li><!--end of individual slide-->
				</ul>
			</section>
			

			<section class="primary-features duplicatable-content">
				<div class="container">
					<div class="row">
							<div class="col-md-4 col-sm-6 clearfix">
								<div class="feature feature-icon-small">
									<i class="icon icon-ribbon" data-scroll-reveal="enter bottom and move 30px"></i>
									<h6 class="text-white">Easy to get</h6>
									<p class="text-white font-bigger">
										Use card at any site, shop and ATM worldwide that accepts Visa.
									</p>
								</div><!--end of feature-->
							</div>
						
							<div class="col-md-4 col-sm-6 clearfix">
								<div class="feature feature-icon-small">
									<i class="icon icon-speedometer" data-scroll-reveal="enter bottom and move 30px"></i>
									<h6 class="text-white">Instant</h6>
									<p class="text-white font-bigger">
										Get the card and load it in seconds.
									</p>
								</div><!--end of feature-->
							</div>
						
							<div class="col-md-4 col-sm-6 clearfix">
								<div class="feature feature-icon-small" >
									<i class="icon icon-gears" data-scroll-reveal="enter bottom and move 30px"></i>
									<h6 class="text-white">Features</h6>
									<p class="text-white font-bigger">
										Both Chip & Pin and virtual cards are available in EUR.
									</p>
								</div><!--end of feature-->
							</div>
		
					</div><!--end of row-->
				
				</div><!--end of container-->
			</section>
			
			<section class="product-right">
			
				<div class="background-image-holder">
					<img class="background-image" alt="Background Image" src="img/grey-bg.jpg">
				</div>
				
				<div class="container align-vertical">
					<div class="row">
						<div class="col-md-5 col-sm-6">
							<h1>What is FILLIT?</h1>
							<p class="lead">
								FILLIT is a prepaid card service that allows users to transfer money from their PayPal accounts or other merchants such as betting companies and others on a plastic or virtual FILLIT Visa card and allows them to use this card as any other worldwide payment card. FILLIT.eu and FILLIT trademarks belong to Streamflow EOOD, a company based in Bulgaria, founded in 2014.

							</p>
							<a href="about-us.php" class="btn btn-primary" data-scroll-reveal="enter left and move 30px">About Us</a>
							<a href="signup.php" class="btn btn-primary btn-filled btn-not-white" data-scroll-reveal="enter left and move 30px">Get Started</a>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
				
				<div class="product-image" data-scroll-reveal="enter right and move 100px">
					<img alt="card holder" src="img/right-landingn.jpg">
				</div>
			</section>

			<header class="page-header fixed-bg">
				<div class="container">
					<div class="row">
						<div class="text-center col-sm-12">
							<span style="font-size: 19px;" class="text-white alt-font">Simplify your business and life</span>
							<h1 class="text-white">Fill your pocket with FILLIT</div></h1>
							<center><a href="signup.php" class="btn btn-primary btn-white" data-scroll-reveal="enter left and move 30px">Register For Free</a></center>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</header>

			<section class="duplicatable-content">
			
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<h1 style="margin-bottom: 5px">FILLIT Prepaid Card Features</h1>
							<p class="text-center" style="margin-bottom: 48px;">Some of great benefits you get with FILLIT Prepaid Card</p>
						</div>
					</div><!--end of row-->
		
					<div class="row">
						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-credit-card" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>It's prepaid</h5>
									<p>
										No bank account needed, no credit check.
									</p>
								</div>
							</div>
						</div><!--end 6 col-->
						
						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-truck" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>Standard or Express delivery</h5>
									<p>
										We offer FREE standard delivery or DHL Express service for an extra charge.
									</p>
								</div>
							</div>
						</div><!--end 6 col-->
						
						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-money" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>Low Fees</h5>
									<p>
										We charge only 1% fee. Check all fees
									</p>
								</div>
							</div>
						</div><!--end 6 col-->

						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-rocket" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>High limits</h5>
									<p>
										High deposit and withdrawal limits.
									</p>
								</div>
							</div>
						</div><!--end 6 col-->

						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-life-ring" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>Premium support</h5>
									<p>
										We LOVE our customers and convinced that high level 24/7 support is our strongest side.
									</p>
								</div>
							</div>
						</div><!--end 6 col-->

						<div class="col-sm-6">
							<div class="feature feature-icon-large">
								<div class="pull-left myhover">
									<i class="fa fa-lock" aria-hidden="true" data-scroll-reveal="enter left and move 30px"></i>
								</div>
								<div class="pull-right">
									<h5>Trusted and Secure</h5>
									<p>
										Card issuer is an authorised and regulated e-money institution in Gibraltar. Our technical platform meets high techical security requirements
									</p>
								</div>
							</div>
						</div><!--end 6 col-->
						
					</div><!--end of row-->
				</div>
			</section>

			<section class="no-pad-bottom projects-gallery">
				<h1 class="text-center">FILLIT Fees</h1>
				
				<div class="projects-wrapper clearfix">
					
					<div class="projects-container">
						
						<div class="col-md-4 col-sm-6 no-pad project print image-holder">
							<div class="background-image-holder">
								<img class="background-image" alt="Background Image" src="img/project1.jpg">
							</div>
							<div class="hover-state">
								<div class="align-vertical">
									<h3 class="text-white"><strong>Prices and fees</strong></h3>
									<p class="text-white">
										Click on View Price button to see the details
									</p>
									<a href="fee.php" class="btn btn-primary btn-white">View Prices</a>
								</div>
							</div>
						</div><!--end of individual project-->
						
						<div class="col-md-4 col-sm-6 no-pad project branding image-holder">
							<div class="background-image-holder">
								<img class="background-image" alt="Background Image" src="img/project2.jpg">
							</div>
							<div class="hover-state">
								<div class="align-vertical">
									<h3 class="text-white"><strong>Limits</strong></h3>
									<p class="text-white">
										Click on View Price button to see the details
									</p>
									<a href="fee.php" class="btn btn-primary btn-white">View Prices</a>
								</div>
							</div>
						</div><!--end of individual project-->
						
						<div class="col-md-4 col-sm-6 no-pad project print image-holder">
							<div class="background-image-holder">
								<img class="background-image" alt="Background Image" src="img/project3.jpg">
							</div>
							<div class="hover-state">
								<div class="align-vertical">
									<h3 class="text-white"><strong>P2P Transfers</strong></h3>
									<p class="text-white">
										Click on View Price button to see the details
									</p>
									<a href="fee.php" class="btn btn-primary btn-white">View Prices</a>
								</div>
							</div>
						</div><!--end of individual project-->
					
					</div><!--end of projects-container-->
					
				</div><!--end of projects wrapper-->
			</section>

			<section class="video-inline">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<h1 class="space-bottom-medium">What is FILLIT Prepaid Card?</h1>
							<p class="lead space-bottom-medium" style="text-align: justify;">
								FILLIT Prepaid Card is a real visa card that can be funded with any currency. Thus make it possible to make any payment in the real world by using it at any shop or restaurant and online shopping. Furthermore, it can be used by companies to pay staff or suppliers.
							</p>
						</div>
						
						<div class="col-md-6 col-sm-12">
							<div class="inline-video-wrapper">
								<video controls="">

									<source src="video/video.mp4" type="video/mp4">
									<source src="video/video.ogv" type="video/ogg">
								</video>
							</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>

			<section class="side-image clearfix">
				
				<div class="container">
					<div class="row">
						<div class="col-md-6 content col-sm-8 clearfix">
							<h1>Frequently Asked Questions</h1>
		
							<ul class="blog-snippet-2">
								<li>
									<div class="icon">
										<i class="icon icon-pencil"></i>
									</div>
									<div class="title">
										<a>Q: How do I get a FILLIT Prepaid Card?</a>
										<span class="sub alt-font">A: FILLIT Prepaid Corporate Prepaid cards are only available through corporate invitation. If you work with an organization who offers this card program, please ask them for an invitation.</span>
									</div>
								</li>
								
								<li>
									<div class="icon">
										<i class="icon icon-pencil"></i>
									</div>
									<div class="title">
										<a>Q: How long does it take to receive my FILLIT Prepaid Card?</a>
										<span class="sub alt-font">A: FILLIT Prepaid Card are created instantly, and the access details are sent to you to your email id. FILLIT Prepaid Plastic cards should reach you approximately 7 to 10 business days after your card is ordered by the corporate partner</span>
									</div>
								</li>
								
								<li>
									<div class="icon">
										<i class="icon icon-pencil"></i>
									</div>
									<div class="title">
										<a>Q: What do I do when I receive my card in the mail?</a>
										<span class="sub alt-font">A: When your card arrives, simply activate it. Follow the printed activation instructions that arrive with your card.</span>
									</div>
								</li>
								
								<li>
								</li>
							</ul>	
							<a href="faq.php" class="btn btn-primary btn-mobile" data-scroll-reveal="enter left and move 30px">Read More</a>
							
							</div><!--end of row-->

						
					</div><!--end of container-->
				</div>
				
				<div class="image-container col-md-5 col-sm-3 pull-right">
					<div class="background-image-holder">
						<img class="background-image" alt="Background Image" src="img/hero10.jpg">
					</div>
				</div>
			</section>


			
			<section class="action-banner overlay">
			
				<div class="background-image-holder">
					<img class="background-image" alt="Background Image" src="img/hero3.jpg">
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
							<h1 class="text-white">I'm ready to use FILLIT prepaid card service. Where do I signup?</h1>
							<h2 class="text-white">We're chuffed to hear it, and you'll be chuffed by using our incredible service.</h2>
							<a href="signup.php" class="btn btn-primary btn-white" data-scroll-reveal="enter left and move 30px">Get Register</a>
							<a href="fee.php" class="btn btn-primary btn-white btn-filled" data-scroll-reveal="enter left and move 30px">Our Fee</a>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>

			<section class="feature-divider">
			
				<div class="background-image-holder" data-scroll-reveal="wait 0.2s then enter 200px from bottom over 0.3s">
					<img class="background-image" alt="Background Image" src="img/grey-bg.jpg">
				</div>
			
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
							<h1>Enjoy FILLIT Anywhere Anytime</h1>
							
						</div>
                                                <div class="col-md-5">
			     				<h2>Free download FILLIT Mobile Applications</h2>
							
							<a class="store-link" href="#"><img alt="Buy On App Store" src="img/app-store.png"></a>
							<a class="store-link" href="#"><img alt="Buy On App Store" src="img/google-play.png"></a>
						</div>
					
						<div class="col-sm-7" data-scroll-reveal="enter from bottom and move 100px">
							<img alt="App Screenshot" src="img/app2.png">
						</div>
					</div><!--end of row-->
				</div>
			</section>

		</div>

		<section class="map">
			<div class="map-holder">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5865.5206541244315!2d23.337462!3d42.687619!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40aa859f636d00db%3A0xea1869eb8c58894a!2sVasil+Levski+Monument%2C+1164+Borisova+Gradina%2C+Sofia%2C+Bulgaria!5e0!3m2!1sen!2sin!4v1510425529638"></iframe>
			</div>
		</section>

		<section class="contact-center">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
							<h1>Get in Touch</h1>
							<p class="lead">
								Do you have a question for us? we'd love to here from you and we would be happy to answer your questions. Reach out to us and we'll respond as soon as we can.
							</p>
						</div>
					</div><!--end of row-->
					
					<div class="row">
						<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
							<div class="form-wrapper clearfix">
								<form class="form-contact email-form" method="post">
									<div class="inputs-wrapper">
                                        <input type="hidden" name="actionc" value="sendEmail">
										<input class="form-name validate-required" type="text"  placeholder="Your Name" name="namec">
										<input class="form-email validate-required validate-email" type="text" name="emailc" placeholder="Your Email Address">
										<textarea class="form-message validate-required" name="messagec" placeholder="Your Message"></textarea>
									</div>
									<input type="submit" class="btn-white" value="Send Form">
									<div class="form-success">
										<span class="text-white">Message sent - Thanks for your enquiry</span>
									</div>
									<div class="form-error">
										<span class="text-white">Please complete all fields correctly</span>
									</div>
								</form>
							</div>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>

			<div id="catapult-cookie-bar" style="display: none;">
				<div class="ctcc-inner ">
					<span class="ctcc-left-side">This site uses cookies: 
						<a class="ctcc-more-info-link" tabindex="0" target="_blank" href="cookie.php">Find out more.</a>
					</span>
					<span class="ctcc-right-side">
						<button id="catapultCookie">Okay, thanks</button>
					</span>
				</div>
			</div>
			
			<div class="footer-container">			
				<footer class="details">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<img alt="logo" class="logo" src="img/logo-light.png">
							<p>
								<img src="img/footer-company.png" alt="">
							</p>
						</div>
						
						<div class="col-sm-3">
							<h1 class="footer-h1-padding">Fees</h1>
							<p>
								<ul>
									<li><a href="fee.php">Virtual card fees and limits</a></li>
									<li><a href="fee.php">Plastic card fees and limits</a></li>
								</ul>
							</p>
						</div>

						<div class="col-sm-3">
							<h1 class="footer-h1-padding">Info</h1>
							<ul>
								<li><a href="support.php">Support</a></li>
								<li><a href="contact-us.php">Contact us</a></li>
								<li><a href="">Affiliate program</a></li>
							</ul>
						</div>
						
						<div class="col-sm-3">
							<h1 class="footer-h1-padding">Legal</h1>
							<ul>
								<li><a href="terms.php">Terms & conditions</a></li>
								<li><a href="a_k.php">AML & KYC policy</a></li>
								<li><a href="privacy_policy.php">Privacy policy</a></li>
								<li><a href="cardholder_agreement.php">Cardholder agreement</a></li>
								<li><a href="cookie.php">Cookie policy</a></li>
                                <li><a href="https://mychoicecorporate.com/privacy-policy/ ">MyChoice Privacy Policy</a></li>
							
							</ul>

						</div>
						<p class="text-center">“Visa<span style="font-size:11px">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood © 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.”</p>
					</div><!--end of row-->
					<style>
                        .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
                            background-color: #fff !important;
                            border-color: #fff !important;
                            color:black !important;
                        }
                        .btn-primary:focus, .btn-primary.focus {
                            background-color: #fff !important;
                            border-color: #fff !important;
                            color:black !important;
                        }
                    </style>
					<div class="row">
						<div class="col-sm-12">
							<span class="sub">© Copyright 2017 <a href="https://FILLIT.eu">FILLIT.eu</a> - All Rights Reserved</span>
						</div>
					</div>
					
				</div><!--end of container-->
				</footer>
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
        <script src="js/scripts.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script>
            close = document.getElementById("close");
            close.addEventListener('click', function() {
                note = document.getElementById("note");
                note.style.display = 'none';
            }, false);
        </script>
    </body>

</html>
				