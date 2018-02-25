<?php
$db=mysqli_connect("localhost","root","","famab");
if (mysqli_connect_errno()) {
	echo "Database connection failed with the following errors".mysqli_connect_errno();
	die();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/config.php';
require_once BASEURL."helpers/helpers.php";
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\k2');
