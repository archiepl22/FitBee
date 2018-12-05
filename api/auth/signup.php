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
			$name = "";

			$ip = $_SERVER['REMOTE_ADDR'];

			// GETs are only here for debugging.  To be commented out in the future.
			if (isset($_GET['name'])){
				$name = $_GET['name'];
			}

			if (isset($_GET['username'])){
				$username = $_GET['username'];
			}

			if (isset($_GET['password'])){
				$password = $_GET['password'];
			}
			
			if (isset($_POST['name'])){
				$name = $_POST['name'];
			}

			if (isset($_POST['username'])){
				$username = $_POST['username'];
			}

			if (isset($_POST['password'])){
				$password = $_POST['password'];
			}
				

			$name = trim($name);
			$name = mysqli_real_escape_string($database, $name);
			$username = trim($username);
			$username = mysqli_real_escape_string($database, $username);
			$password = trim($password);
			$password = mysqli_real_escape_string($database, $password);
				
			if (($password == "") || ($username == "") || ($name == "")) {
				http_response_code(500);
				exit();	
			}


			$query = "select username from users where username = '$username'";
			$result = mysqli_query($database, $query); 
				
				#echo "<br> $query <br>";
				
			$rowcount=mysqli_num_rows($result);
			if ($rowcount == 0){
				//$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.
				$key = '4hbRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=tenHDhctMDAJMswgkDsM6Lsg==4d6f';

				function my_encrypt($data, $thekey) {
					$key = substr($thekey, 2, 44);
					$iv = base64_decode(substr($thekey, 48, 24));
					// Remove the base64 encoding from our key
					$encryption_key = base64_decode($key);
					// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
					$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
					// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
					//return base64_encode($encrypted . '::' . $iv);
					return base64_encode($encrypted);
				}

				function my_decrypt($data, $thekey) {
					$key = substr($thekey, 2, 44);
					$iv = base64_decode(substr($thekey, 48, 24));
					// Remove the base64 encoding from our key
					$encryption_key = base64_decode($key);
					// To decrypt, split the encrypted data from our IV - our unique separator used was "::"
					//list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
					$encrypted_data = base64_decode($data);
					return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
				}

				//our data to be encoded
				$password_plain = $password;
				//echo $password_plain . "<br>";

				//our data being encrypted. This encrypted data will probably be going into a database
				//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
				$password_encrypted = my_encrypt($password_plain, $key);
				//echo $password_encrypted . "<br>";

				//now we turn our encrypted data back to plain text
				$password_decrypted = my_decrypt($password_encrypted, $key);
				//echo $password_decrypted . "<br>";				
								
				$firstname = "";
				$lastname = "";
				$email = "";
				$authcode = "";
				$sql2 = "INSERT INTO users (firstname, lastname, email, accessword, authcode, name, username) VALUES ('$firstname', '$lastname', '$email', '$password_encrypted', '$authcode', '$name', '$username')";
				$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));



				$query = "select uid, name, bio, '' as followed_by, '' as following, image_url, location, username, '' as workouts_purchased from users where name = '$name' and username = '$username'";
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
				} 
		
			} else {
				http_response_code(500);
				exit();	
			}
		
			$json = json_encode($results);
			echo $json;

		?>