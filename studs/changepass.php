<?php 
require "config.php";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application\json');

$id = $_POST['id'];
$newpass=$_POST['pass'];
$sql="Update accounts set password='".$newpass."' where username='".$id."'";
$res = mysqli_query($conn,$sql);
if($res){
$x = array('MSG'=>'PASSWORD CHANGED');	
}
echo json_encode($x);
?>