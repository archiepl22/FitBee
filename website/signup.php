<?php
	include("sandt_nli.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="css" rel="stylesheet">
		<script src="jquery.min.js.download"></script>
		<script src="header.js.download"></script>  
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php
				
				$fne = "";
				$lne = "";
				$eme = "";
				$accessworde = "";
				$aworde = "";
				$signup_error = false;
				$firstname = "";
				$lastname = "";
				$email = "";

				if (isset($_POST['submit']))
				{
					if(isset($_POST['firstname'])) {$firstname = $_POST['firstname'];}
					if(isset($_POST['lastname'])) {$lastname = $_POST['lastname'];}
					if(isset($_POST['email'])) {$email = $_POST['email'];}
					
					if ($_POST['firstname'] == '')
					{
						$fne = " is required.";
						$signup_error = true;
					}
					if ($_POST['lastname'] == '')
					{
						$lne = " is required.";
						$signup_error = true;
					}
					if ($_POST['email'] == '')
					{
						$eme = " is required.";
						$signup_error = true;
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
								$eme = " is already used.";
								$signup_error = true;
							}
						}
						else
						{
							//this error will set if the email format is not correct
							$eme = " is not valid.";
							$signup_error = true;
						}
					}
					//whether the password is blank
					if ($_POST['accessword'] == '')
					{
						$accessworde = " is required.";
						$signup_error = true;
					}

					if ($_POST['accessword'] <> $_POST['aword'])
					{
						$accessworde = " Passwords don't match.";
						$signup_error = true;
					}

					if (isset($_POST['tnc']))
					{ ; } else {
						//$_SESSION['error']['tnc'] = "Acceptance of Terms and Conditions is required.";
					}

					$coach = 0;
					$trainer = 0;
					if (isset($_POST['coach'])) $coach = 1;
					if (isset($_POST['trainer'])) $trainer = 1;
					
					//if an error exists, go back to the signup form and display issues
					if ($signup_error)
					{
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
							return base64_encode($encrypted);
						}

						function my_decrypt($data, $thekey) {
							$key = substr($thekey, 2, 44);
							$iv = base64_decode(substr($thekey, 48, 24));
							// Remove the base64 encoding from our key
							$encryption_key = base64_decode($key);
							$encrypted_data = base64_decode($data);
							return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
						}

						//our data to be encoded
						$password_plain = $accessword;
						//echo $password_plain . "<br>";

						//our data being encrypted. This encrypted data will probably be going into a database
						//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
						$password_encrypted = my_encrypt($password_plain, $key);
						//echo $password_encrypted . "<br>";

						//now we turn our encrypted data back to plain text
						//$password_decrypted = my_decrypt($password_encrypted, $key);
						//echo $password_decrypted . "<br>";				
										
						$sql2 = "INSERT INTO users (firstname, lastname, email, accessword, authcode) VALUES ('$firstname', '$lastname', '$email', '$password_encrypted', '$authcode')";
						$result2 = mysqli_query($database,$sql2) or die(mysqli_error($database));
						//echo "<div>$sql2</div>";
						
						$id = mysqli_insert_id($database);
						$sql3 = "INSERT INTO profiles (uid, coach, trainer, public) VALUES ($id, $coach, $trainer, 0)";
						$result3 = mysqli_query($database,$sql3) or die(mysqli_error($database));
						//echo "<div>$sql3</div>";
						
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

			//				$sentmail = mail($to, $subject, $message, implode("\r\n", $headers));
							#$sentmail = mail($to,$subject,$message,$header);

							if($sentmail)
							{
			//					$logerror = "Your Confirmation link Has Been Sent To Your Email Address.  Click on the link to complete registration.";
							}
							else
							{
			//					$logerror = "Account created.  Error sending confirmation link to your e-mail address.  Please contact us for help.";
							}
							echo '<script type="text/javascript">window.location = "welcome"</script>';
						}
					//$logerror .= " Registration Completed."	;
					}
				}
			
		?>
		

		<?php
			include("header_nli.php");
		?>
		
		<main>
			<div class="c-hero c--blue">
				<h1>Let's get started.</h1>
			</div>
			<?php 
				if ($logerror <> "") {
					?> <div style="color: red;"><?php echo $logerror; ?></div> <?php
				}
			?>
			
			<div class="t-main t-form">
			  <form action="signup" method="POST">
				<h2>Just the bare necessities and you're on your way.</h2>
				<div class="c-grid__row">
				  <div class="c-grid__col6">
					<label class="c-input">First Name <div style="display:inline; color: red;"><?php echo $fne; ?></div>
						<input class="u-width-full" name="firstname" type="text" placeholder="First Name" value="<?php echo $firstname; ?>">
					</label>
				  </div>
				  <div class="c-grid__col6">
					<label class="c-input">Last Name <div style="display:inline; color: red;"><?php echo $lne; ?></div>
						<input class="u-width-full" name="lastname" type="text" placeholder="Last Name" value="<?php echo $lastname; ?>">
					</label>
				  </div>
				</div>
				<div class="c-grid__row u-margin-top-xxlg">
				  <label class="c-input u-width-full">Email <div style="display:inline; color: red;"><?php echo $eme; ?></div>
					<input class="u-width-full" name="email" type="email" placeholder="Email" value="<?php echo $email; ?>">
				  </label>
				</div>
				<div class="c-grid__row u-margin-top-xxlg">
				  <div class="c-grid__col6">
					<label class="c-input">Password <div style="display:inline; color: red;"><?php echo $accessworde; ?></div>
					<input class="u-width-full u-margin-bottom-lg" name="accessword" type="password" placeholder="Password"></label>
					<label class="c-input">Confirm Password <div style="display:inline; color: red;"><?php echo $aworde; ?></div>
					<input class="u-width-full" name="aword" type="password" placeholder="Password"></label>
				  </div>
				  <div class="c-grid__col6 u-margin-top-xxlg">
					<?php
						$checked = "";
						if(isset($_POST['trainer'])) {$checked= 'checked="checked" ';}
					?>
					<div class="c-checkbox">
					  <input type="checkbox" id="trainer" name="trainer" value="trainer" class="c-checkbox" <?php echo $checked;?>><label for="trainer">I am a Trainer</label>
					</div>
					<?php
						$checked = "";
						if(isset($_POST['coach'])) {$checked= 'checked="checked" ';}
					?>
					<div class="c-checkbox u-margin-top-xlg">
					  <input type="checkbox" id="coach" name="coach" value="coach" class="c-checkbox" <?php echo $checked;?>><label for="coach">I am a Coach</label>
					</div>
				  </div>
				</div>
				<div class="u-margin-top-xxlg u-text-align-right">
				  <button href="" name="submit" type="submit" class="c-button c--primary">Sign up</button>
				</div>
			  </form>
			</div>

		</main>

	</body>
</html>