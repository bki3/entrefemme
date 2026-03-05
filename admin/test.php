<?php 

include '../config/config.php';

$sql = mysqli_query($con, "SELECT * FROM `visitors` WHERE `country` = 'Unknown' LIMIT 30000");

if($sql){
	echo mysqli_num_rows($sql);

	while($r = mysqli_fetch_assoc($sql)){
	

	}


		
}else{
	echo mysql_error($con);
}
	


 ?>