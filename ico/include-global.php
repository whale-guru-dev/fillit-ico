<?php
require_once('function.php');
session_start();
$gen = $db->query("SELECT sitetitle, currency, cur, colorcode FROM general_setting WHERE  id='1'")->fetch();
$basetitle = $gen[0];
$basecurrency = $gen[1];
$basecur = $gen[2];
$basecolor = $gen[3];
$baseDecimal = 2;

$metatag = "$basetitle";
$keytag = "$basetitle";
$ogimg = "";
?>
