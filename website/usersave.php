<?php
	$a = session_id();
	if(empty($a)) session_start();
#	echo "SID: ".SID."<br>session_id(): ".session_id()."<br>";
    include("sitedb.php");
		
	$id = mysqli_real_escape_string($database, $_GET['id']);
	$firstname = mysqli_real_escape_string($database, $_GET['firstname']);
	$lastname = mysqli_real_escape_string($database, $_GET['lastname']);
	$email = mysqli_real_escape_string($database, $_GET['email']);
    
	$query = "update users set firstname = '$firstname',  lastname = '$lastname',  email = '$email' where uid = $id";
	$result = mysqli_query($database, $query) ;
	#echo $query;
	
    header("Location: usertables.php");

?>


