<?php
require_once('../function.php');
session_start();



if(isset($_POST["username"]) or isset($_POST["password"])){

sleep(1);


$username = $_POST["username"];
$password = $_POST["password"];
$mdpass = md5($password);

$data = $db->query("SELECT password FROM admin WHERE username='".$username."'")->fetch();

if ($data[0] == $mdpass) {

//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth
$tm = time();
$si = "$username$tm";
$sid = md5($si);
$_SESSION['asid'] = $sid;
$_SESSION['ausername'] = $username;
$db->query("UPDATE admin SET sid='".$sid."' WHERE username='".$username."'");
//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth

echo "ok"; // log in

}else{
echo "Combination of Username And Password is Wrong";
}

exit();
}
?>