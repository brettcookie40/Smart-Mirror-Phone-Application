<?php
	$db_name = "androidTest";
	$mysql_username = "root";
	$mysql_password = "";
	$server_name = "localhost";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
	
	if($conn){
		//Find userID in the database
		$userId = $_POST['userId'];
		$Sql_Query = "SELECT UNIQUE_ID FROM 
		testdata WHERE UNIQUE_ID = '$userId'";
		$result = $conn->query($Sql_Query);

		if(mysqli_query($conn,$Sql_Query)){
			//If the user exist, make them current user
			if ($result->num_rows > 0) {
				$returning_user = "UPDATE testdata SET currently_used = 1 WHERE UNIQUE_ID = '$userId'";
				if(mysqli_query($conn,$returning_user)){
					echo "returning";
				}else{
					echo "Returning User Unverified";
				}
			//If the user is new, make a new row with 0 data and make them the current user
			} else {
				$new_user_query = "insert into testdata (UNIQUE_ID,currently_used) values ('$userId',1)";
				if(mysqli_query($conn,$new_user_query)){
					echo "new";
				}else{
					echo "New User Unverified";
				}
			}
			
			//Make all other users not current
			$updata_user = "UPDATE testdata SET currently_used = 0 WHERE UNIQUE_ID <> '$userId'";
			if(!mysqli_query($conn,$updata_user)){
				echo "Update Unsuccessful";
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