<?php
	header('Content-type: application/json');
	include("../../sitedb.php");
		
			$results            = array();
			
			// Once defined, will need to query and fill these in
			$followed_by        = array();
			$following          = array();
			$workouts_created   = array();
			$workouts_purchased = array();
			
			#	?id=&name=&bio=&cover_url=&image_url=&location=&title=&username=
			
			if (isset($_GET['username'])){
				$srch = $_GET['username'];
				
				$query = "select uid, name, bio, '' as followed_by, '' as following, cover_url, image_url, location, title, username, '' as workouts_purchased from users where username = '$srch'";
				$result = mysqli_query($database, $query); 
				
				#echo "<br> $query <br>";
				
				$rowcount=mysqli_num_rows($result);
				if ($rowcount == 1){
					$row=mysqli_fetch_assoc($result);
					$results[] = array('id' => $row['uid'],
						'name' => $row['name'],
						'bio' => $row['bio'],
						'followed_by' => $followed_by,
						'following' => $following,
						'cover_url' => $row['cover_url'],
						'image_url' => $row['image_url'],
						'location' => $row['location'],
						'title'    => $row['title'],
						'username' => $row['username'],
						'workouts_created'  => $workouts_created,
						'workouts_purchased' => $workouts_purchased
					);	
				} else {
				#	$results[] = array(
				#		'id' => -1,
				#		'name' => "not found",
				#		'bio' => "",
				#		'followed_by' => "",
				#		'following' => "",
				#		'image_url' => "",
				#		'location' => "",
				#		'username' => "",
				#		'workouts_purchased' => ""
				#	);
				}

				
			} else {
			#	$results[] = array(
			#		'id' => -2,
			#		'name' => "bad call",
			#		'bio' => "",
			#		'followed_by' => "",
			#		'following' => "",
			#		'image_url' => "",
			#		'location' => "",
			#		'username' => "",
			#		'workouts_purchased' => ""
			#	);
				#$results = 
				http_response_code(404);
				#echo $results;
				exit();
			}
		
		
			$json = json_encode($results);
			echo $json;

		?>