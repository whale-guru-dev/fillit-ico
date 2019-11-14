<?php
require_once('../function.php');
session_start();

if (!is_admin()) {
redirect("$adminurl");
}

$user = $_SESSION['ausername'];
$sid = $_SESSION['asid'];
$usid = $db->query("SELECT id, sid, pwr FROM admin WHERE username='".$user."'")->fetch();
$uid = $usid[0];
$mypower = $usid[2];


if($sid!=$usid[1]){
 redirect('signout.php');
}

if ($mypower<100) {
redirect("$adminurl/Dashboard");
}


	
	if ($_REQUEST['delete']) {
		
		$iidd = $_REQUEST['delete'];
		$frm = $_REQUEST['frm'];


       $stmt = $db->query("DELETE FROM $frm WHERE id ='".$iidd."'");
		if ($stmt) {
			echo "Deleted Successfully";
		}
		
	}

	?>

