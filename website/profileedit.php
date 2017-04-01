<?php
	include("sandt_li.php");
	//foreach ($_POST as $name => $value) { echo $name."=".$value."<br>"; }	
	//foreach ($_SESSION as $name => $value) {echo $name."=".$value."<br>";}	
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

			if (isset($_POST['editp1']) == "savep1") {
				$coach = 0;
				$trainer = 0; 
				$profession = ""; 
				$location = "";
				if (isset($_POST['coach'])) {$coach = 1;}
				if (isset($_POST['trainer'])) {$trainer = 1; }
				if (isset($_POST['profession'])) {$profession = $_POST['profession'];} 
				if (isset($_POST['location'])) {$location = $_POST['location']; }

				$query = "update profiles set coach=$coach, trainer=$trainer, profession='$profession', location='$location' where uid = $uid";
				$result = mysqli_query($database, $query);
				//echo "Error: " . $query . "<br>" . mysqli_error($database);
				
			}	
			
			if (isset($_POST['editp2']) == "savep2") {
				$description = "";
				$dob = "";
				$hometown = "";
				$gym = "";
				$team = "";
				$school = "";
				$website = "";
				$email = "";
				$phone = "";
				$sociallink = "";
				$lookingforclients = 0; 
				$trainingdescription = ""; 
				$liverate = 0; 
				$virtualrate = 0; 
				$keywords = ""; 
				if (isset($_POST['description'])) {$description = $_POST['description']; }
				if (isset($_POST['dob'])) {$dob = $_POST['dob']; }
				if (isset($_POST['hometown'])) {$hometown = $_POST['hometown']; }
				if (isset($_POST['gym'])) {$gym = $_POST['gym']; }
				if (isset($_POST['team'])) {$team = $_POST['team'];} 
				if (isset($_POST['school'])) {$school = $_POST['school']; }
				if (isset($_POST['website'])) {$website = $_POST['website']; }
				if (isset($_POST['email'])) {$email = $_POST['email']; }
				if (isset($_POST['phone'])) {$phone = $_POST['phone']; }
				if (isset($_POST['sociallink'])) {$sociallink = $_POST['sociallink']; }
				if (isset($_POST['lookingforclients'])) 
					{if ($_POST['lookingforclients'] == "yes") {$lookingforclients = 1;} else {$lookingforclients = 0;} }
				if (isset($_POST['trainingdescription'])) {$trainingdescription = $_POST['trainingdescription']; }
				if (isset($_POST['liverate'])) {$liverate = $_POST['liverate']; }
				if (isset($_POST['virtualrate'])) {$virtualrate = $_POST['virtualrate']; }
				if (isset($_POST['keywords'])) {$keywords = $_POST['keywords']; }


				
				$query = "update profiles set description='$description', dob='$dob', 
					hometown='$hometown', gym='$gym', team='$team', school='$school', website='$website', email='$email', phone='$phone', sociallink='$sociallink',
					lookingforclients='$lookingforclients', trainingdescription='$trainingdescription', liverate=$liverate, virtualrate=$virtualrate,
					keywords='$keywords'  where uid = $uid";
				$result = mysqli_query($database, $query);
				//echo "Error: " . $query . "<br>" . mysqli_error($database);
				
			}	


			
			$query = "select * from profiles where uid = $uid";
			$result = mysqli_query($database, $query); 
			$thisrow=mysqli_fetch_assoc($result);

			$public 	= $thisrow['public'];
			$profileimagetype = $thisrow['profileimagetype'];
			$coach = $thisrow['coach'];
			$trainer = $thisrow['trainer']; 
			$private_search = $thisrow['private_search']; 
			$private_profileview = $thisrow['private_profileview']; 
			$private_messages = $thisrow['private_messages']; 
			$private_workoutsview = $thisrow['private_workoutsview']; 
			$private_calendarview = $thisrow['private_calendarview']; 
			$private_groupinvites = $thisrow['private_groupinvites']; 
			$profession = $thisrow['profession']; 
			$location = $thisrow['location']; 
			$description = $thisrow['description']; 
			$dob = $thisrow['dob']; 
			$hometown = $thisrow['hometown']; 
			$gym = $thisrow['gym']; 
			$team = $thisrow['team']; 
			$school = $thisrow['school']; 
			$website = $thisrow['website']; 
			$email = $thisrow['email']; 
			$phone = $thisrow['phone']; 
			$sociallink = $thisrow['sociallink']; 
			$lookingforclients = $thisrow['lookingforclients']; 
			$trainingdescription = $thisrow['trainingdescription']; 
			$liverate = $thisrow['liverate']; 
			$virtualrate = $thisrow['virtualrate']; 
			$keywords = $thisrow['keywords']; 

		?>
	  
		<main>
			<div class="c-hero c--blue c--profile">
				<h1></h1>
			</div>
			<div class="t-main t-profile">

				<div class="c-profile">
					<div class="c-profile__image t-profile__edit-image u-text-align-center u-color-bg-white u-border u-padding-sm">
					  <form   name="ppic" id="ppic" action="profilepicupload.php" method="post" target="_blank" >
						<?php
							$picture = sprintf("%08d", $uid);
							if (file_exists("profiles/$picture$profileimagetype")) {
								#echo "<br><br>filename = $filename <br><br>";
						?>
								<img src="profiles/<?php echo$picture.$profileimagetype;?>" >
								<button type="submit" id="picc" name="picc" value="picc" class="c-link t-profile__edit-photo u-text-size-normal u-margin-top-md">
									Change your profile photo
								</button>
						<?php 
							} else { 
						?>
							<svg class="c-icon t-profile__edit-avatar u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.7 53.7"><path d="M23.4 25.8c7.1 0 12.9-5.8 12.9-12.9C36.3 5.8 30.5 0 23.4 0S10.5 5.8 10.5 12.9C10.5 20 16.3 25.8 23.4 25.8zM23.4 3.4c5.3 0 9.5 4.3 9.5 9.5 0 5.3-4.3 9.5-9.5 9.5s-9.5-4.3-9.5-9.5C13.8 7.6 18.1 3.4 23.4 3.4z"></path><path d="M45.6 39.1c-3.2-5.6-8.4-9.7-14.5-11.6 -0.8-0.3-1.7 0.1-2 0.9 -1.3 2.7-3.2 4.9-5.7 6.5 -2.4-1.6-4.4-3.8-5.7-6.5 -0.4-0.8-1.2-1.1-2-0.9C9.5 29.4 4.4 33.6 1.1 39.1c-0.3 0.5-0.3 1.2 0 1.7 4.6 7.9 13.1 12.8 22.2 12.8S41 48.7 45.6 40.8C45.9 40.3 45.9 39.7 45.6 39.1zM31.4 31.2c0.9 0.4 1.8 0.8 2.7 1.2 -1.4 2.4-3.3 5.2-5.7 7.4 -0.3-0.2-0.6-0.5-0.9-0.8 -0.6-0.5-1.2-1.1-1.9-1.6C28 35.8 29.9 33.7 31.4 31.2zM21.1 37.4c-0.6 0.5-1.3 1-1.9 1.6 -0.3 0.3-0.6 0.5-0.9 0.8 -2.4-2.2-4.4-5-5.7-7.4 0.9-0.5 1.8-0.9 2.7-1.2C16.8 33.7 18.8 35.8 21.1 37.4zM24.5 50.3v-7.4c0-0.6-0.5-1.1-1.1-1.1s-1.1 0.5-1.1 1.1v7.4C15.1 49.9 8.5 46.1 4.6 40c1.6-2.5 3.7-4.7 6.2-6.4 1.6 2.8 3.9 6.1 6.9 8.5 0.4 0.3 1 0.3 1.4 0 0.6-0.4 1.1-0.9 1.7-1.4 0.8-0.8 1.7-1.6 2.6-2.1 0.9 0.5 1.7 1.3 2.6 2.1 0.6 0.5 1.1 1 1.7 1.4 0.2 0.2 0.4 0.2 0.7 0.2 0.2 0 0.5-0.1 0.7-0.2 3-2.4 5.4-5.8 6.9-8.5 2.5 1.7 4.6 3.8 6.2 6.4C38.3 46.1 31.7 49.9 24.5 50.3z"></path></svg>
							<button  type="submit" id="pica" name="pica" value="pica" class="c-link t-profile__edit-photo u-text-size-normal u-margin-top-md">
								Add a profile photo
							</button>
						<?php
							}
						?>
					  </form>
					  <form   action="profileedit.php" method="post" >
							<button  type="submit" class="c-link t-profile__edit-photo u-text-size-normal u-margin-top-md">
								REFRESH PHOTO AFTER UPLOAD
							</button>
					  </form>
					</div>
				<form   name="editp1f" id="editp1f" action="profileedit.php" method="post">
					<div class="c-profile__main">
						<div class="c-profile__top u-display-flex u-padding-lg">
							<div class="c-profile__details u-width-full">
								<div class="c-profile__name u-display-flex u--align-center u-margin-top-none u-text-size-large">
									<?php echo $_SESSION['firstname']." ".$_SESSION['lastname']." "; ?>
								</div>
								<div>
									<div class="t-profile__edit-profession">
										<span class="u-margin-right-lg u-text-bold">
											Are you a coach or a trainer?
										</span>
											<div class="t-profile__edit-check">
												<div class="c-checkbox">
													<input type="checkbox"  name="trainer" id="trainer" value="trainer" class="c-checkbox" <?php if ($trainer == 1) {echo "checked='checked'";} ?>><label for="trainer">Trainer</label>
												<!--</div>
												<div class="c-checkbox u-margin-left-md">-->
													&nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox"  name="coach" id="coach" value="coach" class="c-checkbox" <?php if ($coach == 1) {echo "checked='checked'";} ?>><label for="coach">Coach</label>
												</div>
											</div>
										
									</div>
            
									<div class="u-margin-top-xlg">
										<label>What is your profession?</label>
										<input type="text"  name="profession" id="profession" value="<?php echo $profession; ?>" placeholder="e.g. Head Coach, Nutritionist" class="u-margin-top-sm u-width-full">
									</div>
									<div class="u-margin-top-xlg">
										<label>What is your current location?</label>
										<input type="text"  name="location" id="location" value="<?php echo $location; ?>"  placeholder="Location" class="u-margin-top-sm u-width-full">
									</div>
									<div class="u-margin-top-xlg">
										<button type="submit" id="editp1" name="editp1" value="savep1" class="c-button c--primary">Save</button>
										<br><br><a href="profile" class="c-button c--primary">Back to Profile</a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</form>
				</div>

				<div class="c-grid__row u-margin-top-xxlg">
					<div class="c-grid__col4 hidden-xs-up">
					</div>
					<div class="c-grid__col8 u-display-block">

						<div class="js-about c-about u-display-block u-margin-top-none">
							<h1 class="u-text-size-title u-margin-top-none u-margin-bottom-md">About</h1>
							<div class="c-item u-padding-xlg">
								<form name="editp2f" id="editp2f" action="profileedit.php" method="post" class="t-profile__edit"  >
									<button type="submit" id="editp2" name="editp2" value="savep2" class="c-button c--primary">Save</button>
									<a href="profile" class="c-button c--primary">Back to Profile</a>
									<br><br>
									<label>Description</label>
									<textarea name="description" id="description" placeholder="Write something about yourself."><?php echo $description; ?></textarea>
									<div class="t-profile__edit-input">
										<label>Date of Birth </label>
										&nbsp; <input type="date"  name="dob" id="dob" value="<?php echo $dob; ?>" >
									</div>
									<div class="t-profile__edit-input">
										<label>Hometown </label>
										&nbsp; <input type="text"  name="hometown" id="hometown" value="<?php echo $hometown; ?>" placeholder="Hometown">
									</div>
									<div class="t-profile__edit-input">
										<label>Gym </label>
										&nbsp; <input type="text"  name="gym" id="gym" value="<?php echo $gym; ?>" placeholder="Gym">
									</div>
									<div class="t-profile__edit-input">
										<label>Team </label>
										&nbsp; <input type="text"  name="team" id="team" value="<?php echo $team; ?>" placeholder="Team">
									</div>
									<div class="t-profile__edit-input">
										<label>School </label>
										&nbsp; <input type="text"  name="school" id="school" value="<?php echo $school; ?>" placeholder="School">
									</div>
									<hr>
									<div class="t-profile__edit-input">
										<label>Website </label>
										&nbsp; <input type="url"  name="website" id="website" value="<?php echo $website; ?>" placeholder="Website">
									</div>
									<div class="t-profile__edit-input">
										<label>Email </label>
										&nbsp; <input type="email"  name="email" id="email" value="<?php echo $email; ?>" placeholder="Email">
									</div>
									<div class="t-profile__edit-input">
										<label>Phone </label>
										&nbsp; <input type="tel"  name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Phone">
									</div>
									<div class="t-profile__edit-input">
										<label>Social Link </label>
										&nbsp; <input type="text"  name="sociallink" id="sociallink" value="<?php echo $sociallink; ?>" placeholder="Social Link">
									</div>
									
									<?php 
										if (($coach == 1) || ($trainer == 1)) {
									?>
											<hr>
											<div class="t-profile__edit-input u-margin-bottom-xxlg">
												<label>Are you currently looking for clients?</label>
												<div class="c-checkbox">
													<input type="radio" name="lookingforclients" id="lookingforclients" <?php if ($lookingforclients == 1) {echo "checked='checked'";} ?> value="yes" class="c-checkbox"><label for="looking">Yes</label>
												</div>
												<div class="c-checkbox">
													<input type="radio"  name="lookingforclients" id="lookingforclients" <?php if ($lookingforclients == 0) {echo "checked='checked'";} ?> value="no" class="c-checkbox"><label for="looking">No</label>
												</div>
											</div>
											<label>Training Description</label>
											<textarea name="trainingdescription" id="trainingdescription" placeholder="E.g. What do your training services profide? What results can clients expect?"><?php echo $trainingdescription; ?></textarea>
											<div class="u-margin-top-xxlg u-margin-bottom-xxlg">
												<div class="t-profile__edit-input">
													<label>Live Rate </label>
													&nbsp; $ &nbsp; <input   name="liverate" id="liverate" value="<?php echo $liverate; ?>" class="t-profile__edit-number" type="number" placeholder="">/hr
												</div>
												<div class="t-profile__edit-input u-margin-bottom-md">
													<label>Virtual Rate </label>
													&nbsp; $ &nbsp; <input  name="virtualrate" id="virtualrate" value="<?php echo $virtualrate; ?>" class="t-profile__edit-number" type="number" placeholder="">/hr
												</div>
											</div>
											<label>Keywords to help clients find you</label>
											<textarea name="keywords" id="keywords" class="u-margin-bottom-xxlg" placeholder="E.g. Cardio, Nutrition, Olympic Lifting, Soccer"><?php echo $keywords; ?></textarea>
									<?php }	?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		  
		</main>

	</body>
</html>