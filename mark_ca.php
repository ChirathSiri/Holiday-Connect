<!DOCTYPE html>

<html>
<head>
	<title>MODULE MARKS</title>
</head>
<body> 
	<?php

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$cw1_data = $_POST["Cw1"];
			$cw2_data = $_POST["Cw2"];

			if(!is_numeric($cw1_data) || !is_numeric($cw2_data)){
				echo 'Please enter numeric values !';
			}else{
				$course_work_marks = ($cw1_data * 0.4) + (0.6* $cw2_data);
				echo 'Your Module Marks = '.$course_work_marks;
			}
		}else{
			echo 'Request method not found !';
		}
	?>
</body>
</html>