<?php
	$username = "root";
	$password = "";
	$databasename = "fitbee";
	$host_name  = "localhost";

	$username = "dbo673255201";
	$password = "FitBee1!";
	$databasename = "db673255201";
	$host_name  = "db673255201.db.1and1.com";
 	
	# Connect to the database server
	$database = mysqli_connect($host_name, $username, $password, $databasename);
  
	if (!$database) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		die("Database Error");
		exit;
	}

	$showstuff = false;
	if ($host_name == "localhost") {
		$showstuff = true;
	}
	
	#echo "Success: Connection to MySQL database was made! " . PHP_EOL;
	#echo "Host information: " . mysqli_get_host_info($database) . PHP_EOL;

	//mysqli_close($database);
?>