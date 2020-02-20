<?php
	$db_name = "androidTest";
	$mysql_username = "root";
	$mysql_password = "";
	$server_name = "localhost";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
	
	if($conn){
		//Recieve the data
		$userId = $_POST['userId'];
		$clkState = $_POST['clkState'];
		$clkX = $_POST['clkX'];
		$clkY = $_POST['clkY'];
		$wthState = $_POST['wthState'];
		$wthX = $_POST['wthX'];
		$wthY = $_POST['wthY'];
		
		//Find the user
		$Sql_Query = "SELECT UNIQUE_ID FROM 
		testdata WHERE UNIQUE_ID = '$userId'";
		$result = $conn->query($Sql_Query);

		if(mysqli_query($conn,$Sql_Query)){
			//Update data if user is found
			if ($result->num_rows > 0) {
				$update_query = "UPDATE testdata SET
				clock_state = '$clkState', clockX = '$clkX', clockY = '$clkY',
				weather_state = '$wthState', weatherX = '$wthX', weatherY = '$wthY'
				WHERE UNIQUE_ID = '$userId'";
				if(mysqli_query($conn,$update_query)){
					echo "Data Updated Successfully";
				}else{
					echo "Data Update Unsuccessful";
				}
			} else {
					echo "No User Returned";
			}
		}
		else{
			echo "Connection unsuccessful";
		}
		mysqli_close($conn);
	}
	else{
		echo "Connection unsuccessful";
	}
?>