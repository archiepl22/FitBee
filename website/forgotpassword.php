<?php
	include("sandt_nli.php");

	$logerror = "";
	$logsuccess = "";
	if(isset($_POST['submit'])) {
		//check whether needed fields are blank 
		if($_POST['email'] == '')
			{
				$logerror = "E-mail is required. To reset your password, please resubmit with your email.";
			}
		else
			{
			$email = mysqli_real_escape_string($database, $_POST['email']);
			//whether the email format is correct
				if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $email))
				{
					//if it has the correct format whether the email has already exist
					$sql1 = "SELECT email, firstname, lastname FROM users WHERE email = '$email'";
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

//							$sentmail = mail($to, $subject, $message, implode("\r\n", $headers));
							#$sentmail = mail($to,$subject,$message,$header);

							if($sentmail)
							{
//								$logerror = "Your password reset link has been sent to your e-mail address.  Use the link in the e-mail to reset your password.";
							}
							else
							{
//								$logerror = "Cannot send confirmation link to your e-mail address.  Please contact customer support for assistance.";
							}
							$logsuccess = "Account found.  Need to wire to email server";
						}
					} else {
						$logerror = "Password not reset.  Account not found.  To reset your password, please resubmit with your email.";
					}
				}
				else
				{
					//this error will set if the email format is not correct
					$logerror = "Password not reset.  Account not found.  To reset your password, please resubmit with your email.";
				}
			}

		}
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
		?>

		<?php
			include("header_nli.php");
		?>
	  
		<main>
			<div class="c-hero c--blue">
				<h1>Forgot Password</h1>
			</div>
			<div class="t-form t-main">
				<form action="forgotpassword" method="POST">
					<h2>Reset Password Request</h2>
					<div style="color:red;"><?php echo $logerror;  ?></div><div><?php echo $logsuccess;  ?></div>
					<div class="c-grid__row">
					  <div class="c-grid__col6">
						<label class="c-input">Email
						<input class="u-width-full" type="email" name="email" placeholder="Email"></label>
					  </div>
					</div>
					<div class="u-display-flex u--flex-end u--align-baseline u-margin-top-xxlg">
					  <input name="submit" type="submit" class="c-button c--primary" value="Send Request">
					</div>
				</form>
			</div>

		</main>

	</body>
</html>