<?php 
require "config.php";
header("Access-Control-Allow-Origin:*");
header('Content-Type: application/json');
$username = '201510539';
$pass = 'default123';
$sql = "Select * from accounts where username='".$username."' and password = '".$pass."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))){

	$sql = "Select * from accounts where username='".$username."' and password = '".$pass."'";
	$res = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($res);
	
//check account type	
if($data[3]=="student"){

//get info
$sql = "Select * from  students where student_id ='".$username."'";
$data = mysqli_fetch_array(mysqli_query($conn,$sql));
$info =array('STUDENT_ID'=>$username,'LNAME'=>$data[2],'FNAME'=>$data[3],'MNAME'=>$data[4],'COURSE'=>$data[5],'YEARLEVEL'=>$data[6],'CURRICULUM'=>$data[7]);
//get year_level
$rawyear = explode(" ",$data[6]);
$year_level=$rawyear[0];

//get grades
$sql = "Select * from  qrygrades where student_id ='".$username."'";
$res = mysqli_query($conn,$sql);
while($data = mysqli_fetch_array($res)){
$grades[]= array('CODE'=>$data[1],'TITLE'=>$data[2],'LAB'=>$data[3],'LEC'=>$data[4],'PRE'=>$data[5],'YEAR'=>$data[6],'SEM'=>$data[7],'GRADE'=>$data[8]);
}
//get prospectus of program
$sql = "Select * from  prospectus where COURSE='".$info['COURSE']."' and CURRICULUM='".$info['CURRICULUM']."'";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$prospectus[] = array('CODE'=>$data[3],'TITLE'=>$data[4],'LEC'=>$data[5],'LAB'=>$data[6],'PRE'=>$data[7],'YEAR'=>$data[8],'SEMESTER'=>$data[9],'NAME'=>$data[10]);		
}


//get enlistment semester example yung 1st sem or 2nd sem or summer
$sql = "Select * from  sem";
$res = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($res);
$semester = explode(" ",$data[1]);

//get enlistment subjects
$sql="Select * from prospectus where YEAR ='".$year_level."' and SEMESTER ='".$semester[0]."' and course = '".$info['COURSE']."'";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){

$enlistment_subs[]=array('CODE'=>$data[3],'TITLE'=>$data[4]);	

}

$total_info =array('INFO'=>$info,'GRADES'=>$grades,'ENLISTMENT'=>$enlistment_subs,'TYPE'=>'student','PROSPECTUS'=>$prospectus,'SEM'=>$semester);
echo json_encode($total_info);
}else{

$admin = array('NAME'=>$username,'TYPE'=>'ADMIN');	
echo json_encode($admin);
}


//end of check account 
}else {
	echo "wala";
}



?>