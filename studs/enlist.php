<?php 
require "config.php";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application\json');

$subjects = $_POST['subjects'];
$sched = $_POST['sched'];
$id = $_POST['id'];
$values="";
$enlist_count=count($subjects);

for($i=0;$i<=count($subjects)-1;$i++){
$sql="Select * from enlistment where SUBJECT_CODE='".$subjects[$i]."' and student_ID='".$id."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))){
}else{	
$values=$values."('".$subjects[$i]."','".$id."','".$sched."'),";	
;	
}
}

if($enlist_count>0){
//delete prev enlistment
$sql="Delete from enlistment where STUDENT_ID='".$id."'";
mysqli_query($conn,$sql);
//insert enlistment
$sql ="Insert into enlistment(SUBJECT_CODE,STUDENT_ID,PREF_DATE)values".rtrim($values, ",");
mysqli_query($conn,$sql);
$x = array('MSG'=>'Enlisting Updated!  God bless');
} else {
$sql ="Insert into enlistment(SUBJECT_CODE,STUDENT_ID,PREF_DATE)values".rtrim($values, ",");
mysqli_query($conn,$sql);
$x = array('MSG'=>'Thank you! Enlisting Updated! God bless');
}
echo json_encode($x);
?>