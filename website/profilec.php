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
		<script src="header.js.download"></script>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<?php
			$dashboard = 0;
			include("header_li_dashboard.php");

			if (isset($_POST['fuid'])){
				$fuid = $_POST['fuid'];
			} else {
				echo '<script type="text/javascript">window.location = "default.php"</script>';
				header('Location: default.php');
				exit();
			}

			if (isset($_POST['follow']) == "follow") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
					$query = "INSERT INTO users2users (uid1, uid2, connection) values ($uid, $fuid, 1)";
					$result = mysqli_query($database, $query);
					#echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	
			
			if (isset($_POST['unfollow']) == "unfollow") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
					$query = "delete from users2users where uid1 = $uid and uid2 = $fuid and connection = 1";
					$result = mysqli_query($database, $query);
					#echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	

			if (isset($_POST['train']) == "train") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
					$query = "INSERT INTO users2users (uid1, uid2, connection) values ($uid, $fuid, 2)";
					$result = mysqli_query($database, $query);
					#echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	
			
			if (isset($_POST['untrain']) == "untrain") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
					$query = "delete from users2users where uid1 = $uid and uid2 = $fuid and connection = 2";
					$result = mysqli_query($database, $query);
					#echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	

			$cf = 0;
			$ct = 0;
			$query = "select count(*) as cf from users2users where uid1 = $uid and uid2 = $fuid and connection = 1";
			$result = mysqli_query($database, $query); 
			$thisrow=mysqli_fetch_assoc($result);

			$cf = $thisrow['cf'];

			$query = "select count(*) as ct from users2users where uid1 = $uid and uid2 = $fuid and connection = 2";
			$result = mysqli_query($database, $query); 
			$thisrow=mysqli_fetch_assoc($result);

			$ct = $thisrow['ct'];

			$query = "select firstname, lastname from users where uid = $fuid";
			$result = mysqli_query($database, $query); 
			$thisrow=mysqli_fetch_assoc($result);

			$theirname 	= $thisrow['firstname']." ".$thisrow['lastname'];
			$theirfirstname = $thisrow['firstname'];
		
		
			$query = "select *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dob)), '%Y')+0 AS age from profiles where uid = $fuid";
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
			$age = $thisrow['age']; 
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
		
			if (isset($_POST['feed']) == "share") {
				$sharepublic = 0;
				$feedcontent = " ";
				if (isset($_POST['feedcontent'])) {$feedcontent = $_POST['feedcontent']; } 
				if (isset($_POST['public']) == "public") {$sharepublic = 1;}
				
				if (strlen($feedcontent) > 1) {
					$query = "INSERT INTO feeds (uid, feed, public) values ($uid, '$feedcontent', $sharepublic)";
					$result = mysqli_query($database, $query);
					//echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	

			$query = "select count(*) as nf from users2users where uid2 = $uid and connection = 1";
			$result = mysqli_query($database, $query); 
			$thisrow=mysqli_fetch_assoc($result);

			$numfollowers 	= $thisrow['nf'];
			
			$isct = $coach + $trainer; 
		?>
	  
		<main>

		
			<div class="c-hero c--blue c--profile">
				<h1></h1>
			</div>
			<div class="t-main t-profile">
				<div class="c-profile ">
					<div class="c-profile__image">
						<?php
							$picture = sprintf("%08d", $fuid);
							if (file_exists("profiles/$picture$profileimagetype")) {
								#echo "<br><br>filename = $filename <br><br>";
						?>
								<img src="profiles/<?php echo$picture.$profileimagetype;?>" >
						<?php 
							} 
						?>
					</div>
					<div class="c-profile__main">
						<div class="c-profile__top u-display-flex u-padding-lg">
							<div class="c-profile__details">
								<div class="c-profile__name u-display-flex u--align-center   u-text-size-large">
									<?php 
										echo $theirname
									?>
									<!--<a href="profileedit">
										<svg class="c-icon c--small u-fill-blue u-margin-left-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.2 15.3"><path d="M15.2 14.1l-0.7-3.8c0-0.2-0.1-0.4-0.3-0.5L4.7 0.3C4.5 0.1 4.3 0 4 0 3.8 0 3.5 0.1 3.4 0.3L0.3 3.4c-0.4 0.4-0.4 1 0 1.3l9.6 9.6c0.1 0.1 0.3 0.2 0.5 0.3l3.8 0.7c0.1 0 0.1 0 0.2 0 0.3 0 0.5-0.1 0.7-0.3C15.2 14.8 15.3 14.4 15.2 14.1zM11 13.7l2.7-2.7 0.2 1.1 -1.8 1.8L11 13.7zM1 4l0.7-0.7 6.8 6.8c0.1 0.1 0.1 0.1 0.2 0.1s0.2 0 0.2-0.1C9 10 9 9.8 8.9 9.7L2.1 2.9l0.7-0.7 1.4 1.4c0.1 0.1 0.1 0.1 0.2 0.1 0.1 0 0.2 0 0.2-0.1 0.1-0.1 0.1-0.3 0-0.4L3.3 1.7 4 1l9.4 9.4 -0.7 0.7L5.9 4.3c-0.1-0.1-0.3-0.1-0.5 0 -0.1 0.1-0.1 0.3 0 0.4l6.8 6.8 -0.7 0.7 -1.4-1.4c-0.1-0.1-0.3-0.1-0.5 0s-0.1 0.3 0 0.4l1.4 1.4 -0.7 0.7L1 4zM12.9 14l1.2-1.2 0.3 1.4L12.9 14z"></path></svg>          
									</a>-->
								</div>
								<div class="u-display-flex u--align-center">
									<span class="u-margin-left-md u-text-bold"><?php echo $profession;?></span>
									<!--<svg class="c-icon c--xxlarge u-fill-yellow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190.6 30.3">
										<polygon points="17.7 0 22.6 10 33.6 11.6 25.6 19.4 27.5 30.3 17.7 25.2 7.8 30.3 9.7 19.4 1.7 11.6 12.7 10 "></polygon>
										<polygon points="56.9 0 61.8 10 72.9 11.6 64.9 19.4 66.8 30.3 56.9 25.2 47.1 30.3 48.9 19.4 41 11.6 52 10 "></polygon>
										<polygon points="96.2 0 101.1 10 112.1 11.6 104.1 19.4 106 30.3 96.2 25.2 86.3 30.3 88.2 19.4 80.2 11.6 91.2 10 "></polygon>
										<polygon points="135.4 0 140.3 10 151.4 11.6 143.4 19.4 145.3 30.3 135.4 25.2 125.6 30.3 127.4 19.4 119.5 11.6 130.5 10 "></polygon>
										<polygon points="174.7 0 179.6 10 190.6 11.6 182.6 19.4 184.5 30.3 174.7 25.2 164.8 30.3 166.7 19.4 158.7 11.6 169.7 10 "></polygon>
									</svg>-->        
								</div>
								<div class="u-display-flex u--align-center u-margin-top-xlg">
									<!--<svg class="c-icon c--small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 12.1"><path d="M4.6 0C2.1 0 0 2.1 0 4.6c0 2 1.3 3.7 3.1 4.3L4 10.3c0.1 0.2 0.4 0.3 0.6 0.3 0.3 0 0.5-0.1 0.6-0.3L6.1 9c1.8-0.6 3.1-2.4 3.1-4.3C9.2 2.1 7.1 0 4.6 0zM5.6 8.3l-1 1.6 -1-1.6C1.9 7.9 0.8 6.4 0.8 4.6c0-2.1 1.7-3.8 3.8-3.8 2.1 0 3.8 1.7 3.8 3.8C8.4 6.4 7.2 7.9 5.6 8.3z"></path><path d="M1.9 4.6c0-1.5 1.2-2.7 2.7-2.7 0.3 0 0.6 0.1 0.9 0.2 0.1 0 0.3 0 0.3-0.1 0-0.1 0-0.3-0.1-0.3C5.4 1.4 5 1.4 4.6 1.4c-1.8 0-3.2 1.4-3.2 3.2 0 0.8 0.3 1.6 0.9 2.3 0 0.1 0.1 0.1 0.2 0.1 0.1 0 0.1 0 0.2-0.1 0.1-0.1 0.1-0.3 0-0.4C2.2 6 1.9 5.3 1.9 4.6z"></path><path d="M7.8 4c0-0.1-0.2-0.2-0.3-0.2C7.3 3.8 7.2 4 7.3 4.1c0 0.2 0 0.3 0 0.5 0 1.5-1.2 2.7-2.7 2.7 -0.4 0-0.8-0.1-1.2-0.3C3.3 7 3.1 7 3.1 7.2 3 7.3 3.1 7.4 3.2 7.5c0.4 0.2 0.9 0.3 1.4 0.3 1.8 0 3.2-1.4 3.2-3.2C7.8 4.4 7.8 4.2 7.8 4z"></path><path d="M6.9 3.2c0 0.1 0.1 0.1 0.2 0.1 0 0 0.1 0 0.1 0 0.1-0.1 0.2-0.2 0.1-0.3C7.2 2.6 6.9 2.3 6.6 2.1 6.5 2 6.4 2 6.3 2.1c-0.1 0.1-0.1 0.3 0 0.4C6.6 2.7 6.8 2.9 6.9 3.2z"></path><path d="M6.2 11.3H3c-0.2 0-0.4 0.2-0.4 0.4 0 0.2 0.2 0.4 0.4 0.4h3.2c0.2 0 0.4-0.2 0.4-0.4C6.6 11.5 6.4 11.3 6.2 11.3z"></path></svg>-->
									<span class="u-margin-left-md u-text-bold"><?php echo $location;?></span>
								</div>
								<div class="c-profile__followers">

									<form action='profilec.php' method='post'>
									<span><?php echo $numfollowers; ?> Followers &nbsp; </span>
										<input type="hidden"  name="fuid" value="<?php echo $fuid; ?>" >
											<?php if ($cf == 0) { ?>
												<button type="submit" id="follow" name="follow" value="follow" class="c-link u-margin-left-lg submitLink">Follow</button>
											<?php } else { ?>
												<button type="submit" id="unfollow" name="unfollow" value="unfollow" class="c-link u-margin-left-lg submitLink">Unfollow</button>
											<?php } ?>	
									</form>
									<!--<a class="c-link u-margin-left-lg">Follow</a>-->
								</div>
							</div>
							<div class="c-profile__contact u-text-align-center u-margin-top-xlg u-margin-right-lg">
								<!--<a class="c-button c--primary u-display-block u-margin-bottom-lg">Train&nbsp;with&nbsp;User</a>
								<BR><Button class="cc-friend__request c-button c--primary u-margin-right-sm">Train with me</button>-->

								<form action='profilec.php' method='post'>
									<input type="hidden"  name="fuid" value="<?php echo $fuid; ?>" >
									<?php if ($ct == 0) { ?>
										<button type="submit" id="train" name="train" value="train" class="c-button c--primary">Train with <?php echo $theirfirstname;?></button>
									<?php } else { ?>
										<button type="submit" id="untrain" name="untrain" value="untrain" class="c-button c--primary">Stop training with <?php echo $theirfirstname;?></button>
									<?php } ?>	
								</form>
								<form action='sendmessage.php' method='post'>
									<input type='hidden' name='fuid' value='<?php echo $fuid; ?>'>
									<!--<button class='c-button c--primary  u-margin-bottom-lg ' id='submit' name='submit' type='submit'>Send <?php echo $theirfirstname;?> a message - nyi</button>-->
									<button class='c-link u-display-block submitLink' id='submit' name='submit' type='submit'>Send <?php echo $theirfirstname;?> a message - nyi</button>
								</form>
								<!--<a class="c-profile__view c-button c--secondary u-display-block u-margin-bottom-lg">View <?php echo $theirfirstname;?>&#39;s Workouts - nyi</a>-->
								<br>
								<form action='workouts.php' method='post'>
									<input type='hidden' name='fuid' value='<?php echo $fuid; ?>'>
									<!--<button class='c-profile__view c-button c--secondary u-display-block u-margin-bottom-lg ssubmitLink sc-link' id='submit' name='submit' type='submit'>See <?php echo $theirfirstname;?>&#39;s Workouts - nyi</button>-->
									<button class='c-button c--primary  u-margin-bottom-lg ' id='submit' name='submit' type='submit'>See <?php echo $theirfirstname;?>&#39;s Workouts - nyi</button>
								</form>
							</div>
						</div>
						<div class="c-profile__buttons">
							<div class="js-profile-feed c-profile__button c--active">
								<span>Feed</span>
							</div>
							<div class="js-profile-about c-profile__button">
								<span>About</span>
							</div>
						</div>
					</div>
				</div>  
				<div class="c-grid__row u-margin-top-xxlg">
					<div class="c-grid__col4 hidden-xs-up">
						<div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
							<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Workouts</h4>
							<br>
							<?php
								$query = "SELECT wid, name FROM workouts where creator = $fuid order by created desc";
								$result = mysqli_query($database, $query); 

								if (mysqli_num_fields($result) > 0) {
              
									while ($thisrow=mysqli_fetch_row($result)) {
									 ?>   
										<form action='workouts.php' method='post'>
											<input type='hidden' id='wid' name='wid' value='<?php echo $thisrow[0]; ?>'>
											<button class='submitLink c-link' id='submit' name='submit' type='submit'><?php echo $thisrow[1]; ?></button>
										</form>
										<?php
									}
								}   

							?>


							<!--
							<ul>
								<li class="u-color-blue u-margin-bottom-md"><a href="profile" class="c-link">Fran</a></li>
								<li class="u-color-blue u-margin-bottom-md"><a href="profile" class="c-link">Aerobic Death</a></li>
							</ul> 
							-->
							<!--<a href="workouts" class="c-link u-text-size-small">See all of Users workouts &gt;</a>-->
							<form action='workouts.php' method='post'>
								<input type='hidden' name='fuid' value='<?php echo $fuid; ?>'>
								<button class='submitLink c-link' id='submit' name='submit' type='submit'>See all of Users workouts &gt;</button>
							</form>

						</div>     
						<div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
							<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Upcoming Events - NYI</h4>
							<ul>
								<li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
								<li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
								<li class="u-color-blue u-margin-bottom-md">Clicking a Workout Event does WHAT?</li>
							</ul> 
						</div>     
						<div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
							<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Groups</h4>
							<br>

							
							<?php
								$query = "SELECT u2g.gid, groupname FROM users2groups u2g, groups where u2g.uid = $fuid and u2g.gid = groups.gid order by groupname";
								$result = mysqli_query($database, $query); 

								if (mysqli_num_fields($result) > 0) {
              
									while ($thisrow=mysqli_fetch_row($result)) {
									 ?>   
										<form action='group1.php' method='post'>
											<input type='hidden' id='groupid' name='groupid' value='<?php echo $thisrow[0]; ?>'>
											<button class='submitLink c-link' id='submit' name='submit' type='submit'><?php echo $thisrow[1]; ?></button>
										</form>
										<?php
									}
								}   

							?>
							<!--
							<ul>
								<li class="u-color-blue u-margin-bottom-md"><a class="c-link">Racine Ericksonâ€™s Baseball Team</a></li>
								<li class="u-color-blue u-margin-bottom-md"><a class="c-link">Vagreville Vikings Soccer</a></li>
							</ul> 
							-->
						</div>  
					</div>
					<div class="c-grid__col8">
						<div class="js-feed c-feed c--active ">
							<?php 
								$query = "select feed, DATE_FORMAT(created, '%c/%d/%y %h:%i %p') from feeds where uid = $fuid and gid=0 and ga=0 order by fid desc";
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
													$picture = sprintf("%08d", $fuid);
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
													<span class="u-text-bold u-color-blue"><?php echo $theirname." "; ?></span> 
													
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
						<div class="js-about c-about ">
							<h1 class="u-text-size-title u-margin-top-none u-margin-bottom-md">About</h1>
							<div class="c-item">
								<div class="u-padding-xlg">
									<p class="u-margin-none u-margin-bottom-lg u-text-size-small"><?php echo $description;?></p>
    
									<div>
										<div class="c-grid__row">
											<div>
												<div class="u-text-size-quiet">
													Age: &nbsp; 
												</div>
												<?php echo $age; ?>
											</div>
											<div>
												<div class="u-text-size-quiet">
													Hometown:
												</div>
												<?php echo $hometown; ?>
											</div>
										</div>
										<div class="c-grid__row">
											<div>
												<div class="u-text-size-quiet">
													Gym:
												</div>
												<?php echo $gym; ?> &nbsp;
											</div>
											<div>
												<div class="u-text-size-quiet">
													Team:
												</div>
												<?php echo $team; ?> &nbsp;
											</div>
											<div>
												<div class="u-text-size-quiet">
													School:
												</div>
												<?php echo $school; ?> 
											</div>
										</div>
									</div>
								</div>
							</div>	
							<?php if ($lookingforclients == 1) { ?>
								<div class="c-item">
									<div class="u-padding-xlg">
										<div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Training description: &nbsp; 
													</div>
													<?php echo $trainingdescription; ?>
												</div>
											</div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Website: &nbsp; 
													</div>
													<?php echo $website; ?>
												</div>
											</div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Email: &nbsp; 
													</div>
													<?php echo $email; ?> &nbsp; &nbsp;
												</div>
												<div>
													<div class="u-text-size-quiet">
														Phone number:
													</div>
													<?php echo $phone; ?>
												</div>
											</div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Social Link: &nbsp; 
													</div>
													<?php echo $sociallink; ?>
												</div>
											</div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Live rate:  &nbsp; &nbsp;
													</div>
													<?php echo $liverate; ?>  &nbsp; &nbsp;
												</div>
												<div>
													<div class="u-text-size-quiet">
														Virtual rate:
													</div>
													<?php echo $virtualrate; ?> &nbsp;
												</div>
											</div>
											<div class="c-grid__row">
												<div>
													<div class="u-text-size-quiet">
														Keywords: &nbsp; 
													</div>
													<?php echo $keywords; ?>
												</div>
											</div>
										</div>
									</div>
								<!--<div class="u-border-top u-padding-xlg">
									<div class="c-grid__row">
										<div>
											<div class="u-text-size-quiet">Gym:</div>
											Steve Nash
										</div>
										<div>
											<div class="u-text-size-quiet">Team:</div>
											Nash Foxes
										</div>
										<div>
											<div class="u-text-size-quiet">School:</div>
											Las Vegas High
										</div>
									</div>
								</div>-->
								</div>
							<?php } ?>
						</div>  
					</div>
				</div>


			</div>		
		
		
		</main>

	</body>
</html>