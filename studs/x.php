<?php 
require "config.php";
$sql = "SELECT * FROM qrymyprospectusreal where student_id='201110590'";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$remarks='FAILED';
if(is_null($data[7])){
$remarks='NOT TAKEN';
}

$prospectus[] = array('YEAR'=>$data[1],'SEMESTER'=>$data[2],'CODE'=>$data[3],'TITLE'=>$data[4],'LEC'=>$data[5],'LAB'=>$data[6],'GRADE'=>$data[7],'REMARKS'=>$remarks);		
}
echo json_encode($prospectus[3]);
?>