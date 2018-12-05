<?php
	include("../../sitedb.php");
?>
<html>
	<body>

		<?php
		
			$results = array();
			
			if (isset($_GET['query'])){
				$srch = $_GET['query'];
				
				$query = "select id, name, bio, '' as followed_by, '' as following, image_url, location, username, '' as workouts_purchased from users where name = '$srch'";
				$result = mysqli_query($database, $query); 
				
				#echo "<br> $query <br>";
				
				$rowcount=mysqli_num_rows($result);
				if ($rowcount == 1){
					$row=mysqli_fetch_assoc($result);
					$results[] = array(
						'id' => $row['id'],
						'name' => $row['name'],
						'bio' => $row['bio'],
						'followed_by' => "",
						'following' => "",
						'image_url' => $row['image_url'],
						'location' => $row['location'],
						'username' => $row['username'],
						'workouts_purchased' => ""
					);	
				} else {
					$results[] = array(
						'id' => -1,
						'name' => "not found",
						'bio' => "",
						'followed_by' => "",
						'following' => "",
						'image_url' => "",
						'location' => "",
						'username' => "",
						'workouts_purchased' => ""
					);
				}

				
			} else {
				$results[] = array(
					'id' => -2,
					'name' => "bad call",
					'bio' => "",
					'followed_by' => "",
					'following' => "",
					'image_url' => "",
					'location' => "",
					'username' => "",
					'workouts_purchased' => ""
				);
				
			}
		
		
			$json = json_encode($results);
			echo $json;

		?>

	</body>
</html>