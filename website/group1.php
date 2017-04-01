<?php
	include("sandt_li.php");
//	foreach ($_POST as $name => $value) { echo $name."=".$value."<br>"; }
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

			if (isset($_POST['feed']) == "share") {
				$ga = 0;
				$feedcontent = " ";
				if (isset($_POST['feedcontent'])) {$feedcontent = $_POST['feedcontent']; } 
				if (isset($_POST['ga']) == "ga") {$ga = 1;}
				
				if (strlen($feedcontent) > 1) {
					if ($ga == 1) {$feedcontent = substr($feedcontent,0,40);}
					$query = "INSERT INTO feeds (uid, feed, gid, ga) values ($uid, '$feedcontent', $groupid, $ga)";
					$result = mysqli_query($database, $query);
					//echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	
			
			$query = "select groupname, grouppurpose, grouplocation, imagetype, public from groups where gid=$groupid";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);

			$groupname 	= $thisrow['groupname'];
			$grouppurpose = $thisrow['grouppurpose'];
			$grouplocation = $thisrow['grouplocation'];
			$imagetype = $thisrow['imagetype'];
			$public = $thisrow['public'];
			
			$query = "select count(*) as members from users2groups where gid=$groupid";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);
			$members 	= $thisrow['members'];

			$query = "select count(*) as youareamember from users2groups where gid=$groupid and uid=$uid";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);
			$youareamember 	= $thisrow['youareamember'];
			
			$query = "select count(*) as youareanadmin from users2groups where gid=$groupid and uid=$uid and admin=1";
			$result = mysqli_query($database, $query); 
			$thisrow = mysqli_fetch_assoc($result);
			$youareanadmin 	= $thisrow['youareanadmin'];
			
			$joinrequest = 0;
			$workoutcompleted = 0;
			$message = 0;
			$wallpost = 0;
			
			if ($youareanadmin == 1) {
				$query = "select joinrequest, workoutcompleted, message, wallpost from users2groups where gid=$groupid and uid=$uid and admin=1";
				$result = mysqli_query($database, $query); 
				$thisrow = mysqli_fetch_assoc($result);

				$joinrequest 	= $thisrow['joinrequest'];
				$workoutcompleted = $thisrow['workoutcompleted'];
				$message = $thisrow['message'];
				$wallpost = $thisrow['wallpost'];
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
					<h1 class="t-group__title u-color-white u-text-align-center">
						<?php echo $groupname ; ?>
					</h1>
				</div>
				<div class="t-group__toolbar u-position-relative u-border-bottom u-padding-left-md u-color-bg-white u-width-full u-display-flex u-align-center   u--space-between">
					<div class="u-display-flex u-align-center u-hidden-sm-down">
										<form name="members" id="members" action="members.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="memberb" name="memberb" value="memberb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												<?php echo $members; ?> Members
											</button>
										</form>

							<?php 
								if ($youareamember == 1) { ?>
										<form name="invite" id="invite" action="invite.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="inviteb" name="inviteb" value="inviteb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												+ Invite Someone???
											</button>
										</form>
									<?php
								} else {
									?>
										<form name="join" id="join" action="group1.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="joinb" name="joinb" value="joinb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												+ Join Group
											</button>
										</form>
									<?php	
								}	
							?>
						
					</div>


					<div class="js-group-menu t-group__menu u-padding-top-lg u-padding-bottom-lg  u-hidden-xs-up c-link">Group Menu (needs styling for form submits)<svg class="c-icon c--xsmall u-fill-blue t-group__menu-arrow u-margin-left-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.8 12.9"><path d="M9.5 11.6c0.3 0.3 0.3 0.7 0 1 -0.1 0.1-0.3 0.2-0.5 0.2 -0.2 0-0.4-0.1-0.5-0.2L2.8 6.9c-0.3-0.3-0.3-0.7 0-1l5.6-5.7c0.3-0.3 0.7-0.3 1 0 0.3 0.3 0.3 0.7 0 1L4.3 6.4 9.5 11.6z"></path></svg>
					</div>
					<ul class="t-group__menu-items">  
						<li>	
										<form name="members" id="members" action="members.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="memberb" name="memberb" value="memberb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												<?php echo $members; ?> Members
											</button>
										</form>
						</li>				
							<?php 
								if ($youareamember == 1) { ?>
									<li>	
										<form name="invite" id="invite" action="invite.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="inviteb" name="inviteb" value="inviteb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												+ Invite Someone???
											</button>
										</form>
									</li>
									<?php
								} else {
									?>
									<li>
										<form name="join" id="join" action="group1.php" method="post">
											<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
											<button  type="submit" id="joinb" name="joinb" value="joinb" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none; 	font-size: 16px; line-height: 10px; ">
												+ Join Group
											</button>
										</form>
									</li>
									<?php	
								}	
							?>
						<!--<li><a>Send Group Message</a></li>-->
						<li><a>Calendar</a></li>
						<?php if ($youareanadmin == 1) { ?>
							<li>
							<form name="gs" id="gs" action="group-settings.php" method="post">
								<input type="hidden"  name="groupid" id="groupid" value="<?php echo $groupid; ?>" >
								<button  type="submit" id="gss" name="gss" value="gss" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none;">
									<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.5 35.9"><path d="M10.9 18.3c0 4 3.3 7.3 7.3 7.3 4 0 7.3-3.3 7.3-7.3S22.3 11 18.2 11C14.2 11 10.9 14.3 10.9 18.3zM23.3 18.3c0 2.8-2.3 5-5 5 -2.8 0-5-2.3-5-5 0-2.8 2.3-5 5-5C21 13.3 23.3 15.6 23.3 18.3z"></path><path d="M35.2 18.2L33 17.1c-0.1-1.2-0.3-2.3-0.7-3.4l1.6-2.1c0.6-0.7 0.6-1.8 0.2-2.6 -0.7-1.3-1.7-2.5-2.7-3.5 -0.4-0.5-1-0.7-1.6-0.7 -0.3 0-0.7 0.1-1 0.2l-2.3 1.1c-1.1-0.7-2.2-1.3-3.5-1.7l-0.6-2.6c-0.2-0.9-1-1.6-2-1.7C19.7 0 18.9 0 18.2 0c-0.7 0-1.4 0-2.2 0.1 -1 0.1-1.7 0.8-2 1.7l-0.6 2.6c-1.2 0.4-2.4 1-3.5 1.7L7.7 5.1c-0.3-0.1-0.6-0.2-1-0.2 -0.6 0-1.2 0.2-1.6 0.7C4.1 6.6 3.2 7.8 2.4 9 1.9 9.9 2 10.9 2.6 11.6l1.6 2.1c-0.4 1.1-0.6 2.3-0.7 3.4l-2.2 1.1c-0.9 0.4-1.4 1.4-1.3 2.3 0.2 1.5 0.6 3 1.1 4.5 0.3 0.9 1.2 1.4 2.1 1.5l2.6 0c0.6 0.9 1.2 1.7 2 2.4l-0.5 2.5c-0.2 0.9 0.2 1.9 1 2.4 1.3 0.9 2.8 1.5 4.3 2 0.2 0.1 0.5 0.1 0.7 0.1 0.7 0 1.3-0.3 1.8-0.8l1.7-2c0.5 0 1 0.1 1.5 0.1 0.5 0 1 0 1.5-0.1l1.7 2c0.4 0.5 1.1 0.8 1.8 0.8 0.2 0 0.5 0 0.7-0.1 1.5-0.5 2.9-1.2 4.3-2 0.8-0.5 1.2-1.5 1-2.4l-0.5-2.5c0.7-0.7 1.4-1.5 2-2.4l2.6 0c0.9 0 1.8-0.6 2.1-1.5 0.6-1.4 0.9-2.9 1.1-4.5C36.6 19.6 36.1 18.6 35.2 18.2zM26.2 8.8l3.5-1.6c0.9 0.9 1.7 2 2.3 3.1L30.7 12c-0.1-0.3-0.3-0.6-0.5-0.8 -0.2-0.4-0.7-0.5-1.1-0.3 -0.4 0.2-0.5 0.7-0.3 1.1 0.9 1.5 1.5 3.2 1.7 5 0.8 6.8-4.1 13-11 13.7 -3.3 0.4-6.5-0.6-9.1-2.6 -2.6-2.1-4.2-5-4.6-8.3s0.6-6.5 2.6-9.1c0.6-0.8 1.4-1.5 2.1-2.1 0 0 0 0 0.1 0 0.1-0.1 0.2-0.1 0.3-0.2 1.3-0.9 2.8-1.6 4.4-2l0 0c0.5-0.1 1-0.2 1.4-0.3 1.4-0.2 2.8-0.1 4.2 0.2l0 0C23 6.7 24.7 7.6 26.2 8.8zM16.3 2.4c0.6-0.1 1.3-0.1 1.9-0.1 0.6 0 1.3 0 1.9 0.1l0.5 2.2c-1.3-0.2-2.6-0.3-4-0.1 -0.3 0-0.6 0.1-0.9 0.1L16.3 2.4zM6.7 7.1l2 0.9c-0.5 0.5-1 1-1.5 1.6 -0.6 0.7-1.1 1.5-1.5 2.4l-1.4-1.8C5.1 9.1 5.8 8.1 6.7 7.1zM2.3 20.3l2-1c0 0.2 0 0.4 0.1 0.6 0.2 1.5 0.6 3 1.2 4.3l-2.3 0C2.8 22.9 2.5 21.6 2.3 20.3zM9.6 31.9l0.5-2.2c1.4 1 3 1.8 4.7 2.2l-1.4 1.7C12 33.2 10.7 32.6 9.6 31.9zM23.2 33.6l-1.5-1.8c1.7-0.4 3.3-1.2 4.7-2.2l0.5 2.2C25.7 32.6 24.5 33.2 23.2 33.6zM33.2 24.2l-2.3 0c0.7-1.5 1.1-3.2 1.3-4.9l2 1C34 21.6 33.7 22.9 33.2 24.2z"></path><path d="M7.6 18.3c0 2.4 0.8 4.8 2.3 6.6 0.2 0.2 0.4 0.3 0.6 0.3 0.2 0 0.3-0.1 0.5-0.2 0.3-0.3 0.4-0.7 0.1-1.1 -1.3-1.6-2-3.6-2-5.7 0-5 4.1-9.1 9.1-9.1 1 0 1.9 0.2 2.8 0.5 0.4 0.1 0.8-0.1 1-0.5 0.1-0.4-0.1-0.8-0.5-1 -1.1-0.4-2.2-0.5-3.3-0.5C12.4 7.7 7.6 12.5 7.6 18.3z"></path><path d="M27.3 18.3c0 5-4.1 9.1-9.1 9.1 -1.5 0-2.8-0.3-4.1-1 -0.4-0.2-0.8 0-1 0.3 -0.2 0.4 0 0.8 0.3 1 1.5 0.8 3.1 1.2 4.8 1.2 5.9 0 10.6-4.8 10.6-10.6 0-2.6-0.9-5.1-2.6-7C26 11 25.5 11 25.2 11.3c-0.3 0.3-0.3 0.8-0.1 1.1C26.5 14 27.3 16.1 27.3 18.3z"></path></svg>
								</button>
							</form>
							</li>
							<!--<a href="http:group-settings" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg">
								<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.5 35.9"><path d="M10.9 18.3c0 4 3.3 7.3 7.3 7.3 4 0 7.3-3.3 7.3-7.3S22.3 11 18.2 11C14.2 11 10.9 14.3 10.9 18.3zM23.3 18.3c0 2.8-2.3 5-5 5 -2.8 0-5-2.3-5-5 0-2.8 2.3-5 5-5C21 13.3 23.3 15.6 23.3 18.3z"></path><path d="M35.2 18.2L33 17.1c-0.1-1.2-0.3-2.3-0.7-3.4l1.6-2.1c0.6-0.7 0.6-1.8 0.2-2.6 -0.7-1.3-1.7-2.5-2.7-3.5 -0.4-0.5-1-0.7-1.6-0.7 -0.3 0-0.7 0.1-1 0.2l-2.3 1.1c-1.1-0.7-2.2-1.3-3.5-1.7l-0.6-2.6c-0.2-0.9-1-1.6-2-1.7C19.7 0 18.9 0 18.2 0c-0.7 0-1.4 0-2.2 0.1 -1 0.1-1.7 0.8-2 1.7l-0.6 2.6c-1.2 0.4-2.4 1-3.5 1.7L7.7 5.1c-0.3-0.1-0.6-0.2-1-0.2 -0.6 0-1.2 0.2-1.6 0.7C4.1 6.6 3.2 7.8 2.4 9 1.9 9.9 2 10.9 2.6 11.6l1.6 2.1c-0.4 1.1-0.6 2.3-0.7 3.4l-2.2 1.1c-0.9 0.4-1.4 1.4-1.3 2.3 0.2 1.5 0.6 3 1.1 4.5 0.3 0.9 1.2 1.4 2.1 1.5l2.6 0c0.6 0.9 1.2 1.7 2 2.4l-0.5 2.5c-0.2 0.9 0.2 1.9 1 2.4 1.3 0.9 2.8 1.5 4.3 2 0.2 0.1 0.5 0.1 0.7 0.1 0.7 0 1.3-0.3 1.8-0.8l1.7-2c0.5 0 1 0.1 1.5 0.1 0.5 0 1 0 1.5-0.1l1.7 2c0.4 0.5 1.1 0.8 1.8 0.8 0.2 0 0.5 0 0.7-0.1 1.5-0.5 2.9-1.2 4.3-2 0.8-0.5 1.2-1.5 1-2.4l-0.5-2.5c0.7-0.7 1.4-1.5 2-2.4l2.6 0c0.9 0 1.8-0.6 2.1-1.5 0.6-1.4 0.9-2.9 1.1-4.5C36.6 19.6 36.1 18.6 35.2 18.2zM26.2 8.8l3.5-1.6c0.9 0.9 1.7 2 2.3 3.1L30.7 12c-0.1-0.3-0.3-0.6-0.5-0.8 -0.2-0.4-0.7-0.5-1.1-0.3 -0.4 0.2-0.5 0.7-0.3 1.1 0.9 1.5 1.5 3.2 1.7 5 0.8 6.8-4.1 13-11 13.7 -3.3 0.4-6.5-0.6-9.1-2.6 -2.6-2.1-4.2-5-4.6-8.3s0.6-6.5 2.6-9.1c0.6-0.8 1.4-1.5 2.1-2.1 0 0 0 0 0.1 0 0.1-0.1 0.2-0.1 0.3-0.2 1.3-0.9 2.8-1.6 4.4-2l0 0c0.5-0.1 1-0.2 1.4-0.3 1.4-0.2 2.8-0.1 4.2 0.2l0 0C23 6.7 24.7 7.6 26.2 8.8zM16.3 2.4c0.6-0.1 1.3-0.1 1.9-0.1 0.6 0 1.3 0 1.9 0.1l0.5 2.2c-1.3-0.2-2.6-0.3-4-0.1 -0.3 0-0.6 0.1-0.9 0.1L16.3 2.4zM6.7 7.1l2 0.9c-0.5 0.5-1 1-1.5 1.6 -0.6 0.7-1.1 1.5-1.5 2.4l-1.4-1.8C5.1 9.1 5.8 8.1 6.7 7.1zM2.3 20.3l2-1c0 0.2 0 0.4 0.1 0.6 0.2 1.5 0.6 3 1.2 4.3l-2.3 0C2.8 22.9 2.5 21.6 2.3 20.3zM9.6 31.9l0.5-2.2c1.4 1 3 1.8 4.7 2.2l-1.4 1.7C12 33.2 10.7 32.6 9.6 31.9zM23.2 33.6l-1.5-1.8c1.7-0.4 3.3-1.2 4.7-2.2l0.5 2.2C25.7 32.6 24.5 33.2 23.2 33.6zM33.2 24.2l-2.3 0c0.7-1.5 1.1-3.2 1.3-4.9l2 1C34 21.6 33.7 22.9 33.2 24.2z"></path><path d="M7.6 18.3c0 2.4 0.8 4.8 2.3 6.6 0.2 0.2 0.4 0.3 0.6 0.3 0.2 0 0.3-0.1 0.5-0.2 0.3-0.3 0.4-0.7 0.1-1.1 -1.3-1.6-2-3.6-2-5.7 0-5 4.1-9.1 9.1-9.1 1 0 1.9 0.2 2.8 0.5 0.4 0.1 0.8-0.1 1-0.5 0.1-0.4-0.1-0.8-0.5-1 -1.1-0.4-2.2-0.5-3.3-0.5C12.4 7.7 7.6 12.5 7.6 18.3z"></path><path d="M27.3 18.3c0 5-4.1 9.1-9.1 9.1 -1.5 0-2.8-0.3-4.1-1 -0.4-0.2-0.8 0-1 0.3 -0.2 0.4 0 0.8 0.3 1 1.5 0.8 3.1 1.2 4.8 1.2 5.9 0 10.6-4.8 10.6-10.6 0-2.6-0.9-5.1-2.6-7C26 11 25.5 11 25.2 11.3c-0.3 0.3-0.3 0.8-0.1 1.1C26.5 14 27.3 16.1 27.3 18.3z"></path></svg>
							</a>-->
						<?php } ?>	
						
					</ul>
					
					<div class="u-display-flex u-align-center">
						<?php if ($youareanadmin == 1) { ?>
							<form name="gs" id="gs" action="group-settings.php" method="post">
								<input type="hidden"  name="groupid" id="groupid" value="<?php echo $groupid; ?>" >
								<button  type="submit" id="gss" name="gss" value="gss" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none;">
									<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.5 35.9"><path d="M10.9 18.3c0 4 3.3 7.3 7.3 7.3 4 0 7.3-3.3 7.3-7.3S22.3 11 18.2 11C14.2 11 10.9 14.3 10.9 18.3zM23.3 18.3c0 2.8-2.3 5-5 5 -2.8 0-5-2.3-5-5 0-2.8 2.3-5 5-5C21 13.3 23.3 15.6 23.3 18.3z"></path><path d="M35.2 18.2L33 17.1c-0.1-1.2-0.3-2.3-0.7-3.4l1.6-2.1c0.6-0.7 0.6-1.8 0.2-2.6 -0.7-1.3-1.7-2.5-2.7-3.5 -0.4-0.5-1-0.7-1.6-0.7 -0.3 0-0.7 0.1-1 0.2l-2.3 1.1c-1.1-0.7-2.2-1.3-3.5-1.7l-0.6-2.6c-0.2-0.9-1-1.6-2-1.7C19.7 0 18.9 0 18.2 0c-0.7 0-1.4 0-2.2 0.1 -1 0.1-1.7 0.8-2 1.7l-0.6 2.6c-1.2 0.4-2.4 1-3.5 1.7L7.7 5.1c-0.3-0.1-0.6-0.2-1-0.2 -0.6 0-1.2 0.2-1.6 0.7C4.1 6.6 3.2 7.8 2.4 9 1.9 9.9 2 10.9 2.6 11.6l1.6 2.1c-0.4 1.1-0.6 2.3-0.7 3.4l-2.2 1.1c-0.9 0.4-1.4 1.4-1.3 2.3 0.2 1.5 0.6 3 1.1 4.5 0.3 0.9 1.2 1.4 2.1 1.5l2.6 0c0.6 0.9 1.2 1.7 2 2.4l-0.5 2.5c-0.2 0.9 0.2 1.9 1 2.4 1.3 0.9 2.8 1.5 4.3 2 0.2 0.1 0.5 0.1 0.7 0.1 0.7 0 1.3-0.3 1.8-0.8l1.7-2c0.5 0 1 0.1 1.5 0.1 0.5 0 1 0 1.5-0.1l1.7 2c0.4 0.5 1.1 0.8 1.8 0.8 0.2 0 0.5 0 0.7-0.1 1.5-0.5 2.9-1.2 4.3-2 0.8-0.5 1.2-1.5 1-2.4l-0.5-2.5c0.7-0.7 1.4-1.5 2-2.4l2.6 0c0.9 0 1.8-0.6 2.1-1.5 0.6-1.4 0.9-2.9 1.1-4.5C36.6 19.6 36.1 18.6 35.2 18.2zM26.2 8.8l3.5-1.6c0.9 0.9 1.7 2 2.3 3.1L30.7 12c-0.1-0.3-0.3-0.6-0.5-0.8 -0.2-0.4-0.7-0.5-1.1-0.3 -0.4 0.2-0.5 0.7-0.3 1.1 0.9 1.5 1.5 3.2 1.7 5 0.8 6.8-4.1 13-11 13.7 -3.3 0.4-6.5-0.6-9.1-2.6 -2.6-2.1-4.2-5-4.6-8.3s0.6-6.5 2.6-9.1c0.6-0.8 1.4-1.5 2.1-2.1 0 0 0 0 0.1 0 0.1-0.1 0.2-0.1 0.3-0.2 1.3-0.9 2.8-1.6 4.4-2l0 0c0.5-0.1 1-0.2 1.4-0.3 1.4-0.2 2.8-0.1 4.2 0.2l0 0C23 6.7 24.7 7.6 26.2 8.8zM16.3 2.4c0.6-0.1 1.3-0.1 1.9-0.1 0.6 0 1.3 0 1.9 0.1l0.5 2.2c-1.3-0.2-2.6-0.3-4-0.1 -0.3 0-0.6 0.1-0.9 0.1L16.3 2.4zM6.7 7.1l2 0.9c-0.5 0.5-1 1-1.5 1.6 -0.6 0.7-1.1 1.5-1.5 2.4l-1.4-1.8C5.1 9.1 5.8 8.1 6.7 7.1zM2.3 20.3l2-1c0 0.2 0 0.4 0.1 0.6 0.2 1.5 0.6 3 1.2 4.3l-2.3 0C2.8 22.9 2.5 21.6 2.3 20.3zM9.6 31.9l0.5-2.2c1.4 1 3 1.8 4.7 2.2l-1.4 1.7C12 33.2 10.7 32.6 9.6 31.9zM23.2 33.6l-1.5-1.8c1.7-0.4 3.3-1.2 4.7-2.2l0.5 2.2C25.7 32.6 24.5 33.2 23.2 33.6zM33.2 24.2l-2.3 0c0.7-1.5 1.1-3.2 1.3-4.9l2 1C34 21.6 33.7 22.9 33.2 24.2z"></path><path d="M7.6 18.3c0 2.4 0.8 4.8 2.3 6.6 0.2 0.2 0.4 0.3 0.6 0.3 0.2 0 0.3-0.1 0.5-0.2 0.3-0.3 0.4-0.7 0.1-1.1 -1.3-1.6-2-3.6-2-5.7 0-5 4.1-9.1 9.1-9.1 1 0 1.9 0.2 2.8 0.5 0.4 0.1 0.8-0.1 1-0.5 0.1-0.4-0.1-0.8-0.5-1 -1.1-0.4-2.2-0.5-3.3-0.5C12.4 7.7 7.6 12.5 7.6 18.3z"></path><path d="M27.3 18.3c0 5-4.1 9.1-9.1 9.1 -1.5 0-2.8-0.3-4.1-1 -0.4-0.2-0.8 0-1 0.3 -0.2 0.4 0 0.8 0.3 1 1.5 0.8 3.1 1.2 4.8 1.2 5.9 0 10.6-4.8 10.6-10.6 0-2.6-0.9-5.1-2.6-7C26 11 25.5 11 25.2 11.3c-0.3 0.3-0.3 0.8-0.1 1.1C26.5 14 27.3 16.1 27.3 18.3z"></path></svg>
								</button>
							</form>
							<!--<a href="http:group-settings" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg">
								<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.5 35.9"><path d="M10.9 18.3c0 4 3.3 7.3 7.3 7.3 4 0 7.3-3.3 7.3-7.3S22.3 11 18.2 11C14.2 11 10.9 14.3 10.9 18.3zM23.3 18.3c0 2.8-2.3 5-5 5 -2.8 0-5-2.3-5-5 0-2.8 2.3-5 5-5C21 13.3 23.3 15.6 23.3 18.3z"></path><path d="M35.2 18.2L33 17.1c-0.1-1.2-0.3-2.3-0.7-3.4l1.6-2.1c0.6-0.7 0.6-1.8 0.2-2.6 -0.7-1.3-1.7-2.5-2.7-3.5 -0.4-0.5-1-0.7-1.6-0.7 -0.3 0-0.7 0.1-1 0.2l-2.3 1.1c-1.1-0.7-2.2-1.3-3.5-1.7l-0.6-2.6c-0.2-0.9-1-1.6-2-1.7C19.7 0 18.9 0 18.2 0c-0.7 0-1.4 0-2.2 0.1 -1 0.1-1.7 0.8-2 1.7l-0.6 2.6c-1.2 0.4-2.4 1-3.5 1.7L7.7 5.1c-0.3-0.1-0.6-0.2-1-0.2 -0.6 0-1.2 0.2-1.6 0.7C4.1 6.6 3.2 7.8 2.4 9 1.9 9.9 2 10.9 2.6 11.6l1.6 2.1c-0.4 1.1-0.6 2.3-0.7 3.4l-2.2 1.1c-0.9 0.4-1.4 1.4-1.3 2.3 0.2 1.5 0.6 3 1.1 4.5 0.3 0.9 1.2 1.4 2.1 1.5l2.6 0c0.6 0.9 1.2 1.7 2 2.4l-0.5 2.5c-0.2 0.9 0.2 1.9 1 2.4 1.3 0.9 2.8 1.5 4.3 2 0.2 0.1 0.5 0.1 0.7 0.1 0.7 0 1.3-0.3 1.8-0.8l1.7-2c0.5 0 1 0.1 1.5 0.1 0.5 0 1 0 1.5-0.1l1.7 2c0.4 0.5 1.1 0.8 1.8 0.8 0.2 0 0.5 0 0.7-0.1 1.5-0.5 2.9-1.2 4.3-2 0.8-0.5 1.2-1.5 1-2.4l-0.5-2.5c0.7-0.7 1.4-1.5 2-2.4l2.6 0c0.9 0 1.8-0.6 2.1-1.5 0.6-1.4 0.9-2.9 1.1-4.5C36.6 19.6 36.1 18.6 35.2 18.2zM26.2 8.8l3.5-1.6c0.9 0.9 1.7 2 2.3 3.1L30.7 12c-0.1-0.3-0.3-0.6-0.5-0.8 -0.2-0.4-0.7-0.5-1.1-0.3 -0.4 0.2-0.5 0.7-0.3 1.1 0.9 1.5 1.5 3.2 1.7 5 0.8 6.8-4.1 13-11 13.7 -3.3 0.4-6.5-0.6-9.1-2.6 -2.6-2.1-4.2-5-4.6-8.3s0.6-6.5 2.6-9.1c0.6-0.8 1.4-1.5 2.1-2.1 0 0 0 0 0.1 0 0.1-0.1 0.2-0.1 0.3-0.2 1.3-0.9 2.8-1.6 4.4-2l0 0c0.5-0.1 1-0.2 1.4-0.3 1.4-0.2 2.8-0.1 4.2 0.2l0 0C23 6.7 24.7 7.6 26.2 8.8zM16.3 2.4c0.6-0.1 1.3-0.1 1.9-0.1 0.6 0 1.3 0 1.9 0.1l0.5 2.2c-1.3-0.2-2.6-0.3-4-0.1 -0.3 0-0.6 0.1-0.9 0.1L16.3 2.4zM6.7 7.1l2 0.9c-0.5 0.5-1 1-1.5 1.6 -0.6 0.7-1.1 1.5-1.5 2.4l-1.4-1.8C5.1 9.1 5.8 8.1 6.7 7.1zM2.3 20.3l2-1c0 0.2 0 0.4 0.1 0.6 0.2 1.5 0.6 3 1.2 4.3l-2.3 0C2.8 22.9 2.5 21.6 2.3 20.3zM9.6 31.9l0.5-2.2c1.4 1 3 1.8 4.7 2.2l-1.4 1.7C12 33.2 10.7 32.6 9.6 31.9zM23.2 33.6l-1.5-1.8c1.7-0.4 3.3-1.2 4.7-2.2l0.5 2.2C25.7 32.6 24.5 33.2 23.2 33.6zM33.2 24.2l-2.3 0c0.7-1.5 1.1-3.2 1.3-4.9l2 1C34 21.6 33.7 22.9 33.2 24.2z"></path><path d="M7.6 18.3c0 2.4 0.8 4.8 2.3 6.6 0.2 0.2 0.4 0.3 0.6 0.3 0.2 0 0.3-0.1 0.5-0.2 0.3-0.3 0.4-0.7 0.1-1.1 -1.3-1.6-2-3.6-2-5.7 0-5 4.1-9.1 9.1-9.1 1 0 1.9 0.2 2.8 0.5 0.4 0.1 0.8-0.1 1-0.5 0.1-0.4-0.1-0.8-0.5-1 -1.1-0.4-2.2-0.5-3.3-0.5C12.4 7.7 7.6 12.5 7.6 18.3z"></path><path d="M27.3 18.3c0 5-4.1 9.1-9.1 9.1 -1.5 0-2.8-0.3-4.1-1 -0.4-0.2-0.8 0-1 0.3 -0.2 0.4 0 0.8 0.3 1 1.5 0.8 3.1 1.2 4.8 1.2 5.9 0 10.6-4.8 10.6-10.6 0-2.6-0.9-5.1-2.6-7C26 11 25.5 11 25.2 11.3c-0.3 0.3-0.3 0.8-0.1 1.1C26.5 14 27.3 16.1 27.3 18.3z"></path></svg>
							</a>-->
						<?php } ?>	
							<form name="mes" id="mes" action="" method="post">
								<input type="hidden"  name="groupidm" id="groupidm" value="<?php echo $groupid; ?>" >
								<button  type="submit" id="message" name="message" value="message" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none;">
									<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.3 38.9"><path d="M25.1 1.6c6.6 0 13.1 0 19.7 0 3.3 0 5.3 1.9 5.3 5.3 0 7.9 0 15.8 0 23.8 0 3.2-1.9 5.2-5.2 5.2 -13.3 0-26.5 0-39.8 0 -3.2 0-5.2-2-5.2-5.2 0-8 0-16 0-24 0-3.1 2-5.1 5.1-5.1C11.8 1.6 18.5 1.6 25.1 1.6zM6 32.5c0 0.1 0.1 0.1 0.1 0.2 13.1 0 26.1 0 39.4 0 -0.4-0.3-0.6-0.5-0.9-0.7 -3.2-2.2-6.3-4.4-9.5-6.7 -0.9-0.6-1.8-1.3-2.7-1.9 -0.8-0.6-1-1.2-0.6-1.7 0.4-0.6 1-0.6 1.8 0 0.1 0.1 0.1 0.1 0.2 0.2 4 2.8 8.1 5.7 12.1 8.5 0.3 0.2 0.6 0.3 0.9 0.5 0-8.1 0-16 0-24.1 -0.4 0.3-0.7 0.5-1 0.7 -6.2 4.8-12.3 9.7-18.5 14.5 -1.5 1.2-2.2 1.2-3.8 0C17.1 16.9 10.6 11.8 4 6.7 3.8 6.5 3.6 6.4 3.2 6.1c0 8.6 0 17 0 25.6 0.4-0.3 0.7-0.4 0.9-0.6 3.3-2.3 6.7-4.7 10-7 1.3-0.9 2.5-1.8 3.9-2.7 0.3-0.2 0.8-0.2 1.2-0.1 0.3 0.1 0.6 0.7 0.5 0.9 -0.1 0.4-0.4 0.8-0.8 1 -2.9 2.1-5.9 4.1-8.8 6.2C8.7 30.6 7.3 31.6 6 32.5zM45.7 5.1c0-0.1-0.1-0.2-0.1-0.2 -13.4 0-26.8 0-40.3 0C5.6 5.1 5.8 5.3 6 5.5c6.2 4.8 12.4 9.7 18.6 14.5 0.8 0.6 1.3 0.7 2 0 4.7-3.8 9.5-7.4 14.2-11.2C42.4 7.6 44 6.4 45.7 5.1z"></path></svg>
								</button>
							</form>
							<form name="cal" id="cal" action="" method="post">
								<input type="hidden"  name="groupidc" id="groupidc" value="<?php echo $groupid; ?>" >
								<button  type="submit" id="gss" name="gss" value="gss" class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg" style="background-color: transparent; border: none; 	outline: none;">
									<svg class="c-icon c--medium u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.8 15.1"><path d="M9.9 1.3c0-0.3 0-0.5 0-0.8 0-0.3 0.2-0.5 0.5-0.5 0.3 0 0.5 0.2 0.5 0.5 0 0.2 0 0.5 0 0.7 0 0 0 0.1 0 0.2 0.1 0 0.1 0 0.1 0 0.5 0 1 0 1.5 0 0.7 0 1.3 0.6 1.3 1.4 0 0 0 0.1 0 0.1 0 3.6 0 7.2 0 10.8 0 0.6-0.2 1-0.7 1.3 -0.2 0.1-0.5 0.2-0.7 0.2 -3.6 0-7.2 0-10.9 0 -0.9 0-1.5-0.7-1.5-1.6 0-2.8 0-5.7 0-8.5 0-0.7 0-1.5 0-2.2 0-0.3 0.1-0.7 0.3-0.9C0.6 1.5 1 1.3 1.5 1.3c0.4 0 0.9 0 1.3 0 0 0 0.1 0 0.2 0 0-0.1 0-0.2 0-0.3 0-0.2 0-0.3 0-0.5C2.9 0.2 3.1 0 3.4 0c0.2 0 0.5 0.1 0.5 0.4 0 0.1 0 0.3 0 0.5 0 0.1 0 0.3 0 0.4C5.9 1.3 7.9 1.3 9.9 1.3zM10.9 2.3c0 0.1 0 0.1 0 0.2 0 0.3 0 0.6 0 0.9 0 0.3-0.2 0.4-0.5 0.4 -0.3 0-0.5-0.2-0.5-0.5 0-0.3 0-0.6 0-0.9 0 0 0-0.1 0-0.1 -2 0-4 0-6.1 0 0 0.1 0 0.1 0 0.2 0 0.3 0 0.6 0 0.9 0 0.3-0.3 0.4-0.5 0.4 -0.3 0-0.4-0.2-0.4-0.5 0-0.3 0-0.6 0-0.9 0 0 0-0.1 0-0.1 -0.1 0-0.1 0-0.1 0 -0.4 0-0.8 0-1.2 0C1.2 2.3 1 2.5 1 2.8c0 0.7 0 1.4 0 2.1C1 4.9 1 5 1 5c4 0 7.9 0 11.9 0 0 0 0 0 0 0 0-0.7 0-1.5 0-2.2 0-0.3-0.2-0.5-0.5-0.5 -0.4 0-0.8 0-1.2 0C11.1 2.3 11 2.3 10.9 2.3zM1 9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.4 0 0-0.8 0-1.6 0-2.4C2.6 9 1.8 9 1 9zM10.5 9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.4 0 0-0.8 0-1.6 0-2.4C12.1 9 11.3 9 10.5 9zM7.3 8.9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.3 0 0-0.8 0-1.6 0-2.4C8.9 8.9 8.1 8.9 7.3 8.9zM6.5 11.3c0-0.8 0-1.6 0-2.4C5.8 9 5 9 4.2 9c0 0.8 0 1.6 0 2.4C5 11.3 5.8 11.3 6.5 11.3zM3.4 8.2c0-0.7 0-1.5 0-2.2C2.6 6 1.8 6 1 6c0 0.7 0 1.5 0 2.2C1.8 8.2 2.6 8.2 3.4 8.2zM10.5 8.2c0.8 0 1.6 0 2.4 0 0-0.7 0-1.5 0-2.2 -0.8 0-1.6 0-2.4 0C10.5 6.7 10.5 7.4 10.5 8.2zM7.3 6c0 0.7 0 1.5 0 2.2 0.8 0 1.6 0 2.4 0 0-0.7 0-1.5 0-2.2C8.9 6 8.1 6 7.3 6zM4.2 6c0 0.7 0 1.5 0 2.2 0.8 0 1.6 0 2.3 0 0-0.7 0-1.5 0-2.2C5.8 6 5 6 4.2 6zM3.4 12.1c-0.8 0-1.6 0-2.4 0 0 0.5 0 1.1 0 1.6 0 0.3 0.2 0.5 0.5 0.5 0.6 0 1.2 0 1.8 0 0 0 0.1 0 0.1 0C3.4 13.5 3.4 12.8 3.4 12.1zM10.5 12.1c0 0.7 0 1.4 0 2 0 0 0.1 0 0.1 0 0.6 0 1.1 0 1.7 0 0.4 0 0.6-0.2 0.6-0.6 0-0.5 0-0.9 0-1.4 0 0 0-0.1 0-0.1C12.1 12.1 11.3 12.1 10.5 12.1zM9.7 14.2c0-0.7 0-1.4 0-2 -0.8 0-1.6 0-2.4 0 0 0.7 0 1.4 0 2C8.1 14.2 8.9 14.2 9.7 14.2zM6.5 12.1c-0.8 0-1.6 0-2.3 0 0 0.7 0 1.4 0 2 0.8 0 1.6 0 2.3 0C6.5 13.5 6.5 12.8 6.5 12.1z"></path></svg>
								</button>
							</form>
							<!--<a class="u-display-flex u--align-center u-padding-lg c-link u-margin-right-xlg">
								<svg class="c-icon c--large u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.3 38.9"><path d="M25.1 1.6c6.6 0 13.1 0 19.7 0 3.3 0 5.3 1.9 5.3 5.3 0 7.9 0 15.8 0 23.8 0 3.2-1.9 5.2-5.2 5.2 -13.3 0-26.5 0-39.8 0 -3.2 0-5.2-2-5.2-5.2 0-8 0-16 0-24 0-3.1 2-5.1 5.1-5.1C11.8 1.6 18.5 1.6 25.1 1.6zM6 32.5c0 0.1 0.1 0.1 0.1 0.2 13.1 0 26.1 0 39.4 0 -0.4-0.3-0.6-0.5-0.9-0.7 -3.2-2.2-6.3-4.4-9.5-6.7 -0.9-0.6-1.8-1.3-2.7-1.9 -0.8-0.6-1-1.2-0.6-1.7 0.4-0.6 1-0.6 1.8 0 0.1 0.1 0.1 0.1 0.2 0.2 4 2.8 8.1 5.7 12.1 8.5 0.3 0.2 0.6 0.3 0.9 0.5 0-8.1 0-16 0-24.1 -0.4 0.3-0.7 0.5-1 0.7 -6.2 4.8-12.3 9.7-18.5 14.5 -1.5 1.2-2.2 1.2-3.8 0C17.1 16.9 10.6 11.8 4 6.7 3.8 6.5 3.6 6.4 3.2 6.1c0 8.6 0 17 0 25.6 0.4-0.3 0.7-0.4 0.9-0.6 3.3-2.3 6.7-4.7 10-7 1.3-0.9 2.5-1.8 3.9-2.7 0.3-0.2 0.8-0.2 1.2-0.1 0.3 0.1 0.6 0.7 0.5 0.9 -0.1 0.4-0.4 0.8-0.8 1 -2.9 2.1-5.9 4.1-8.8 6.2C8.7 30.6 7.3 31.6 6 32.5zM45.7 5.1c0-0.1-0.1-0.2-0.1-0.2 -13.4 0-26.8 0-40.3 0C5.6 5.1 5.8 5.3 6 5.5c6.2 4.8 12.4 9.7 18.6 14.5 0.8 0.6 1.3 0.7 2 0 4.7-3.8 9.5-7.4 14.2-11.2C42.4 7.6 44 6.4 45.7 5.1z"></path></svg>
							</a>
							<a class="u-display-block u-padding-lg c-link">
								<svg class="c-icon c--medium u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.8 15.1"><path d="M9.9 1.3c0-0.3 0-0.5 0-0.8 0-0.3 0.2-0.5 0.5-0.5 0.3 0 0.5 0.2 0.5 0.5 0 0.2 0 0.5 0 0.7 0 0 0 0.1 0 0.2 0.1 0 0.1 0 0.1 0 0.5 0 1 0 1.5 0 0.7 0 1.3 0.6 1.3 1.4 0 0 0 0.1 0 0.1 0 3.6 0 7.2 0 10.8 0 0.6-0.2 1-0.7 1.3 -0.2 0.1-0.5 0.2-0.7 0.2 -3.6 0-7.2 0-10.9 0 -0.9 0-1.5-0.7-1.5-1.6 0-2.8 0-5.7 0-8.5 0-0.7 0-1.5 0-2.2 0-0.3 0.1-0.7 0.3-0.9C0.6 1.5 1 1.3 1.5 1.3c0.4 0 0.9 0 1.3 0 0 0 0.1 0 0.2 0 0-0.1 0-0.2 0-0.3 0-0.2 0-0.3 0-0.5C2.9 0.2 3.1 0 3.4 0c0.2 0 0.5 0.1 0.5 0.4 0 0.1 0 0.3 0 0.5 0 0.1 0 0.3 0 0.4C5.9 1.3 7.9 1.3 9.9 1.3zM10.9 2.3c0 0.1 0 0.1 0 0.2 0 0.3 0 0.6 0 0.9 0 0.3-0.2 0.4-0.5 0.4 -0.3 0-0.5-0.2-0.5-0.5 0-0.3 0-0.6 0-0.9 0 0 0-0.1 0-0.1 -2 0-4 0-6.1 0 0 0.1 0 0.1 0 0.2 0 0.3 0 0.6 0 0.9 0 0.3-0.3 0.4-0.5 0.4 -0.3 0-0.4-0.2-0.4-0.5 0-0.3 0-0.6 0-0.9 0 0 0-0.1 0-0.1 -0.1 0-0.1 0-0.1 0 -0.4 0-0.8 0-1.2 0C1.2 2.3 1 2.5 1 2.8c0 0.7 0 1.4 0 2.1C1 4.9 1 5 1 5c4 0 7.9 0 11.9 0 0 0 0 0 0 0 0-0.7 0-1.5 0-2.2 0-0.3-0.2-0.5-0.5-0.5 -0.4 0-0.8 0-1.2 0C11.1 2.3 11 2.3 10.9 2.3zM1 9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.4 0 0-0.8 0-1.6 0-2.4C2.6 9 1.8 9 1 9zM10.5 9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.4 0 0-0.8 0-1.6 0-2.4C12.1 9 11.3 9 10.5 9zM7.3 8.9c0 0.8 0 1.6 0 2.4 0.8 0 1.6 0 2.3 0 0-0.8 0-1.6 0-2.4C8.9 8.9 8.1 8.9 7.3 8.9zM6.5 11.3c0-0.8 0-1.6 0-2.4C5.8 9 5 9 4.2 9c0 0.8 0 1.6 0 2.4C5 11.3 5.8 11.3 6.5 11.3zM3.4 8.2c0-0.7 0-1.5 0-2.2C2.6 6 1.8 6 1 6c0 0.7 0 1.5 0 2.2C1.8 8.2 2.6 8.2 3.4 8.2zM10.5 8.2c0.8 0 1.6 0 2.4 0 0-0.7 0-1.5 0-2.2 -0.8 0-1.6 0-2.4 0C10.5 6.7 10.5 7.4 10.5 8.2zM7.3 6c0 0.7 0 1.5 0 2.2 0.8 0 1.6 0 2.4 0 0-0.7 0-1.5 0-2.2C8.9 6 8.1 6 7.3 6zM4.2 6c0 0.7 0 1.5 0 2.2 0.8 0 1.6 0 2.3 0 0-0.7 0-1.5 0-2.2C5.8 6 5 6 4.2 6zM3.4 12.1c-0.8 0-1.6 0-2.4 0 0 0.5 0 1.1 0 1.6 0 0.3 0.2 0.5 0.5 0.5 0.6 0 1.2 0 1.8 0 0 0 0.1 0 0.1 0C3.4 13.5 3.4 12.8 3.4 12.1zM10.5 12.1c0 0.7 0 1.4 0 2 0 0 0.1 0 0.1 0 0.6 0 1.1 0 1.7 0 0.4 0 0.6-0.2 0.6-0.6 0-0.5 0-0.9 0-1.4 0 0 0-0.1 0-0.1C12.1 12.1 11.3 12.1 10.5 12.1zM9.7 14.2c0-0.7 0-1.4 0-2 -0.8 0-1.6 0-2.4 0 0 0.7 0 1.4 0 2C8.1 14.2 8.9 14.2 9.7 14.2zM6.5 12.1c-0.8 0-1.6 0-2.3 0 0 0.7 0 1.4 0 2 0.8 0 1.6 0 2.3 0C6.5 13.5 6.5 12.8 6.5 12.1z"></path></svg>
							</a>-->
					</div>
				</div>  
				<div class="t-group__main c-grid__row">
					<div class="c-grid__col4 u-hidden-xs-down">
						<div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
							<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Upcoming Events???</h4>
							<ul>
							  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
							  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
							  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
							</ul> 
						</div>       
						<div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
							<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Group Announcements</h4>
							<ul>
							<?php 
								$query = "select feed, DATE_FORMAT(created, '%c/%d/%y %h:%i %p') from feeds where uid = $uid and gid = $groupid and ga = 1 order by fid desc";
								$result = mysqli_query($database, $query); 
								while ($thisrow=mysqli_fetch_row($result))  
								{
									$feed = $thisrow[0]; 
									$created = $thisrow[1]; 
								?>
									<li class="u-color-blue u-margin-bottom-md"><?php echo $created."<br>".$feed;?></li>
								<?php
								}
								?>
							</ul> 
						</div>    
					</div>
					
					<div class="c-grid__col8">

						<div class="js-feed c-feed c--active ">
							<form name="gaf" id="gaf" action='group1.php' method='post'>
								<div class="c-share">
									<div class="c-share__icons">
										&nbsp;
										<!--<div class="c-share__label u-display-inline-block u-text-bold u-color-blue">
											<svg class="c-icon c--small u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 8"><path d="M8.3 1.1H8V0.6C8 0.3 7.8 0 7.5 0H5.6C5.2 0 5 0.3 5 0.6v0.5H0.9C0.4 1.1 0 1.5 0 1.9v4.2C0 6.6 0.4 7 0.9 7h1.7c0.5 0.6 1.2 1 2 1 0.8 0 1.6-0.4 2-1h1.7c0.5 0 0.9-0.4 0.9-0.9V1.9C9.2 1.5 8.8 1.1 8.3 1.1zM5.6 0.6h1.9v0.5H5.6V0.6zM4.6 7.4c-1.1 0-2-0.9-2-2 0-1.1 0.9-2 2-2 1.1 0 2 0.9 2 2C6.6 6.6 5.7 7.4 4.6 7.4zM8.3 6.5H7c0.1-0.3 0.2-0.6 0.2-1C7.2 4 6 2.9 4.6 2.9 3.2 2.9 2 4 2 5.5c0 0.4 0.1 0.7 0.2 1H0.9c-0.2 0-0.3-0.1-0.3-0.3V2.5h5.9c0.1 0 0.2-0.1 0.2-0.2S6.6 2.1 6.5 2.1H0.6V1.9c0-0.2 0.1-0.3 0.3-0.3h7.4c0.2 0 0.3 0.1 0.3 0.3v0.1h-1c-0.1 0-0.2 0.1-0.2 0.2s0.1 0.2 0.2 0.2h1v3.7C8.6 6.3 8.5 6.5 8.3 6.5z"></path><path d="M6 4.9c0-0.1-0.2-0.1-0.3-0.1C5.6 4.8 5.6 4.9 5.6 5c0.1 0.1 0.1 0.3 0.1 0.4 0 0.6-0.5 1.1-1.1 1.1S3.5 6.1 3.5 5.5c0-0.6 0.5-1.1 1.1-1.1 0.1 0 0.3 0 0.4 0.1 0.1 0 0.2 0 0.3-0.1 0-0.1 0-0.2-0.1-0.3C5 4 4.8 4 4.6 4 3.8 4 3.1 4.6 3.1 5.5c0 0.8 0.7 1.5 1.5 1.5 0.8 0 1.5-0.7 1.5-1.5C6.1 5.3 6 5.1 6 4.9z"></path><circle cx="4.6" cy="5.5" r="0.5"></circle></svg>
												Add Photo
										</div>
										<div class="c-share__label u-display-inline-block  u-text-bold u-color-blue">
											<svg class="c-icon c--small u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 8.6"><path d="M8.8 5.4h-1c0 0-0.1 0-0.1 0L7 5.8V5.2C7 5 6.8 4.9 6.6 4.9h-6C0.4 4.9 0.3 5 0.3 5.2v1.1c0 0.2 0.1 0.3 0.3 0.3h0.7v1.6c0 0.2 0.1 0.3 0.3 0.3h5C6.8 8.6 7 8.4 7 8.3V7.8l0.8 0.4c0 0 0.1 0 0.1 0h1C9 8.2 9.2 8 9.2 7.9V5.7C9.2 5.6 9 5.4 8.8 5.4zM1.9 7.9V6.4h2.7c0.1 0 0.2-0.1 0.2-0.2S4.8 6 4.6 6H0.9V5.5h5.4V6H5.7C5.5 6 5.4 6.1 5.4 6.2s0.1 0.2 0.2 0.2h0.7v1.5H1.9zM8.5 7.5H8.1V6.7c0-0.1-0.1-0.2-0.2-0.2 -0.1 0-0.2 0.1-0.2 0.2v0.7L7.1 7.1V6.5L8 6.1h0.6V7.5z"></path><path d="M2.2 4.5C3 4.5 3.7 4 4.1 3.4 4.5 4 5.2 4.5 6 4.5c1.2 0 2.2-1 2.2-2.2C8.3 1 7.3 0 6 0 5.2 0 4.5 0.4 4.1 1.1 3.7 0.4 3 0 2.2 0 1 0 0 1 0 2.2 0 3.5 1 4.5 2.2 4.5zM6 0.7c0.9 0 1.6 0.7 1.6 1.6S6.9 3.8 6 3.8c-0.9 0-1.6-0.7-1.6-1.6S5.2 0.7 6 0.7zM2.2 0.7c0.9 0 1.6 0.7 1.6 1.6S3.1 3.8 2.2 3.8c-0.9 0-1.6-0.7-1.6-1.6S1.4 0.7 2.2 0.7z"></path><path d="M2.2 2.9c0.4 0 0.7-0.3 0.7-0.7 0-0.4-0.3-0.7-0.7-0.7 -0.4 0-0.7 0.3-0.7 0.7C1.5 2.6 1.8 2.9 2.2 2.9zM2.2 2c0.1 0 0.3 0.1 0.3 0.3S2.4 2.5 2.2 2.5C2.1 2.5 2 2.4 2 2.2S2.1 2 2.2 2z"></path><path d="M6 2.9c0.4 0 0.7-0.3 0.7-0.7 0-0.4-0.3-0.7-0.7-0.7 -0.4 0-0.7 0.3-0.7 0.7C5.3 2.6 5.6 2.9 6 2.9zM6 2c0.1 0 0.3 0.1 0.3 0.3S6.2 2.5 6 2.5 5.8 2.4 5.8 2.2 5.9 2 6 2z"></path></svg>
												Add Video
										</div>-->
									</div>
									<div class="u-padding-sides-lg">
										<textarea name="feedcontent" id="feedcontent" placeholder="Share your accomplishments!"></textarea>
									</div>
									<div class="u-display-flex u--align-center u--space-between u-padding-lg">
										<div class="c-checkbox c--quiet">
											<input type="checkbox" value="ga" id="ga" name="ga">
											<label for="ga">Group Announcement (40 character limit)</label>
										</div>    
										<input type="hidden"  name="groupid" value="<?php echo $groupid; ?>" >
										<button type="submit" id="feed" name="feed" value="share" class="c-button c--primary">Share</button>
									</div>
								</div> 
							</form>
							<?php 
								$query = "select feed, DATE_FORMAT(created, '%c/%d/%y %h:%i %p') from feeds where uid = $uid and gid = $groupid  and ga = 0 order by fid desc";
								$result = mysqli_query($database, $query); 
								while ($thisrow=mysqli_fetch_row($result))  
								{
									$feed = $thisrow[0]; 
									$created = $thisrow[1]; 
								?>
									<article class="c-post u-display-flex u--column">
										<div class="c-post__profile u-display-flex u-padding-lg">
											<div class="c-post__image u-margin-right-lg">
												<?php
													$picture = sprintf("%08d", $uid);
													if (file_exists("profiles/$picture$profileimagetype")) {
														#echo "<br><br>filename = $filename <br><br>";
												?>
														<img src="profiles/<?php echo$picture.$profileimagetype;?>" >
												<?php 
													} 
												?>
											</div>
											<div class="c-post__details">
												<h1 class="u-margin-none">
													<span class="u-text-bold u-color-blue"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']." "; ?></span> 
													
												</h1>
												<span class="u-text-size-small"><?php echo $created;?></span>
											</div>
										</div>
				  
										<div class="c-post__content u-padding-lg">
											<p class="u-margin-bottom-lg u-margin-top-none"><?php echo $feed;?></p>
											<!--<div class="c-post__content-image">
												<img src="./profile_files/profile-pic.jpg">
											</div>-->
										</div>
									</article>
								<?php
								}
								?>
						</div>    
					
					</div>
				</div>

			</div>
		</main>

	</body>
</html>