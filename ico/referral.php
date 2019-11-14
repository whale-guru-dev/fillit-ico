<?php
Include('include-global.php');
$cod_referat = $_GET['code'];

$count = $db->query("SELECT ref_id FROM users WHERE ref_id='".$cod_referat."' ")->fetch();
//error case

if (!empty($count) ) {

    $_SESSION['referred']=$count[0];
    // var_dump($_SESSION);exit;
    header('Location: https://www.fillit.eu/ico/');
//    header('Location: http://fillitcrowd.com');
}
