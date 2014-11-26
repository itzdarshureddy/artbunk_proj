<?php
session_start();
if(!$_SESSION['userId']){
  header("Location: login.php");
}

$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$id= $_GET["id"];
$query = "select painting from painting where painting_id='$id'";
$result = mysqli_query($con, $query);
		$num_rows = mysqli_num_rows($result);
		 if($num_rows==1){
		 	$row = mysqli_fetch_assoc($result);
		 	$image = $row['painting'];
		 	header("content-type: image/jpeg");
		 	echo $image;
		 	}		


?>