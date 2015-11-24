<?php 
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$sql="Select * from students";
$res= mysqli_query($conn,$sql);
$name=array();

while($data=mysqli_fetch_array($res)){
$name[]=array(
'ID'=>$data[1],
'LNAME'=>$data[2],
'FNAME'=>$data[3],
'MNAME'=>$data[4],
'COURSE'=>$data[5],
'YEAR'=>$data[6]);
}

$json[] = array('LISTS'=>$name);
echo json_encode($json[0]);

?>