<?php 
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');

$sql="Select distinct(NAME) from prospectus";
$res= mysqli_query($conn,$sql);
$name=array();

while($data=mysqli_fetch_array($res)){
$name[]=array('NAME'=>$data['NAME']);
	
}
$json = array('LISTS'=>$name);
echo json_encode($json);

?>