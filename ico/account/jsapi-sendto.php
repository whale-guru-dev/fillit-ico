<?php
require_once('../function.php');
session_start();

if(isset($_POST["sendto"])){
$email = $_POST["sendto"];

if ($email!="") {

$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$email."'")->fetch();

if($count[0]!=1){
echo "<b style='color:red;'>NO USER FOUND WITH ABOVE EMAIL</b>";
}else{
$data = $db->query("SELECT firstname, lastname FROM users WHERE email='".$email."'")->fetch();
echo "<b>You Are Sending Money To <span style='color:green;'> $data[0] $data[1] </span></b>";
}


}

} 
?>


