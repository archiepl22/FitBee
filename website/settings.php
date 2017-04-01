<?php
	include("sandt_li.php");
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
			$dashboard = 0;
			include("header_li_dashboard.php");

			if (isset($_POST['submit']))
				{
				$public =       		0;
				$private_search =      	0;
				$private_profileview =  0;
				$private_messages =     0;
				$private_workoutsview = 0;
				$private_calendarview = 0;
				$private_groupinvites = 0;
				
				if(isset($_POST['public'])) 	{$public = $_POST['public'];}
				if(isset($_POST['search'])) 	{$private_search = $_POST['search'];}
				if(isset($_POST['profile'])) 	{$private_profileview = $_POST['profile'];}
				if(isset($_POST['messages'])) 	{$private_messages = $_POST['messages'];}
				if(isset($_POST['workouts'])) 	{$private_workoutsview = $_POST['workouts'];}
				if(isset($_POST['calendar'])) 	{$private_calendarview = $_POST['calendar'];}
				if(isset($_POST['groups'])) 	{$private_groupinvites = $_POST['groups'];}

				$query = "update profiles set public = $public, private_search = $private_search, private_profileview = $private_profileview, private_messages = $private_messages, private_workoutsview = $private_workoutsview, private_calendarview = $private_calendarview, private_groupinvites = $private_groupinvites where uid=$uid";
				$result = mysqli_query($database, $query); 

				}
			
			//$uid = userid
			$query = "select public, private_search, private_profileview, private_messages, private_workoutsview, private_calendarview, private_groupinvites from profiles where uid=$uid";
			$result = mysqli_query($database, $query); 
					
			if (mysqli_num_rows($result) == 0) {
				# exit;
				header("Location: default.php");
			}		
			else {
				$thisrow = mysqli_fetch_assoc($result);
				$public =       		$thisrow['public'];
				$private_search =      	$thisrow['private_search'];
				$private_profileview =  $thisrow['private_profileview'];
				$private_messages =     $thisrow['private_messages'];
				$private_workoutsview = $thisrow['private_workoutsview'];
				$private_calendarview = $thisrow['private_calendarview'];
				$private_groupinvites = 	$thisrow['private_groupinvites'];

				//public, private_search, private_profileview, private_messages, private_workoutsview, private_calendarview, private_groupinvite
			}	
		?>
						
		<main>

			<div class="t-form t-main">
				<form action="settings" method="POST">
					<h2 class="u-margin-top-xxlg">Settings  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						<button href="" id="submit" name="submit" type="submit" class="c-button c--primary">Save</button>
					</h2>
					
					<h4 class="u-margin-bottom-lg">My Privacy Settings</h4>
					<div class="u-margin-left-lg">
						<?php	$zero = ($public == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($public == 1) ? 'checked="checked"' : ''; ?>
						<label for="public" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="public" class="u-margin-right-md" <?php echo $zero; ?>>
							Public
						</label>
						<label for="private" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="public" class="u-margin-right-md" <?php echo $one; ?>>
							Private
						</label>
					</div>
    
					<h4 class="u-margin-bottom-lg">Custom Privacy Settings</h4>
					
					<h5 class="u-text-normal u-text-size-normal">Search</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_search == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_search == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="search" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all users to search for me
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="search" class="u-margin-right-md" <?php echo $one; ?>>
							Do not allow users to search for me
						</label>
					</div>
					
					<h5 class="u-text-normal u-text-size-normal">Profile</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_profileview == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_profileview == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="profile" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all followers to view my full profile
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="profile" class="u-margin-right-md" <?php echo $one; ?>>
							Only allow followers that I follow back to view my full profile
						</label>
					</div>
					
					<h5 class="u-text-normal u-text-size-normal">Messages</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_messages == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_messages == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="messages" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all followers to message me
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="messages" class="u-margin-right-md" <?php echo $one; ?>>
							Only allow followers that I follow back to message me
						</label>
					</div>
    
					<h5 class="u-text-normal u-text-size-normal">Workouts</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_workoutsview == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_workoutsview == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="workouts" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all followers to view my workouts
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="workouts" class="u-margin-right-md" <?php echo $one; ?>>
							Only allow followers that I follow back to view my workouts
						</label>
					</div>
					
					<h5 class="u-text-normal u-text-size-normal">Calendar</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_calendarview == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_calendarview == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="calendar" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all followers to view my calendar
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="calendar" class="u-margin-right-md" <?php echo $one; ?>>
							Only allow followers that I follow back to view my calendar
						</label>
					</div>
					
					<h5 class="u-text-normal u-text-size-normal">Groups</h5>
					<div class="u-margin-left-lg">
						<?php	$zero = ($private_groupinvites == 0) ? 'checked="checked"' : ''; ?>
						<?php	$one  = ($private_groupinvites == 1) ? 'checked="checked"' : ''; ?>
						<label for="private" class="u-display-flex u--align-center">
							<input type="radio" value="0" name="groups" class="u-margin-right-md" <?php echo $zero; ?>>
							Allow all followers to invite me into groups
						</label>
						<label for="public" class="u-display-flex u--align-center u-margin-top-xlg">
							<input type="radio" value="1" name="groups" class="u-margin-right-md" <?php echo $one; ?>>
							Only allow followers that I follow back to invite me into groups
						</label>
					</div>
    
<!--					<h5 class="u-text-normal u-text-size-normal u-margin-bottom-none">Blocked users</h5>
					<div class="u-margin-left-lg">
						<span class="u-text-size-small">Blocked users cannot see any of your information.</span>
						<ul>
							<li class="u-margin-bottom-lg">
								<span class="u-text-bold u-margin-right-lg">Timothy James</span><a class="c-link">Unblock</a>
							</li>
							<li class="u-margin-bottom-lg">
								<span class="u-text-bold u-margin-right-lg">Timothy James</span><a class="c-link">Unblock</a>
							</li>
						</ul>
					</div>
-->
				</form>
			</div>

		</main>

	</body>
</html>