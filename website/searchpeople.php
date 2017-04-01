<?php
session_start();
echo "<br>Search for People Page<br>";

foreach ($_SESSION as $name => $value)
{
    echo $name."=".$value."<br>";
}
//phpinfo();
?>

<br>Feeds on this page
<br><a href="logout.php">Logout</a>
<br><a href="profile.php">Profile ( with Calendar(s) and my posts )</a>
<br><a href="searchpeople.php">Search People</a>
<br><a href="searchworkouts.php">Search Workouts</a>
<br><a href="myworkouts.php">My Workouts</a>
<br>
------------------------------------------------
<br><a href="profileedit.php">Edit My Profile</a>


<?php
	include("fitbeedb.php");

	$uid = $_SESSION['uid'];

	$query = "select firstname, lastname from users where uid = $uid";
	$result = mysqli_query($database, $query); 
					
	if (mysqli_num_rows($result) == 0) {
		$firstname = "Not found";
		$lastname  = "Not found";
		$found = false;
		
	} else {
		$thisrow=mysqli_fetch_assoc($result);
		$firstname = $thisrow['firstname'];
		$lastname  = $thisrow['lastname'];
		$found = true;
	
		$query = "select coach from profiles where uid = $uid";
		$result = mysqli_query($database, $query); 
		$thisrow=mysqli_fetch_assoc($result);

		$coach = $thisrow['coach'];
	}	

	

?>
<br>USERSID = <?php echo $uid; ?>
<br>FN = <?php echo $firstname; ?>
<br>LN = <?php echo $lastname; ?>
<br>Coach = <?php echo $coach; ?>
<br>
		<?php
			$user1 = $firstname." ".$lastname;

			if ($found) {
				$query = "SELECT uid1, uid2, connection, firstname, lastname FROM users2users, users where uid1 = $uid and users.uid = uid2 order by connection";
				echo "<br>$query<br>";
				$result = mysqli_query($database, $query); 
				
				while($row = mysqli_fetch_assoc($result))
					{
						$user2 = $row['firstname']." ".$row['lastname'];
						
						if ($row['connection'] == 1){
								echo "$user1 is connected to $user2.<br>";
						}
						if ($row['connection'] == 2){
								echo "$user1 is a coach of $user2.<br>";
						}
						if ($row['connection'] == 3){
								echo "$user1 is a client of $user2.<br>";
						}
					}
			} 
			

?>
<br><br><br>