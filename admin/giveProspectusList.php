<?php 
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$name = $_POST['name'];
$sql ="Select * from prospectus where name ='".$name."'";
$res = mysqli_query($conn,$sql);
$lists = array();
while($data=mysqli_fetch_array($res)){
$lists[] =array('CODE'=>$data[3],'TITLE'=>$data[4],'LEC'=>$data[5],'LAB'=>$data[6],'PRE'=>$data[7],'YEAR'=>$data[8],'SEM'=>$data[9]);	
}
echo json_encode($lists);
?>
