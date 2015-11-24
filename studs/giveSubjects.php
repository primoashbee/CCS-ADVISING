<?php 
require "config.php";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$id=$_POST['id'];
$year=$_POST['year'];
$sem=$_POST['sem']; 
$course = $_POST['course'];
$curr = $_POST['curr'];
$sql ="Select distinct(SUBJECT_CODE), TITLE from qry where student_ID='".$id."'  and year='".$year."' and semester ='".$sem."' and course ='".$course."' and curriculum='".$curr."'";
$res = mysqli_query($conn,$sql);

$sql="Select * from qrygradeslist where student_ID='".$id."' and year='".$year."' and semester ='".$sem."'";
$res = mysqli_query($conn,$sql);
$info =array();
$ctr=0;
$sub_count=0;	
while($data=mysqli_fetch_array($res)){
$grade;
//if grade is null
/*if($data[6]>74){
$remarks="PASSED";

//if grade is <74 and subject_code  is null
}else if($data[6]<75 || $data[6]=='F' || $data[6]=="FDA"){
$remarks="FAILED";	
}else{
$remarks="NOT TAKEN";	
$ctr++;	
$sub_count++;
}*/
$remarks ="FAILED";
if($data[6]>74){
$remarks="PASSED";
$ctr++;
$sub_count++;
}elseif($data[6]==NULL){
$remarks="NOT TAKEN";
$sub_count++;
}

$info[]=array('SCODE'=>$data[3],'STITLE'=>$data[4],'SGRADE'=>$data[6],'REMARKS'=>$remarks);		
}
$taken=array();
$taken_x=mysqli_num_rows($res);
while($data=mysqli_fetch_array($res)){
$taken[]=array('SUBJECT_CODE'=>$data[0],'TITLE'=>$data[1]);	
}

//get subjects in that year and sem
$sql ="Select * from prospectus where  year='".$year."' and semester ='".$sem."' and course ='".$course."' and curriculum='".$curr."'";
$subjects =array();
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$subjects[]=array('CODE'=>$data[3],'TITLE'=>$data[4]);	
}
$subject_x=mysqli_num_rows($res);
//index 0 to N ng subjects
$percent = ($taken_x)/($subject_x)*100;
if($ctr==0){
$percent=0;	
}else{
	
$percent =($ctr/$sub_count)*100;
	
}
$json[]= array('INFO'=>$info,'PERCENTAGE'=>$percent,'NOT'=>$taken,'TAKEN'=>(array_values(array_diff_key($subjects,$taken))));

echo json_encode($json);
?>