<?php
require 'config.php';
//kapag pinindot yung submit
if(isset($_POST["Import"])){
//yung input type yung file
 		echo $filename=$_FILES["file"]["tmp_name"];
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into tbl_class (`fld_classid`, `fld_subjcode`,`fld_coursetitle`, `fld_day`, `fld_time`, `fld_rm`, `fld_instructor`) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query($conn,$sql);
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"manage-class.html\"
						</script>";
 
				}
 
	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	        header("location:manage-class.html");
 
 
 
			 //close of connection
			mysqli_close($conn); 
 
 
 
		 }
	}	 
?>