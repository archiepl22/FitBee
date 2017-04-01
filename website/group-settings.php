<?php
	include("sandt_li.php");
//	echo "<br><br><br><br><br><br>";
//	foreach ($_POST as $name => $value) { echo $name."=".$value."<br>"; }	
	//foreach ($_SESSION as $name => $value) {echo $name."=".$value."<br>";}	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="css" rel="stylesheet">
		<script src="jquery.min.js.download"></script>
		<script src="jquery-ui.min.js.download"></script>
		<script src="header.js.download"></script>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<?php
			$dashboard = 1;
			include("header_li_dashboard.php");

			if (isset($_POST['groupid'])) {
				$groupid = $_POST['groupid'];
			} else {
				echo '<script type="text/javascript">window.location = "default.php"</script>';
				header('Location: default.php');
				exit();
			}	


			$query = "select groupname, imagetype from groups where gid=$groupid";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);

			$groupname = $thisrow['groupname'];
			$imagetype = $thisrow['imagetype'];
			
			
			$query = "select joinrequest, workoutcompleted, message, wallpost from users2groups where gid=$groupid and uid=$uid and admin=1";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);

			$joinrequest 	= $thisrow['joinrequest'];
			$workoutcompleted = $thisrow['workoutcompleted'];
			$message = $thisrow['message'];
			$wallpost = $thisrow['wallpost'];


			if (isset($_POST['editp2']) == "savep2") {
				$joinrequest = 0;
				$workoutcompleted = 0; 
				$message = 0; 
				$wallpost = 0;
				if (isset($_POST['joinrequest'])) {$joinrequest = 1; }
				if (isset($_POST['workoutcompleted'])) {$workoutcompleted = 1; }
				if (isset($_POST['message'])) {$message = 1; }
				if (isset($_POST['wallpost'])) {$wallpost = 1; }
				
				$query = "update users2groups set  joinrequest=$joinrequest, workoutcompleted=$workoutcompleted, message=$message, wallpost=$wallpost where gid=$groupid and uid=$uid and admin=1";
				$result = mysqli_query($database, $query);
				//echo "Error: " . $query . "<br>" . mysqli_error($database);
				
			
			}	

			
		?>
	  
		<main>

		
			<div class="t-group">

				<div class="t-group__header">
					<div class="c-hero c--blue c--profile u-margin-bottom-none">
						<h1></h1>
					</div>    
					<div class="t-group__title-bg u-width-full u-color-bg-dark-gray">
					</div>
					<h1 class="t-group__title u-color-white u-text-align-center"><?php echo $groupname ; ?></h1>
				</div>

				<div class="t-group__toolbar u-position-relative u-border-bottom u-padding-left-md u-color-bg-white u-width-full u-display-flex u-align-center   u--space-between">
				</div>  
				<div class="t-group__main u-margin-left-xxlg">
					<h2 class="u-margin-top-xxlg">Settings</h2>
					<form name="gs" id="gs" action="group-settings.php" method="post">
						<input type="hidden"  name="groupid" id="groupid" value="<?php echo $groupid; ?>" >
						<h4 class="u-margin-bottom-lg">Group Settings</h4>
						<div class="u-margin-left-lg">
							<div class="c-checkbox u-margin-top-xlg">
								<input type="checkbox" name="joinrequest" id="joinrequest" value="joinrequest" class="c-checkbox" <?php if ($joinrequest == 1) {echo "checked='checked'";} ?>>
								<label for="joinrequest">Notify me when a request to join the group has been made</label>
							</div>
							<p>Notify me when a member does any of the following:</p>
							<div class="c-checkbox u-margin-top-xlg">
								<input type="checkbox" name="workoutcompleted" value="workoutcompleted" class="c-checkbox" <?php if ($workoutcompleted == 1) {echo "checked='checked'";} ?>>
								<label for="workoutcompleted">Completes a workout</label>
							</div>
							<div class="c-checkbox u-margin-top-xlg">
								<input type="checkbox" name="message" value="message" class="c-checkbox" <?php if ($message == 1) {echo "checked='checked'";} ?>>
								<label for="message">Sends me a message</label>
							</div>
							<div class="c-checkbox u-margin-top-xlg">
								<input type="checkbox" name="wallpost" value="wallpost" class="c-checkbox" <?php if ($wallpost == 1) {echo "checked='checked'";} ?>>
								<label for="wallpost">Posts to the wall</label>
							</div>
						</div>
						<br><button type="submit" id="editp2" name="editp2" value="savep2" class="c-button c--primary">Save</button>
					</form>
				</div>
			</div>
		
		
		
		</main>

	</body>
</html>