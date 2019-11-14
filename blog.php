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
$modal = true;
$error[] = 'Account created succesfully. <br> Please log in.';
}
}

$offset = 0;
$page_result = 6;
if(isset($_GET['pageno'])){
if($_GET['pageno'])
{
$page_value = $_GET['pageno'];
if($page_value > 1)
{
$offset = ($page_value - 1) * $page_result;
}
}}

$stmt = $db->prepare('SELECT postID FROM blog_posts');
$stmt->execute();
$rowc = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare('SELECT postID,postTitle,postDesc,postDate,postImg FROM blog_posts LIMIT :offset, :page');
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':page',$page_result, PDO::PARAM_INT);
$stmt->execute();
$rowabs = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    
<head>
        <meta charset="utf-8">
        <title>FILLIT | Blog</title>
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
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
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
			<header class="page-header">
				<div class="background-image-holder parallax-background">
					<img class="background-image" alt="Background Image" src="img/hero23.jpg">
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<span class="text-white alt-font">news &amp; Views&nbsp;</span>
							<h1 class="text-white">FILLIT Blog</h1>
							
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</header>
			
			<section class="blog-masonry bg-muted">
			
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">

						</div>
					</div><!--end of row-->
				</div><!--end of container-->




<style>
   .ion-ios-arrow-left::before{
    font-family: ElegantIcons;
    speak: none;
    font-style: normal;
    font-weight: 400;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    content: "\<";
    color:#FE9700;
    }
   .ion-ios-arrow-right::before{
       font-family: ElegantIcons;
       speak: none;
       font-style: normal;
       font-weight: 400;
       font-variant: normal;
       text-transform: none;
       line-height: 1;
       -webkit-font-smoothing: antialiased;
       content: "\=";
       color: #FE9700;
   }

