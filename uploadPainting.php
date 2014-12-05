<?php
session_start();
if(!$_SESSION['userId']){
  header("Location: login.php");
}
$fileName = $_FILES['image']['name'];
$tmpName  = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$fileType = $_FILES['image']['type'];


echo "".$fileType.$tmpName.$fileSize.$fileName;

$name = $_POST['name'];
$description = $_POST['description'];
$artist = $_POST['artist'];
$category =$_POST['category'];
$price =$_POST['price'];
$year =$_POST['year'];
$width =$_POST['width'];
$height =$_POST['height'];
$categoryId = $_POST["category"];
$sellerId = $_SESSION['userId'];
$status = "AVAILABLE";
$fileData = file_get_contents($_FILES['image']['tmp_name']);

$now = new DateTime();
$date_uploaded = $now->format('Y-m-d H:i:s');
$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		try{
		$query = "insert into painting(painting_name,category_id,artist_name,seller_id,price,dimensions,painting,painting_status,painting_year,description,date_uploaded) 
		values('$name','$categoryId','$artist','$sellerId','$price','$width X $height','".mysql_escape_string(file_get_contents($tmpName))."','$status','$year','$description',now())";
		//echo $query;
		$retval = mysqli_query($con, $query);
		}catch(Exception $e){

	echo "error while converting to json".$e->getMessage();
}
		header("Location: home.php");
?>