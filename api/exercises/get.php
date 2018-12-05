<?php
	header('Content-type: application/json');
	include("../../sitedb.php");

		
			$results            = (object)[];
			
			$id = "";

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['id'])){
				$id = $_GET['id'];
			}

			if (isset($_POST['id'])){
				$id = $_POST['id'];
			}

			$id = trim($id);
			$id = mysqli_real_escape_string($database, $id);

			if (($id == "")) {
				http_response_code(500);
				exit();	
			}


			$query = "select id, creator_id, name, description, image_url, video_url, unit, created_date from exercises where id = $id";
			$result = mysqli_query($database, $query); 
				
			#echo "<br> $query <br>";
			
			$rowcount=mysqli_num_rows($result);
			if ($rowcount == 1){
				$row=mysqli_fetch_assoc($result);
				$results = ['id' => $row['id'],
					'creator_id' => $row['creator_id'],
					'name' => $row['name'],
					'description' => $row['description'],
					'image_url' => $row['image_url'],
					'video_url' => $row['video_url'],
					'created_date' => $row['created_date'],
					'unit' => $row['unit']
				];	
			} else {
				http_response_code(500);
				exit();	
			}
		
			$json = json_encode($results);
			echo $json;

		?>