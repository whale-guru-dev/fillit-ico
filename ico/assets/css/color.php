<?php
header ("Content-Type:text/css");
$color = "#ff0000"; // Change your Color Here

function checkhexcolor($color) {
	return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
	$color = "#" . $_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
	$color = "#ff0000";
}

?>



a,
#home-slider .caption h1 span, 
#twitter-carousel .item span, 
#footer .footer-bottom, 
#single-portfolio .close-folio-item:hover, 
.single-table.featured .btn.btn-primary, 
.contact-info ul li a:hover, 
#footer .footer-bottom a  {
  color: <?php echo $color; ?>;
}

.btn.btn-primary:hover,
.btn-submit:hover {
  background-color: #027db3
}

a:hover, a:focus {
	color: #027db3;
}







.caption .btn-start {
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  padding:14px 40px;
  border: 1px solid <?php echo $color; ?>;
  border-radius: 4px;
  margin-top: 40px;
}

.caption .btn-start:hover {
  color: #fff
}



.caption .btn-reg {
background: <?php echo $color; ?>;
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  padding:14px 40px;
  border: 1px solid <?php echo $color; ?>;
  border-radius: 4px;
  margin-top: 40px;
}

.caption .btn-reg:hover {
  background-color: transparent;
}







.main-nav, 
.service-icon, 
.progress-bar.progress-bar-primary, 
.single-table.featured, 
.btn.btn-primary, 
.twitter-icon .fa-twitter, 
.twitter-left-control:hover, .twitter-right-control:hover, 
.post-icon, 
.entry-header .date:after, 
.btn-loadmore:hover, 
.btn-submit,
#footer, 
.caption .btn-start:hover, 
.left-control:hover, 
.right-control:hover, 
.folio-overview a:hover {
  background-color:<?php echo $color; ?>;
}

.twitter-left-control:hover, 
.twitter-right-control:hover, 
.btn-loadmore:hover  {
	border: 1px solid <?php echo $color; ?>;
}

.caption .btn-start:hover, 
.left-control:hover, 
.right-control:hover {
	border-color: <?php echo $color; ?>;
}

.twitter-icon .fa-twitter:after {
	border-color: <?php echo $color; ?> transparent transparent;
}




.bottom-line {
    display: inline-block;
    margin-bottom: 30px;
    width: auto;
    position: relative;

}


.bottom-line::before {
  margin-top: 40px;
    border: 2px solid #424951;
    content: "";
    left: 0%;
    position: absolute;
    width: 100%;
}


.bottom-line::after {
  margin-top: 40px;
    border: 3px solid <?php echo $color; ?>;
    content: "";
    left: 35%;
    position: absolute;
    top: -1px;
    width: 30%;
}

.features {
  text-align: center;
}

.features i {
  font-size: 48px;
  color: <?php echo $color; ?>;
}

.features h3 {
  margin-top: 15px;
  font-size: 30px;
  margin-bottom: 7px;
  color: <?php echo $color; ?>;
}

.features p {
  margin-top: 15px;
  color: #000;
  text-transform: uppercase;
  font-weight: bold;
}
