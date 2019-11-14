<?php
Include('include-global.php');
Include('include-header.php');
?>



<?php
if($_POST["amount"] && $_POST["payto"] && $_POST["paytoname"] && $_POST["itemname"] && $_POST["responseurl"] && $_POST["successurl"] && $_POST["cancelurl"] && $_POST["custom"]){

$amount = $_POST["amount"];
$payto = $_POST["payto"];
$paytoname = $_POST["paytoname"];
$itemname = $_POST["itemname"];
$responseurl = $_POST["responseurl"];
$successurl = $_POST["successurl"];
$cancelurl = $_POST["cancelurl"];
$custom = $_POST["custom"];


$_SESSION['xamount'] = $amount;
$_SESSION['xpayto'] = $payto;
$_SESSION['xpaytoname'] = $paytoname;
$_SESSION['xitemname'] = $itemname;
$_SESSION['xresponseurl'] = $responseurl;
$_SESSION['xsuccessurl'] = $successurl;
$_SESSION['xcancelurl'] = $cancelurl;
$_SESSION['xcustom'] = $custom;



$urrl= "$apiurl/signin";
redirect($urrl);
}else{
echo '<br><br><br><h1 class="text-center bold" style="color: red;">AN UNESPECTED ERROR OCCURED. <br> PLEASE CHECK BACK WITH API OWNER.</h1><br><br><br>';
}
?>

<?php
Include('include-footer.php');
?>
</body>
</html>