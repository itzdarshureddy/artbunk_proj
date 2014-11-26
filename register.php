	<?php

	// define variables and set to empty values
	$fName = $email = $lName = $address = $password = "";
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$fName = test_input($_POST["firstname"]);
		$password = test_input($_POST["passwd"]);
		$lName = test_input($_POST["lastname"]);
		$email = test_input($_POST["email"]);
		$address = test_input($_POST["address"]);
		$password = md5($password);
		

		$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$query = "insert into user(password,fname,lname,email,address) values('".$password."','".$fName."','".$lName."','".$email."','".$address."')";

		$retval = mysqli_query($con, $query);
		if($retval){
			header("Location: login.php");
		}
	}




	?>