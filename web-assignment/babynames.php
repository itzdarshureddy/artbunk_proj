
<?php

if(isset($_GET['year'])) {
$con=mysqli_connect("localhost","root","intuit01","webAssignment"); 

$year = intval($_GET['year']);

$query = "SELECT * from BabyNames where year=$year";

$results = mysqli_query($con,$query);
$num_rows = mysqli_num_rows($results);
if($num_rows>0){
$rows= array();
try{
while($data = mysqli_fetch_array($results,MYSQL_ASSOC)){
	$rows[]=$data;
};
echo json_encode($rows);
}catch(Exception $e){

	echo "error while converting to json".$e->getMessage();
}
}
else{
	http_response_code(400);
}

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

}

else{
	http_response_code(400);
}

?>