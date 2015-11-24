<?php 

require "config.php";
header('application\json');
$x="x";
if(isset($_POST["submit"])){
$x="submitted but no files";
	if(isset($_FILES["file"])){
		$filename=$_FILES["file"]["tmp_name"];
		$file=fopen($filename,"r");
		
			while(($x=fgetcsv($file,10000,"\t"))!==FALSE){
				$sql="INSERT INTO `prospectus` 
				(`COURSE`, `CURRICULUM`, `SUBJECT_CODE`, `SUBJECT_TITLE`, `LEC`, `LAB`, `PRE_REQUISITE`, `YEAR`, `SEMESTER`, `NAME`)
				values
				('".$x[0]."',
				'".$x[1]."',
				'".$x[2]."',
				'".$x[3]."',
				'".$x[4]."',
				'".$x[5]."',
				'".$x[6]."',
				'".$x[7]."',
				'".$x[8]."',
				'".$x[0]." ".$x[1]."')";
				mysqli_query($conn,$sql);
	
			
			if(strpos($x[6]," ")){
				$pre = explode(" ", $x[6]);
				for($z=0;$z<=count($pre)-1;$z++){
				$sql="Insert into pre_reqs(SUBJECT_CODE,PRE_REQ)values('".$x[2]."','".$pre[$z]."')";
				mysqli_query($conn,$sql);
					
				}
				
				
			}
				
			}
						
	}
}

header('location:addprospectus.html');

?>