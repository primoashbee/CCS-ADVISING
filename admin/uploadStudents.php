<?php 
require "config.php";
header('application\json');

$x="x";
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST["submit"])){
$x="submitted but no files";
	if(isset($_FILES["file"])){
		$filename=$_FILES["file"]["tmp_name"];
		$file=fopen($filename,"r");
		$values;
	
			while(($data=fgetcsv($file,10000,"\t"))!==FALSE){
			
		
			$values=$values."(
			'".html_entity_decode($data[0])."',
			'".html_entity_decode($data[1])."',
			'".html_entity_decode($data[2])."',
			'".html_entity_decode($data[3])."',
			'".html_entity_decode($data[4])."',
			'".html_entity_decode($data[5])."',
			'".html_entity_decode($data[6])."'),";
	
			}
			$sql="INSERT INTO `students` 
				(STUDENT_ID,LAST_NAME,FIRST_NAME,MIDDLE_NAME,COURSE,YEAR_LEVEL,CURRICULUM)
				values".rtrim($values, ",");
				mysqli_query($conn,$sql);
			
						
	}
}

//header('location:addstudent.html');

?>