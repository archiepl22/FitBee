<?php
	header('Content-type: application/json');
	include("../../sitedb.php");
    session_start();
echo " ";
#echo "<br><br><br><br>";
#error_reporting(E_ALL);
ini_set('display_errors', '0'); 
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
	
	//Write 1st usage history entry based upon setting upon arriving on page
	$log_update = "INSERT INTO usagehistory (uid, email, page, session_ip, session_sid, session_ua, http_ip, http_sid, http_ua) VALUES ($uid, '$email', '$page', '$session_ip', '$session_sid', '$session_ua', '$http_ip', '$http_sid', '$http_ua')";
	$result = mysqli_query($database,$log_update) or die(mysqli_error($database));
	
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	
?>