<?php
	session_start();
	$logerror = "";
	if(isset($_SESSION['error']))
	{
		if(isset($_SESSION['error']['email'])) $logerror .= $_SESSION['error']['email']."  ";
		unset($_SESSION['error']);
	} else {
		include('fitbeedb.php');
		$logerror="";
		if(isset($_POST['submit'])) {
			//check whether needed fields are blank 
			if($_POST['email'] == '')
			{
				$_SESSION['error']['email'] = "E-mail is required. To reset your password, please resubmit with your email.";
				header("Location: resetpassword.php");
				exit;
			}
			else
			{
				$email = mysqli_real_escape_string($database, $_POST['email']);
				//whether the email format is correct
				if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $email))
				{
					//if it has the correct format whether the email has already exist
					$sql1 = "SELECT * FROM users WHERE email = '$email'";
					$result1 = mysqli_query($database,$sql1) or die(mysqli_error());
					if (mysqli_num_rows($result1) > 0)
					{
						$resetcode = md5(uniqid(rand()));
						$thisrow=mysqli_fetch_assoc($result1);
						$firstname = $thisrow['firstname'];
						$lastname = $thisrow['lastname'];


						$sql2 = "update users set resetcode = '$resetcode' where email = '$email'";
						$result2 = mysqli_query($database,$sql2) or die(mysqli_error());

						if($result2)
						{
							$to = $email;
							$subject = "Reset Password from FITBEE to $firstname $lastname";
							$header = "Reset Password from FITBEE";
							$message = "Please click the link below to verify and activate your account. rn";
							$message .= "http://www.innovation-in-action.com/fitbee/resetpasswordemail.php?passkey=$resetcode";

					$headers   = array();
					$headers[] = "MIME-Version: 1.0";
					$headers[] = "Content-type: text/plain; charset=iso-8859-1";
					$headers[] = "From: FITBEE <fitbee@innovation-in-action.com>";
					$headers[] = "Bcc: Marc Rubin <marcr63@gmail.com>";
					$headers[] = "Reply-To: FITBEE <info@fitbee.com>";
					$headers[] = "Subject: FITBEE Password Reset";
					$headers[] = "X-Mailer: PHP/".phpversion();

					$sentmail = mail($to, $subject, $message, implode("\r\n", $headers));
					#$sentmail = mail($to,$subject,$message,$header);

							if($sentmail)
							{
								$logerror = "Your password reset link has been sent to your e-mail address.  Use the link in the e-mail to reset your password.";
							}
							else
							{
								$logerror = "Cannot send confirmation link to your e-mail address.  Please contact customer support for assistance.";
							}
						}
						header("Location: reset.php");
					} else {
						$_SESSION['error']['email'] = "Password not reset.  Account not found.  To reset your password, please resubmit with your email.";
						header("Location: resetpassword.php");
					}
				}
				else
				{
					//this error will set if the email format is not correct
					$_SESSION['error']['email'] = "Password not reset.  Account not found.  To reset your password, please resubmit with your email.";
					header("Location: resetpassword.php");
					exit;
				}
			}

		}
	}
	?>
			<form action="resetpassword.php" method="post" >
				
					<p style="width: 250px">Enter the email address associated with your account and we'll email you a link to reset your password.</p>
					<br>
					<p>Email Address</p>
					<input name="email" maxlength="64" type="text" placeholder="example@fitbee.com">
					<br>
					<br>
					<input name="submit" type="submit" value="Send Password Reset Link"/>
					<br>
					<br>
				
			</form>
