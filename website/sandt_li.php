<?php
session_start();
#echo "<br><br><br><br><br><br>";
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

 	include("sitedb.php");

	$uid = $_SESSION['uid'];
	if ($uid < 1) {$uid = -1;}
	$email = $_SESSION['username'];
	$username = $email;
	$page = $_SERVER['REQUEST_URI'];
	$session_ip = $_SESSION['ip'];
	$session_sid = $_SESSION['sid'];
	$session_ua = $_SESSION['ua'];
	
	$http_ip = $_SERVER['REMOTE_ADDR'];
	$http_sid = session_id();
	$http_ua = $_SERVER['HTTP_USER_AGENT'];

#echo "Username:   ".$_SESSION['username']."<br>"; 
#echo "UID:        ".$_SESSION['uid']."<br>";
#echo "Firstname:  ".$_SESSION['firstname']."<br>";
#echo "Lastname:   ".$_SESSION['lastname']."<br>";
#echo "IP:         ".$_SESSION['ip']."<br>";
#echo "UA          ".$_SESSION['ua']."<br>";
#echo "SESS_SID:        ".$_SESSION['sid']."<br>";	
#echo "HTTP_SID:   ".$http_sid."<br>";
#echo "<br>";
	//Write 1st usage history entry based upon setting upon arriving on page
	$log_update = "INSERT INTO usagehistory (uid, email, page, session_ip, session_sid, session_ua, http_ip, http_sid, http_ua) VALUES ($uid, '$email', '$page', '$session_ip', '$session_sid', '$session_ua', '$http_ip', '$http_sid', '$http_ua')";
	$result = mysqli_query($database,$log_update) or die(mysqli_error($database));
	
	//Need to do some testing here and kick it back to the landing page if things don't match:  session expired or accessing it when not logged in_array
	if ($uid == -1) {
		echo '<script type="text/javascript">window.location = "default.php"</script>';
		header('Location: default.php');
		exit();
	}
	if ($session_sid <> $http_sid) {
		echo '<script type="text/javascript">window.location = "default.php"</script>';
		header('Location: default.php');
		exit();
	}
	
	$query = "select profileimagetype from profiles where uid = $uid";
	$result = mysqli_query($database, $query); 
	$thisrow=mysqli_fetch_assoc($result);

	$profileimagetype = $thisrow['profileimagetype'];

?>