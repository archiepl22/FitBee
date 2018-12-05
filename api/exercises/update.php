<?php
	header('Content-type: application/json');
	include("../../sitedb.php");

		
			$results            = (object)[];
			
			$id = "";
			$name = "";
			$description = "";
			$image_url = "";
			$video_url = "";
			$unit = "";
			

			$ip = $_SERVER['REMOTE_ADDR'];

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['id'])){
				$id = $_GET['id'];
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
		

			
			if (isset($_POST['id'])){
				$id = $_POST['id'];
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
		

			$id = trim($id);
			$id = mysqli_real_escape_string($database, $id);
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

			if (($id == "") || ($name == "") || ($description == "")) {
				http_response_code(500);
				exit();	
			}


			$sql2 = "update exercises set name='$name', description='$description', image_url='$image_url', video_url='$video_url', unit='$unit' where id=$id";
			$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));



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