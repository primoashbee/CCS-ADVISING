<?php 
session_start();

$host = "localhost";
$user = "gcccsorg_ashbee";
$pass = "iLocked1234";
$db = "gcccsorg_ccsadvise";
$conn = mysqli_connect($host,$user,$pass,$db);
$conn->set_charset("utf8");

?>