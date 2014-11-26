<?php
session_start();
$password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$password = $_POST["passwd"];
		$email = $_POST["email"];
		$password = md5($password);

		$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$query = "select * from user user where email='".$email."'";
		$result = mysqli_query($con, $query);
		$num_rows = mysqli_num_rows($result);
		echo $num_rows;
		 if($num_rows==1){
		 	$row = mysqli_fetch_assoc($result);
		 	$storedPass = $row['password'];
		 	
			if($password == $storedPass){
				$_SESSION["userId"] = $row["user_id"];
				header("Location: home.php");

			} else{
				echo "Login Failed";
			}
		 }
	}


?>