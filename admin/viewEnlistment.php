<?php
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
//curriculum enlistmend count
$sql="Select distinct(name),count(distinct(student_id)) as enlisted from qryEnlistment  group by name";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$currs[] =array('CURR'=>$data[0],'COUNT'=>$data[1]);
}

//students enlisted with count
$sql = "Select distinct(STUDENT_ID), LAST_NAME,FIRST_NAME,MIDDLE_NAME,COUNT(STUDENT_ID) AS ENLISTED_COUNT, COURSE FROM qryEnlistment group by student_id";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$studs[]=array(
'ID'=>$data[0],
'LNAME'=>$data[1],
'FNAME'=>$data[2],
'MNAME'=>$data[3],
'ENLISTED'=>$data[4],'COURSE'=>$data[5]);
}

//subjects with enlisted
$sql ="Select subject_code,subject_title, count(subject_code) as enlisted from qryEnlistment group by subject_code ";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$subs[] =array('CODE'=>$data[0],'TITLE'=>$data[1],'ENLISTED'=>$data[2]);
}

$json = array('LISTS'=>array('currs'=>$currs,'students'=>$studs,'subs'=>$subs));

echo json_encode($json);
?>