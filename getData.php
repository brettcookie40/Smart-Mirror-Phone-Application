<?php
	$db_name = "androidTest";
	$mysql_username = "root";
	$mysql_password = "";
	$server_name = "localhost";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
	
	if($conn){
		//Select the user who is in use of mirror
		$Sql_Query = "SELECT clock_state, clockX, clockY, weather_state, weatherX, weatherY FROM testdata WHERE currently_used=1";
		$result = $conn->query($Sql_Query);

		if(mysqli_query($conn,$Sql_Query)){
			//Send state of widgets and their respective coordinates
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				echo $row["clock_state"]. "," .$row["clockX"]. "," .$row["clockY"]. "," 
				.$row["weather_state"]. "," .$row["weatherX"]. "," .$row["weatherY"];
				
			} else {
				echo "0 results";
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