<?php
	$username = $_POST['username'];
	$email = $_POST['email'];
	$id = $_POST['id'];
	$chosenItem = $_POST['chosenItem'];
	
	$conn = new mysqli('localhost', 'root', '', 'user_details');
	if($conn->connect_error){
		die('Connection Failed : ' .$conn->connect_error);	
	}
	else{
		$stmt = $conn->prepare("INSERT INTO borrowerinfo (username, email, id, chosenItem) 
		VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE id = id");
	 
		$stmt->bind_param("ssis",$username,$email, $id, $chosenItem);

		if ($stmt->execute()) {
			if ($stmt->affected_rows > 0) {
				echo "Registration successful.";
			} else {
				// Handle the case where no rows were affected (e.g., duplicate entry)
				echo "Duplicate entry detected. Registration failed.";
			}
		} else {
			// Handle other errors (e.g., connection issues, query syntax errors)
			echo "Error: " . $stmt->error;
		}

		$stmt->close();
		$conn->close();
	}
?>