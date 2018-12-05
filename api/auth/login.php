<?php
	header('Content-type: application/json');
	include("../../sitedb.php");
		
			$results            = (object)[];
			
			// Once defined, will need to query and fill these in
			$followed_by        = array();
			$following          = array();
			$workouts_purchased = array();
			
			$username = "";
			$password = "";

			$ip = $_SERVER['REMOTE_ADDR'];

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['username'])){
				$username = $_GET['username'];
			}

			if (isset($_GET['password'])){
				$password = $_GET['password'];
			}
			
			if (isset($_POST['username'])){
				$username = $_POST['username'];
			}

			if (isset($_POST['password'])){
				$password = $_POST['password'];
			}
				

			$username = trim($username);
			$username = mysqli_real_escape_string($database, $username);
			$password = trim($password);
			$password = mysqli_real_escape_string($database, $password);
				
			if (($password == "") || ($username == "")) {
				$query = "insert into loginfailurehistory (username, accesscode, ipaddress) values ('$username', '$password', '$ip')";
				$result = mysqli_query($database, $query)or die(mysqli_error($database));
				http_response_code(500);
				#echo "<br>one is empty<br>";
				exit();	
			}
			
			//$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.
			$key = '4hbRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=tenHDhctMDAJMswgkDsM6Lsg==4d6f';

			function my_encrypt($data, $thekey) {
				$key = substr($thekey, 2, 44);
				$iv = base64_decode(substr($thekey, 48, 24));
				// Remove the base64 encoding from our key
				$encryption_key = base64_decode($key);
				// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
				$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
				return base64_encode($encrypted);
			}


			$password_encrypted = my_encrypt($password, $key);
			
			$query = "select uid, name, bio, '' as followed_by, '' as following, image_url, location, username, '' as workouts_purchased from users where username = '$username' and accessword='$password_encrypted'";
			$result = mysqli_query($database, $query); 
				
			#echo "<br> $query <br>";
				
			$rowcount=mysqli_num_rows($result);
			if ($rowcount == 1){
					$row=mysqli_fetch_assoc($result);
					$results = ['id' => $row['uid'],
						'name' => $row['name'],
						'bio' => $row['bio'],
						'followed_by' => $followed_by,
						'following' => $following,
						'image_url' => $row['image_url'],
						'location' => $row['location'],
						'username' => $row['username'],
						'workouts_purchased' => $workouts_purchased
					];
			} else {
				$query = "insert into loginfailurehistory (username, accesscode, ipaddress) values ('$username', '$password', '$ip')";
				$result = mysqli_query($database, $query)or die(mysqli_error($database));
				http_response_code(500);
				#echo "<br>Not Found<br>";
				exit();	
			}
			
			
			session_start();
			/* Create a new session, deleting the previous session data. */
			session_regenerate_id(TRUE);
			$sid = session_id();
			/* erase data carried over from previous session */
			$_SESSION=array();		
			$username = $row['username'];
			$_SESSION['username'] = htmlspecialchars($username); 
			$_SESSION['uid'] = $row['uid'];
			//$_SESSION['firstname'] = $row['firstname'];
			//$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['ip'] = $ip;
			$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['sid'] = $sid;
			
			$uid = $_SESSION['uid'];
			$query = "UPDATE users SET lastlogin = now() where uid = '$uid'";
			$result = mysqli_query($database, $query)or die(mysqli_error($database));
					
			$query = "insert into loginhistory (uid, ipaddress) values ($uid, '$ip')";
			$result = mysqli_query($database, $query)or die(mysqli_error($database));
					
			$json = json_encode($results);
			echo $json;

		?>