</style>

                    <?php

                    if(!array_key_exists('viewpost',$_GET)){

                    ?>
                    <div class="row iq-mt-80">
					<div class="col-lg-12 col-md-12 text-center">
						<ul class="pagination pagination-lg">
							<?php
$pagecount = count($rowc); // Total number of rows
$num = ceil($pagecount / $page_result);


/*
if($_GET['pageno'] > 1)
							{
							echo "<a href = 'samepage.php?pageno = ".($_GET['pageno'] - 1)." '> Prev </a>";
							}
							for($i = 1 ; $i <= $num ; $i++)
							{
							echo "<a href = \"samepage.php?pageno = ". $i ." >". $i ."</a>";
							}
							if($num != 1)
							{
							echo "<a href = 'samepage.php?pageno = ".($_GET['pageno'] + 1)." '> Next </a>";
							}
							*/
                            if(array_key_exists('pageno',$_GET)) {

                                if ($_GET['pageno'] > 1) {
                                    ?>
                                    <li><a href="blog.php?pageno=<?php echo($_GET['pageno'] - 1) ?> "> <i
                                                    class="ion-ios-arrow-left"></i> </a></li>                        <?php
                                } else {
                                    ?>
                                    <li class="disabled"><a href="#"> <i
                                                    class="ion-ios-arrow-left"></i> </a></li>
                                    <?php
                                }

                                for ($i = 1; $i <= $num; $i++) {
                                    ?>
                                    <li <?php if (array_key_exists('pageno', $_GET) AND $_GET['pageno'] == $i) {echo 'class="active"';} ?>><a  href="blog.php?pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($num == $_GET['pageno']) {
                                    ?>
                                    <li class="disabled"><a href="#"> <i class="ion-ios-arrow-right"></i> </a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li ><a href="blog.php?pageno=<?php echo($_GET['pageno'] + 1) ?>"> <i
                                                    class="ion-ios-arrow-right"></i> </a></li>
                                    <?php
                                }
                            }else{
                                ?>
                                <li class="disabled"><a href="#"> <i class="ion-ios-arrow-left"></i> </a></li>
                                <?php
                                for ($i = 1; $i <= $num; $i++) {
                                    ?>
                                    <li <?php if (array_key_exists('pageno', $_GET) AND $_GET['pageno'] == $i) {echo 'class="active"';} ?>><a  href="blog.php?pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }
                                ?>
                                <li ><a href="blog.php?pageno=2"> <i class="ion-ios-arrow-right"></i> </a></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
        </div>
     



				<div class="container">
					<div class="row">
						<div class="blog-masonry-container">

                                    <?php


                                    foreach (array_chunk($rowabs, 2, true) as $array) {
                                        //echo '<div class="row">';
                                        foreach($array as $kicks) {

                                            ?>

                                            <div class="col-md-4 col-sm-6 blog-masonry-item branding">
                                                <div class="item-inner">
                                                    <a href="blog.php?viewpost=<?php echo $kicks['postID']; ?>">
                                                        <img class="img-responsive center-block" src="<?php echo $kicks['postImg']; ?>" alt="#">
                                                    </a>
                                                    <div class="post-title">
                                                        <h2><?php echo $kicks['postTitle']; ?></h2>
                                                        <p><?php echo $kicks['postDesc'];?></p>
                                                        <div class="post-meta">
                                                            <span class="sub alt-font">Posted on </span>
                                                            <span class="sub alt-font"><?php echo $kicks['postDate']; ?></span>
                                                        </div>
                                                        <a href="blog.php?viewpost=<?php echo $kicks['postID']; ?>" class="link-text">Read More</a>
                                                    </div>
                                                </div>
                                            </div><!--end of individual post-->


                                            <?php

                                        }
                                       // echo '</div>';
                                    }



                                    ?>
                                    <?php /*

							
							<div class="col-md-4 col-sm-6 blog-masonry-item print">
								<div class="item-inner">
									<iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/154584032&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
									<div class="post-title">
										<h2>Henry Saiz - Anubis</h2>
										<div class="post-meta">
											<span class="sub alt-font">Posted on June 11th</span>
											<span class="sub alt-font">4 Minute Read</span>
										</div>
										<a href="blog-single.html" class="link-text">Read More</a>
									</div>
								</div>
							</div><!--end of individual post-->
							
							<div class="col-md-4 col-sm-6 blog-masonry-item print">
								<div class="item-inner video-post">
									<iframe src="http://player.vimeo.com/video/106181453"></iframe>
									<div class="post-title">
										<h2>Vimeo Video Post</h2>
										<div class="post-meta">
											<span class="sub alt-font">Posted on June 3rd</span>
											<span class="sub alt-font">2 Minute Read</span>
										</div>
										<a href="blog-single.html" class="link-text">Read More</a>
									</div>
								</div>
							</div><!--end of individual post-->
							
							<div class="col-md-4 col-sm-6 blog-masonry-item development">
								<div class="item-inner video-post">
									<iframe src="http://www.youtube.com/embed/VdEVhE4X6x0"></iframe>
									<div class="post-title">
										<h2>Youtube Video Post</h2>
										<div class="post-meta">
											<span class="sub alt-font">Posted on June 3rd</span>
											<span class="sub alt-font">2 Minute Read</span>
										</div>
										<a href="blog-single.html" class="link-text">Read More</a>
									</div>
								</div>
							</div><!--end of individual post-->
*/ ?>

						</div><!--end of blog masonry container-->
                    </div><!--end of row-->
                </div><!--end of container-->
        </section>
                    <?php } ?>

        <?php
        if(array_key_exists('viewpost',$_GET)){


$stmt = $db->prepare('SELECT postImg,postCont,postDate,postTitle FROM blog_posts WHERE postID=:idd');
$stmt->execute(array(
        ':idd' => $_GET['viewpost']
    )
);
$rowca = $stmt->fetch(PDO::FETCH_ASSOC);

?>
        <div class="container">


                <?php

            echo '<h1>'.$rowca['postTitle'].'</h1>';
            echo '   <img class="img-responsive center-block" src="'.$rowca["postImg"].'" alt="#">';
            ?>

            <p><?php echo $rowca['postCont']; ?></p>

                </div>

                    <?php
        }

        ?>
    </div>
			<section class="cta bg-pre text-white">
				<div class="container">
					<div class="row clearfix">
						<form class="mail-list-signup">
							<div class="col-md-6 col-sm-9 col-xs-12 pull-left clear-fix">
								<h3 class="text-white pull-left"><strong>Fill your pocket with FILLIT&nbsp;</strong></h3>
							</div>
							
							<div class="col-md-4 col-sm-3 col-xs-12 text-right pull-right">
								<a href="signup.php" class="btn btn-cta btn-xl btn-rounded">Get Started</a>
							</div>
						</form>
					</div>
					
				</div>
			</section>

			
		</div>
		
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
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/scripts.js"></script>
       
    </body>

</html>
				