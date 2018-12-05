<?php
	header('Content-type: application/json');
	include("../../sitedb.php");

		
			$results            = [];
			$resultsall			= [];
			
			$id = "";
			$which = "";
			$numrecs = "";
			$offset = "";

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['userid'])){
				$id = $_GET['userid'];
			}

			if (isset($_POST['userid'])){
				$id = $_POST['userid'];
			}

			if (isset($_GET['which'])){
				$which = $_GET['which'];
			}

			if (isset($_POST['which'])){
				$which = $_POST['which'];
			}

			if (isset($_GET['numrecs'])){
				$numrecs = $_GET['numrecs'];
			}

			if (isset($_POST['numrecs'])){
				$numrecs = $_POST['numrecs'];
			}
			
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}

			if (isset($_POST['offset'])){
				$offset = $_POST['offset'];
			}




			$id = trim($id);
			$id = mysqli_real_escape_string($database, $id);
			$which = trim($which);
			$which = mysqli_real_escape_string($database, $which);
			$numrecs = trim($numrecs);
			$numrecs = mysqli_real_escape_string($database, $numrecs);
			$offset = trim($offset);
			$offset = mysqli_real_escape_string($database, $offset);

			if (($which == "") || ($id == "") || ($numrecs == "") || ($offset == "")) {
				http_response_code(500);
				exit();	
			}

			#localhost/fitbeeftp/api/exercises/getall?which=0&userid=0&offset=0&numrecs=2
			$query = "select id, creator_id, name, description, image_url, video_url, unit, created_date from exercises where ";
			
			if ($which == 0) {$query .= " creator_id in (0) ";}
			else if ($which == 1) {$query .= " creator_id in ($id) ";}
			else {$query .= " creator_id in (0, $id) ";}
			
			$query .= " order by id limit $offset , $numrecs ";
#echo "$query";			
			$result = mysqli_query($database, $query); 
				
			#echo "<br> $query <br>";
			
			$rowcount=mysqli_num_rows($result);
			$needsep = false;
			
			$i = 0;
			if ($rowcount > 0){
				#$row=mysqli_fetch_assoc($result);
				
				while(list($id, $creator_id, $name, $description, $image_url, $video_url, $unit, $created_date) = mysqli_fetch_row($result)) {
				
					if ($needsep == false) {
						$needsep = true;
					} else {
						
						#$resultsall[] .= " ,";
					}
					
					$results =  ['id' => $id,
						'creator_id' => $creator_id,
						'name' => $name,
						'description' => $description,
						'image_url' => $image_url,
						'video_url' => $video_url,
						'created_date' => $created_date,
						'unit' => $unit
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
			
			#$results2 = [['id' => 123,'creator_id' => 456],['id' => 123,'creator_id' => 456] ];
			#$json = json_encode($results2);
			#echo $json;

		?>
