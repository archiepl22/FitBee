<body>
	<?php
	session_start();
	echo $logerror;
	if (isset($_SESSION['error']))
	{
		$logerror = "";
		if (isset($_SESSION['error']['firstname']))  $logerror .= $_SESSION['error']['firstname']."  ";
		if (isset($_SESSION['error']['lastname']))   $logerror .= $_SESSION['error']['lastname']."  ";
		if (isset($_SESSION['error']['email']))      $logerror .= $_SESSION['error']['email']."  ";
		if (isset($_SESSION['error']['accessword'])) $logerror .= $_SESSION['error']['accessword']."  ";
		if (isset($_SESSION['error']['aword']))      $logerror .= $_SESSION['error']['aword']."  ";
		//if (isset($_SESSION['error']['tnc']))        $logerror .= $_SESSION['error']['tnc']."  ";
		unset($_SESSION['error']);
	} else {
		include('fitbeedb.php');
		//$logerror="";
		if (isset($_POST['submit']))
		{
			//check whether needed fields are blank 
			if ($_POST['firstname'] == '')
			{
				$_SESSION['error']['firstname'] = "First Name is required.";
			}
			if ($_POST['lastname'] == '')
			{
				$_SESSION['error']['lastname'] = "Last Name is required.";
			}
			if ($_POST['email'] == '')
			{
				$_SESSION['error']['email'] = "E-mail is required.";
			}
			else
			{
				$email = mysqli_real_escape_string($database, $_POST['email']);
				//whether the email format is correct
				if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $email))
				{
					//if it has the correct format whether the email has already exist
					$sql = "SELECT * FROM users WHERE email = '$email'";
					$result = mysqli_query($database,$sql) or die(mysqli_error());
					if (mysqli_num_rows($result) > 0)
					{
						$_SESSION['error']['email'] = "This Email is already used.";
					}
				}
				else
				{
					//this error will set if the email format is not correct
					$_SESSION['error']['email'] = "Your email is not valid.";
				}
			}
			//whether the password is blank
			if ($_POST['accessword'] == '')
			{
				$_SESSION['error']['accessword'] = "Password is required.";
			}

			if ($_POST['accessword'] <> $_POST['aword'])
			{
				$_SESSION['error']['password'] = "Passwords don't match.";
			}

			if (isset($_POST['tnc']))
			{ ; } else {
				//$_SESSION['error']['tnc'] = "Acceptance of Terms and Conditions is required.";
			}

			$coach = 0;
			$trainer = 0;
			if (isset($_POST['coach'])) $coach = 1;
			if (isset($_POST['trainer'])) $trainer = 1;
			
			//if an error exists, go back to the registration form and display issues
			if (isset($_SESSION['error']))
			{
				//echo 'An error occurreed - #1';
				echo '<script type="text/javascript">window.location = "registration.php"</script>';
				exit;
			}
			else
			{
				$firstname = mysqli_real_escape_string($database, $_POST['firstname']);
				$lastname = mysqli_real_escape_string($database, $_POST['lastname']);
				$email = mysqli_real_escape_string($database, $_POST['email']);
				$accessword = mysqli_real_escape_string($database, $_POST['accessword']);
				$authcode = md5(uniqid(rand()));

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
				$password_plain = $accessword;
				echo $password_plain . "<br>";

				//our data being encrypted. This encrypted data will probably be going into a database
				//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
				$password_encrypted = my_encrypt($password_plain, $key);
				echo $password_encrypted . "<br>";

				//now we turn our encrypted data back to plain text
				$password_decrypted = my_decrypt($password_encrypted, $key);
				echo $password_decrypted . "<br>";				
								
				$sql2 = "INSERT INTO users (firstname, lastname, email, accessword, authcode) VALUES ('$firstname', '$lastname', '$email', '$password_encrypted', '$authcode')";
				$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));

				$id = mysqli_insert_id($database);
				$sql3 = "INSERT INTO profiles (uid, coach, trainer, public) VALUES ($id, $coach, $trainer, 0)";
				$result3 = mysqli_query($database,$sql3) or die(mysqli_error($database));

				//echo $sql2;
				//exit;
				if($result2)
				{
					$to = $email;
					$subject = "Confirmation from FITBEE to $firstname $lastname";
					#$header = "Registration Confirmation from FITBEE";
					$message = "Please click the link below to verify and activate your account. \r\n";
					$message .= "http://www.innovation-in-action.com/fitbee/confirm.php?passkey=$authcode";

					$headers   = array();
					$headers[] = "MIME-Version: 1.0";
					$headers[] = "Content-type: text/plain; charset=iso-8859-1";
					$headers[] = "From: FITBEE <info@fitbee.com>";
					$headers[] = "Bcc: FitBee <fitbee@innovation-in-action.com>";
					$headers[] = "Reply-To: FITBEE <info@fitbee.com>";
					$headers[] = "Subject: FITBEE Registration Confirmation";
					$headers[] = "X-Mailer: PHP/".phpversion();

					$sentmail = mail($to, $subject, $message, implode("\r\n", $headers));
					#$sentmail = mail($to,$subject,$message,$header);

					if($sentmail)
					{
						$logerror = "Your Confirmation link Has Been Sent To Your Email Address.  Click on the link to complete registration.";
					}
					else
					{
						$logerror = "Account created.  Error sending confirmation link to your e-mail address.  Please contact us for help.";
					}
				}
			//$logerror .= " Registration Completed."	;
			//echo '<script type="text/javascript">window.location = "registration.php"</script>';
			}
		}
	}
	?>
	
	<?php 
	if ($logerror <> "") {
		?> <div style="color: red;"><?php echo $logerror; ?></div> <?php
	}
	?>
	
	<h3>Register</h3> 
	<i>It's free and it takes less than a minute!</i><br>
	<form action="registration.php" method="post" >
		<input type="text" name="firstname" id="firstname" placeholder="First Name"  maxlength="45" ></input>
		<br>
		<br>
		<input type="text" name="lastname" id="lastname" placeholder="Last Name"  maxlength="45" ></input>
		<br>
		<br>
		<input type="text" name="email" id="email" placeholder="Email Address" maxlength="80" ></input>
		<br>
		<br>
		<input name="accessword" type="accessword" id="accessword" placeholder="Password" maxlength="45" ></input>
		<br>
		<br>
		<input name="aword" type="aword" id="aword" placeholder="Confirm Password"  maxlength="45" ></input>
		<br>
		<br>
		<?php
			$checked = "";
			if(isset($_POST['coach'])) {$checked= 'checked="checked" ';}
		?>
		<input type="checkbox" name="coach" id="coach" style="width: 20px; height: auto;" <?php echo $checked;?>> Coach
		<br>
		<br>
		<?php
			$checked = "";
			if(isset($_POST['trainer'])) {$checked= 'checked="checked" ';}
		?>
		<input type="checkbox" name="trainer" id="trainer" style="width: 20px; height: auto;" <?php echo $checked;?>> Trainer
		<br>
		<br>
		<input name="submit" type="submit" value="Register"/>
	</form>
</body>
