<?php
require_once('../function.php');
session_start();

if(session_destroy())
	redirect('index.php');
	exit;
?>