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

			if (isset($_POST['follow']) == "follow") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
					$query = "INSERT INTO users2users (uid1, uid2, connection) values ($uid, $fuid, 1)";
					$result = mysqli_query($database, $query);
					echo "Error: " . $query . "<br>" . mysqli_error($database);
				}
			}	
			
			if (isset($_POST['unfollow']) == "unfollow") {
				if (isset($_POST['fuid'])) {
					$fuid = $_POST['fuid'];  
	 				$query = "delete from users2users where uid1 = $uid and uid2 = $fuid and connection = 1";
					$result = mysqli_query($database, $query);
					echo "Error: " . $query . "<br>" . mysqli_error($database);
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
			
			if (isset($_POST['keywords'])) {
				$search_text = $_POST['keywords'];
				$search_text = ltrim($search_text);
				$search_text = rtrim($search_text);
				$qs = "";
				if (strlen($search_text) > 0) {
				
					$kt=split(" ",$search_text);//Breaking the string to array of words
		
					// Now let us generate the sql 
					while(list($key,$val)=each($kt)){
						if($val<>" " and strlen($val) > 0){$qs .= " firstname like '%$val%' or lastname like '%$val%' or keywords like '%$val%' or ";}
					}
					$qs=substr($qs,0,(strlen($qs)-3));
				}
			}
		?>
	  
		<main>
			<div class="c-hero c--blue">
				<h1>Connect</h1>
			</div>
			<div class="t-main">
				<h1>Search</h1>
				<form  action='connect.php' method='post'>
					<div class="c-search">
					
						<div class="c-search__keywords">
							<label class="u-color-blue u-text-bold" for="keywords">Keywords</label>
							<input type="text" name="keywords" placeholder="Type a friend's name or a keyword">
						</div>
						<div class="c-search__filters u-display-flex u--align-center u-margin-top-none">
							<div class="u-padding-none">
								<div class="c-checkbox">
									<input type="checkbox" name="trainers" value="trainers" class="c-checkbox">
									<label class="u-text-bold u-text-size-normal u-color-blue" for="trainers">Search for Coaches and Trainers only</label>
								</div>
							</div>
							<div class="u-margin-left-auto">
								<button type="submit" name="search" value="search" class="c-button c--primary u-display-block u-margin-left-auto">Search</button>
							</div>
						</div>
					</div>
				</form>

				<h2>Results</h2>
					<?php
						#$query = "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer FROM users, profiles WHERE users.uid = profiles.uid";

						if (isset($_POST['search']) == "search") {
							if ((isset($_POST['trainers']))) {
								$query = "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1, u2u.uid2 FROM profiles, users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 = $uid WHERE users.uid = profiles.uid and lookingforclients=1";
								$query =     "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1 as u1, u2u.uid2 as u2, u4u.uid1 as u3, u4u.uid2 as u4, u2u.connection , u4u.connection FROM users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 =$uid and connection=1 , profiles left outer join users2users u4u on u4u.uid2=profiles.uid and u4u.uid1 =$uid and connection=2 WHERE users.uid = profiles.uid and lookingforclients=1";
								if (strlen($qs) > 0){
									$query .= " and (".$qs.")"; 
								}
							} else {
								$query = "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1, u2u.uid2 FROM profiles, users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 = $uid WHERE users.uid = profiles.uid";
								$query =     "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1 as u1, u2u.uid2 as u2, u4u.uid1 as u3, u4u.uid2 as u4, u2u.connection , u4u.connection FROM users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 =$uid and connection=1 , profiles left outer join users2users u4u on u4u.uid2=profiles.uid and u4u.uid1 =$uid and connection=2 WHERE users.uid = profiles.uid";
								if (strlen($qs) > 0){
									$query .= " and (".$qs.")"; 
								}
							}
						} else {
							#$query =    "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1, u2u.uid2 FROM profiles, users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 = $uid WHERE users.uid = profiles.uid";
							#                            0         1         2           3          4                5      6        7                  8               9               10              11              12                                                                                                                                        
							$query =     "SELECT users.uid, firstname, lastname, profession, location, profileimagetype, coach, trainer, lookingforclients, u2u.uid1 as u1, u2u.uid2 as u2, u4u.uid1 as u3, u4u.uid2 as u4, u2u.connection , u4u.connection FROM users left outer join users2users u2u on u2u.uid2=users.uid and u2u.uid1 =$uid and connection=1 , profiles left outer join users2users u4u on u4u.uid2=profiles.uid and u4u.uid1 =$uid and connection=2 WHERE users.uid = profiles.uid";

							}
						$result = mysqli_query($database, $query); 

						if (mysqli_num_fields($result) > 0) {
              
							while ($thisrow=mysqli_fetch_row($result)) {
								$lookingforclients = $thisrow[8];
								$fuid = $thisrow[0];
								if ($uid != $fuid) {
									if ($thisrow[10] == NULL) { $following = 0; } else { $following =  $thisrow[10]; }
									if ($thisrow[12] == NULL) { $training = 0; } else { $training =  $thisrow[12]; }
								?>   
									<article class="c-friend">   <!--<article class="c-friend c--trainer">-->
										<div class="c-friend__wrapper u-color-bg-white u-border u-padding-md">
											
												<div class="c-friend__image">
													<?php
														$tuid = $thisrow[0];
														$picture = sprintf("%08d", $tuid);
														$profileimagetype=$thisrow['5'];
														#	echo "filename = profiles/$picture$profileimagetype <br><br>";
														if (file_exists("profiles/$picture$profileimagetype")) {
													?>
															<img src="profiles/<?php echo$picture.$profileimagetype;?>" >
													<?php 
														} else {
													?>
															<svg class="c-icon t-profile__edit-avatar u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.7 53.7"><path d="M23.4 25.8c7.1 0 12.9-5.8 12.9-12.9C36.3 5.8 30.5 0 23.4 0S10.5 5.8 10.5 12.9C10.5 20 16.3 25.8 23.4 25.8zM23.4 3.4c5.3 0 9.5 4.3 9.5 9.5 0 5.3-4.3 9.5-9.5 9.5s-9.5-4.3-9.5-9.5C13.8 7.6 18.1 3.4 23.4 3.4z"></path><path d="M45.6 39.1c-3.2-5.6-8.4-9.7-14.5-11.6 -0.8-0.3-1.7 0.1-2 0.9 -1.3 2.7-3.2 4.9-5.7 6.5 -2.4-1.6-4.4-3.8-5.7-6.5 -0.4-0.8-1.2-1.1-2-0.9C9.5 29.4 4.4 33.6 1.1 39.1c-0.3 0.5-0.3 1.2 0 1.7 4.6 7.9 13.1 12.8 22.2 12.8S41 48.7 45.6 40.8C45.9 40.3 45.9 39.7 45.6 39.1zM31.4 31.2c0.9 0.4 1.8 0.8 2.7 1.2 -1.4 2.4-3.3 5.2-5.7 7.4 -0.3-0.2-0.6-0.5-0.9-0.8 -0.6-0.5-1.2-1.1-1.9-1.6C28 35.8 29.9 33.7 31.4 31.2zM21.1 37.4c-0.6 0.5-1.3 1-1.9 1.6 -0.3 0.3-0.6 0.5-0.9 0.8 -2.4-2.2-4.4-5-5.7-7.4 0.9-0.5 1.8-0.9 2.7-1.2C16.8 33.7 18.8 35.8 21.1 37.4zM24.5 50.3v-7.4c0-0.6-0.5-1.1-1.1-1.1s-1.1 0.5-1.1 1.1v7.4C15.1 49.9 8.5 46.1 4.6 40c1.6-2.5 3.7-4.7 6.2-6.4 1.6 2.8 3.9 6.1 6.9 8.5 0.4 0.3 1 0.3 1.4 0 0.6-0.4 1.1-0.9 1.7-1.4 0.8-0.8 1.7-1.6 2.6-2.1 0.9 0.5 1.7 1.3 2.6 2.1 0.6 0.5 1.1 1 1.7 1.4 0.2 0.2 0.4 0.2 0.7 0.2 0.2 0 0.5-0.1 0.7-0.2 3-2.4 5.4-5.8 6.9-8.5 2.5 1.7 4.6 3.8 6.2 6.4C38.3 46.1 31.7 49.9 24.5 50.3z"></path></svg>
													<?php		
														}
													?>
												</div>
												<div class="c-friend__details u-margin-left-lg">
													<form action='profilec.php' method='post'>
														<input type="hidden"  name="fuid" value="<?php echo $fuid; ?>" >
														<!--<button class='submitLink c-link' id='submit' name='submit' type='submit'><?php echo $thisrow[1]; ?></button>-->
															<h1 class="u-color-blue u-text-bold u-margin-none u-line-height-sm u-margin-bottom-md u-margin-top-sm">
																<button class='submitLink2 u-text-bold' id='submit' name='submit' type='submit'><?php echo $thisrow['1']; ?> <?php echo $thisrow['2']; ?></button>
															</h1>
													</form>		
													<span class="ccc-friend__title u-margin-right-sm"><?php echo $thisrow['3']; ?></span>
													<svg class="c-icon c--xxlarge u-fill-yellow c-friend__rating" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190.6 30.3"><polygon points="17.7 0 22.6 10 33.6 11.6 25.6 19.4 27.5 30.3 17.7 25.2 7.8 30.3 9.7 19.4 1.7 11.6 12.7 10 "></polygon><polygon points="56.9 0 61.8 10 72.9 11.6 64.9 19.4 66.8 30.3 56.9 25.2 47.1 30.3 48.9 19.4 41 11.6 52 10 "></polygon><polygon points="96.2 0 101.1 10 112.1 11.6 104.1 19.4 106 30.3 96.2 25.2 86.3 30.3 88.2 19.4 80.2 11.6 91.2 10 "></polygon><polygon points="135.4 0 140.3 10 151.4 11.6 143.4 19.4 145.3 30.3 135.4 25.2 125.6 30.3 127.4 19.4 119.5 11.6 130.5 10 "></polygon><polygon points="174.7 0 179.6 10 190.6 11.6 182.6 19.4 184.5 30.3 174.7 25.2 164.8 30.3 166.7 19.4 158.7 11.6 169.7 10 "></polygon></svg>
													<div class="c-friend__location u-display-flex u--align-center u-color-grey">
														<!--<svg class="c-icon c--small u-fill-grey u-margin-right-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 12.1"><path d="M4.6 0C2.1 0 0 2.1 0 4.6c0 2 1.3 3.7 3.1 4.3L4 10.3c0.1 0.2 0.4 0.3 0.6 0.3 0.3 0 0.5-0.1 0.6-0.3L6.1 9c1.8-0.6 3.1-2.4 3.1-4.3C9.2 2.1 7.1 0 4.6 0zM5.6 8.3l-1 1.6 -1-1.6C1.9 7.9 0.8 6.4 0.8 4.6c0-2.1 1.7-3.8 3.8-3.8 2.1 0 3.8 1.7 3.8 3.8C8.4 6.4 7.2 7.9 5.6 8.3z"></path><path d="M1.9 4.6c0-1.5 1.2-2.7 2.7-2.7 0.3 0 0.6 0.1 0.9 0.2 0.1 0 0.3 0 0.3-0.1 0-0.1 0-0.3-0.1-0.3C5.4 1.4 5 1.4 4.6 1.4c-1.8 0-3.2 1.4-3.2 3.2 0 0.8 0.3 1.6 0.9 2.3 0 0.1 0.1 0.1 0.2 0.1 0.1 0 0.1 0 0.2-0.1 0.1-0.1 0.1-0.3 0-0.4C2.2 6 1.9 5.3 1.9 4.6z"></path><path d="M7.8 4c0-0.1-0.2-0.2-0.3-0.2C7.3 3.8 7.2 4 7.3 4.1c0 0.2 0 0.3 0 0.5 0 1.5-1.2 2.7-2.7 2.7 -0.4 0-0.8-0.1-1.2-0.3C3.3 7 3.1 7 3.1 7.2 3 7.3 3.1 7.4 3.2 7.5c0.4 0.2 0.9 0.3 1.4 0.3 1.8 0 3.2-1.4 3.2-3.2C7.8 4.4 7.8 4.2 7.8 4z"></path><path d="M6.9 3.2c0 0.1 0.1 0.1 0.2 0.1 0 0 0.1 0 0.1 0 0.1-0.1 0.2-0.2 0.1-0.3C7.2 2.6 6.9 2.3 6.6 2.1 6.5 2 6.4 2 6.3 2.1c-0.1 0.1-0.1 0.3 0 0.4C6.6 2.7 6.8 2.9 6.9 3.2z"></path><path d="M6.2 11.3H3c-0.2 0-0.4 0.2-0.4 0.4 0 0.2 0.2 0.4 0.4 0.4h3.2c0.2 0 0.4-0.2 0.4-0.4C6.6 11.5 6.4 11.3 6.2 11.3z"></path></svg>-->
														<?php echo $thisrow['4']; ?>
													</div>
													<div class="c-friend__buttons">
														<form action='connect.php' method='post'>
															<input type="hidden"  name="fuid" value="<?php echo $fuid; ?>" >
															<!--<button class='submitLink c-link' id='submit' name='submit' type='submit'><?php echo $thisrow[1]; ?></button>-->
															<?php
																if ($lookingforclients > 0) { ?>
																	<?php if ($training == 0) { ?>
																		<button type="submit" id="train" name="train" value="train" class="c-button c--secondary">Train with me</button>
																	<?php } else { ?>
																		<button type="submit" id="untrain" name="untrain" value="untrain" class="c-button c--secondary">Stop training with me</button>
																	<?php } ?>	
																	<!--<button class="cc-friend__request c-button c--primary u-margin-right-sm">Train with me</button>-->
																<?php } ?>
																<?php if ($following == 0) { ?>
																	<button type="submit" id="follow" name="follow" value="follow" class="c-button c--primary">Follow</button>
																<?php } else { ?>
																	<button type="submit" id="unfollow" name="unfollow" value="unfollow" class="c-button c--primary">Unfollow</button>
																<?php } ?>	
														</form>
													</div>
												</div>
												
										</div>
									</article>
							<?php
								}
							}
						}	
						?>
    
			</div>
		</main>

	</body>
</html>