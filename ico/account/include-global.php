<?php
require_once('../function.php');
session_start();
$gen = $db->query("SELECT sitetitle, currency, cur, colorcode, deci FROM general_setting WHERE  id='1'")->fetch();
$basetitle = $gen[0];
$basecurrency = $gen[1];
$basecur = $gen[2];
$basecolor = $gen[3];
$baseDecimal = $gen[4];

$metatag = "$basetitle";
$keytag = "$basetitle";
$ogimg = "";

//////////////////GENERATE TRX #
$a1 = date("ymd", time());
$a2 = rand(100,999);
$u = substr(uniqid(), 7);
$c = chr(rand(97,122));
$c2 = chr(rand(97,122));
$c3 = chr(rand(97,122));
$ok = "$c$u$c2$a2$c3";
$txn_id = strtoupper($ok);
//////////////////GENERATE TRX #
?>
