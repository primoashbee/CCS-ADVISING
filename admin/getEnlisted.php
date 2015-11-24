<?php
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$id = $_POST["id"];
$sql ="Select subject_code,subject_title from qryEnlistment where student_ID='".$id."'";
$res = mysqli_query($conn,$sql);
$s1;
while($data=mysqli_fetch_array($res)){
$subs[]=array('CODE'=>$data[0],'TITLE'=>$data[1]);
}

$sql ="Select * from students where student_id='".$id."'";
$res = mysqli_query($conn,$sql);
$data=mysqli_fetch_array($res);

$course = $data['COURSE'];
$program = $data['CURRICULUM'];
$yearx = explode(" ",$data['YEAR_LEVEL']);
$year= $yearx[0];
$sql="Select * from prospectus where course='".$course."' and curriculum ='".$program."' and year='".$year."' and semester='2nd'";

$res =mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$set[] = array('ID'=>$data['ID'],'CODE'=>$data['SUBJECT_CODE'],'TITLE'=>$data['SUBJECT_TITLE']);
}
$left = array_diff_key($set,$subs);
$json = array('LISTS'=>$subs,'DIFF'=>$left,'SET'=>$set);
echo json_encode($json);
?>
