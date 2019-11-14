<?php
$fronturl = "http://abir.khan/ewallet"; //////Main Page URL
$baseurl = "http://abir.khan/ewallet/account"; ////// Member Panel URL
$adminurl = "http://abir.khan/ewallet/admin"; ////// Admin Panel URL
$apiurl = "http://abir.khan/ewallet/paynow"; ////// API URL
$verifyurl = "http://abir.khan/ewallet/verify"; ////// Verify URL

$PurchaseCode = "";

date_default_timezone_set('Asia/Dhaka');
$tm = time();


error_reporting(E_ALL);
    
$dbname = "ewallet";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

?>