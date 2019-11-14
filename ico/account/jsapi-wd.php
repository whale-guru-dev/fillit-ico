<?php
require_once('include-global.php');

if(isset($_POST["id"])){
$id = $_POST["id"];
$am = $_POST["am"];

if ($id!="" && $am>0) {

$data = $db->query("SELECT name, minamo, maxamo, charged, chargep, processtm FROM wd_method WHERE id='".$id."'")->fetch();

$per = $am*$data[4]/100;
$charge = round($per+$data[3],$baseDecimal);



echo "<b>$data[1] - $data[2] $basecurrency</b> | <b style='color: green'> Processed Within $data[5] Days</b> | <b style='color: red'> Charge $charge $basecurrency </b>";


}
} 
?>


