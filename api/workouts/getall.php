<?php
	header('Content-type: application/json');
	include("../../sitedb.php");

		
			$results            = [];
			$resultsall			= [];
			
			$id = "";

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['userid'])){
				$id = $_GET['userid'];
			}

			if (isset($_POST['userid'])){
				$id = $_POST['userid'];
			}



			$id = trim($id);
			$id = mysqli_real_escape_string($database, $id);

			if ($id == "") {
				http_response_code(500);
				exit();	
			}

			#localhost/fitbeeftp/api/exercises/getall?which=0&userid=0&offset=0&numrecs=2
			$query = "select wid, creator, created, wdescription from workouts where creator = $id ";
			
#echo "$query";			
			$result = mysqli_query($database, $query); 
				
			#echo "<br> $query <br>";
			
			$rowcount=mysqli_num_rows($result);
			$needsep = false;
			
			$i = 0;
			if ($rowcount > 0){
				#$row=mysqli_fetch_assoc($result);
	
				while(list($id, $creator_id, $created, $description) = mysqli_fetch_row($result)) {
				
					if ($needsep == false) {
						$needsep = true;
					} else {
						
						#$resultsall[] .= " ,";
					}
					
					$results =  ['id' => $id,
						'creator_id' => $creator_id,
						'description' => $description,
						'created_date' => $created
					];	
					
					$resultsall[$i] = $results;
					$i = $i + 1;
				}
				
			} else {
				http_response_code(500);
				exit();	
			}
		
			$json = json_encode($resultsall);
			echo $json;
			

		?>
