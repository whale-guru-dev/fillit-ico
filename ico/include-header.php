<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?php echo $title; ?></title>


	        <meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta content="width=device-width, initial-scale=1" name="viewport" />
			<meta name="author" content="Abir Khan - abirkhan75@gmail.com" />
			<meta name="description" content="<?php echo $metatag; ?>">
			<meta name="keywords" content="<?php echo $keytag; ?>">
			<meta property="og:title" content="<?php echo $title; ?>"/>
			<meta property="og:site_name" content="<?php echo $basetitle; ?>"/>
			<meta property="og:description" content="<?php echo $metatag; ?>"/>
			<meta property="og:image" content="<?php echo $ogimg; ?>"/>

       
<link href="<?php echo $fronturl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $fronturl; ?>/assets/css/animate.min.css" rel="stylesheet"> 
<link href="<?php echo $fronturl; ?>/assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $fronturl; ?>/assets/css/main.css" rel="stylesheet">
<link href="<?php echo $fronturl; ?>/assets/css/color.php?color=<?php echo $basecolor; ?>" rel="stylesheet">
<link href="<?php echo $fronturl; ?>/assets/css/responsive.css" rel="stylesheet">
<link href="<?php echo $fronturl; ?>/assets/css/fakeLoader.css" rel="stylesheet" type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo $fronturl; ?>/assets/images/favicon.png">

</head><!--/head-->

<body>
<div id="fakeLoader"></div>

<header id="home">
<div class="main-nav">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="https://www.fillit.eu/ico/">
<h1><img class="img-responsive white" src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="logo"></h1>
</a>                    
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">                 
<li><a href="<?php echo $fronturl; ?>">Home</a></li>

<?php 
$ddaa = $db->query("SELECT id, name FROM menus ORDER BY id");
while ($data = $ddaa->fetch()){
$uri = urlmod($data[1]);
?>
  <li>
      <a href="<?php echo "$fronturl/menu/$data[0]/$uri"; ?>" class="dropdown-toggle">
          <?php echo $data[1];  ?>
      </a>
  </li>

<?php 
}
?>


<li class="" style="padding-left: 40px;"> &nbsp; </li>
<li><a href="<?php echo $baseurl; ?>"> <i class="fa fa-sign-in"> </i> SIGN IN </a></li>     
<li><a href="<?php echo $baseurl; ?>/Register">  <i class="fa fa-edit"> </i>  Sign Up </a></li>     
</ul>
</div>
</div>
</div><!--/#main-nav-->
