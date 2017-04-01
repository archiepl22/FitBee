<!DOCTYPE html>
<head>
</head>
<body>
	<?php
		include('fitbeedb.php');
		$passkey = "33333";
		if(isset($_GET['passkey'])){
			$passkey = $_GET['passkey'];
		}
		$sql = "UPDATE users SET com_code=NULL WHERE com_code='$passkey'";
		$result = mysqli_query($database,$sql);
		if (mysqli_affected_rows($database) > 0) {
			$res1 = "Your account is now active.";
			$res2= "You may now <a href='login.php'>Log in</a>";
		}
		else
		{
			$res1 = "An error occurred.";
			$res2 = "Please contact customer support.";
	
		}
	?>	
</body>
</html>