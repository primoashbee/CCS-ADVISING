<?php 

require "config.php";
header('application\json');
$x="x";	
ini_set('MAX_EXECUTION_TIME', -1);
if(isset($_POST["submit"])){
$x="submitted but no files";
	if(isset($_FILES["file"])){
		$filename=$_FILES["file"]["tmp_name"];
		$file=fopen($filename,"r");
		$values;
			while(($x=fgetcsv($file,10000,"\t"))!==FALSE){
				
				
				//mysqli_query($conn,$sql);
	
			$values=$values."('".$x[0]."','".$x[2]."','".$x[1]."','".$x[3]."'),";
		
				
			}
			$sql="INSERT INTO `grades` 
				(SUBJECT_CODE,STUDENT_ID,GRADE,ACAD_YEAR)
				values".rtrim($values, ",");
			mysqli_query($conn,$sql);
		
						
	}
}

header('location:uploadgrades.html');

?>