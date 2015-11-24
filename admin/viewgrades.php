<?php
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$sql = "Select * from qrymyprospectusreal where grade is not null";
$res = mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($res)){
$grades[] = array('STUDID'=>$data[0],'CODE'=>$data[3],'TITLE'=>$data[4],'GRADE'=>$data[7]);	
}
echo json_encode($grades);
?>