<?php
include("sandt_nli.php");
?>
<?php 
	
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

			$logerror = "";
			if(isset($_POST['submit'])) {
				$email = trim($_POST['email']);
				$email = mysqli_real_escape_string($database, $email);
				$password = trim($_POST['password']);
				$password = mysqli_real_escape_string($database, $password);
				$password_encrypted = my_encrypt($password, $key);
				// $query = "SELECT email, uid, firstname, lastname FROM users WHERE email='$email' AND accessword='$password_encrypted' AND authcode IS NULL";
				$query = "SELECT email, uid, firstname, lastname FROM users WHERE email='$email' AND accessword='$password_encrypted'";
				$result = mysqli_query($database,$query)or die(mysqli_error($database));
				$num_row = mysqli_num_rows($result);
				$row=mysqli_fetch_array($result);
				$ip = $_SERVER['REMOTE_ADDR'];
				if( $num_row == 1 )
				{
					session_start();
					/* Create a new session, deleting the previous session data. */
					session_regenerate_id(TRUE);
					$sid = session_id();
					/* erase data carried over from previous session */
					$_SESSION=array();					
					$_SESSION['username'] = htmlspecialchars($email); 
					$_SESSION['uid'] = $row['uid'];
					$_SESSION['firstname'] = $row['firstname'];
					$_SESSION['lastname'] = $row['lastname'];
					$_SESSION['ip'] = $ip;
					$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
					$_SESSION['sid'] = $sid;
					
					$uid = $_SESSION['uid'];
					$query = "UPDATE users SET lastlogin = now() where uid = '$uid'";
					$result = mysqli_query($database, $query)or die(mysqli_error($database));
					
					$query = "insert into loginhistory (uid, ipaddress) values ($uid, '$ip')";
					$result = mysqli_query($database, $query)or die(mysqli_error($database));
					
					echo '<script type="text/javascript">window.location = "home"</script>';
					exit;
				}
				else
				{
					$logerror = "Login Failed.  Try Again.";

					$query = "insert into loginfailurehistory (username, accesscode, ipaddress) values ('$email', '$password', '$ip')";
					$result = mysqli_query($database, $query)or die(mysqli_error($database));
					
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
			include("header_nli.php");
		?>
		<main>
			<div class="c-hero c--blue">
				<h1>Welcome back!</h1>
			</div>
			<div class="t-main t-form">
				<form action="login" method="POST">
					<h2>Login</h2>
					<div style="color:red;"><?php echo $logerror;  ?></div>
					<div class="c-grid__row">
					  <div class="c-grid__col6">
						<label class="c-input">Email
						<input class="u-width-full" type="email" name="email" placeholder="Email"></label>
					  </div>
					  <div class="c-grid__col6">
						<label class="c-input">Password
						<input class="u-width-full" type="password" name="password" placeholder="Password"></label>
						<a href="forgotpassword" class="c-link u-text-size-small u-display-block u-text-align-right u-padding-top-md">I forgot my password</a>
					  </div>
					</div>
					<div class="u-display-flex u--flex-end u--align-baseline u-margin-top-xxlg">
					  <div class="c-checkbox u-margin-right-xlg">
						<input type="checkbox" value="remember" class="c-checkbox"><label for="remember">Remember me</label>
					  </div>
					  <!-- <a href="" type="submit" name="submit" id="submit" class="c-button c--primary">Login</a> -->
					  <input name="submit" type="submit" class="c-button c--primary" value="Login">
					</div>
				</form>
			</div>

		</main>

	</body>
</html>