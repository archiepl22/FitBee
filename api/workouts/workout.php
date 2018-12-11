<?php
	header('Content-type: application/json');
	include("../../sitedb.php");
	
	if (isset($_POST['workout'])){
		$jsonin = $_POST['workout']; 
	} else {
		http_response_code(500);
		exit();	
	}	


	if (isset($_POST['userid'])){
		$useridj = $_POST['userid']; 
	} else {
		http_response_code(500);
		exit();	
	}	
	
	if (isset($_POST['operation'])){
		$operation = $_POST['operation']; 
	} else {
		http_response_code(500);
		exit();	
	}	

	if (isset($_POST['workoutid'])){
		$workoutid = $_POST['workoutid']; 
	} else {
		http_response_code(500);
		exit();	
	}	
	
	
	$json = $jsonin;

	#$array = json_decode($json, true);

	$useridj = trim($useridj);
	$useridj = mysqli_real_escape_string($database, $useridj);
	$operation = trim($operation);
	$operation = mysqli_real_escape_string($database, $operation);
	$workoutid = trim($workoutid);
	$workoutid = mysqli_real_escape_string($database, $workoutid);
	$description = trim($json);
	$description = mysqli_real_escape_string($database, $description);
	
	if ($operation == "create"){
		$sql2 = "INSERT INTO workouts (creator, wdescription) VALUES ($useridj, '$description')";
		#echo "<br> $sql2 <br>";
		$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));
		
		$query = "select wid, creator, wdescription from workouts where creator = $useridj and wdescription = '$description' order by wid desc";
		$result = mysqli_query($database, $query); 
				
		#echo "<br> $query <br>";
			
		$rowcount=mysqli_num_rows($result);
		if ($rowcount > 0){
			$row=mysqli_fetch_assoc($result);
			$results = ['id' => $row['wid'],
				'userid' => $row['creator'],
				'description' => $row['wdescription']
			];	
		} else {
			http_response_code(500);
			exit();	
		}
		
		$json = json_encode($results);
		echo $json;

	}
	
	if ($operation == "replace"){
		
		
	}

	if ($operation == "retrieve"){
		if ($workoutid == -1){
			$query = "select wid, creator, wdescription from workouts order by wid desc limit 1";
		} else {
			$query = "select wid, creator, wdescription from workouts where wid = $workoutid order by wid desc";
		}	
		$result = mysqli_query($database, $query); 
				
		#echo "<br> $query <br>";
			
		$rowcount=mysqli_num_rows($result);
		if ($rowcount > 0){
			$row=mysqli_fetch_assoc($result);
			$results = ['id' => $row['wid'],
				'userid' => $row['creator'],
				'description' => $row['wdescription']
			];	
		} else {
			http_response_code(500);
			exit();	
		}
		
		$json = json_encode($results);
		echo $json;

	}

	exit();
	


?>