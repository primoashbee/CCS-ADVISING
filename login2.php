<?php 
require "config.php";
header("Access-Control-Allow-Origin:*");
header('Content-type: application/json');
$username = $_POST['username'];
$pass = $_POST['password'];
$sql = "Select * from accounts where username='".$username."' and password = '".$pass."'";
//$mysqli->set_charset("utf8");

$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res)){

	$sql = "Select * from accounts where username='".$username."' and password = '".$pass."'";
	$res = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($res);
	
	
//check account type	
if($data[3]=="student"){


//get info
$sql = "Select * from  students where student_id ='".$username."'";
$data = mysqli_fetch_array(mysqli_query($conn,$sql));
$info =array('STUDENT_ID'=>$username,'LNAME'=>$data[2],'FNAME'=>$data[3],'MNAME'=>$data[4],'COURSE'=>$data[5],'YEARLEVEL'=>$data[6],'CURRICULUM'=>$data[7]);
//print_r($info);
//get year_level
//$info =array_map('htmlentities',$info );
$rawyear = explode(" ",$data[6]);
$year_level=$rawyear[0];
$enlistCur=$data[7];
//get grades
$sql = "Select * from  qrygrades where student_id ='".$username."'";
$res = mysqli_query($conn,$sql);
while($data = mysqli_fetch_array($res)){
$grades[]= array('CODE'=>$data[1],'TITLE'=>$data[2],'LAB'=>$data[3],'LEC'=>$data[4],'PRE'=>$data[5],'YEAR'=>$data[6],'SEM'=>$data[7],'GRADE'=>$data[8]);
}

//get prospectus of program
$sql = "SELECT * FROM qrymyprospectusreal where student_id='".$username."'";
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$remarks='FAILED';
if($data[7]==null){
$remarks='NOT TAKEN';
}

else if($data[7]>74){
$remarks="PASSED";	
}
$prospectus[] = array('YEAR'=>$data[1],'SEMESTER'=>$data[2],'CODE'=>$data[3],'TITLE'=>$data[4],'LEC'=>$data[5],'LAB'=>$data[6],'GRADE'=>$data[7],'REMARKS'=>$remarks);		
}


//get enlistment semester example yung 1st sem or 2nd sem or summer
$sql = "Select * from  sem";
$res = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($res);
$semester = explode(" ",$data[1]);

//get enlistment subjects
$sql="Select * from prospectus where YEAR ='".$year_level."' and SEMESTER ='".$semester[0]."' and course = '".$info['COURSE']."' and curriculum='".$enlistCur."'";

$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){

$enlistment_subs[]=array('CODE'=>$data[3],'TITLE'=>$data[4]);	

}

$total_info =array('INFO'=>$info,'GRADES'=>$grades,'ENLISTMENT'=>$enlistment_subs,'TYPE'=>'student','PROSPECTUS'=>$prospectus,'SEM'=>$semester);

echo json_encode($total_info );
}else{

$admin = array('NAME'=>$username,'TYPE'=>'ADMIN');	
echo json_encode($admin);
}


//end of check account 
}else {
$err =array('ERR'=>'WALA');
	echo json_encode($err);
}



?>