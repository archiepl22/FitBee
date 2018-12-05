<?php
	header('Content-type: application/json');
	include("../../sitedb.php");

		
			$results            = (object)[];
			
			$creator_id = "";
			$name = "";
			$description = "";
			$image_url = "";
			$video_url = "";
			$unit = "";
			

			$ip = $_SERVER['REMOTE_ADDR'];

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['creator_id'])){
				$creator_id = $_GET['creator_id'];
			}

			if (isset($_GET['name'])){
				$name = $_GET['name'];
			}

			if (isset($_GET['description'])){
				$description = $_GET['description'];
			}

			if (isset($_GET['image_url'])){
				$image_url = $_GET['image_url'];
			}

			if (isset($_GET['video_url'])){
				$video_url = $_GET['video_url'];
			}
			
			if (isset($_GET['unit'])){
				$unit = $_GET['unit'];
			}
		

			
			if (isset($_POST['creator_id'])){
				$creator_id = $_POST['creator_id'];
			}

			if (isset($_POST['name'])){
				$name = $_POST['name'];
			}

			if (isset($_POST['description'])){
				$description = $_POST['description'];
			}

			if (isset($_POST['image_url'])){
				$image_url = $_POST['image_url'];
			}

			if (isset($_POST['video_url'])){
				$video_url = $_POST['video_url'];
			}
			
			if (isset($_POST['unit'])){
				$unit = $_POST['unit'];
			}
	
			$creator_id = trim($creator_id);
			$creator_id = mysqli_real_escape_string($database, $creator_id);
			$name = trim($name);
			$name = mysqli_real_escape_string($database, $name);
			$description = trim($description);
			$description = mysqli_real_escape_string($database, $description);
			$image_url = trim($image_url);
			$image_url = mysqli_real_escape_string($database, $image_url);
			$video_url = trim($video_url);
			$video_url = mysqli_real_escape_string($database, $video_url);
			$unit = trim($unit);
			$unit = mysqli_real_escape_string($database, $unit);

			if (($creator_id == "") || ($name == "") ) {
				http_response_code(500);
				exit();	
			}


			$sql2 = "INSERT INTO exercises (creator_id, name, description, image_url, video_url, unit) VALUES ($creator_id, '$name', '$description', '$image_url', '$video_url', '$unit')";
#echo "<br> $sql2 <br>";
			$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));


			$query = "select id, creator_id, name, description, image_url, video_url, unit, created_date from exercises where creator_id = $creator_id and name = '$name' and description = '$description' order by id desc";
#echo "<br> $query <br>";
			$result = mysqli_query($database, $query); 
				
			#echo "<br> $query <br>";
			
			$rowcount=mysqli_num_rows($result);
			if ($rowcount > 0){
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