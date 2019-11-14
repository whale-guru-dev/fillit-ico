<?php
require_once('include-global.php');
$txt = "Your Deposit of 3213123 FILLIT via BACILA Has Been Processed. Transcaction # 1";
abiremail('andreibacila35@yahoo.com', "Deposited Successfully", 'bacila', $txt);