<?php
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$sql = "Select * from accounts";
$res = mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($res)){
$accounts[] = array('USERNAME'=>$data[1],'PASSWORD'=>$data[2]);	
}
echo json_encode($accounts);
?>