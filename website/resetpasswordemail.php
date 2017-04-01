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

			$accessworde = "";
			$aworde = "";
			$signup_error = false;
			$email = "";

			if (isset($_POST['submit']))
			{
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

				if($_POST['passkey'] == '')
				{
					$logerror = "Unable to reset password.  Please contact customer support.";
					$signup_error = true;
				}

					
					//if an error exists, go back to the signup form and display issues
					if ($signup_error)
					{
					}
					else
					{
						$pw = mysqli_real_escape_string($database, $_POST['accessword']);
						$passkey = mysqli_real_escape_string($database, $_POST['passkey']);

						$sql1 = "SELECT * FROM users WHERE resetcode = '$passkey'";
						$result1 = mysqli_query($database,$sql1) or die(mysqli_error());
            
						if (mysqli_num_rows($result1) > 0){

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
							$password_plain = $pw;
							//echo $password_plain . "<br>";

							//our data being encrypted. This encrypted data will probably be going into a database
							//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
							$password_encrypted = my_encrypt($password_plain, $key);
							//echo $password_encrypted . "<br>";


						
							$sql = "UPDATE users SET resetcode=NULL, accessword = '$password_encrypted' WHERE resetcode='$passkey'";
							$result = mysqli_query($database,$sql) or die(mysqli_error());
							if($result)
							{
								$logerror = "Your password has been reset."; 
								header('Location: login.php');
							}
							else
							{
								$_SESSION['error']['cb'] = "Password reset failed.  Please try again or contact customer support.";
								#echo "An error occur.";
								header('Location: resetpasswordemail.php');
								
							}
						} 
					}
					
			}
			
		?>
		

		<?php
			include("header_nli.php");

			$passkey = "3456";
			if(isset($_GET['passkey'])){
				$passkey = $_GET['passkey']; 
			}
			if(isset($_POST['passkey'])){
				$passkey = $_GET['passkey']; 
			}

			// If user got here without a passkey set, then time to leave
			if ($passkey = "3456") {
				echo '<script type="text/javascript">window.location = "default.php"</script>';
				header('Location: default.php');
				exit();
			}

		?>
		
		<main>
			<div class="c-hero c--blue">
				<h1>Set New Password</h1>
			</div>
			<?php 
				if ($logerror <> "") {
					?> <div style="color: red;"><?php echo $logerror; ?></div> <?php
				}
			?>
			
			<div class="t-form t-main">
			  <form action="resetpasswordemail" method="POST">
				<h2>Just enter your new password and you're on your way.</h2>
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
				</div>
				<div class="u-margin-top-xxlg u-text-align-right">
				  <button href="" name="submit" type="submit" class="c-button c--primary">Set New Password</button>
				</div>
				<input type="hidden" name="passkey" value="<?php echo $passkey; ?>">
			  </form>
			</div>

		</main>

	</body>
</html>